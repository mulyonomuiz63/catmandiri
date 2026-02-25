<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\UserMemberCategory;
use App\Repositories\User\AccountBalanceRepository;
use DB;
use App\Models\User;

class NotificationHandler extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected $accountBalanceRepository;

    public function __construct(AccountBalanceRepository $accountBalanceRepository)
    {
        $this->accountBalanceRepository = $accountBalanceRepository;
    }


    public function __invoke(Request $request)
    {
        try {
            $payload = json_decode($request->getContent());
            $serverKey = config('services.midtrans.serverKey');
            
            // 1. Validasi Signature
            $signature = hash("sha512", $payload->order_id . $payload->status_code . $payload->gross_amount . $serverKey);
            if ($payload->signature_key !== $signature) {
                return response(['message' => 'Invalid signature'], 403);
            }

            $status = $payload->transaction_status;
            $orderId = $payload->order_id;
            $setting = Setting::first();
            $message = '';

            // 2. Cari Data (Transaction atau Account Balance)
            $trx = Transaction::where('code', $orderId)->first();
            $isTopUp = false;

            if (!$trx) {
                $trx = $this->accountBalanceRepository->findCode($orderId);
                $isTopUp = true;
            }

            if (!$trx) return response(['message' => 'Transaction not found'], 404);

            // 3. Mapping Status (Ringkas status ke format internal)
            $internalStatus = match($status) {
                'settlement', 'capture' => 'done',
                'pending'               => 'pending',
                'deny', 'cancel'        => 'failed',
                'expire'                => 'expired',
                default                 => 'pending'
            };

            // 4. Eksekusi Update Berdasarkan Tipe Transaksi
            if ($isTopUp) {
                DB::transaction(function () use ($trx, $internalStatus) {
                    $trx->update(['transaction_status' => $internalStatus]);
                    if ($internalStatus === 'done') {
                        $user = User::find($trx->user_id);
                        $user->increment('account_balance', $trx->top_up_balance);
                    }
                });
                $amount = $trx->top_up_balance;
            } else {
                $trx->update([
                    'transaction_status' => $internalStatus,
                    'expired_date' => $internalStatus === 'done' 
                        ? ($trx->period_type == 'day' ? now()->addDays($trx->active_period) : now()->addMonths($trx->active_period)) 
                        : $trx->expired_date
                ]);

                if ($internalStatus === 'done') {
                    UserMemberCategory::create([
                        'transaction_id' => $trx->id,
                        'user_id' => $trx->user_id,
                        'category_id' => $trx->category_id,
                        'description' => $trx->description,
                        'member_categories' => $trx->member_categories,
                        'expired_date' => $trx->expired_date,
                    ]);
                    UserMemberCategory::where('expired_date', '<', now())->delete();
                }
                $amount = $trx->total_payment;
            }

            // 5. Susun Pesan WhatsApp
            $statusText = match($internalStatus) {
                'done'    => "*TRANSAKSI BERHASIL DAN SUDAH AKTIF*",
                'pending' => "*STATUS: SILAKAN UNTUK MELAKUKAN PEMBAYARAN*",
                'failed'  => "*STATUS: DIBATALKAN, SILAKAN LAKUKAN TRANSAKSI ULANG*",
                'expired' => "*STATUS: EXPIRED, SILAKAN LAKUKAN TRANSAKSI ULANG*",
                default   => ""
            };

            $message = "*[TRANSAKSI " . ($setting->app_name ?? 'App') . "]*\n\n"
                    . "Kode Transaksi: " . $trx->code . "\n"
                    . "Total Pembayaran: Rp" . number_format($amount, 2, ",", ".") . "\n"
                    . "Keterangan: " . ($trx->description ?? '-') . "\n\n"
                    . $statusText . "\n\nTerimakasih.";

            // 6. Kirim Notifikasi (Gunakan variabel $trx yang sudah pasti ada)
            if (optional($trx->user->student)->phone_number) {
                sendWhatsappNotification($trx->user->student->phone_number, $message);
            }

            return response(['message' => 'OK']);

        } catch (\Exception $e) {
            \Log::error("Midtrans Error: " . $e->getMessage());
            return response(['message' => 'Server Error'], 500);
        }
    }
}
