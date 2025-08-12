<div class="col-sm-12">
    <button type="button" class="btn btn-primary w-100" name="new_record_btn"><i
            class="ti ti-plus"></i> Tambah Barang Masuk</button>
</div>
<div class="col-sm-12">
    <label class="form-label" for="pencarian">Pencarian Nama Barang</label>
    <div class="input-group input-group-merge">
        <input type="text" class="form-control" name="pencarian" placeholder="Type here..." aria-label="Type here..."
            aria-describedby="pencarian2" />
        <button type="button" class="btn btn-outline-secondary" type="button" name="pencarian_btn">
            <i class="ti ti-search"></i>
        </button>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <input type="hidden" name="stok_barang_id">
        <div class="col-6">
            <label class="form-label" for="kode">Kode</label>
            <div class="input-group input-group-merge">
                <input type="text" class="form-control" name="kode" placeholder="Nama" aria-label="Type here..."
                    aria-describedby="kode2" disabled required />
            </div>
        </div>
        <div class="col-6">
            <label class="form-label" for="nama">Nama</label>
            <div class="input-group input-group-merge">
                <input type="text" class="form-control" name="nama" placeholder="Nama" aria-label="Type here..."
                    aria-describedby="nama2" disabled required />
            </div>
        </div>
        <div class="col-4">
            <label class="form-label" for="ukuran">Ukuran</label>
            <div class="input-group input-group-merge">
                <input type="number" class="form-control" name="ukuran" placeholder="Ukuran" aria-label="Type here..."
                    aria-describedby="ukuran2" disabled required />
            </div>
        </div>
        <div class="col-4">
            <label class="form-label" for="satuan">Satuan</label>
            <div class="input-group input-group-merge">
                <input type="text" class="form-control" name="satuan" placeholder="Satuan" aria-label="Type here..."
                    aria-describedby="satuan2" disabled required />
            </div>
        </div>
        <div class="col-4">
            <label class="form-label" for="harga">Harga</label>
            <div class="input-group input-group-merge">
                <input type="number" class="form-control" name="harga" placeholder="Harga" aria-label="Type here..."
                    aria-describedby="harga2" disabled required />
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <label class="form-label" for="jumlah">Jumlah</label>
    <div class="input-group input-group-merge">
        <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" aria-label="Type here..."
            aria-describedby="jumlah2" required />
    </div>
</div>
<div class="col-sm-12">
    <label class="form-label" for="tanggal">Tanggal</label>
    <div class="input-group input-group-merge">
        <input type="date" class="form-control" name="tanggal" placeholder="Tanggal" aria-label="Type here..."
            aria-describedby="tanggal2" required />
    </div>
</div>
<div class="col-sm-12">
    <label class="form-label" for="keterangan">Keterangan</label>
    <div class="input-group input-group-merge">
        <textarea class="form-control" name="keterangan" placeholder="Isi keterangan / bisa dikosongi..." aria-label="Type here..."
            aria-describedby="keterangan2" /></textarea>
    </div>
</div>
