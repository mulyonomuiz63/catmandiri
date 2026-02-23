<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }} - Data Materi / Modul
        </title>
    </Head>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3 fw-bold">E-Library</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 bg-transparent">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Materi & Modul</li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <hr class="border-light" />

            <div v-if="!categoryModules.length" class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <div class="card shadow-sm border-0 py-5">
                        <div class="card-body">
                            <i class="bx bx-book-open display-1 text-muted opacity-25"></i>
                            <h5 class="mt-3 text-secondary">Data Materi Belum Tersedia</h5>
                            <p class="text-muted">Silahkan cek kembali beberapa saat lagi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div v-for="category in categoryModules" :key="category.id" class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="category-icon-box bg-primary-subtle me-3">
                        <i class="bx bxs-folder-open text-primary fs-4"></i>
                    </div>
                    <h5 class="mb-0 fw-bold text-dark text-uppercase letter-spacing-1">
                        {{ category.name }}
                    </h5>
                    <div class="ms-auto flex-grow-1 border-bottom ms-3 opacity-25"></div>
                </div>

                <div class="row g-4">
                    <div
                        class="col-12 col-sm-6 col-md-4 col-lg-3"
                        v-for="materialModule in category.module"
                        :key="materialModule.id"
                    >
                        <div class="card h-100 border-0 shadow-sm hover-elevate overflow-hidden">
                            <div class="card-header-gradient p-4 text-center position-relative">
                                <div class="module-icon-circle shadow-sm">
                                    <i class="bx bxs-file-pdf"></i>
                                </div>
                                <span class="badge position-absolute top-0 end-0 m-3 shadow-sm" 
                                      :class="checkMemberCategories(materialModule.category_id, materialModule.member_categories) ? 'bg-success' : 'bg-warning text-dark'">
                                    <i class="bx" :class="checkMemberCategories(materialModule.category_id, materialModule.member_categories) ? 'bx-check-double' : 'bx-lock-alt'"></i>
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-bold text-dark mb-2 text-limit-1">
                                    {{ materialModule.title }}
                                </h6>
                                
                                <p class="text-muted small mb-4 text-limit-2" style="min-height: 38px">
                                    {{ materialModule.description || 'Pelajari modul ini untuk memperdalam pemahaman Anda.' }}
                                </p>

                                <div class="mt-auto">
                                    <div class="mb-3">
                                        <template v-if="materialModule.member_categories && materialModule.member_categories.length">
                                            <span
                                                v-for="cat in materialModule.member_categories"
                                                :key="cat"
                                                class="badge rounded-pill bg-light-primary text-primary border border-primary-subtle me-1 mb-1 fw-normal"
                                            >
                                                {{ cat }}
                                            </span>
                                        </template>
                                        <span v-else class="badge rounded-pill bg-light-secondary text-secondary border border-secondary-subtle">
                                            Akses Publik
                                        </span>
                                    </div>

                                    <div v-if="checkMemberCategories(materialModule.category_id, materialModule.member_categories)">
                                        <button
                                            @click="openMaterial(materialModule.link)"
                                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center py-2 shadow-sm"
                                        >
                                            <i class="bx bx-book-content me-2"></i> Buka Materi
                                        </button>
                                    </div>
                                    <div v-else>
                                        <Link
                                            :href="`/user/vouchers?category_id=${materialModule.category_id}`"
                                            class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center py-2"
                                        >
                                            <i class="bx bx-lock-open-alt me-2"></i> 
                                            {{ materialModule.member_categories.length == 1 ? 'Upgrade Ke ' + materialModule.member_categories[0] : 'Upgrade Member' }}
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMateri" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-fullscreen"> 
            <div class="modal-content border-0">
                <div class="modal-header shadow-sm bg-white py-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-subtle p-2 rounded me-3 d-none d-md-block">
                            <i class="bx bxs-book-reader text-primary fs-4"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-dark">E-Reader Modul</h5>
                    </div>
                    <button type="button" class="btn-close shadow-none" @click="closeMaterial"></button>
                </div>
                <div class="modal-body p-0 bg-dark-subtle overflow-hidden">
                    <div v-if="loadingIframe" class="loader-container">
                        <div class="spinner-grow text-primary" role="status"></div>
                        <p class="mt-3 fw-medium">Menyiapkan Materi...</p>
                    </div>
                    
                    <iframe 
                        v-if="activeMaterial"
                        :src="activeMaterial" 
                        class="iframe-viewer"
                        frameborder="0"
                        @load="loadingIframe = false"
                        oncontextmenu="return false;"
                        allow="autoplay; fullscreen"
                    ></iframe>
                </div>
                <div class="modal-footer bg-white border-top shadow-lg-top">
                    <span class="text-muted small me-auto d-none d-md-block">
                        <i class="bx bx-info-circle me-1"></i> Klik 'Tutup Materi' untuk kembali ke dashboard
                    </span>
                    <button type="button" class="btn btn-secondary px-4 shadow-sm" @click="closeMaterial">Tutup Materi</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Typography & General */
.letter-spacing-1 { letter-spacing: 1px; }
.text-limit-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
.text-limit-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* Category Style */
.category-icon-box {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}

/* Card Styling */
.card-header-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    min-height: 100px;
}
.module-icon-circle {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: #f41127; /* PDF Color */
    font-size: 28px;
    margin-bottom: -15px;
}
.hover-elevate {
    transition: all 0.3s ease;
}
.hover-elevate:hover {
    transform: translateY(-8px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
}

/* Chips Style */
.bg-light-primary { background-color: #e0eaff; }
.bg-light-secondary { background-color: #f0f1f2; }

/* Modal & Iframe */
.loader-container {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.iframe-viewer {
    width: 100%;
    height: 100%;
    transition: opacity 0.3s ease;
}

/* Buttons */
.btn {
    border-radius: 8px;
    font-weight: 500;
}

/* Responsive Fixes */
@media (max-width: 576px) {
    .page-content { padding: 15px; }
    .card-header-gradient { min-height: 80px; }
}
</style>

<script>
import { ref, onMounted } from 'vue'; // Tambahkan onMounted
import { Link, Head } from "@inertiajs/vue3";
import LayoutUser from "../../../../Layouts/Layout.vue";

export default {
    layout: LayoutUser,
    components: { Link, Head },
    props: {
        categoryModules: Object,
        userMemberCategories: Object,
    },
    setup(props) {
        const activeMaterial = ref(null);
        const loadingIframe = ref(false);
        const modalElement = ref(null);
        let bsModal = null;

        // Inisialisasi Bootstrap Modal saat komponen dipasang
        onMounted(() => {
            bsModal = new bootstrap.Modal(document.getElementById('modalMateri'));
        });

        const openMaterial = (link) => {
            activeMaterial.value = link;
            loadingIframe.value = true;
            bsModal.show();
        };

        const closeMaterial = () => {
            bsModal.hide();
            // Reset link saat modal ditutup agar iframe berhenti loading di background
            activeMaterial.value = null; 
        };

        const checkMemberCategories = (category_id, categories) => {
            // Logika filter Anda yang sudah ada
            var userMemberCategories = props.userMemberCategories.filter(
                (item) => item.category_id === category_id
            );

            if (categories) {
                for (const entry of userMemberCategories) {
                    if (entry.member_categories.some((cat) => categories.includes(cat))) {
                        return true;
                    }
                }
                return false;
            }
            return true;
        };

        return {
            checkMemberCategories,
            activeMaterial,
            loadingIframe,
            openMaterial,
            closeMaterial,
            modalElement
        };
    },
};
</script>
