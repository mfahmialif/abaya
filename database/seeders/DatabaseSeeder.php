<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Hapus folder stok-barang dan barang
        if (file_exists(public_path('stok-barang'))) {
            \File::deleteDirectory(public_path('stok-barang'));
        }
        if (file_exists(public_path('barang'))) {
            \File::deleteDirectory(public_path('barang'));
        }
        // Seeder lama
        DB::table('role')->insert([
            'akses' => 'admin',
        ]);
        DB::table('role')->insert([
            'akses' => 'user',
        ]);
        DB::table('role')->insert([
            'akses' => 'jadi',
        ]);
        DB::table('role')->insert([
            'akses' => 'mentah',
        ]);
        DB::table('users')->insert([
            'email'         => 'admin@example.com',
            'username'      => 'admin',
            'name'          => 'Admin',
            'password'      => bcrypt('admin'),
            'role_id'       => 1,
            'jenis_kelamin' => '*',
        ]);
        DB::table('users')->insert([
            'email'         => 'user@example.com',
            'username'      => 'user',
            'name'          => 'User',
            'password'      => bcrypt('user'),
            'role_id'       => 2,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        DB::table('users')->insert([
            'email'         => 'user2@example.com',
            'username'      => 'user2',
            'name'          => 'User 2',
            'password'      => bcrypt('user2'),
            'role_id'       => 2,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        DB::table('users')->insert([
            'email'         => 'jadi@example.com',
            'username'      => 'jadi',
            'name'          => 'Jadi',
            'password'      => bcrypt('jadi'),
            'role_id'       => 3,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        DB::table('users')->insert([
            'email'         => 'mentah@example.com',
            'username'      => 'mentah',
            'name'          => 'Mentah',
            'password'      => bcrypt('mentah'),
            'role_id'       => 4,
            'jenis_kelamin' => 'Laki-laki',
        ]);

        // Seeder untuk barang
        $barang1_id = DB::table('barang')->insertGetId([
            'kode_barang' => 'KK-1212',
            'nama'        => 'Kain Katun',
            'kategori'    => 'mentah',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        $barang2_id = DB::table('barang')->insertGetId([
            'kode_barang' => 'AA-1212',
            'nama'        => 'Abaya Hitam',
            'kategori'    => 'jadi',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Seeder untuk stok_barang
        $stok1_id = DB::table('stok_barang')->insertGetId([
            'barang_id'  => $barang1_id,
            'kode'       => 'KK-001',
            'ukuran'     => '2 meter',
            'stok'       => 0,
            'harga'      => 50000,
            'satuan'     => 'meter',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $stok2_id = DB::table('stok_barang')->insertGetId([
            'barang_id'  => $barang2_id,
            'kode'       => 'AH-001',
            'ukuran'     => 'L',
            'stok'       => 0,
            'harga'      => 200000,
            'satuan'     => 'pcs',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seeder untuk barang_masuk
        DB::table('barang_masuk')->insert([
            'stok_barang_id' => $stok1_id,
            'jumlah'         => 20,
            'tanggal'        => now()->subDays(2)->toDateString(),
            'keterangan'     => 'Pembelian bahan baru',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        DB::table('barang_masuk')->insert([
            'stok_barang_id' => $stok2_id,
            'jumlah'         => 10,
            'tanggal'        => now()->subDays(1)->toDateString(),
            'keterangan'     => 'Stok abaya ready',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Seeder untuk barang_keluar
        // Untuk barang mentah tetap diinput manual
        DB::table('barang_keluar')->insert([
            'stok_barang_id' => $stok1_id,
            'jumlah'         => 5,
            'tanggal'        => now()->toDateString(),
            'keterangan'     => 'Digunakan untuk produksi',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        // Untuk barang jadi, data barang_keluar hanya diinput dari transaksi

        // Seeder untuk transaksi dan barang_keluar otomatis
        // Transaksi hanya untuk barang jadi
        // Contoh: Siti membeli Abaya Hitam 1 pcs
        $jumlahSiti         = 1;
        $barangKeluarSitiId = DB::table('barang_keluar')->insertGetId([
            'stok_barang_id' => $stok2_id,
            'jumlah'         => $jumlahSiti,
            'tanggal'        => now()->toDateString(),
            'keterangan'     => 'Siti membeli barang',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        // DB::table('transaksi')->insert([
        //     'barang_keluar_id' => $barangKeluarSitiId,
        //     'nama_pembeli'     => 'Siti Aminah',
        //     'alamat'           => 'Jl. Melati No. 5',
        //     'no_hp'            => '08234567890',
        //     'email'            => 'siti@example.com',
        //     'tanggal'          => now()->toDateString(),
        //     'total'            => 200000,
        //     'keterangan'       => 'Pembelian Abaya Hitam',
        //     'created_at'       => now(),
        //     'updated_at'       => now(),
        // ]);
        // ...existing code...

        // Transaksi Siti membeli Abaya Hitam 1 pcs
        $jumlahSiti         = 1;
        $barangKeluarSitiId = DB::table('barang_keluar')->insertGetId([
            'stok_barang_id' => $stok2_id,
            'jumlah'         => $jumlahSiti,
            'tanggal'        => now()->toDateString(),
            'keterangan'     => 'Siti membeli barang',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        // DB::table('transaksi')->insert([
        //     'barang_keluar_id' => $barangKeluarSitiId,
        //     'nama_pembeli'     => 'Siti Aminah',
        //     'alamat'           => 'Jl. Melati No. 5',
        //     'no_hp'            => '08234567890',
        //     'email'            => 'siti@example.com',
        //     'tanggal'          => now()->toDateString(),
        //     'total'            => 200000,
        //     'keterangan'       => 'Pembelian Abaya Hitam',
        //     'created_at'       => now(),
        //     'updated_at'       => now(),
        // ]);
        // Transaksi Siti membeli Abaya Hitam 1 pcs
        $jumlahSiti         = 1;
        $barangKeluarSitiId = DB::table('barang_keluar')->insertGetId([
            'stok_barang_id' => $stok2_id,
            'jumlah'         => $jumlahSiti,
            'tanggal'        => now()->toDateString(),
            'keterangan'     => 'Siti membeli barang',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
        // DB::table('transaksi')->insert([
        //     'barang_keluar_id' => $barangKeluarSitiId,
        //     'nama_pembeli'     => 'Siti Aminah',
        //     'alamat'           => 'Jl. Melati No. 5',
        //     'no_hp'            => '08234567890',
        //     'email'            => 'siti@example.com',
        //     'tanggal'          => now()->toDateString(),
        //     'total'            => 200000,
        //     'keterangan'       => 'Pembelian Abaya Hitam',
        //     'created_at'       => now(),
        //     'updated_at'       => now(),
        // ]);

// Seeder untuk transaksi
        DB::table('transaksi')->insert([
            'kode_transaksi' => 'TRX-001',
            'pembeli_id'     => 2,
            'stok_barang_id' => $stok2_id,
            'jumlah'         => 1,
            'tanggal'        => now()->toDateString(),
            'total_harga'    => 200000,
            'status'         => 'proses',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        DB::table('transaksi')->insert([
            'kode_transaksi' => 'TRX-002',
            'pembeli_id'     => 3,
            'stok_barang_id' => $stok1_id,
            'jumlah'         => 2,
            'tanggal'        => now()->subDays(1)->toDateString(),
            'total_harga'    => 100000,
            'status'         => 'selesai',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Update stok barang sesuai barang masuk dan keluar (setelah semua transaksi dan barang keluar diinsert)
        $stokMasuk1  = DB::table('barang_masuk')->where('stok_barang_id', $stok1_id)->sum('jumlah');
        $stokKeluar1 = DB::table('barang_keluar')->where('stok_barang_id', $stok1_id)->sum('jumlah');
        $stokAkhir1  = $stokMasuk1 - $stokKeluar1;
        DB::table('stok_barang')->where('id', $stok1_id)->update(['stok' => $stokAkhir1]);

        $stokMasuk2  = DB::table('barang_masuk')->where('stok_barang_id', $stok2_id)->sum('jumlah');
        $stokKeluar2 = DB::table('barang_keluar')->where('stok_barang_id', $stok2_id)->sum('jumlah');
        $stokAkhir2  = $stokMasuk2 - $stokKeluar2;
        DB::table('stok_barang')->where('id', $stok2_id)->update(['stok' => $stokAkhir2]);
    }
}
