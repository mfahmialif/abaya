@extends('layouts.admin.template')
@section('title', 'Transaksi')
@section('content')

    <div class="card" id="card1">
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
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('submit', '.form-delete-record', function(e) {
            e.preventDefault();
            var id = $(e.target).find('input[name="id"]').val();
            var name = $(e.target).find('input[name="name"]').val();

            Swal.fire({
                title: `Are you sure delete ${name}?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.transaksi.delete') }}",
                        data: new FormData($(e.target)[0]),
                        // use [0] because inner swal so there are has 2 target, cant use currentTarget
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            showToastr(response.type, response.type, response
                                .message);
                            dataTable.ajax.reload(null, false);
                        },
                    });
                }
            });
        });

        var dataTable = initDataTables('table-1', 'loader-user', 'card1', null, false,
            'Transaksi', "{{ route('admin.transaksi.data') }}",
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
                {
                    data: "action",
                    name: "action",
                    className: "align-middle",
                    searchable: false,
                    orderable: false,
                },
            ]
        );

        function updateStatus(kodeTransaksi, status) {
            Swal.fire({
                title: `Yakin ingin update status ${kodeTransaksi} menjadi ${status}?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.transaksi.updateStatus') }}",
                        data: {
                            'kode_transaksi': kodeTransaksi,
                            'status': status,
                            '_token': '{{ csrf_token() }}',
                            '_method': 'PUT'
                        },
                        success: function(response) {
                            showToastr(response.type, response.type, response
                                .message);
                            dataTable.ajax.reload(null, false);
                        },
                    });
                }
            });
        }
    </script>
@endpush
