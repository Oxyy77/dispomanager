<?php

use App\Models\Pengiriman;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SekrePengajuan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\SuratSekreController;
use App\Http\Controllers\Kurir\KurirController;
use App\Http\Controllers\SekreFormatController;
use App\Http\Controllers\Direktur\DirekturController;
use App\Http\Controllers\Direktur\FormatSuratController;
use App\Http\Controllers\Direktur\TambahFormatController;
use App\Http\Controllers\Sekretaris\SekretarisController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login/{userType}', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::post('/get-format-options', [SuratController::class, 'getFormatOptions']);
Route::patch('/update-status/{id}', [DirekturController::class, 'edit'])->name('update-status');



Route::middleware(['checkUserRole:direktur'])->group(function(){
    Route::get('/dashboard/direktur', [DirekturController::class, 'index'])->name('dashboard.direktur');
    Route::get('/kelola-direktur', [DirekturController::class, 'kelola']);

    Route::get('/tambah-surat', function () {
    return view('direktur.tambah-surat');
    });

    Route::get('/format-surat', [FormatSuratController::class, 'index']);

    Route::get('/tambah-format', function () {
        return view('direktur.tambah-format');
    });

    Route::get('/surat-masuk', [DirekturController::class, 'suratMasuk']);

    Route::get('/baca-surat', function () {
        return view('direktur.baca-surat');
    });

    Route::get('/data-surat', [DirekturController::class, 'semuaSurat'] );
 

    Route::resource('/format-surat/tambah', TambahFormatController::class);
    Route::resource('/tambah-surat/tambah', SuratController::class);
    Route::patch('/updateStatus/{id}', [DirekturController::class, 'bacaSurat'])->name('updateSurat');

});

Route::middleware(['checkUserRole:sekretaris'])->group(function(){
    Route::get('/dashboard/sekretaris', [SekretarisController::class, 'index'])->name('dashboard.sekretaris');
    Route::get('/kelola-sekretaris', [SekrePengajuan::class, 'index']);

    Route::get('/sekretaris/tambah-surat', function () {
    return view('sekretaris.tambah-surat');
    });

    Route::get('sekretaris/format-surat', [SekreFormatController::class, 'index']);
    Route::resource('/sekretaris/tambah-surat/tambah', SuratSekreController::class);
    Route::resource('/sekretaris/format-surat/tambah', SekreFormatController::class);

    Route::get('/sekretaris/tambah-format', function () {
        return view('sekretaris.tambah-format');
    });

    Route::get('/sekretaris/surat-masuk', [SekretarisController::class, 'suratMasuk']);
    Route::patch('/updateSekre/{id}', [SekretarisController::class, 'bacaSurat'])->name('updateSekre');


    Route::get('/sekretaris/baca-surat', function () {
        return view('sekretaris.baca-surat');
    });

    Route::get('/sekretaris/data-surat', [SekretarisController::class, 'semuaSurat']);
});

Route::middleware(['checkUserRole:kurir'])->group(function(){
    Route::get('/dashboard/kurir', [KurirController::class, 'index'])->name('dashboard.kurir');
    Route::resource('/kurir/surat-masuk', PengirimanController::class);

    Route::get('/kurir/surat-keluar', function () {
        return view('kurir.surat-keluar');
    });

    Route::get('/kurir/surat-keluar', [KurirController::class, 'suratKeluar']);

    Route::get('/kurir/data-surat', [KurirController::class, 'semuaSurat']);

    Route::put('/kurir/surat-masuk/{id}/kirim', [PengirimanController::class, 'kirim'])->name('pengiriman.kirim');
    Route::put('/kurir/surat-masuk/{id}/selesai', [PengirimanController::class, 'selesai'])->name('pengiriman.selesai');

    Route::put('/pengiriman/{id}/keluar-kirim', [PengirimanController::class, 'keluarKirim'])->name('pengiriman.kirimKeluar');
    Route::put('/pengiriman/{id}/keluar-selesai', [PengirimanController::class, 'keluarSelesai'])->name('pengiriman.selesaiKeluar');

});