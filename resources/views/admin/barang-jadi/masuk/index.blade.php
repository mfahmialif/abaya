@extends('layouts.admin.template')
@section('title', 'Barang Jadi Masuk')
@section('content')

    @include('admin.barang-jadi.masuk.filter')
    <div class="card" id="card1">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-hover" id="table-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('admin.barang-jadi.masuk.add')
    @include('admin.barang-jadi.masuk.edit')


    <div class="modal fade" id="modal_keterangan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="isi"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
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
                        url: "{{ route('admin.barang-jadi.masuk.delete') }}",
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

        const modalKeterangan = document.getElementById('modal_keterangan')
        if (modalKeterangan) {
            modalKeterangan.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const keterangan = button.getAttribute('data-keterangan');

                $('#isi').attr('style', 'white-space:pre-wrap').html(keterangan);
            })
        }
    </script>

    <script>
        var dataTable = initDataTables('table-1', 'loader-user', 'card1', 'new-record-button', false,
            'Barang Jadi Masuk', "{{ route('admin.barang-jadi.masuk.data') }}",
            [{
                    data: "nama",
                    name: "nama",
                    className: "align-middle",
                },
                {
                    data: "tanggal",
                    name: "tanggal",
                    className: "align-middle",
                },
                {
                    data: "jumlah",
                    name: "jumlah",
                    className: "align-middle",
                },
                {
                    data: "keterangan",
                    name: "keterangan",
                    className: "align-middle",
                },
                {
                    data: "action",
                    name: "action",
                    className: "align-middle",
                    searchable: false,
                    orderable: false,
                },
            ],
            ['tanggal_filter', 'tanggal_mulai', 'tanggal_selesai']
        );

        function initializeAutocomplete(inputSearch, offcanvasID) {
            $(inputSearch).autocomplete({
                appendTo: offcanvasID,
                source: function(request, response) {
                    var url =
                        "{{ route('operasi.barang.autocomplete', ['kategori' => 'jadi', 'query' => 'query']) }}";
                    url = url.replace('query', request.term);

                    $.ajax({
                        type: "get",
                        url: url,
                        success: function(data) {
                            response(data.map(item => ({
                                label: item.label,
                                value: item.value
                            })));
                        }
                    });
                },
                select: function(event, ui) {
                    // Set the label in the user input
                    $(inputSearch).val(ui.item.value);
                    $(inputSearch).siblings('button').trigger('click');
                    return false;
                }
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .append(`<div style="padding: 5px; font-size: 14px;">${item.label}</div>`)
                    .appendTo(ul);
            };
        }

        function ukuran(formId, kode) {
            $(formId).find('[name="nama"]').attr('disabled', true);
            $(formId).find('[name="ukuran"]').attr('disabled', false);
            $(formId).find('[name="satuan"]').attr('disabled', false);
            $(formId).find('[name="harga"]').attr('disabled', false);

            $(formId).find('[name="barang_id"]').val('');
            $(formId).find('[name="stok_barang_id"]').val('');

            $(formId).find('[name="kode_barang"]').val('');
            $(formId).find('[name="kode"]').val('');
            $(formId).find('[name="nama"]').val('');
            $(formId).find('[name="ukuran"]').val('');
            $(formId).find('[name="satuan"]').val('');
            $(formId).find('[name="harga"]').val('');

            $(formId).find('[name="ukuran_barang"]').empty();
            $(formId).find('[name="ukuran_barang"]').append(`<option value="">- Pilih Ukuran -</option>`);
            var url =
                "{{ route('operasi.barang.ukuran', ['kode' => 'kode']) }}";
            url = url.replace('kode', kode);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    if (!response.barang) {
                        showToastr('error', 'error', 'Barang Tidak ditemukan');
                        $(formId).find('[name="nama"]').attr('disabled', false);
                        $(formId).find('[name="nama"]').focus();
                        return false;
                    }
                    $(formId).find('[name="barang_id"]').val(response.barang.id);
                    $(formId).find('[name="nama"]').val(response.barang.nama);
                    $(formId).find('[name="kode_barang"]').val(response.barang.kode_barang);

                    if (response.stokBarang.length <= 0) {
                        showToastr('error', 'error', 'Stok Barang Tidak Ditemukan');
                        $(formId).find('[name="ukuran"]').focus();
                        return false;
                    }
                    let content = '';
                    response.stokBarang.forEach(element => {
                        content += `<option value="${element.id}">${element.nama} - ${element.ukuran}`
                    });
                    $(formId).find('select[name="ukuran_barang"]').append(content);
                    $(formId).find('select[name="ukuran_barang"]').focus();
                },
                error: function(response) {
                    showToastr('error', 'error', 'Barang Tidak ditemukan');
                    $(formId).find('[name="nama"]').attr('disabled', false);
                    $(formId).find('[name="nama"]').focus();
                }
            });
        }

        function initSelectUkuranBarang(selectElement, formId) {
            $(formId).find('[name="ukuran"]').attr('disabled', false);
            $(formId).find('[name="satuan"]').attr('disabled', false);
            $(formId).find('[name="harga"]').attr('disabled', false);

            var stokBarangId = selectElement.val();
            var url =
                "{{ route('operasi.barang.stokBarang', ['stokBarangId' => 'stokBarangId']) }}";
            url = url.replace('stokBarangId', stokBarangId);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    $(formId).find('[name="ukuran"]').attr('disabled', true);
                    $(formId).find('[name="satuan"]').attr('disabled', true);
                    $(formId).find('[name="harga"]').attr('disabled', true);

                    $(formId).find('[name="stok_barang_id"]').val(response.id);
                    $(formId).find('[name="kode"]').val(response.kode);
                    $(formId).find('[name="ukuran"]').val(response.ukuran);
                    $(formId).find('[name="satuan"]').val(response.satuan);
                    $(formId).find('[name="harga"]').val(response.harga);

                    $(formId).find('[name="jumlah"]').focus();

                },
                error: function(response) {
                    showToastr('error', 'error', 'Barang Tidak ditemukan');
                    $(formId).find('[name="ukuran"]').focus();
                }
            });
        }
    </script>
@endpush
