<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }}
            - Pembelian Voucher
        </title>
    </Head>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Voucher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Pembelian Voucher
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div v-if="$page.props.session.failed || $page.props.session.error" class="alert alert-danger border-0">
                        <div v-html="$page.props.session.failed || $page.props.session.error"></div>
                    </div>
                    <div v-if="$page.props.session.success" class="alert alert-success border-0">
                        <div v-html="$page.props.session.success"></div>
                    </div>
                </div>

                <div class="col-lg-12 mx-auto">
                    <form @submit.prevent="submit">
                        <div class="card border-0 shadow-sm border-top border-3 border-primary">
                            <div class="card-header bg-transparent py-3">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-0 text-primary">Konfirmasi Pembayaran</h5>
                                        <small class="text-muted">Silakan lengkapi data transfer Anda dengan benar</small>
                                    </div>
                                    <div class="ms-auto">
                                        <Link :href="`/user/transactions/${transaction.id}`" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                            <i class="bx bx-arrow-back"></i> Kembali
                                        </Link>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Kode Transaksi</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="bx bx-hash"></i></span>
                                            <input type="text" class="form-control bg-light" :value="transaction.code" readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Tanggal Transfer</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                            <input type="date" class="form-control" v-model="form.transfer_date" :class="{'is-invalid': errors.transfer_date}" />
                                            <div v-if="errors.transfer_date" class="invalid-feedback">{{ errors.transfer_date }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nama Pengirim Transfer</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" v-model="form.rekening_name" :class="{'is-invalid': errors.rekening_name}" placeholder="Contoh: Budi Santoso" />
                                            <div v-if="errors.rekening_name" class="invalid-feedback">{{ errors.rekening_name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Jumlah Transfer (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-wallet"></i></span>
                                            <input type="number" class="form-control" v-model="form.total_payment" :class="{'is-invalid': errors.total_payment}" placeholder="0" />
                                            <div v-if="errors.total_payment" class="invalid-feedback">{{ errors.total_payment }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Di Transfer Ke Rekening</label>
                                        <select v-model="form.bank_id" :class="{'is-invalid': errors.bank_id}" class="form-select shadow-none">
                                            <option value="">-- Pilih Bank Tujuan --</option>
                                            <option v-for="(bank, index) in banks" :key="index" :value="bank.id">
                                                {{ bank.bank_name }} | {{ bank.rekening_number }} (a.n {{ bank.rekening_name }})
                                            </option>
                                        </select>
                                        <div v-if="errors.bank_id" class="invalid-feedback">{{ errors.bank_id }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Bukti Transfer (Gambar/PDF)</label>
                                        <div class="card border-dashed p-3 text-center bg-light">
                                            <input type="file" class="form-control" @input="form.file = $event.target.files[0]" :class="{'is-invalid': errors.file}" />
                                            <small class="text-muted mt-2">Pastikan foto bukti transfer terlihat jelas</small>
                                            <div v-if="errors.file" class="invalid-feedback d-block">{{ errors.file }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent p-4 border-top-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                        <i class="bx bx-check-circle"></i> Konfirmasi Pembayaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Tambahan style untuk mempercantik */
.border-dashed {
    border: 2px dashed #dee2e6;
}
.form-label {
    margin-bottom: 0.5rem;
    color: #495057;
}
.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.form-control:focus, .form-select:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.input-group:focus-within {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    border-radius: 0.375rem;
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
            bank_id: "",
            rekening_name: "",
            transfer_date: "",
            total_payment: "",
            file: "",
        });

        // submit method
        const submit = () => {
            // send data to server
            Inertia.post(
                `/user/transactions/${props.transaction.id}/payment-confirmations`,
                {
                    forceFormData: true,
                    bank_id: form.bank_id,
                    rekening_name: form.rekening_name,
                    transfer_date: form.transfer_date,
                    total_payment: form.total_payment,
                    file: form.file,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Konfirmasi Pembayaran Berhasil.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1000,
                        });
                    },
                }
            );
        };

        // return form state and submit method
        return {
            form,
            submit,
        };
    },
};
</script>
