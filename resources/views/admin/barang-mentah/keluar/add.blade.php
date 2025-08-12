<!-- Modal new record -->
<div class="offcanvas offcanvas-end" id="new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">New Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="record pt-0 row g-2" id="form-new-record" action="{{ route('admin.barang-mentah.keluar.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.barang-mentah.keluar.form')
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
            initializeAutocomplete("#new-record input[name='pencarian']", "#new-record");

            // Initialize autocomplete when the offcanvas is opened
            $('#new-record').on('shown.bs.offcanvas', function() {
                $('#form-new-record [name="pencarian"]').focus();
            });

            var offCanvasNewRecord = new bootstrap.Offcanvas($('#new-record'));

            $(document).on('click', '#new-record-button', function() {
                offCanvasNewRecord.show();
                $('#form-new-record [name="username"]').focus();
            });

            // set tanggal sekarang
            $('#form-new-record [name="tanggal"]').val(new Date().toISOString().split('T')[0]);

            $('#form-new-record button[name="pencarian_btn"]').click(function(e) {
                e.preventDefault();
                ukuran('#new-record', $('#new-record [name="pencarian"]').val());
            });

            $('#form-new-record [name="ukuran_barang"]').change(function(e) {
                e.preventDefault();
                initSelectUkuranBarang($(this), '#form-new-record');
            });

            $(document).on('submit', '#form-new-record', function(e) {
                e.preventDefault();
                ajaxRequestDt(e, offCanvasNewRecord, dataTable);
                $('#form-new-record').find('[name="ukuran_barang"]').empty();

                $('#form-new-record').find('[name="jumlah"]').attr('disabled', true);
                $('#form-new-record').find('[name="tanggal"]').attr('disabled', true);
                $('#form-new-record').find('[name="keterangan"]').attr('disabled', true);

                $('#form-new-record').find('[name="pencarian"]').val('');
                $('#form-new-record').find('[name="barang_id"]').val('');
                $('#form-new-record').find('[name="stok_barang_id"]').val('');
                $('#form-new-record').find('[name="kode_barang"]').val('');
                $('#form-new-record').find('[name="kode"]').val('');
                $('#form-new-record').find('[name="nama"]').val('');
                $('#form-new-record').find('[name="ukuran"]').val('');
                $('#form-new-record').find('[name="satuan"]').val('');
                $('#form-new-record').find('[name="harga"]').val('');
                $('#form-new-record').find('[name="jumlah"]').val('');
                $('#form-new-record [name="tanggal"]').val(new Date().toISOString().split('T')[0]);
                $('#form-new-record').find('[name="keterangan"]').val('');
            });
        });
    </script>
@endpush
