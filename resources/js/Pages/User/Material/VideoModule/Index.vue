<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }} - Data Video Pembelajaran
        </title>
    </Head>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Video Pembelajaran</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Video Pembelajaran
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <hr />

            <div v-if="!categoryVideoModules.length" class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bx bx-video-off display-1 text-muted"></i>
                            <h5 class="mt-3">Data Video Pembelajaran Belum Tersedia.</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div v-for="category in categoryVideoModules" :key="category.id" class="mb-4">
                <h5 class="mb-3 text-uppercase fw-bold text-primary">
                    <i class="bx bx-collection"></i> {{ category.name }}
                </h5>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    <div class="col" v-for="videoModule in category.video_module" :key="videoModule.id">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden video-card">
                            <div class="position-relative overflow-hidden">
                                <img 
                                    :src="getThumbnail(videoModule.link)" 
                                    class="card-img-top thumbnail-img" 
                                    alt="Thumbnail"
                                >
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2 shadow">
                                    <i class="bx bx-video fs-6"></i>
                                </span>
                                <div 
                                    class="play-overlay" 
                                    @click="openVideo(videoModule)" 
                                    v-if="checkMemberCategories(videoModule.category_id, videoModule.member_categories)"
                                >
                                    <i class="bx bx-play-circle display-4 text-white"></i>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-bold text-dark mb-2 line-clamp-2">
                                    {{ videoModule.title }}
                                </h6>
                                
                                <p class="card-text text-muted small mb-3 line-clamp-2">
                                    {{ videoModule.description || 'Tidak ada deskripsi untuk video ini.' }}
                                </p>

                                <div class="mb-3 mt-auto text-center">
                                    <template v-if="videoModule.member_categories && videoModule.member_categories.length">
                                        <span
                                            v-for="cat in videoModule.member_categories" :key="cat"
                                            class="badge rounded-pill bg-light-success text-success border border-success m-1"
                                        >
                                            {{ cat }}
                                        </span>
                                    </template>
                                    <span v-else class="badge rounded-pill bg-light-info text-info border border-info">
                                        Seluruh Member
                                    </span>
                                </div>

                                <div v-if="checkMemberCategories(videoModule.category_id, videoModule.member_categories)">
                                    <button @click="openVideo(videoModule)" class="btn btn-primary w-100">
                                        <i class="bx bx-play-circle"></i> Putar Video
                                    </button>
                                </div>
                                <div v-else>
                                    <Link :href="`/user/vouchers?category_id=${videoModule.category_id}`" class="btn btn-outline-primary w-100">
                                        <i class="bx bx-lock-alt"></i> Upgrade Member
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-4" />
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVideoPlayer" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 bg-dark overflow-hidden">
                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title text-white text-truncate me-3">
                        <i class="bx bx-video text-danger"></i> {{ activeVideo?.title }}
                    </h6>
                    <button type="button" class="btn-close btn-close-white" @click="closeVideo"></button>
                </div>
                <div class="modal-body p-0 mt-2">
                    <div class="ratio ratio-16x9">
                        <iframe 
                            v-if="activeVideo"
                            :src="formatYoutubeLink(activeVideo.link)" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light btn-sm px-4" @click="closeVideo">
                        <i class="bx bx-x"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutUser from "../../../../Layouts/Layout.vue";
import { Link, Head } from "@inertiajs/vue3";

export default {
    layout: LayoutUser,
    components: { Link, Head },
    props: {
        categoryVideoModules: Array,
        userMemberCategories: Array,
    },
    data() {
        return {
            activeVideo: null,
            loadingVideo: false,
            bsModal: null
        }
    },
    mounted() {
        const modalElement = document.getElementById('modalVideoPlayer');
        if (modalElement) {
            this.bsModal = new bootstrap.Modal(modalElement);
        }
    },
    methods: {
        getThumbnail(url) {
            if (!url) return '/assets/images/default-thumb.jpg';
            let videoId = '';
            try {
                if (url.includes('youtu.be/')) {
                    videoId = url.split('youtu.be/')[1].split(/[?#]/)[0];
                } else if (url.includes('youtube.com/watch')) {
                    videoId = url.split('v=')[1].split('&')[0];
                } else if (url.includes('youtube.com/embed/')) {
                    videoId = url.split('embed/')[1].split(/[?#]/)[0];
                }
                return `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
            } catch (e) {
                return '/assets/images/default-thumb.jpg';
            }
        },
        formatYoutubeLink(url) {
            if (!url) return '';
            let videoId = '';
            try {
                if (url.includes('youtu.be/')) {
                    videoId = url.split('youtu.be/')[1].split(/[?#]/)[0];
                } else if (url.includes('youtube.com/watch')) {
                    videoId = url.split('v=')[1].split('&')[0];
                } else if (url.includes('youtube.com/embed/')) {
                    return url;
                }
                return `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
            } catch (e) {
                return url;
            }
        },
        openVideo(videoModule) {
            this.activeVideo = videoModule;
            this.bsModal.show();
        },
        closeVideo() {
            if (this.bsModal) this.bsModal.hide();
            this.activeVideo = null;
        },
        checkMemberCategories(category_id, categories) {
            const userMemberCategories = this.userMemberCategories.filter(
                (item) => item.category_id === category_id
            );
            if (categories && categories.length > 0) {
                for (const entry of userMemberCategories) {
                    if (entry.member_categories.some((category) => categories.includes(category))) {
                        return true;
                    }
                }
                return false;
            }
            return true;
        }
    },
};
</script>

<style scoped>
/* Membatasi teks deskripsi & judul agar rapi */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;  
    overflow: hidden;
    min-height: 2.8em; /* Menjaga tinggi tetap sama jika teks pendek */
}

/* Styling Gambar Thumbnail */
.thumbnail-img {
    aspect-ratio: 16/9;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.video-card:hover .thumbnail-img {
    transform: scale(1.1);
}

/* Overlay Play Button */
.play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
    z-index: 2;
}

.video-card:hover .play-overlay {
    opacity: 1;
}

/* Badge Warna Soft */
.bg-light-success {
    background-color: #e2f6ed;
}
.bg-light-info {
    background-color: #e0f3ff;
}

.video-card {
    transition: all 0.3s ease;
}
.video-card:hover {
    transform: translateY(-5px);
}
</style>