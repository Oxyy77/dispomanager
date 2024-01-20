<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SekretarisController;



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
Route::get('/dashboard/kurir', [KurirController::class, 'index'])->name('dashboard.kurir')->middleware('auth');


// route direktur
Route::get('/dashboard/direktur', [DirekturController::class, 'index'])->name('dashboard.direktur')->middleware('auth');
// route frontend
Route::get('/kelola-direktur', function () {
    return view('direktur.kelola');
})->middleware('auth');

Route::get('/tambah-surat', function () {
    return view('direktur.tambah-surat');
})->middleware('auth');

Route::get('/format-surat', function () {
    return view('direktur.format-surat');
})->middleware('auth');

Route::get('/tambah-format', function () {
    return view('direktur.tambah-format');
})->middleware('auth');

Route::get('/surat-masuk', function () {
    return view('direktur.surat-masuk');
})->middleware('auth');

Route::get('/baca-surat', function () {
    return view('direktur.baca-surat');
})->middleware('auth');

Route::get('/data-surat', function () {
    return view('direktur.data');
})->middleware('auth');

// route sekretaris
Route::get('/dashboard/sekretaris', [SekretarisController::class, 'index'])->name('dashboard.sekretaris')->middleware('auth');
// route frontend
Route::get('/kelola-sekretaris', function () {
    return view('sekretaris.kelola');
})->middleware('auth');

Route::get('/sekretaris/tambah-surat', function () {
    return view('sekretaris.tambah-surat');
})->middleware('auth');

Route::get('/sekretaris/format-surat', function () {
    return view('sekretaris.format-surat');
})->middleware('auth');

Route::get('/sekretaris/tambah-format', function () {
    return view('sekretaris.tambah-format');
})->middleware('auth');

Route::get('/sekretaris/surat-masuk', function () {
    return view('sekretaris.surat-masuk');
})->middleware('auth');

Route::get('/sekretaris/baca-surat', function () {
    return view('sekretaris.baca-surat');
})->middleware('auth');

Route::get('/sekretaris/data-surat', function () {
    return view('sekretaris.data');
})->middleware('auth');

// route kurir
Route::get('/dashboard/kurir', [KurirController::class, 'index'])->name('dashboard.kurir')->middleware('auth');



Route::get('/kurir/surat-masuk', function () {
    return view('kurir.surat-masuk');
})->middleware('auth');

Route::get('/kurir/surat-keluar', function () {
    return view('kurir.surat-keluar');
})->middleware('auth');

Route::get('/kurir/data-surat', function () {
    return view('kurir.data');
})->middleware('auth');