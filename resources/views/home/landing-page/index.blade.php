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
                            Toko abaya yang menghadirkan busana muslimah elegan, nyaman, dan syar’i dengan desain modern.
                            Cocok untuk aktivitas harian maupun acara spesial, membuat setiap langkah lebih anggun
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            {{-- <span class="hero-btn-item position-absolute d-none d-md-flex fw-medium">Join community
                                <img src="{{ asset('admin') }}/assets/img/front-pages/icons/Join-community-arrow.png"
                                    alt="Join community arrow" class="scaleX-n1-rtl" /></span> --}}
                            <a href="#landingPricing" class="btn btn-primary btn-lg">Get Started</a>
                        </div>
                    </div>
                    {{-- <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="../vertical-menu-template/app-ecommerce-dashboard.html"> --}}

                </div>
            </div>
            {{-- <div class="landing-hero-blank"></div> --}}
        </section>

        <section id="product" class="section-py landing-team">
            <form action="javascript:void(0)" method="post" id="formBeli">
                @csrf
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
                        @foreach ($data as $item)
                            <div class="col-lg-3 col-sm-6">
                                <div class="card mt-3 mt-lg-2 shadow-none">
                                    <div
                                        class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box">
                                        <img src="{{ asset('barang/' . $item->foto_barang) }}"
                                            class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                            alt="{{ $item->nama }}" />
                                    </div>
                                    <div class="card-body border border-top-0 border-label-primary text-center">
                                        <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                                        <p class="text-muted mb-0">Premium</p>

                                        <!-- Quantity Input -->
                                        <div class="d-flex justify-content-center align-items-center mt-2">
                                            <button class="btn btn-sm btn-outline-secondary qty-minus btn-minus"
                                                data-id="{{ $item->id }}">-</button>
                                            <input type="number" class="form-control mx-1 text-center qty-input jml"
                                                name="jml" value="1" min="1" style="width: 50px;"
                                                data-id="{{ $item->id }}">
                                            <button class="btn btn-sm btn-outline-secondary qty-plus btn-plus"
                                                data-id="{{ $item->id }}">+</button>
                                        </div>
                                        <select class="select2 form-select mt-3 stok-barang" style="text-align:center;">
                                            <option value="">Pilih Ukuran</option>
                                            @foreach ($item->stokBarang as $stokBarang)
                                                <option value="{{ $stokBarang->id }}">{{ $stokBarang->ukuran }}</option>
                                            @endforeach
                                        </select>

                                        <!-- Button Beli -->
                                        <a href="javascript:void(0)" class="mt-2 btn btn-primary w-100 beli-btn"
                                            data-id="{{ $item->id }}">
                                            Beli Sekarang
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
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
                                        Ya, semua abaya yang kami jual merupakan produk original yang diimpor langsung dari
                                        Saudi Arabia, dengan kualitas bahan premium.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                        Apakah tersedia berbagai merek (brand) abaya?
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Tentu, kami menyediakan berbagai merek abaya branded ternama dari Saudi Arabia,
                                        sehingga pelanggan dapat memilih sesuai selera dan kebutuhan.
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
                                        Ya, kami menyediakan ukuran mulai dari S hingga XXL. Untuk memastikan ukuran sesuai,
                                        silakan cek panduan ukuran yang tersedia di setiap produk.
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
                                        Untuk saat ini, kami menjual abaya ready stock. Namun, beberapa brand menyediakan
                                        layanan pre-order dengan model dan ukuran tertentu.
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
                                        Kami memiliki kebijakan retur/penukaran dalam waktu 3 hari setelah barang diterima,
                                        selama produk belum digunakan dan label masih terpasang.
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
                                    Jika Anda ingin membahas hal terkait pembayaran, akun, kerja sama, atau memiliki
                                    pertanyaan sebelum pembelian, Anda berada di tempat yang tepat.
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
@push('scripts')
    <script>
        $(document).on('click', '.btn-plus', function() {
            let jml = $(".jml").val();

            let j = parseInt(jml);

            let btnMinus = $(this).closest(".card-body").find(".btn-minus");

            if (j <= 1) {
                btnMinus.prop("disabled", true);
            } else {
                btnMinus.prop("disabled", false);
            }

            let total = j + 1;

            $(".jml").val(total);


        });
        $(document).on('click', '.btn-minus', function() {
            let jml = $(".jml").val();
            let j = parseInt(jml);
            let btnMinus = $(this).closest(".card-body").find(".btn-minus");

            if (j <= 2) {
                btnMinus.prop("disabled", true);
            } else {
                btnMinus.prop("disabled", false);
            }
            let total = j - 1;

            $(".jml").val(total);


        });

        $(document).ready(function() {
            $(document).on('input', '.qty-input', function() {
                console.log("Event input terpanggil");
                let jml = $(this).val();
                let j = parseInt(jml);
                console.log(j);
            });
        });

        $(document).on('click', '.beli-btn', function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let barang = $(this).data('id');

            let jml = $(this).closest('.card-body').find('.qty-input').val();
            let stokBarangId = $(this).closest('.card-body').find('.stok-barang').val();

            let form = new FormData();
            form.append('barang_id', barang);
            form.append('jml', jml);

            $.ajax({
                type: "POST",
                url: "{{ route('admin.beli.store') }}",
                data: {
                    'jml': jml,
                    'stok_barang_id': stokBarangId,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(response) {
                    showToastr(response.code, response.code, response.message);
                },
                error: function(xhr) {
                    console.log(xhr)
                    if (xhr.status === 401) {
                        window.location.href = '{{ route('login') }}';
                    }
                }

            });

        });
    </script>
@endpush
