@extends('layouts.home.template')
@section('title', 'Detail | Absensi UII Dalwa')
@push('css')
    <style>
        .dt-layout-full {
            padding: 0 !important;
        }

        @media only screen and (max-width: 480px) {
            .table td {
                display: table-cell !important;
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush
@section('content')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Absensi <span></span> Detail
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery d-flex justify-content-center bg-brand h-100 border-radius-10">
                                    <img src="{{ asset('home/assets/imgs/theme/user.png') }}" alt="User Profile" />
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info mt-3 mt-md-0">
                                    <h2 class="title-detail">
                                        {{ $user->name }}
                                    </h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span>
                                                Departemen:
                                                <a href="products.html">{{ $user->departemen->nama }}</a></span>
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <span class="font-small ml-5 text-muted">
                                                {{ $user->absensi->count() }} Absensi</span>
                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p class="text-bold">
                                            <li>Nama : {{ $user->name }}</li>
                                            <li>Departemen : {{ $user->departemen->nama }}</li>
                                            <li>Jenis Kelamin : {{ $user->jenis_kelamin }}</li>
                                        </p>
                                    </div>

                                    <ul class="product-meta font-xs color-grey mt-50">
                                        <li class="mb-5">Departemen: <a href="#">{{ $user->departemen->nama }}</a>
                                        </li>
                                        <li class="mb-5">
                                            Role: <a href="#" rel="tag">{{ $user->role->akses }}</a>,
                                        </li>
                                    </ul>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 m-auto entry-main-content">
                                <h2 class="section-title style-1 mb-30">Absensi</h2>
                                <div class="mb-3">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label for="startDate" class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="startDate" name="startDate">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="endDate" class="form-label">Tanggal Akhir</label>
                                            <input type="date" class="form-control" id="endDate" name="endDate">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button type="button" id="filterButton"
                                                class="btn btn-primary w-100">Filter</button>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button type="button" id="resetButton"
                                                class="btn btn-secondary w-100">Tampilkan
                                                Semua Tanggal</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Jam</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Jam</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="social-icons single-share">
                                <ul class="text-grey-5 d-inline-block">
                                    <li><strong class="mr-10">Bagikan :</strong></li>
                                    <li>
                                        <a href="#" id="copyButton" class="hover-up" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Copy">
                                            <i class="fi-rs-copy"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        document.addEventListener("DOMContentLoaded", function() {
            let copyButton = document.getElementById("copyButton");

            // Inisialisasi Tooltip Bootstrap
            var tooltip = new bootstrap.Tooltip(copyButton);

            copyButton.addEventListener("click", function(e) {
                e.preventDefault(); // Mencegah navigasi default
                let currentURL = "{{ route('absensi.show', ['user' => $user]) }}"; // Ambil URL saat ini

                navigator.clipboard.writeText(currentURL).then(function() {
                    copyButton.setAttribute("title", "Copied!");
                    tooltip.dispose(); // Hapus tooltip lama
                    tooltip = new bootstrap.Tooltip(copyButton); // Buat tooltip baru
                    tooltip.show(); // Tampilkan tooltip

                    setTimeout(() => {
                        copyButton.setAttribute("title", "Copy URL");
                        tooltip.dispose();
                        tooltip = new bootstrap.Tooltip(copyButton);
                    }, 1500);
                });
            });

            let dataTable = $("#example").DataTable({
                autoWidth: true,
                processing: true,
                serverSide: true,
                search: {
                    return: true,
                },
                ajax: {
                    url: "{{ route('absensi.data', ['user' => $user]) }}",
                    method: "GET",
                    data: function(d) {
                        d.startDate = $("#startDate").val();
                        d.endDate = $("#endDate").val();
                    },
                },
                columns: [{
                        class: "text-center",
                        data: "tgl_absen",
                        name: "tgl_absen",
                    },
                    {
                        class: "text-center",
                        data: "pagi",
                        name: "pagi",
                    },
                ],
                order: [
                    [0, "desc"]
                ],
            });

            $('#startDate').change(function(e) {
                e.preventDefault();
                dataTable.ajax.reload(null, false);
            });

            $('#endDate').change(function(e) {
                e.preventDefault();
                dataTable.ajax.reload(null, false);
            });

            $('#resetButton').click(function(e) {
                e.preventDefault();
                $('#startDate').val('');
                $('#endDate').val('');
                dataTable.ajax.reload(null, false);
            });

            $('#filterButton').click(function(e) {
                e.preventDefault();
                dataTable.ajax.reload(null, false);
            });

        });
    </script>
@endpush
