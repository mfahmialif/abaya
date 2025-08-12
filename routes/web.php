<?php

use App\Http\Controllers\Admin\BarangMentahController;
use App\Http\Controllers\Admin\BarangMentahKeluarController;
use App\Http\Controllers\Admin\BarangMentahMasukController;
use App\Http\Controllers\Admin\BarangMentahStokController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Home\LandingPageController;
use App\Http\Controllers\Home\PrivacyPolicyController;
use App\Http\Controllers\Operasi\BarangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'reset'   => false,
    'verify'  => false,
    'confirm' => false,
    'email'   => false,
]);

Route::get('/beranda', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [LandingPageController::class, 'index'])->name('root.index');
Route::get('/privacy_policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy.index');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::prefix('barang-mentah')->group(function () {
        Route::get('/', [BarangMentahController::class, 'index'])->name('admin.barang-mentah.index');
        Route::get('/data', [BarangMentahController::class, 'data'])->name('admin.barang-mentah.data');
        Route::put('/update', [BarangMentahController::class, 'update'])->name('admin.barang-mentah.update');
        Route::delete('/delete', [BarangMentahController::class, 'delete'])->name('admin.barang-mentah.delete');

        Route::prefix('stok')->group(function () {
            Route::get('/', [BarangMentahStokController::class, 'index'])->name('admin.barang-mentah.stok.index');
            Route::get('/data', [BarangMentahStokController::class, 'data'])->name('admin.barang-mentah.stok.data');
            Route::put('/update', [BarangMentahStokController::class, 'update'])->name('admin.barang-mentah.stok.update');
            Route::delete('/delete', [BarangMentahStokController::class, 'delete'])->name('admin.barang-mentah.stok.delete');
        });
        Route::prefix('masuk')->group(function () {
            Route::get('/', [BarangMentahMasukController::class, 'index'])->name('admin.barang-mentah.masuk.index');
            Route::get('/data', [BarangMentahMasukController::class, 'data'])->name('admin.barang-mentah.masuk.data');
            Route::post('/store', [BarangMentahMasukController::class, 'store'])->name('admin.barang-mentah.masuk.store');
            Route::put('/update', [BarangMentahMasukController::class, 'update'])->name('admin.barang-mentah.masuk.update');
            Route::delete('/delete', [BarangMentahMasukController::class, 'delete'])->name('admin.barang-mentah.masuk.delete');
        });
        Route::prefix('keluar')->group(function () {
            Route::get('/', [BarangMentahKeluarController::class, 'index'])->name('admin.barang-mentah.keluar.index');
            Route::get('/data', [BarangMentahKeluarController::class, 'data'])->name('admin.barang-mentah.keluar.data');
            Route::post('/store', [BarangMentahKeluarController::class, 'store'])->name('admin.barang-mentah.keluar.store');
            Route::put('/update', [BarangMentahKeluarController::class, 'update'])->name('admin.barang-mentah.keluar.update');
            Route::delete('/delete', [BarangMentahKeluarController::class, 'delete'])->name('admin.barang-mentah.keluar.delete');
        });
    });
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/data', [RoleController::class, 'data'])->name('admin.role.data');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::put('/update', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('/delete', [RoleController::class, 'delete'])->name('admin.role.delete');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/data', [UserController::class, 'data'])->name('admin.user.data');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::put('/update', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/delete', [UserController::class, 'delete'])->name('admin.user.delete');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    });
});

Route::prefix('operasi')->group(function () {
    Route::prefix('barang')->group(function () {
        Route::get('/ukuran/{kode}', [BarangController::class, 'ukuran'])->name('operasi.barang.ukuran');
        Route::get('/stokBarang/{stokBarangId}', [BarangController::class, 'stokBarang'])->name('operasi.barang.stokBarang');
        Route::get('/autocomplete/{kategori}/{query}', [BarangController::class, 'autocomplete'])->name('operasi.barang.autocomplete');
    });
});
