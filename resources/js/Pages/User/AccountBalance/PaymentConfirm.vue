<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }}
            - Konfirmasi Top Up
        </title>
    </Head>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3 border-0">Top Up</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 bg-transparent">
                            <li class="breadcrumb-item">
                                <Link href="/user/dashboard"><i class="bx bx-home-alt text-primary"></i></Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pembayaran</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div v-if="$page.props.session.failed || $page.props.session.error || $page.props.session.success" class="mb-4">
                        <div v-if="$page.props.session.failed" class="alert alert-danger border-0 shadow-sm d-flex align-items-center">
                            <i class='bx bxs-error-circle me-2 fs-4'></i>
                            <div v-html="$page.props.session.failed"></div>
                        </div>
                        <div v-if="$page.props.session.error" class="alert alert-danger border-0 shadow-sm d-flex align-items-center">
                            <i class='bx bxs-x-circle me-2 fs-4'></i>
                            <div v-html="$page.props.session.error"></div>
                        </div>
                        <div v-if="$page.props.session.success" class="alert alert-success border-0 shadow-sm d-flex align-items-center">
                            <i class='bx bxs-check-circle me-2 fs-4'></i>
                            <div v-html="$page.props.session.success"></div>
                        </div>
                    </div>

                    <form @submit.prevent="submit">
                        <div class="card border-0 shadow-sm overflow-hidden">
                            <div class="card-header bg-white py-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box bg-light-primary text-primary rounded-3 me-3 p-2">
                                        <i class="bx bx-receipt fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">Detail Konfirmasi</h5>
                                        <p class="mb-0 text-muted small">Lengkapi data transfer Anda di bawah ini</p>
                                    </div>
                                    <div class="ms-auto">
                                        <Link
                                            :href="`/user/account-balances/${transaction.id}`"
                                            class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                                        >
                                            <i class="bx bx-arrow-back"></i> Kembali
                                        </Link>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-uppercase small text-muted">Informasi Transaksi</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bx bx-hash"></i></span>
                                        <input
                                            type="text"
                                            class="form-control bg-light border-start-0"
                                            :value="transaction.code"
                                            readonly
                                            style="font-family: 'Courier New', Courier, monospace; font-weight: bold;"
                                        />
                                    </div>
                                </div>

                                <hr class="my-4 opacity-25">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nama Pengirim</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="form.rekening_name"
                                            :class="{'is-invalid': errors.rekening_name}"
                                            placeholder="Contoh: Budi Santoso"
                                        />
                                        <div v-if="errors.rekening_name" class="invalid-feedback">{{ errors.rekening_name }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tanggal Transfer</label>
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="form.transfer_date"
                                            :class="{'is-invalid': errors.transfer_date}"
                                        />
                                        <div v-if="errors.transfer_date" class="invalid-feedback">{{ errors.transfer_date }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Ke Rekening Bank</label>
                                        <select
                                            v-model="form.bank_id"
                                            :class="{'is-invalid': errors.bank_id}"
                                            class="form-select"
                                        >
                                            <option value="">-- Pilih Rekening Tujuan --</option>
                                            <option
                                                v-for="(bank, index) in banks"
                                                :key="index"
                                                :value="bank.id"
                                            >
                                                {{ bank.bank_name }} - {{ bank.rekening_number }} (a/n {{ bank.rekening_name }})
                                            </option>
                                        </select>
                                        <div v-if="errors.bank_id" class="invalid-feedback">{{ errors.bank_id }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Jumlah Transfer (Rp)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">Rp</span>
                                            <input
                                                type="number"
                                                class="form-control"
                                                v-model="form.total_payment"
                                                :class="{'is-invalid': errors.total_payment}"
                                                placeholder="Masukkan nominal sesuai bukti"
                                            />
                                            <div v-if="errors.total_payment" class="invalid-feedback">{{ errors.total_payment }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Bukti Transfer (Image/PDF)</label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            @input="form.file = $event.target.files[0]"
                                            :class="{'is-invalid': errors.file}"
                                        />
                                        <div v-if="errors.file" class="invalid-feedback">{{ errors.file }}</div>
                                        <small class="text-muted"><i class="bx bx-info-circle"></i> Pastikan foto bukti transfer terlihat jelas.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light py-3 d-grid">
                                <button type="submit" class="btn btn-primary shadow-sm px-5 py-2">
                                    <i class="bx bx-check-double"></i> Konfirmasi Pembayaran Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Tambahan CSS untuk kesan Premium */
.bg-light-primary {
    background-color: rgba(13, 110, 253, 0.1);
}
.card {
    border-radius: 12px;
}
.form-control, .form-select {
    border-radius: 8px;
    padding: 0.6rem 0.75rem;
    border: 1px solid #e0e0e0;
}
.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05);
}
.btn-primary {
    border-radius: 8px;
    font-weight: 600;
}
</style>

<script>
//import layout admin
import LayoutAdmin from "../../../Layouts/Layout.vue";

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
                `/user/account-balances/${props.transaction.id}/payment-confirmations`,
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
