<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }} - Transaksi
        </title>
    </Head>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3 text-uppercase fw-bold">Transaksi</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <Link :href="`/user/transactions`" class="btn btn-outline-secondary btn-sm px-3 shadow-sm">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </Link>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div v-if="$page.props.session.failed || $page.props.session.error" class="alert alert-danger border-0 border-start border-4 border-danger alert-dismissible fade show shadow-sm">
                        <div v-html="$page.props.session.failed || $page.props.session.error"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <div v-if="$page.props.session.success" class="alert alert-success border-0 border-start border-4 border-success alert-dismissible fade show shadow-sm">
                        <div v-html="$page.props.session.success"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 fw-bold"><i class="bx bx-receipt me-2 text-primary"></i>Ringkasan Transaksi</h5>
                            <Link v-if="transaction.transaction_status == 'pending' && transaction.payment_method == 'manual_transfer'"
                                :href="`/user/transactions/${transaction.id}/payment-confirmations`"
                                class="btn btn-danger btn-sm shadow-sm px-3">
                                <i class="bx bx-check-circle me-1"></i> Konfirmasi Pembayaran
                            </Link>
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6 border-end">
                                    <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">DATA PEMBELI</h6>
                                    <div class="mb-3">
                                        <label class="text-muted small mb-1">Nama Lengkap</label>
                                        <p class="fw-bold mb-0 text-dark">{{ transaction.user.name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small mb-1">Email</label>
                                        <p class="fw-bold mb-0 text-dark">{{ transaction.user.email }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small mb-1">Nomor WhatsApp</label>
                                        <p class="fw-bold mb-0 text-dark">
                                            {{ transaction.user.student?.phone_number || '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">DETAIL PEMBAYARAN</h6>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="text-muted small mb-1">Kode Transaksi</label>
                                            <p class="fw-bold mb-0 text-primary">{{ transaction.code }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="text-muted small mb-1">Status</label>
                                            <div>
                                                <span v-if="transaction.transaction_status == 'pending'" class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                                <span v-if="transaction.transaction_status == 'paid'" class="badge bg-success px-3 py-2">Terbayar</span>
                                                <span v-if="transaction.transaction_status == 'done'" class="badge bg-primary px-3 py-2">Selesai</span>
                                                <span v-if="transaction.transaction_status == 'failed'" class="badge bg-danger px-3 py-2">Gagal</span>
                                                <span v-if="transaction.transaction_status == 'expired'" class="badge bg-secondary px-3 py-2">Kadaluarsa</span>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="text-muted small mb-1">Tanggal</label>
                                            <p class="fw-bold mb-0">{{ transaction.created_at }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="text-muted small mb-1">Total Bayar</label>
                                            <p class="fw-bold mb-0 fs-5 text-danger">{{ formatPrice(transaction.total_payment) }}</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="text-muted small mb-1">Metode Pembayaran</label>
                                        <p class="fw-bold mb-0">
                                            <i class="bx bx-credit-card me-1"></i>
                                            {{ transaction.payment_method == 'account_balance' ? 'Saldo Akun' : (transaction.payment_method == 'manual_transfer' ? 'Transfer Manual' : 'Transfer Otomatis') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h6 class="fw-bold small text-muted text-uppercase mb-2">Item / Layanan</h6>
                                    <div class="p-3 bg-light rounded shadow-sm border">
                                        <p class="mb-1 fw-bold">{{ transaction.category.name }}</p>
                                        <p class="mb-2 text-muted small">{{ transaction.description }}</p>
                                        <div class="mt-2">
                                            <span v-if="transaction.member_categories" v-for="cat in transaction.member_categories" class="badge bg-white text-success border border-success me-1">
                                                {{ cat }}
                                            </span>
                                            <span v-else class="badge bg-white text-success border border-success">Seluruh Member</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="transaction.payment_method == 'automatic_transfer_midtrans' && transaction.transaction_status == 'pending'" class="mt-4 text-center">
                                <div class="alert alert-info">Selesaikan pembayaran Anda segera melalui sistem pembayaran otomatis kami.</div>
                                <button @click="pay" class="btn btn-primary btn-lg px-5 shadow">Bayar Sekarang</button>
                            </div>

                            <div v-if="transaction.payment_method == 'manual_transfer' && transaction.payment_confirmation" class="mt-5 p-4 border rounded bg-light">
                                <h5 class="fw-bold mb-4 text-center">Bukti Konfirmasi Pembayaran</h5>
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <table class="table table-sm table-borderless">
                                            <tr><td width="200" class="text-muted small">Pengirim</td><td class="fw-bold">: {{ transaction.payment_confirmation.rekening_name }}</td></tr>
                                            <tr><td class="text-muted small">Tujuan</td><td class="fw-bold">: {{ transaction.payment_confirmation.bank.bank_name }}</td></tr>
                                            <tr><td class="text-muted small">Tanggal Transfer</td><td class="fw-bold">: {{ transaction.payment_confirmation.transfer_date }}</td></tr>
                                            <tr><td class="text-muted small">Jumlah</td><td class="fw-bold text-success">: {{ formatPrice(transaction.payment_confirmation.total_payment) }}</td></tr>
                                        </table>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <a :href="'/storage/upload_files/payment_confirmation/' + transaction.payment_confirmation.file" target="_blank">
                                            <img :src="'/storage/upload_files/payment_confirmation/' + transaction.payment_confirmation.file" 
                                                class="img-fluid rounded shadow-sm border border-2 border-white" style="max-height: 200px;">
                                        </a>
                                        <p class="small text-muted mt-2">Klik gambar untuk memperbesar</p>
                                    </div>
                                </div>
                            </div>

                            <div v-if="transaction.payment_method == 'manual_transfer' && transaction.transaction_status == 'pending'" class="mt-5">
                                <h6 class="text-center fw-bold mb-4">INSTRUKSI PEMBAYARAN MANUAL</h6>
                                <p class="text-center text-muted small mb-4">Pilih salah satu rekening di bawah ini untuk melakukan transfer:</p>
                                <div class="row row-cols-1 row-cols-md-3 g-4">
                                    <div class="col" v-for="bank in banks" :key="bank.id">
                                        <div class="card h-100 border shadow-none hover-shadow transition-all rounded-4">
                                            <div class="card-body p-4 text-center">
                                                <div class="mb-3" style="height: 50px; display: flex; align-items: center; justify-content: center;">
                                                    <img :src="'/storage/upload_files/banks/' + bank.image" style="max-width: 100px; max-height: 40px;">
                                                </div>
                                                <h6 class="fw-bold mb-1">{{ bank.bank_name }}</h6>
                                                <p class="fs-5 fw-bold text-primary mb-1">{{ bank.rekening_number }}</p>
                                                <p class="small text-muted mb-0">a.n {{ bank.rekening_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.hover-shadow:hover {
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    border-color: #007bff !important;
}
.transition-all {
    transition: all 0.3s ease;
}
</style>

<script>
//import layout admin
import LayoutAdmin from "../../../../Layouts/Layout.vue";

// import Link
import { Link } from "@inertiajs/vue3";

//import reactive
import { reactive } from "vue";

// import Head from Inertia
import { Head } from "@inertiajs/vue3";

// import Swal
import Swal from "sweetalert2";

import { router as Inertia } from "@inertiajs/vue3";

export default {
    // layout
    layout: LayoutAdmin,

    // register components
    components: {
        Link,
        Head,
    },

    //props
    props: {
        errors: Object,
        transaction: Object,
        banks: Object,
    },
    setup(props) {
        const form = reactive({
            payment_method: "",
        });

        // submit method
        const submit = () => {
            // send data to server
            Inertia.post(
                `/user/vouchers/${props.voucher.id}/buy`,
                {
                    // data
                    payment_method: form.payment_method,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Silakan Lakukan Pembayaran",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    },
                }
            );
        };

        const pay = () => {
            window.snap.pay(props.transaction.snap_token, {
                onSuccess: () => {
                    Inertia.post(`/user/transactions/pay`, {
                        transaction_id: props.transaction.id,
                        payment_method: "automatic_transfer_midtrans",
                    });
                },
                onPending: () => {
                    this.$inertia.visit($page.props.setting.app_url);
                },
                onError: () => {
                    this.$inertia.visit($page.props.setting.app_url);
                },
            });
        };

        // return form state and submit method
        return {
            form,
            submit,
            pay,
        };
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return "Rp." + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
    },
};
</script>
