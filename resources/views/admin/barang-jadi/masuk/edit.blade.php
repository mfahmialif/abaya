<!-- Modal edit record -->
<div class="offcanvas offcanvas-end" id="edit-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title">Edit Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="record pt-0 row g-2" id="form-edit-record" action="{{ route('admin.barang-jadi.masuk.update') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id">
            @include('admin.barang-jadi.masuk.form')
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
            var offCanvasEditRecord = new bootstrap.Offcanvas($('#edit-record'));

            $(document).on('click', '.edit-record-button', function() {

                $('#form-edit-record [name="new_record_btn"]').attr('disabled', true);
                $('#form-edit-record [name="pencarian"]').attr('disabled', true);
                $('#form-edit-record [name="pencarian_btn"]').attr('disabled', true);
                $('#form-edit-record [name="ukuran_barang"]').attr('disabled', true);
                $('#form-edit-record .pencarian-container').css('display', 'none');

                $('#form-edit-record [name="nama"]').attr('disabled', true);
                $('#form-edit-record [name="ukuran"]').attr('disabled', true);
                $('#form-edit-record [name="satuan"]').attr('disabled', true);
                $('#form-edit-record [name="harga"]').attr('disabled', true);

                const id = $(this).data('id');
                const kode_barang = $(this).data('kode_barang');
                const kode = $(this).data('kode');
                const nama = $(this).data('nama');
                const ukuran = $(this).data('ukuran');
                const satuan = $(this).data('satuan');
                const harga = $(this).data('harga');
                const jumlah = $(this).data('jumlah');
                const tanggal = $(this).data('tanggal');
                const keterangan = $(this).data('keterangan');

                $('#form-edit-record [name="id"]').val(id);
                $('#form-edit-record [name="pencarian"]').val(kode);
                $('#form-edit-record [name="kode_barang"]').val(kode_barang);
                $('#form-edit-record [name="kode"]').val(kode);
                $('#form-edit-record [name="nama"]').val(nama);
                $('#form-edit-record [name="ukuran"]').val(ukuran);
                $('#form-edit-record [name="satuan"]').val(satuan);
                $('#form-edit-record [name="harga"]').val(harga);
                $('#form-edit-record [name="jumlah"]').val(jumlah);
                $('#form-edit-record [name="tanggal"]').val(tanggal);
                $('#form-edit-record [name="keterangan"]').val(keterangan);

                offCanvasEditRecord.show();
                $('#form-edit-record [name="jumlah"]').focus();
            });

            $(document).on('submit', '#form-edit-record', function(e) {
                e.preventDefault();
                ajaxRequestDt(e, offCanvasEditRecord, typeof dataTable !== 'undefined' ? dataTable : null);
            });
        });
    </script>
@endpush
