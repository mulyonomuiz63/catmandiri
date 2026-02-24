<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }}
            - Data Top Up Saldo
        </title>
    </Head>
    
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row align-items-center mb-4">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="bg-white shadow-sm rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="bx bx-plus-circle fs-3 text-primary"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-dark">Top Up Saldo</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0 bg-transparent" style="font-size: 0.85rem;">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:;" class="text-muted text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript:;" class="text-muted text-decoration-none">Finance</a>
                                    </li>
                                    <li class="breadcrumb-item active text-primary fw-medium" aria-current="page">Top Up</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 d-none d-md-flex justify-content-md-end">
                    <div class="text-end">
                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                            <i class="bx bx-info-circle me-1 text-primary"></i> Proses Otomatis 24 Jam
                        </span>
                    </div>
                </div>
            </div>

            <hr class="mb-4 opacity-25">

            <div class="row">
                <div class="col-lg-12">
                    <form @submit.prevent="submit">
                        <div class="card border-0 shadow-sm p-2" style="border-radius: 20px;">
                            <div class="card-header bg-transparent border-0 pt-3 ps-4">
                                <h5 class="mb-0 fw-bold text-dark">Metode Pengisian</h5>
                                <p class="text-muted small mb-0">Pilih nominal atau masukkan secara manual</p>
                            </div>
                            <div class="card-body p-4">
                                <label class="form-label fw-bold mb-3 text-secondary small text-uppercase">Nominal Instan</label>
                                <div class="row g-3 mb-4">
                                    <div v-for="amount in [10000, 30000, 50000, 100000]" :key="amount" class="col-6 col-md-3">
                                        <input
                                            :value="amount"
                                            type="radio"
                                            class="btn-check"
                                            name="topup-amount"
                                            :id="'amount-' + amount"
                                            @click="clickBalance(amount)"
                                        />
                                        <label class="btn btn-outline-light text-dark border-2 w-100 py-3 rounded-4 shadow-none custom-amount-btn" :for="'amount-' + amount">
                                            <span class="d-block small opacity-75">Rp</span>
                                            <span class="fw-bold fs-5">{{ formatPrice(amount) }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-secondary small text-uppercase">Nominal Kustom</label>
                                        <div class="input-group input-group-lg group-custom">
                                            <span class="input-group-text border-0 bg-light" style="border-radius: 12px 0 0 12px;">Rp</span>
                                            <input
                                                type="number"
                                                class="form-control border-0 bg-light shadow-none"
                                                style="border-radius: 0 12px 12px 0;"
                                                placeholder="0"
                                                v-model="form.top_up_balance"
                                                :class="{'is-invalid': errors.top_up_balance}"
                                            />
                                            <div v-if="errors.top_up_balance" class="invalid-feedback">{{ errors.top_up_balance }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-secondary small text-uppercase">Metode Bayar</label>
                                        <div class="input-group input-group-lg">
                                            <select
                                                v-model="form.payment_method"
                                                :class="{'is-invalid': errors.payment_method}"
                                                class="form-select border-0 bg-light shadow-none"
                                                style="border-radius: 12px;"
                                                required
                                            >
                                                <option value="">Pilih Metode...</option>
                                                <option
                                                    v-for="paymentMethod in $page.props.setting.payment_methods.filter(pm => pm.code !== 'account_balance')"
                                                    :key="paymentMethod.code"
                                                    :value="paymentMethod.code"
                                                >
                                                    {{ paymentMethod.description }}
                                                </option>
                                            </select>
                                            <div v-if="errors.payment_method" class="invalid-feedback">{{ errors.payment_method }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-lg" style="border-radius: 15px; padding: 15px; background: #2575fc; border: none;">
                                        Lanjutkan Pembayaran <i class="bx bx-right-arrow-alt ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-transparent py-3">
                    <h6 class="mb-0 fw-bold"><i class="bx bx-history me-2"></i>Riwayat Top Up</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th class="ps-4">Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total Top Up</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!accountBalances.data.length">
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bx bx-receipt fs-1 d-block mb-2"></i>
                                        Belum ada riwayat transaksi
                                    </td>
                                </tr>
                                <tr v-for="(accountBalance, index) in accountBalances.data" :key="index">
                                    <td class="ps-4 fw-bold text-primary">{{ accountBalance.code }}</td>
                                    <td>{{ accountBalance.created_at }}</td>
                                    <td>Rp {{ formatPrice(accountBalance.top_up_balance) }}</td>
                                    <td class="text-center">
                                        <span v-if="accountBalance.payment_method == 'manual_transfer' && accountBalance.transaction_status == 'pending'">
                                            <a :href="'/user/account-balances/' + accountBalance.id" class="badge rounded-pill bg-warning text-dark px-3 py-2 text-decoration-none">
                                                <i class="bx bx-upload me-1"></i> Upload Bukti
                                            </a>
                                        </span>

                                        <span v-else-if="accountBalance.payment_method == 'automatic_transfer_midtrans' && accountBalance.transaction_status == 'pending'">
                                            <a :href="'/user/account-balances/' + accountBalance.id" class="badge rounded-pill bg-primary px-3 py-2 text-decoration-none">
                                                <i class="bx bx-credit-card me-1"></i> Bayar
                                            </a>
                                        </span>

                                        <template v-else>
                                            <span class="badge rounded-pill bg-success px-3 py-2" v-if="accountBalance.transaction_status == 'paid'">Terbayar</span>
                                            <span class="badge rounded-pill bg-danger px-3 py-2" v-if="accountBalance.transaction_status == 'failed'">Gagal</span>
                                            <span class="badge rounded-pill bg-info px-3 py-2" v-if="accountBalance.transaction_status == 'done'">Selesai</span>
                                            <span class="badge rounded-pill bg-secondary px-3 py-2" v-if="accountBalance.transaction_status == 'pending'">Menunggu</span>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0 py-3">
                    <Pagination :links="accountBalances.links" align="end" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Transisi untuk tombol pilihan nominal */
.btn-check:checked + .btn-outline-primary {
    background-color: var(--bs-primary);
    color: white;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
}

.card {
    transition: transform 0.2s;
}

.table thead th {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-top: none;
}

.z-index-1 {
    z-index: 1;
}

/* Menghilangkan border default saat fokus dan hover */
.custom-amount-btn {
    border: 2px solid #f0f0f0 !important;
    transition: all 0.3s ease;
}

.custom-amount-btn:hover {
    border-color: #2575fc !important;
    background-color: transparent !important;
    color: #2575fc !important;
}

.btn-check:checked + .custom-amount-btn {
    border-color: #2575fc !important;
    background-color: #eef4ff !important;
    color: #2575fc !important;
}

/* Grouping input agar terlihat modern */
.input-group-text, .form-control, .form-select {
    font-size: 1rem;
}

/* Animasi sederhana saat tombol ditekan */
.btn-primary:active {
    transform: scale(0.98);
}
</style>

<script>
//import layout user
import LayoutUser from "../../../Layouts/Layout.vue";

//import component pagination
import Pagination from "../../../Components/Pagination.vue";

// import Link
import { Link } from "@inertiajs/vue3";

//import reactive
import { reactive } from "vue";

import { router as Inertia } from "@inertiajs/vue3";

// import Swal
import Swal from "sweetalert2";

// import Head from Inertia
import { Head } from "@inertiajs/vue3";

export default {
    // layout
    layout: LayoutUser,

    // register components
    components: {
        Link,
        Head,
        Pagination,
    },

    // props
    props: {
        accountBalances: Object,
        errors: Object,
        banks: Object,
    },
    setup() {
        const form = reactive({
            payment_method: "",
            top_up_balance: "",
        });

        const clickBalance = (value) => {
            form.top_up_balance = value;
        };

        // submit method
        const submit = () => {
            // send data to server
            Inertia.post("/user/account-balances", {
                // data
                top_up_balance: form.top_up_balance,
                payment_method: form.payment_method,
            });
        };

        // return form state and submit method
        return {
            form,
            submit,
            clickBalance,
        };
    },

    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed().replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
    },
};
</script>
