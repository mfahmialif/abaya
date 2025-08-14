@extends('layouts.home.template')
@section('title', 'Item')
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
                            Daftar Barang Anda <br> Semua di Satu Tempat
                        </h1>
                        <h2 class="hero-sub-title h6 mb-6">
                            Lihat semua barang yang telah Anda beli dengan mudah. Pantau status, jumlah, dan detail setiap
                            item di daftar belanja Anda.
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            <a href="#listBarang" class="btn btn-primary btn-lg">Lihat Barang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="card mt-3 p-5" id="listBarang">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-hover" id="table-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Pembeli</th>
                            <th>Barang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <!-- / Sections:End -->
@endsection


@push('scripts')
    <script>
        var dataTable = initDataTables('table-1', 'loader-user', 'card1', null, false,
            'Barang yang Dibeli', "{{ route('item.data') }}",
            [{
                    data: "tanggal",
                    name: "tanggal",
                    className: "align-middle",
                },
                {
                    data: "kode_transaksi",
                    name: "kode_transaksi",
                    className: "align-middle",
                },
                {
                    data: "pembeli",
                    name: "pembeli",
                    className: "align-middle",
                },
                {
                    data: "barang",
                    name: "barang",
                    className: "align-middle",
                },
                {
                    data: "total_harga",
                    name: "total_harga",
                    className: "align-middle",
                },
                {
                    data: "status",
                    name: "status",
                    className: "align-middle",
                },
            ]
        );
    </script>
@endpush
