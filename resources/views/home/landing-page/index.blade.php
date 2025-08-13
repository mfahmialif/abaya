@extends('layouts.home.template')
@section('title', 'Landing Page')
@section('content')
    <!-- Sections:Start -->

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <img src="{{ asset('admin') }}/assets/img/front-pages/backgrounds/hero-bg.png" alt="hero background"
                    class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100" data-speed="1" />
                <div class="container">
                    <div class="hero-text-box text-center position-relative">
                        <h1 class="text-primary hero-title display-6 fw-extrabold">
                           Abaya Elegan <br> Pesona Muslimah Sejati
                        </h1>
                        <h2 class="hero-sub-title h6 mb-6">
                            Toko abaya yang menghadirkan busana muslimah elegan, nyaman, dan syar’i dengan desain modern. Cocok untuk aktivitas harian maupun acara spesial, membuat setiap langkah lebih anggun
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            {{-- <span class="hero-btn-item position-absolute d-none d-md-flex fw-medium">Join community
                                <img src="{{ asset('admin') }}/assets/img/front-pages/icons/Join-community-arrow.png"
                                    alt="Join community arrow" class="scaleX-n1-rtl" /></span> --}}
                            <a href="#landingPricing" class="btn btn-primary btn-lg">Get Started</a>
                        </div>
                    </div>
<<<<<<< Updated upstream
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="../vertical-menu-template/app-ecommerce-dashboard.html">
=======
                    {{-- <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="../vertical-menu-template/app-ecommerce-dashboard.html" target="_blank">
>>>>>>> Stashed changes
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/hero-dashboard-light.png"
                                    alt="hero dashboard" class="animation-img"
                                    data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                                <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/hero-elements-light.png"
                                    alt="hero elements"
                                    class="position-absolute hero-elements-img animation-img top-0 start-0"
                                    data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
                            </div>
                        </a>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="landing-hero-blank"></div> --}}
        </section>

         <section id="landingTeam" class="section-py landing-team">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary">Abaya Production</span>
                </div>
                <h4 class="text-center mb-1">
                    <span class="position-relative fw-extrabold z-1">Product 
                        <img src="{{ asset('admin') }}/assets/img/front-pages/icons/section-title-icon.png"
                            alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                    </span>
                    Abaya 
                </h4>
                <p class="text-center mb-md-11 pb-0 pb-xl-12">Yang banyak disukai orang</p>
                <div class="row gy-12 mt-2">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card mt-3 mt-lg-2 shadow-none">
                            <div
                                class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box">
                                <img c:\Users\msi12\Downloads\abaya2.png src="{{ asset('admin') }}/assets/img/front-pages/landing-page/abaya1.png"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-primary text-center">
                                <h5 class="card-title mb-0">ABAYA HAREER</h5>
                                <p class="text-muted mb-0">premium</p>
                                <a href="javascript:void(0)" class="mt-2 btn btn-primary">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div
                                class="bg-label-info border border-bottom-0 border-label-info position-relative team-image-box">
                                <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/abaya2.png"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-info text-center">
                                <h5 class="card-title mb-0">ABAYA FURSAN</h5>
                                <p class="text-muted mb-0">premium</p>
                                <a href="javascript:void(0)" class="mt-2 btn btn-primary">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div
                                class="bg-label-danger border border-bottom-0 border-label-danger position-relative team-image-box">
                                <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/abaya3.png"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-danger text-center">
                                <h5 class="card-title mb-0">ABAYA NIDA</h5>
                                <p class="text-muted mb-0">premium</p>
                                <a href="javascript:void(0)" class="mt-2 btn btn-primary">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div
                                class="bg-label-success border border-bottom-0 border-label-success position-relative team-image-box">
                                <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/abaya4.png"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-success text-center">
                                <h5 class="card-title mb-0">ABAYA MALIKY</h5>
                                <p class="text-muted mb-0">premium</p>
                                <a href="javascript:void(0)" class="mt-2 btn btn-primary">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="landingFAQ" class="section-py bg-body landing-faq">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary">FAQ</span>
                </div>
                <h4 class="text-center mb-1">
                   Pertanyaan yang Sering 
                    <span class="position-relative fw-extrabold z-1">Diajukan
                        <img src="{{ asset('admin') }}/assets/img/front-pages/icons/section-title-icon.png"
                            alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                    </span>
                </h4>
                <p class="text-center mb-12 pb-md-4">
                   Lihat daftar FAQ ini untuk menemukan jawaban dari pertanyaan umum.
                </p>
                <div class="row gy-12 align-items-center">
                    <div class="col-lg-5">
                        <div class="text-center">
                            <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/kursi.png"
                                alt="faq boy with logos" class="faq-image" />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="accordion" id="accordionExample">
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                       Apakah semua abaya di toko ini asli dari Saudi Arabia?
                                    </button>
                                </h2>

                                <div id="accordionOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ya, semua abaya yang kami jual merupakan produk original yang diimpor langsung dari Saudi Arabia, dengan kualitas bahan premium.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionTwo" aria-expanded="false"
                                        aria-controls="accordionTwo">
                                         Apakah tersedia berbagai merek (brand) abaya?
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Tentu, kami menyediakan berbagai merek abaya branded ternama dari Saudi Arabia, sehingga pelanggan dapat memilih sesuai selera dan kebutuhan.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item active">
                                <h2 class="accordion-header" id="headingThree">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionThree" aria-expanded="false"
                                        aria-controls="accordionThree">
                                        Apakah ada pilihan ukuran yang lengkap?
                                    </button>
                                </h2>
                                <div id="accordionThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ya, kami menyediakan ukuran mulai dari S hingga XXL. Untuk memastikan ukuran sesuai, silakan cek panduan ukuran yang tersedia di setiap produk.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionFour" aria-expanded="false"
                                        aria-controls="accordionFour">
                                       Apakah bisa memesan abaya custom?
                                    </button>
                                </h2>
                                <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                       Untuk saat ini, kami menjual abaya ready stock. Namun, beberapa brand menyediakan layanan pre-order dengan model dan ukuran tertentu.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionFive" aria-expanded="false"
                                        aria-controls="accordionFive">
                                       Bagaimana jika produk yang diterima tidak sesuai?
                                    </button>
                                </h2>
                                <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Kami memiliki kebijakan retur/penukaran dalam waktu 3 hari setelah barang diterima, selama produk belum digunakan dan label masih terpasang.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ: End -->

        <!-- CTA: Start -->
        <section id="landingCTA" class="section-py landing-cta position-relative p-lg-0 pb-0">
            <img src="{{ asset('admin') }}/assets/img/front-pages/backgrounds/cta-bg-light.png"
                class="position-absolute bottom-0 end-0 scaleX-n1-rtl h-100 w-100 z-n1" alt="cta image"
                data-app-light-img="front-pages/backgrounds/cta-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/cta-bg-dark.png" />
            <div class="container">
                <div class="row align-items-center gy-12">
                    <div class="col-lg-6 text-start text-sm-center text-lg-start">
                        <h3 class="cta-title text-primary fw-bold mb-0">Ready to Get Started?</h3>
                        <h5 class="text-body mb-8">Beli abaya sekarang juga!</h5>
                        <a href="payment-page.html" class="btn btn-lg btn-primary">Login</a>
                    </div>
                    <div class="col-lg-6 pt-lg-12 text-center text-lg-end">
                        <img width="500" src="{{ asset('admin') }}/assets/img/front-pages/landing-page/toko.png"
                            alt="cta dashboard" class="img-fluid mt-lg-4" />
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA: End -->

        <!-- Contact Us: Start -->
        <section id="landingContact" class="section-py bg-body landing-contact">
            <div class="container">
                <div class="text-center mb-4">
                    <span class="badge bg-label-primary">Contact US</span>
                </div>
                <h4 class="text-center mb-1">
                    <span class="position-relative fw-extrabold z-1">Mari temukan abaya branded Saudi Arabia pilihan Anda
                        <img src="{{ asset('admin') }}/assets/img/front-pages/icons/section-title-icon.png"
                            alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                    </span>
                </h4>
                <p class="text-center mb-12 pb-md-4">Ada pertanyaan atau masukan? Kirimkan pesan kepada kami.</p>
                <div class="row g-6">
                    <div class="col-lg-5">
                        <div class="contact-img-box position-relative border p-2 h-100">
                            <img src="{{ asset('admin') }}/assets/img/front-pages/icons/contact-border.png"
                                alt="contact border"
                                class="contact-border-img position-absolute d-none d-lg-block scaleX-n1-rtl" />
                            <img src="{{ asset('admin') }}/assets/img/front-pages/landing-page/kasir.png"
                                alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                            <div class="p-4 pb-2">
                                <div class="row g-4">
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-label-primary rounded p-1_5 me-3"><i
                                                    class="ti ti-mail ti-lg"></i></div>
                                            <div>
                                                <p class="mb-0">Email</p>
                                                <h6 class="mb-0">
                                                    <a href="mailto:example@gmail.com"
                                                        class="text-heading">example@gmail.com</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-label-success rounded p-1_5 me-3">
                                                <i class="ti ti-phone-call ti-lg"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0">Phone</p>
                                                <h6 class="mb-0"><a href="tel:+1234-568-963" class="text-heading">+1234
                                                        568 963</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="mb-2">Kirim Pesan</h4>
                                <p class="mb-6">
                                   Jika Anda ingin membahas hal terkait pembayaran, akun, kerja sama, atau memiliki pertanyaan sebelum pembelian, Anda berada di tempat yang tepat.
                                </p>
                                <form>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact-form-fullname">Full Name</label>
                                            <input type="text" class="form-control" id="contact-form-fullname"
                                                placeholder="john" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact-form-email">Email</label>
                                            <input type="text" id="contact-form-email" class="form-control"
                                                placeholder="johndoe@gmail.com" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="contact-form-message">Message</label>
                                            <textarea id="contact-form-message" class="form-control" rows="7" placeholder="Write a message"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Send inquiry</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us: End -->
    </div>

    <!-- / Sections:End -->
@endsection
