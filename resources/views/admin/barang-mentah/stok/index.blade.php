@extends('layouts.admin.template')
@section('title', 'Stok Barang Mentah')
@section('content')

    <div class="card" id="card1">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-hover" id="table-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Barang</th>
                        <th>Ukuran</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        var dataTable = initDataTables('table-1', 'loader-user', 'card1', null, false,
            'Stok Barang Mentah', "{{ route('admin.barang-mentah.stok.data') }}",
            [{
                    data: "kode",
                    name: "kode",
                    className: "align-middle",
                },
                {
                    data: "nama",
                    name: "nama",
                    className: "align-middle",
                },
                {
                    data: "ukuran",
                    name: "ukuran",
                    className: "align-middle",
                },
                {
                    data: "satuan",
                    name: "satuan",
                    className: "align-middle",
                },
                {
                    data: "harga",
                    name: "harga",
                    className: "align-middle",
                },
                {
                    data: "stok",
                    name: "stok",
                    className: "align-middle",
                },
            ]
        );
    </script>
@endpush
