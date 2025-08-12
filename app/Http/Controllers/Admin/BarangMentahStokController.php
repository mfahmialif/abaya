<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Services\Helper;
use App\Http\Services\BulkData;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class BarangMentahStokController extends Controller
{
    public function index()
    {
        $kategori = Helper::getEnumValues('barang', 'kategori');
        return view('admin.barang-mentah.stok.index', compact('kategori'));
    }

    public function data(Request $request)
    {
        $search = request('search.value');
        $data   = Barang::join('stok_barang', 'barang.id', '=', 'stok_barang.barang_id')
            ->where('barang.kategori', 'mentah')
            ->select('barang.*', 'stok_barang.ukuran', 'stok_barang.satuan', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.kode');
        return DataTables::of($data)
            ->filter(function ($query) use ($search, $request) {
                $query->where(function ($query) use ($search) {
                    $query->orWhere('barang.nama', 'LIKE', "%$search%");
                    $query->orWhere('barang.kategori', 'LIKE', "%$search%");
                    $query->orWhere('stok_barang.kode', 'LIKE', "%$search%");
                });
            })
            ->editColumn('harga', function ($row) {
                return Helper::doubleToIdr($row->harga);
            })
            ->toJson();
    }

}
