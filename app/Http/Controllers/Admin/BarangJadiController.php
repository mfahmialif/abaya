<?php
namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Services\Helper;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BarangJadiController extends Controller
{
    public function index()
    {
        $kategori = Helper::getEnumValues('barang', 'kategori');
        return view('admin.barang-jadi.index', compact('kategori'));
    }

    public function data(Request $request)
    {
        $search = request('search.value');
        $data   = Barang::where('kategori', 'jadi')
            ->select('*');
        return DataTables::of($data)
            ->filter(function ($query) use ($search, $request) {
                $query->where(function ($query) use ($search) {
                    $query->orWhere('nama', 'LIKE', "%$search%");
                    $query->orWhere('kategori', 'LIKE', "%$search%");
                });
            })
            ->editColumn('harga', function ($row) {
                return Helper::doubleToIdr($row->harga);
            })
            ->editColumn('foto_barang', function ($row) {
                if ($row->foto_barang == null) {
                    return '-';
                }

                if (! file_exists(public_path('barang/' . $row->foto_barang))) {
                    return 'File di server tidak ditemukan atau terhapus';
                }

                $foto_barang = asset('barang/' . $row->foto_barang);
                return '<a href="' . $foto_barang . '" data-fancybox="gallery" data-caption="' . $row->kode . '"><img src="' . $foto_barang . '" alt="Foto_barang" class="img-fluid"></a>';
            })
            ->addColumn('action', function ($row) {
                if (Auth::user()->role->akses === 'owner') {
                    return '<span class="badge bg-label-secondary">Tidak ada aksi</span>';
                }
                $actionButtons = '
                        <div class="d-inline-block">
                            <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical ti-md"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                <li>
                                    <button class="dropdown-item edit-record-button"
                                        data-id="' . $row->id . '"
                                        data-foto_barang="' . $row->foto_barang . '"
                                        >Upload Foto Barang</button></li>
                                    <div class="dropdown-divider"></div>
                                <li>
                                    <form class="form-delete-record">
                                    ' . method_field('DELETE') . csrf_field() . '
                                        <input type="hidden" name="id" value="' . $row->id . '">
                                        <input type="hidden" name="name" value="' . $row->kode_barang . '">
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>';
                return $actionButtons;
            })
            ->rawColumns(['action', 'foto_barang'])
            ->toJson();
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'id'          => 'required|exists:barang,id',
                'foto_barang' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            ];

            $request->validate($rules);

            $barang = Barang::find($request->id);

            // upload foto_barang di direktori public/barang, jika tidak ada maka buat
            if (! file_exists(public_path('barang'))) {
                mkdir(public_path('barang'), 0755, true);
            }

            // hapus foto_barang lama
            if ($barang->foto_barang) {
                unlink(public_path('barang/' . $barang->foto_barang));
            }

            // upload foto_barang dengan nama kode-uniqid-ext
            $foto_barang     = $request->file('foto_barang');
            $foto_barangName = $barang->kode . '-' . uniqid() . '.' . $foto_barang->getClientOriginalExtension();
            $foto_barang->move(public_path('barang'), $foto_barangName);
            $barang->update([
                'foto_barang' => $foto_barangName,
            ]);

            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Berhasil upload foto_barang',
            ];
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'type'    => 'error',
                'message' => implode('<br><br>', array_map('implode', $e->errors())),
                'req'     => $request->all(),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status'  => false,
                'type'    => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'id' => 'required',
            ]);

            $barang = Barang::findOrFail($request->id);
            if ($barang->foto_barang) {
                if (file_exists(public_path('barang/' . $barang->foto_barang))) {
                    unlink(public_path('barang/' . $barang->foto_barang));
                }
            }

            $stokBarang = $barang->stokBarang;
            foreach ($stokBarang as $stok) {
                if ($stok->foto) {
                    if (file_exists(public_path('stok-barang/' . $stok->foto))) {
                        unlink(public_path('stok-barang/' . $stok->foto));
                    }
                }
                $stok->delete();
            }
            $barang->delete();

            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Success',
                'request' => $request->all(),
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status'  => false,
                'type'    => 'error',
                'message' => $th->getMessage(),
                'request' => $request->all(),
            ];
        }
    }
}
