<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }} - Transaksi
        </title>
    </Head>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3">Transaksi</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <Link href="/user/dashboard"><i class="bx bx-home-alt"></i></Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <Link :href="`/user/account-balances`" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </Link>
                </div>
            </div>

            <div class="row">
                <div class="col-12" v-if="$page.props.session.failed || $page.props.session.error || $page.props.session.success">
                    <div v-if="$page.props.session.failed || $page.props.session.error" class="alert alert-danger border-0 shadow-sm">
                        <div v-html="$page.props.session.failed || $page.props.session.error"></div>
                    </div>
                    <div v-if="$page.props.session.success" class="alert alert-success border-0 shadow-sm">
                        <div v-html="$page.props.session.success"></div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h5 class="fw-bold mb-0">Informasi Transaksi</h5>
                                    <p class="text-muted small">Detail pembayaran dan data pembeli</p>
                                </div>
                                <div class="text-end">
                                    <span :class="statusClass(transaction.transaction_status)">
                                        {{ statusLabel(transaction.transaction_status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="text-muted small text-uppercase fw-bold">Data Pembeli</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-light rounded-circle p-2 me-3">
                                            <i class="bx bx-user fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold">{{ transaction.user.name }}</p>
                                            <p class="mb-0 text-muted small">{{ transaction.user.email }}</p>
                                            <p class="mb-0 text-muted small">{{ transaction.user.student?.phone_number ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted small text-uppercase fw-bold">Metode Pembayaran</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="bg-light rounded-circle p-2 me-3">
                                            <i class="bx bx-credit-card fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold">
                                                {{ transaction.payment_method == 'manual_transfer' ? 'Transfer Manual' : 'Transfer Otomatis (Midtrans)' }}
                                            </p>
                                            <p class="mb-0 text-muted small">ID: {{ transaction.code }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12"><hr class="opacity-50"></div>

                                <div class="col-12">
                                    <label class="text-muted small text-uppercase fw-bold mb-3">Ringkasan Biaya</label>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>{{ transaction.description }}</span>
                                        <span class="fw-bold">{{ formatPrice(transaction.top_up_balance) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-3 border-top mt-3">
                                        <span class="fw-bold fs-5">Total Bayar</span>
                                        <span class="fw-bold fs-5 text-primary">{{ formatPrice(transaction.top_up_balance) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top text-end" v-if="transaction.transaction_status == 'pending'">
                                <Link v-if="transaction.payment_method == 'manual_transfer'"
                                    :href="`/user/account-balances/${transaction.id}/payment-confirmations`"
                                    class="btn btn-danger px-4 rounded-pill">
                                    <i class="bx bx-check-shield"></i> Konfirmasi Pembayaran
                                </Link>
                                <button v-if="transaction.payment_method == 'automatic_transfer_midtrans'"
                                    @click="pay"
                                    class="btn btn-primary px-4 rounded-pill">
                                    <i class="bx bx-wallet"></i> Bayar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm mt-4" v-if="payment_confirmation" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3 text-uppercase small">Bukti Pembayaran Anda</h6>
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <img :src="'/storage/upload_files/payment_confirmation/' + payment_confirmation.file" 
                                         class="img-fluid rounded shadow-sm border" alt="Bukti Transfer">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-sm table-borderless mb-0 mt-3 mt-md-0">
                                        <tr>
                                            <td class="text-muted">Pengirim:</td>
                                            <td class="fw-bold">{{ payment_confirmation.rekening_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Bank Tujuan:</td>
                                            <td>{{ payment_confirmation.bank?.bank_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Tanggal:</td>
                                            <td>{{ payment_confirmation.transfer_date }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" v-if="transaction.payment_method == 'manual_transfer' && transaction.transaction_status == 'pending'">
                    <div class="card border-0 shadow-sm bg-primary text-white" style="border-radius: 15px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                        <div class="card-body p-4 text-center">
                            <i class="bx bx-info-circle fs-1 mb-2"></i>
                            <h5 class="fw-bold text-light">Instruksi Pembayaran</h5>
                            <p class="small opacity-75">Silakan transfer tepat sesuai nominal ke salah satu rekening di bawah ini:</p>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm mt-3" v-for="bank in banks" :key="bank.id" style="border-radius: 15px;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <img :src="'/storage/upload_files/banks/' + bank.image" style="width: 60px; height: 40px; object-fit: contain;" class="me-3">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ bank.bank_name }}</h6>
                                    <p class="mb-0 text-primary fw-bold fs-5">{{ bank.rekening_number }}</p>
                                    <p class="mb-0 text-muted small">{{ bank.rekening_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutAdmin from "../../../Layouts/Layout.vue";
import { Link, Head, router as Inertia } from "@inertiajs/vue3";
import { reactive } from "vue";
import Swal from "sweetalert2";

export default {
    layout: LayoutAdmin,
    components: { Link, Head },
    props: {
        errors: Object,
        transaction: Object,
        banks: Object,
        payment_confirmation: Object,
    },
    setup(props) {
        const form = reactive({
            payment_method: "",
        });

        // Helper: Class Status
        const statusClass = (status) => {
            const classes = {
                'pending': 'badge bg-warning text-dark px-3 py-2 rounded-pill',
                'paid': 'badge bg-info text-white px-3 py-2 rounded-pill',
                'done': 'badge bg-success text-white px-3 py-2 rounded-pill',
                'failed': 'badge bg-danger text-white px-3 py-2 rounded-pill',
                'expired': 'badge bg-secondary text-white px-3 py-2 rounded-pill'
            };
            return classes[status] || 'badge bg-secondary px-3 py-2 rounded-pill';
        };

        // Helper: Label Status
        const statusLabel = (status) => {
            const labels = {
                'pending': 'Menunggu Pembayaran',
                'paid': 'Sudah Dibayar',
                'done': 'Selesai',
                'failed': 'Gagal',
                'expired': 'Kadaluarsa'
            };
            return labels[status] || status;
        };

        // Midtrans Pay Method
        const pay = () => {
            if (!window.snap) {
                Swal.fire("Error", "Midtrans Payment Page belum siap. Refresh halaman.", "error");
                return;
            }
            window.snap.pay(props.transaction.snap_token, {
                onSuccess: () => {
                    Inertia.post(`/user/account-balances/pay`, {
                        transaction_id: props.transaction.id,
                        payment_method: "automatic_transfer_midtrans",
                    });
                },
                onPending: () => { Inertia.reload(); },
                onError: () => { Inertia.reload(); },
            });
        };

        // Format Price
        const formatPrice = (value) => {
            if (!value) return "Rp.0";
            let val = (value / 1).toFixed(0).replace(".", ",");
            return "Rp." + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };

        return {
            form,
            pay,
            statusClass,
            statusLabel,
            formatPrice
        };
    }
};
</script>