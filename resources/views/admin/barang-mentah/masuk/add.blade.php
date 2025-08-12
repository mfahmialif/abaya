<!-- Modal new record -->
<div class="offcanvas offcanvas-end" id="new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">New Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="record pt-0 row g-2" id="form-new-record" action="{{ route('admin.barang-mentah.masuk.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.barang-mentah.masuk.form')
            <div class="col-sm-12 mt-4">
                <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            var offCanvasNewRecord = new bootstrap.Offcanvas($('#new-record'));

            $(document).on('click', '#new-record-button', function() {
                offCanvasNewRecord.show();
                $('#form-new-record [name="username"]').focus();
            });

            // set tanggal sekarang
            $('#form-new-record [name="tanggal"]').val(new Date().toISOString().split('T')[0]);

            // Initialize autocomplete when the offcanvas is opened
            $('#new-record').on('shown.bs.offcanvas', function() {
                initializeAutocomplete("#new-record input[name='pencarian']", "#new-record");
            });

            $('#form-new-record button[name="pencarian_btn"]').click(function(e) {
                e.preventDefault();
                search('#new-record', $('#new-record input[name="pencarian"]').val());
            });

            $('#form-new-record button[name="new_record_btn"]').click(function(e) {
                e.preventDefault();
                $('#form-new-record').find('input[name="nama"]').attr('disabled', false);
                $('#form-new-record').find('input[name="ukuran"]').attr('disabled', false);
                $('#form-new-record').find('input[name="satuan"]').attr('disabled', false);
                $('#form-new-record').find('input[name="harga"]').attr('disabled', false);

                $('#form-new-record').find('input[name="nama"]').focus();
            });

            $(document).on('submit', '#form-new-record', function(e) {
                e.preventDefault();
                ajaxRequestDt(e, offCanvasNewRecord, dataTable);

                $('#form-new-record').find('input[name="nama"]').attr('disabled', false);
                $('#form-new-record').find('input[name="ukuran"]').attr('disabled', false);
                $('#form-new-record').find('input[name="satuan"]').attr('disabled', false);
                $('#form-new-record').find('input[name="harga"]').attr('disabled', false);

                $('#form-new-record').find('input[name="pencarian"]').val('');
                $('#form-new-record').find('input[name="stok_barang_id"]').val('');
                $('#form-new-record').find('input[name="kode"]').val('');
                $('#form-new-record').find('input[name="nama"]').val('');
                $('#form-new-record').find('input[name="ukuran"]').val('');
                $('#form-new-record').find('input[name="satuan"]').val('');
                $('#form-new-record').find('input[name="harga"]').val('');
                $('#form-new-record').find('input[name="jumlah"]').val('');
                $('#form-new-record [name="tanggal"]').val(new Date().toISOString().split('T')[0]);
                $('#form-new-record').find('textarea[name="keterangan"]').val('');
            });
        });
    </script>
@endpush
