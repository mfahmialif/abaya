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
                        <th>Foto</th>
                        <th>Barang</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    @include('admin.barang-mentah.edit')
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
                        url: "{{ route('admin.barang-mentah.delete') }}",
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
            'Stok Barang Mentah', "{{ route('admin.barang-mentah.data') }}",
            [{
                    data: "kode_barang",
                    name: "kode_barang",
                    className: "align-middle",
                },
                {
                    data: "foto_barang",
                    name: "foto_barang",
                    className: "align-middle",
                },
                {
                    data: "nama",
                    name: "nama",
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
    </script>
@endpush
