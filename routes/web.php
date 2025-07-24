<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriPembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SnapController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\TingkatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/redirect', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/dashboard');
    } else if (auth()->user()->role === 'siswa') {
        return redirect('/siswa/beranda');
    }
    abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('redirect');




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //crud siswa
    Route::get('/user', [SiswaController::class, 'user'])->name('user.index');
    Route::get('/pembayaran', [PembayaranController::class, 'pembayaran'])->name('pembayaran.index');
    Route::get('/kirim_tagihan', [TagihanController::class, 'index'])->name('kirim_tagihan.index');
    Route::post('/kirim_tagihan', [TagihanController::class, 'store'])->name('kirim_tagihan.store');


    Route::get('/tahun_ajaran', [TahunAjaranController::class, 'index'])->name('tahun_ajaran.index');
    Route::post('/tahun_ajaran', [TahunAjaranController::class, 'store'])->name('tahun_ajaran.store');
    Route::get('/jurusan', [JurusanController::class, 'jurusan'])->name('jurusan.index');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/tingkat', [TingkatController::class, 'index'])->name('tingkat.index');
    Route::post('/tingkat', [TingkatController::class, 'store'])->name('tingkat.store');
    Route::get('/rombel', [RombelController::class, 'index'])->name('rombel.index');
    Route::post('/rombel', [RombelController::class, 'store'])->name('rombel.store');
    Route::get('/kategori', [KategoriPembayaranController::class, 'kategori'])->name('kategori.index');
    Route::post('/kategori', [KategoriPembayaranController::class, 'store'])->name('kategori.store');
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswas.index');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::post('/siswa/pindah', [SiswaController::class, 'pindah'])->name('siswa.pindah');

    Route::get('/laporanspp', [LaporanController::class, 'laporanspp'])->name('admin.laporan.spp');
    Route::get('/laporanujian', [LaporanController::class, 'laporanujian'])->name('admin.laporan.ujian');


    // routes/web.php
    Route::get('/siswa/{id}/detail-a4', [SiswaController::class, 'detailA4'])->name('siswa.detailA4');

    // Proses update data
    Route::put('/tahun_ajaran/{id}', [TahunAjaranController::class, 'update'])->name('tahun_ajaran.update');
    Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::put('/tingkat/{id}', [TingkatController::class, 'update'])->name('tingkat.update');
    Route::put('/rombel/{id}', [RombelController::class, 'update'])->name('rombel.update');
    // Proses update rombel secara massal
    Route::post('/siswa/update-rombel-batch', [SiswaController::class, 'updateRombelBatch'])->name('siswa.updateRombelBatch');
    Route::put('/kategori_pembayaran/{id}', [KategoriPembayaranController::class, 'update'])->name('kategori_pembayaran.update');

    // Proses hapus data
    Route::delete('/tahun_ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('tahun_ajaran.destroy');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    Route::delete('/tingkat/{id}', [TingkatController::class, 'destroy'])->name('tingkat.destroy');
    Route::delete('/rombel/{id}', [RombelController::class, 'destroy'])->name('rombel.destroy');
    Route::delete('/kategori_pembayaran/{id}', [KategoriPembayaranController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/riwayat-pembayaran/{id}', [PembayaranController::class, 'riwayat']);
    
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/siswa/import', [SiswaController::class, 'importForm'])->name('siswa.importForm');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
});


Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/beranda', function () {
        return view('siswa.index');
    })->name('siswa.index');

    Route::get('siswa/pembayaran/spp', [PembayaranController::class, 'spp'])->name('siswa.pembayaran.spp');
    Route::get('siswa/pembayaran/ujian', [PembayaranController::class, 'ujian'])->name('siswa.pembayaran.ujian');

    Route::get('siswa/pembayaran/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('siswa.pembayaran.konfirmasi');
    Route::post('siswa/pembayaran/kirim', [PembayaranController::class, 'kirim'])->name('siswa.pembayaran.kirim');

    Route::get('siswa/riwayat/spp', [RiwayatController::class, 'spp'])->name('siswa.riwayat.riwayat-spp');
    Route::get('siswa/riwayat/ujian', [RiwayatController::class, 'ujian'])->name('siswa.riwayat.riwayat-ujian');
    Route::get('siswa/riwayat/total', [RiwayatController::class, 'total'])->name('siswa.riwayat.riwayat-total');
});

Route::post('/snap/bayar', [SnapController::class, 'bayar'])->name('snap.bayar');
Route::post('/midtrans/callback', [SnapController::class, 'callback']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
