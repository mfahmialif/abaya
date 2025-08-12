<div class="card mb-6 p-0">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <label class="form-label">Tanggal: </label>
                <select class="form-select select2" id="tanggal_filter">
                    <option value="*">Semua Tanggal</option>
                    <option value="custom">Pilih Tanggal</option>
                </select>
            </div>
        </div>

        <div class="row mt-2" id="custom_date_inputs" style="display: none;">
            <div class="col-sm-6">
                <label class="form-label">Tanggal Mulai:</label>
                <input type="date" class="form-control" id="tanggal_mulai">
            </div>
            <div class="col-sm-6">
                <label class="form-label">Tanggal Selesai:</label>
                <input type="date" class="form-control" id="tanggal_selesai">
            </div>
            <div class="col-sm-12 mt-2">
                <button class="btn btn-primary me-2" id="btn_filter">Filter</button>
                <button class="btn btn-secondary" id="btn_reset">Hapus Filter</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#tanggal_filter').change(function() {
        if ($(this).val() === 'custom') {
            $('#custom_date_inputs').show();
        } else {
            $('#custom_date_inputs').hide();
            dataTable.ajax.reload(null, false);
        }
    });

    $('#btn_filter').click(function(e) {
        e.preventDefault();
        dataTable.ajax.reload(null, false);
    });

    $('#btn_reset').click(function(e) {
        e.preventDefault();
        $('#tanggal_filter').val('*').trigger('change');
        $('#tanggal_mulai').val('');
        $('#tanggal_selesai').val('');
        dataTable.ajax.reload(null, false);
    });
</script>
@endpush
