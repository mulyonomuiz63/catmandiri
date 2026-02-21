<!DOCTYPE html>
<html lang="id" translate="no">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description"
        content="Membantu casis POLRI, TNI, CPNS dan Kedinasan dalam berlatih agar lebih siap menghadapi tes yang sebenarnya" />
    <meta name="author" content="{{ $setting->app_name ?? '' }}" />
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="Q05kIXdC7hnNTWXO0wux-gk6NC-1AYhCATIDugZWVso" />
    <title>Home</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png" />
    <link href="{{ asset('assets/landing-page/theme_1/css/styles.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/landing-page/theme_1/css/aos.css') }}" />
    <script data-search-pseudo-elements="" defer="" src="{{ asset('assets/landing-page/theme_1/js/all.min.js') }}"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/landing-page/theme_1/js/feather.min.js') }}" crossorigin="anonymous"></script>
    <style>
        .footer-link li {
            margin-bottom: 8px;
        }

        .footer-link a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .footer-link a:hover {
            color: #ffffff;
            padding-left: 4px;
        }

    </style>
</head>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                <!-- Navbar-->
                <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                    <div class="container px-5">
                        <a class="navbar-brand text-primary"
                            href="{{ url('/') }}">{{ $setting->app_name ?? '' }}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto me-lg-5">
                                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Tim</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Artikel</a></li> --}}
                            </ul>
                            <a class="btn fw-500 ms-lg-4 btn-outline-primary" href="{{ route('login') }}">
                                Login
                            </a>
                            <a class="btn fw-500 ms-lg-4 btn-primary" href="{{ route('register') }}">
                                Daftar
                                <i class="ms-2" data-feather="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </nav>
                <!-- Page Header-->
                <header class="page-header-ui page-header-ui-light bg-white">

                    <div style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%;">
                        <canvas id="nodes"></canvas>
                    </div>
                    <div class="page-header-ui-content"
                        style="position:relative; left: 0px; top: 0px; width: 100%; height: 100%;">
                        <div class="container px-5">
                            <div class="row gx-5 justify-content-center">
                                <div class="col-xl-8 col-lg-10 text-center mb-4" data-aos="fade">
                                    <h1 class="page-header-ui-title text-white">Platform Sistem Computer Assisted Test</h1>
                                    <p class="page-header-ui-text text-white">Membantu casis POLRI, TNI, CPNS dan
                                        Kedinasan dalam berlatih agar lebih siap menghadapi tes yang sebenarnya</p>
                                    <a class="btn btn-primary fw-500 me-2" href="{{ route('login') }}">Mulai
                                        Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="bg-light pb-10 pt-1">
                    <div class="container px-5">
                        <div class="device-laptop text-gray-200 mt-n10" data-aos="fade-up">
                            <svg class="device-container" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="83.911 298.53 426.962 243.838">
                                <path
                                    d="M474.843 516.208V309.886c0-6.418-4.938-11.355-11.354-11.355H131.791c-6.417 0-11.354 4.938-11.354 11.355v206.816H83.911v13.326c4.938 7.896 31.098 12.34 40.969 12.34h345.024c10.366 0 36.526-4.936 40.969-12.34v-13.326h-36.03v-.494zM134.26 313.341h326.762v203.361H134.26V313.341z">
                                </path>
                            </svg>
                            <img class="device-screenshot"
                                src="{{ asset('assets/landing-page/theme_1/image_tenant/hero-image.png') }}" />
                        </div>
                    </div>
                </section>
                <section class="bg-white py-10">
                    <div class="container px-5">
                        <div class="row gx-5 text-center">
                            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i data-feather="layers"></i></div>
                                <h3>Dibuat khusus seperti aslinya</h3>
                                <p class="mb-0">Sistem dibuat mirip dengan tes aslinya agar anda tidak perlu banyak
                                    beradaptasi, sehingga anda tetap fokus dan menghindari dari masalah teknis yang
                                    tidak diinginkan.</p>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i data-feather="smartphone"></i></div>
                                <h3>Modern responsive design</h3>
                                <p class="mb-0">Menampilkan komponen mobile-first yang dibuat dengan sangat elegan,
                                    aplikasi akan berfungsi dengan baik di perangkat apa pun seperti laptop, tablet
                                    ataupun smartphone!</p>
                            </div>
                            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                                    <i data-feather="code"></i></div>
                                <h3>Dokumentasi Lengkap</h3>
                                <p class="mb-0">Semua tata letak, bagian halaman, komponen, dan utilitas sepenuhnya
                                    tercakup dalam dokumen lengkap agar memudahkan user ketika menggunakan aplikasi 
                                    {{ $setting->app_name ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-light py-10">
                    <div class="container px-5">
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="text-xs text-uppercase-expanded text-primary mb-2">Feature Aplikasi
                                    </div>
                                    <h2 class="mb-5">Kami memiliki solusi sederhana untuk masalah yang kompleks</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5">
                            <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up">
                                <a class="card text-center text-decoration-none h-100 lift">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-green-soft text-green mb-4"><i
                                                data-feather="layers"></i></div>
                                        <h5>Peminatan Lengkap</h5>
                                        <p class="card-text small">Terdiri dari tes TNI, POLRI, Kedinasan dan CPNS yang
                                            didalamnya terdapat banyak kategori yang akan diujikan.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                                <a class="card text-center text-decoration-none h-100 lift">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-red-soft text-red mb-4"><i
                                                data-feather="tool"></i></div>
                                        <h5>Sistem Penilaian</h5>
                                        <p class="card-text small">Sistem penilaian untuk kategori peminatan sesuai
                                            dengan sistem yang sebenarnya, sehingga siswa dapat mengetahui ambang batas
                                            nilai di kategori tersebut.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="150">
                                <a class="card text-center text-decoration-none h-100 lift">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-yellow-soft text-yellow mb-4"><i
                                                data-feather="layout"></i></div>
                                        <h5>Peringkat Nilai</h5>
                                        <p class="card-text small">Siswa dapat melihat ranking dari masing-masing Try
                                            Out yang telah diikuti sehingga siswa tahu dimana posisi dia dibanding
                                            dengan siswa lainnya.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0" data-aos="fade-up">
                                <a class="card text-center text-decoration-none h-100 lift">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-purple-soft text-purple mb-4"><i
                                                data-feather="book"></i></div>
                                        <h5>Pembahasan Materi</h5>
                                        <p class="card-text small">Pembahasan materi disajikan dalam bentuk dokumentasi
                                            tertulis atau video, baik itu pembahasan untuk masing-masing soal, atau
                                            materi yang disampaikan sesuai dengan judul bahasan.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                                <a class="card text-center text-decoration-none h-100 lift">
                                    <div class="card-body py-5">
                                        <div class="icon-stack icon-stack-lg bg-blue-soft text-blue mb-4"><i
                                                data-feather="code"></i></div>
                                        <h5>Webinar</h5>
                                        <p class="card-text small">Siswa dapat mengikuti webinar via Zoom Meeting yang
                                            bertujuan untuk mengevaluasi kegiatan pembelajaran</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-white py-10">
                    <div class="container px-5">
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="text-xs text-uppercase-expanded text-primary mb-2">Gambaran Aplikasi
                                    </div>
                                    <h2 class="mb-5">Gambaran Aplikasi  {{ $setting->app_name ?? '' }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12" data-aos="fade-up">
                                <div class="card">
                                    <img src="{{ asset('assets/landing-page/theme_1/image_tenant/image_1.png') }}"
                                        class="card-img-top" alt="{{ $setting->app_name }}" />
                                    <div class="card-body">
                                        <h5 class="card-title">Kategori Peminatan</h5>
                                        <p class="card-text">
                                            Tampilan halaman kategori peminatan, menampilkan kategori untuk TNI, POLRI,
                                            CPNS dan Kedinasan
                                        </p>
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="col-lg-6 col-md-12" data-aos="fade-up">
                                <div class="card">
                                    <img src="{{ asset('assets/landing-page/theme_1/image_tenant/image_2.png') }}"
                                        class="card-img-top" alt="{{ $setting->app_name }}" />
                                    <div class="card-body">
                                        <h5 class="card-title">Halaman Try Out</h5>
                                        <p class="card-text">
                                            Tampilan halaman Try Out dengan soal matematika. menampilkan nomor soal
                                            serta navigasi soal agar siswa tahu soal mana saja yang sudah dijawab.
                                        </p>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-light pt-10">
                    <div class="container px-5">
                        <div class="text-center mb-5">
                            <h2>Kategori Member</h2>
                            <p class="lead">Berikut kategori member yang ada di {{ $setting->app_name ?? '' }}</p>
                            <p>Detail Harga Akan Muncul Ketika Anda Login</p>
                        </div>
                        <div class="row gx-5 z-1">
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <h2>
                                                <div class="badge bg-danger text-white rounded-pill badge-marketing">
                                                    Basic Member (Free)</div>
                                            </h2>
                                        </div>
                                        <br>
                                        <ul class="fa-ul pricing-list">
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark"> Kategori Basic</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Pembahasan untuk Tiap-tiap Soal</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Mengikuti Try Out</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Pembahasan Materi Sesuai Mata Pelajaran</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Webinar Evaluasi Dengan Mentor</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Group Telegram / Whatsapp Khusus</span>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <h2>
                                                <div class="badge bg-primary text-white rounded-pill badge-marketing">
                                                    Standard Member</div>
                                            </h2>
                                        </div>
                                        <br>
                                        <ul class="fa-ul pricing-list">
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark"> Kategori Standard</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Pembahasan untuk Tiap-tiap Soal</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Mengikuti Try Out</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Pembahasan Materi Sesuai Mata Pelajaran</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Webinar Evaluasi Dengan Mentor</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-circle text-gray-200"></i></span>
                                                <span class="text-dark">Group Telegram / Whatsapp Khusus</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-5 mb-lg-n10" data-aos="fade-up" data-aos-delay="100">
                                <div class="card pricing h-100">
                                    <div class="card-body p-5">
                                        <div class="text-center">
                                            <h2>
                                                <div class="badge bg-warning text-white rounded-pill badge-marketing">
                                                    Premium Member</div>
                                            </h2>
                                        </div>
                                        <br>
                                        <ul class="fa-ul pricing-list">
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Try Out Full Akses</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Pembahasan untuk Tiap-tiap Soal</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Mengikuti Try Out</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Pembahasan Materi Sesuai Mata Pelajaran</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Webinar Evaluasi Dengan Mentor</span>
                                            </li>
                                            <li class="pricing-list-item">
                                                <span class="fa-li"><i
                                                        class="far fa-check-circle text-teal"></i></span>
                                                <span class="text-dark">Group Telegram / Whatsapp Khusus</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="svg-border-rounded text-dark">
                        <!-- Rounded SVG Border-->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                            fill="currentColor">
                            <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                        </svg>
                    </div>
                </section>
                <section class="bg-dark pb-10 pt-15">
                    <div class="container px-5">
                        <div class="row gx-5 mb-10 mt-5">
                            <div class="col-lg-6 mb-5">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">Apa itu platform {{ $setting->app_name ?? '' }} ?</h5>
                                        <p class="text-white-50">{{ $setting->app_name ?? '' }} merupakan sistem 
                                            yang bertujuan Membantu casis POLRI, TNI, CPNS dan Kedinasan dalam berlatih
                                            agar lebih siap menghadapi tes yang sebenarnya</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">Apa yang saya dapatkan ketika bergabung ?</h5>
                                        <p class="text-white-50">Anda akan mendapatkan informasi mengenai soal-soal
                                            terupdate, serta penilaian yang sesuai dengan tes aslinya, sehingga anda
                                            akan lebih siap dan percaya diri untuk mengikuti tes pada peminatan yang
                                            anda pilih.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">Apakah saya akan mendapatkan informasi terbaru ?</h5>
                                        <p class="text-white-50">Ya, anda akan mendapatkan informasi ketika anda join
                                            di group Whatsapp kami. silakan hubungi admin, dan admin akan mengundang
                                            anda secara khusus untuk bergabung dengan siswa lainnya di
                                            {{ $setting->app_name ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex h-100">
                                    <div class="icon-stack flex-shrink-0 bg-teal text-white"><i
                                            class="fas fa-question"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-white">Apakah saya dapat mengakses fitur
                                            {{ $setting->app_name ?? '' }} kapan saja ?</h5>
                                        <p class="text-white-50">Ya, anda dapat mengakses semua fitur di
                                            {{ $setting->app_name ?? '' }} selama akun anda aktif dan member anda belum
                                            expired. Cek secara berkala status member anda, jangan sampai terlewat dan
                                            anda kehilangan informasi mengenai soal terupdate.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5 justify-content-center text-center">
                            <h2 class="text-white">Dapatkan Segera Token Member dan Mari Menghemat Waktu.</h2>
                            <p class="lead text-white-50 mb-5">Hematlah waktu anda dengan mengikuti pelajaran yang ada
                                di {{ $setting->app_name ?? '' }}, anda tidak perlu mencari modul dan soal karena di
                                {{ $setting->app_name ?? '' }} soal dan modul sudah tersedia sesuai dengan kisi-kisi.
                            </p>
                            <a class="btn btn-success fw-500" href="{{ route('login') }}">Mulai Sekarang</a>
                        </div>
                    </div>
        </div>
        </section>
        <section class="bg-img-cover overlay overlay-primary overlay-80 pt-15"
            style="background-image: url('https://source.unsplash.com/e3OUQGT9bWU/1400x900')">
            <!-- Spacer for the image section-->
            <div style="height: 35vh"></div>
            <div class="svg-border-rounded text-white">
                <!-- Rounded SVG Border-->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none"
                    fill="currentColor">
                    <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path>
                </svg>
            </div>
        </section>
        <section class="bg-white pb-10">
            <div class="container px-5">
                <div class="row gx-5 mb-5">
                    <div class="col-lg-6 mt-n10 mb-5 mb-lg-0 z-1">
                        <a class="card text-decoration-none h-100 lift">
                            <div class="card-body py-5">
                                <div class="d-flex align-items-center">
                                    <div class="icon-stack icon-stack-xl bg-primary text-white flex-shrink-0"><i
                                            data-feather="edit-3"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-primary">Belajar lebih cerdas, bukan lebih keras</h5>
                                        <p class="card-text text-gray-600">Pelajari lebih lanjut tentang bagaimana
                                            platform kami dapat menghemat waktu dan tenaga Anda dalam belajar.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 mt-0 mt-lg-n10 z-1">
                        <a class="card text-decoration-none h-100 lift">
                            <div class="card-body py-5">
                                <div class="d-flex align-items-center">
                                    <div class="icon-stack icon-stack-xl bg-secondary text-white flex-shrink-0"><i
                                            data-feather="code"></i></div>
                                    <div class="ms-4">
                                        <h5 class="text-secondary">Dibuat semudah mungkin</h5>
                                        <p class="card-text text-gray-600">Kami membuat platform selain untuk membantu,
                                            tentu juga membuat anda nyaman.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-12 text-center">
                        <h4>Dapat Informasi Terbaru</h4>
                        <p class="lead text-gray-500 mb-0">Tetap terhubung dengan pembaruan dan fitur terbaru yang
                            ditambahkan ke aplikasi kami!</p>
                        <br>
                        <a target="_blank"
                            href="https://wa.me/{{ $setting->whatsapp_number }}?text={{ urlencode('Hallo, Admin. saya ingin bergabung dengan ' . $setting->app_name . ' ....') }}"
                            class="btn btn-success">Hubungi Admin</a>
                    </div>
                </div>
            </div>
        </section>
        </main>
    </div>
    <div id="layoutDefault_footer">
        <footer class="footer bg-dark text-white pt-10 pb-5 mt-auto">
            <div class="container px-5">
                <div class="row gx-5 gy-4">

                    <!-- Brand & Deskripsi -->
                    <div class="col-lg-3">
                        <h5 class="fw-bold mb-3 text-white-50">{{ $setting->app_name ?? '' }}</h5>
                        <p class="text-white-50 small">
                            Platform  modern untuk membantu persiapan POLRI, TNI,
                            CPNS dan Kedinasan secara efektif dan terarah.
                        </p>
                    </div>

                    <!-- Menu Halaman -->
                    <div class="col-lg-2 col-md-4">
                        <h6 class="fw-semibold mb-3 text-white-50">Halaman</h6>
                        <ul class="list-unstyled footer-link">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Daftar</a></li>
                        </ul>
                    </div>

                    <!-- Layanan -->
                    <div class="col-lg-2 col-md-4">
                        <h6 class="fw-semibold mb-3 text-white-50">Layanan</h6>
                        <ul class="list-unstyled footer-link">
                            <li><a href="#">Try Out Online</a></li>
                            <li><a href="#">Materi & Pembahasan</a></li>
                            <li><a href="#">Webinar</a></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div class="col-lg-2 col-md-4">
                        <h6 class="fw-semibold mb-3 text-white-50">Kontak</h6>
                        <ul class="list-unstyled footer-link">
                            <li>
                                <a target="_blank"
                                href="https://wa.me/{{ $setting->whatsapp_number }}">
                                    WhatsApp Admin
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ $setting->email ?? 'admin@email.com' }}">
                                    Email Support
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <h6 class="fw-semibold mb-3 text-white-50">Kantor Kami</h6>
                        <p class="text-white-50 small mb-2">
                            <i class="fas fa-map-marker-alt me-2 text-info"></i>
                            {{ $setting->address ?? 'Jl. Contoh Alamat No. 123, Kota Jakarta Selatan, DKI Jakarta 12345' }}
                        </p>
                        <a href="https://maps.google.com" target="_blank" class="btn btn-sm btn-outline-info py-0 px-2" style="font-size: 0.75rem;">
                            Lihat Google Maps
                        </a>
                    </div>

                </div>

                <hr class="border-secondary my-4">

                <!-- Copyright -->
                <div class="row align-items-center">
                    <div id="legalAccordionContainer">
    
                        <div class="collapse mt-3" id="collapsePrivacy" data-bs-parent="#legalAccordionContainer">
                            <div class="card card-body bg-dark text-white border-secondary shadow-lg">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-info mb-0"><i class="fas fa-shield-alt me-2"></i>Kebijakan Privasi Smart Choice</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-toggle="collapse" data-bs-target="#collapsePrivacy"></button>
                                </div>
                                
                                <div style="max-height: 400px; overflow-y: auto; font-size: 0.9rem; line-height: 1.6;" class="pe-3 custom-scroll text-white-50">
                                    <p class="text-white"><strong>A. PENDAHULUAN</strong></p>
                                    <p>Selamat datang di Smart Choice ("kami", "kita", atau "website"). Kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda saat Anda menggunakan layanan kami.</p>
    
                                    <p class="text-white"><strong>B. INFORMASI YANG KAMI KUMPULKAN</strong></p>
                                    <p class="mb-1 text-light">Informasi Pribadi:</p>
                                    <ul>
                                        <li>Nama lengkap, Alamat email, Nomor Telepon, Alamat</li>
                                        <li>Informasi pembayaran, Data pendidikan dan profesional</li>
                                    </ul>
                                    <p class="mb-1 text-light">Informasi Otomatis:</p>
                                    <ul>
                                        <li>Alamat IP, Data browser, Informasi Perangkat</li>
                                        <li>Cookie dan teknologi pelacakan serupa, Data penggunaan website</li>
                                    </ul>
    
                                    <p class="text-white"><strong>C. PENGGUNA INFORMASI</strong></p>
                                    <ul>
                                        <li>Menyediakan dan mengelola layanan pendidikan dan memproses pembayaran</li>
                                        <li>Mengirim pembaruan, informasi terkait layanan, dan materi pemasaran (dengan persetujuan Anda)</li>
                                        <li>Meningkatkan pengalaman pengguna dan mematuhi kewajiban hukum</li>
                                    </ul>
    
                                    <p class="text-white"><strong>D. PENYIMPANAN DAN KEAMANAN DATA</strong></p>
                                    <p>Kami mengimplementasikan langkah-langkah keamanan yang sesuai untuk melindungi data Anda dari akses tidak sah, perubahan, pengungkapan, atau penghapusan yang tidak sah.</p>
    
                                    <p class="text-white"><strong>E. PEMBAGIAN INFORMASI</strong></p>
                                    <ul>
                                        <li>Penyedia layanan pihak ketiga yang membantu operasional website</li>
                                        <li>Mitra bisnis yang terkait dengan layanan kami</li>
                                        <li>Otoritas hukum jika diwajibkan oleh hukum</li>
                                    </ul>
    
                                    <p class="text-white"><strong>F. HAK PENGGUNA</strong></p>
                                    <ul>
                                        <li>Mengakses data pribadi Anda dan meminta koreksi data yang tidak akurat</li>
                                        <li>Meminta penghapusan data atau membatasi penggunaan data Anda</li>
                                        <li>Menarik persetujuan penggunaan data</li>
                                    </ul>
    
                                    <p class="text-white"><strong>G. COOKIE</strong></p>
                                    <p>Website kami menggunakan cookie untuk meningkatkan pengalaman pengguna. Anda dapat mengatur browser Anda untuk menolak cookie, namun hal ini mungkin memengaruhi fungsi website.</p>
    
                                    <p class="text-white"><strong>H. PERUBAHAN KEBIJAKAN PRIVASI</strong></p>
                                    <p>Kami berhak mengubah kebijakan privasi ini sewaktu-waktu. Perubahan akan diumumkan di website dengan tanggal efektif yang baru.</p>
    
                                    <p class="text-white"><strong>I. HUKUM YANG BERLAKU</strong></p>
                                    <p>Kebijakan privasi ini tunduk pada hukum Republik Indonesia dan yurisdiksi pengadilan Indonesia.</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="collapse mt-3" id="collapseTerms" data-bs-parent="#legalAccordionContainer">
                            <div class="card card-body bg-dark text-white border-secondary shadow-lg">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-info mb-0"><i class="fas fa-file-contract me-2"></i>Syarat & Ketentuan Smart Choice</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-toggle="collapse" data-bs-target="#collapseTerms"></button>
                                </div>
    
                                <div style="max-height: 400px; overflow-y: auto; font-size: 0.9rem; line-height: 1.6;" class="pe-3 custom-scroll text-white-50">
                                    <p class="text-white"><strong>A. PENDAHULUAN</strong></p>
                                    <p>Selamat datang di Smart Choice ("Website"), yang dioperasikan oleh Smart Choice Learning Center ("kami", "kita", atau "Perusahaan"). Dengan mengakses dan menggunakan website ini, Anda menyetujui untuk terikat oleh syarat dan ketentuan ini.</p>
    
                                    <p class="text-white"><strong>B. DEFINISI</strong></p>
                                    <ul>
                                        <li>"Pengguna" atau "Anda" merujuk pada setiap individu yang mengakses atau menggunakan website ini</li>
                                        <li>"Layanan" merujuk pada semua produk, konten, dan jasa yang disediakan melalui website</li>
                                        <li>"Materi Pembelajaran" merujuk pada semua konten pendidikan yang tersedia di website</li>
                                    </ul>
    
                                    <p class="text-white"><strong>C. PENGGUNAAN LAYANAN</strong></p>
                                    <ul>
                                        <li>Anda harus berusia minimal 18 tahun atau di bawah pengawasan orang tua/wali.</li>
                                        <li>Anda bertanggung jawab untuk menjaga kerahasiaan akun dan password.</li>
                                        <li>Dilarang menggunakan website untuk tujuan ilegal, menyalin, mendistribusikan, atau memodifikasi materi tanpa izin tertulis.</li>
                                        <li>Dilarang mengunggah konten berbahaya/virus atau melakukan tindakan yang mengganggu fungsi website.</li>
                                        <li>Dilarang menjual kembali layanan tanpa izin tertulis.</li>
                                    </ul>
    
                                    <p class="text-white"><strong>D. PEMBAYARAN DAN PENGAMBILAN DANA</strong></p>
                                    <ul>
                                        <li>Semua pembayaran harus dilakukan sesuai dengan harga yang tercantum.</li>
                                        <li>Pembayaran dianggap final kecuali ditentukan lain. Pengembalian dana sesuai kebijakan yang berlaku.</li>
                                        <li>Kami berhak mengubah harga sewaktu-waktu.</li>
                                    </ul>
    
                                    <p class="text-white"><strong>E. HAK KEKAYAAN INTELEKTUAL</strong></p>
                                    <p>Seluruh konten di website dilindungi hak cipta. Pengguna diberikan lisensi terbatas untuk mengakses materi. Penggunaan materi di luar keperluan pembelajaran pribadi dilarang. Logo dan merek dagang adalah milik Perusahaan.</p>
    
                                    <p class="text-white"><strong>F. BATAS TANGGUNG JAWAB</strong></p>
                                    <p>Website disediakan "sebagaimana adanya". Kami tidak bertanggung jawab atas kerugian yang timbul dari penggunaan website dan tidak menjamin ketersediaan website secara terus menerus. Kami berhak menonaktifkan akun yang melanggar.</p>
    
                                    <p class="text-white"><strong>G. KEBIJAKAN PRIVASI</strong></p>
                                    <p>Penggunaan data pribadi Anda diatur dalam Kebijakan Privasi kami yang merupakan bagian tidak terpisahkan dari Syarat dan Ketentuan ini.</p>
    
                                    <p class="text-white"><strong>H. PERUBAHAN KETENTUAN</strong></p>
                                    <p>Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan efektif setelah diumumkan di website.</p>
    
                                    <p class="text-white"><strong>I. PENYELESAIAN SENGKETA</strong></p>
                                    <p>Setiap sengketa akan diselesaikan secara musyawarah. Jika tidak tercapai kesepakatan, akan diselesaikan melalui pengadilan yang berwenang di bawah hukum Republik Indonesia.</p>
    
                                    <p class="text-white"><strong>J. KETENTUAN LAINNYA</strong></p>
                                    <p>Jika ada ketentuan yang tidak sah, ketentuan lainnya tetap berlaku. Ketentuan ini merupakan kesepakatan menyeluruh antara Pengguna dan Perusahaan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 small text-white-50">
                        © 2026 {{ $setting->app_name ?? '' }}. All rights reserved.
                    </div>
                    <div class="col-md-6 text-md-end small">
                        <a href="javascript:void(0)" class="text-white-50 me-3" data-bs-toggle="collapse" data-bs-target="#collapsePrivacy">Kebijakan Privasi</a>
                        <a href="javascript:void(0)" class="text-white-50" data-bs-toggle="collapse" data-bs-target="#collapseTerms">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets/landing-page/theme_1/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/landing-page/theme_1/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/landing-page/theme_1/js/aos.js') }}"></script>
    <script>
        AOS.init({
            disable: 'mobile',
            duration: 600,
            once: true,
        });
    </script>

    <script type="text/javascript" src="{{ asset('assets/landing-page/theme_1/js/nodes.js') }}"></script>
    <script type="text/javascript">
        var nodesjs = new NodesJs({
            id: 'nodes',
            width: window.innerWidth,
            height: window.innerHeight,
            particleSize: 3,
            lineSize: 1,
            particleColor: [255, 255, 255, 0.3],
            lineColor: [255, 255, 255],
            backgroundFrom: [10, 25, 100],
            backgroundTo: [25, 50, 150],
            backgroundDuration: 4000,
            nobg: false,
            number: window.hasOwnProperty('orientation') ? 30 : 100,
            speed: 20
        });
    </script>

    <script type="text/javascript">
        window.onresize = function() {
            nodesjs.setWidth(window.innerWidth);
            nodesjs.setHeight(window.innerHeight);
        };
    </script>

    <script defer src="{{ asset('assets/landing-page/theme_1/js/vaafb692b2aea4879b33c060e79fe94621666317369993.js') }}"
        integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA=="
        data-cf-beacon='{"rayId":"7632a878ecd1898e","token":"6e2c2575ac8f44ed824cef7899ba8463","version":"2022.10.3","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
