<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', [AdminController::class, 'dataPegawai'])->name('dataPegawai');
Route::post('/tambahPegawai', [AdminController::class, 'tambahPegawai'])->name('tambahPegawai');
Route::put('/editPegawai/{id}', [AdminController::class, 'editPegawai'])->name('editPegawai');
Route::delete('/hapusPegawai/{id}', [AdminController::class, 'hapusPegawai'])->name('hapusPegawai');

Route::get('/dataProvinsi', [AdminController::class, 'dataProvinsi'])->name('dataProvinsi');
Route::post('/tambahProvinsi', [AdminController::class, 'tambahProvinsi'])->name('tambahProvinsi');
Route::put('/editProvinsi/{id}', [AdminController::class, 'editProvinsi'])->name('editProvinsi');
Route::delete('/hapusProvinsi/{id}', [AdminController::class, 'hapusProvinsi'])->name('hapusProvinsi');

Route::get('/dataKecamatan', [AdminController::class, 'dataKecamatan'])->name('dataKecamatan');
Route::post('/tambahKecamatan', [AdminController::class, 'tambahKecamatan'])->name('tambahKecamatan');
Route::put('/editKecamatan/{id}', [AdminController::class, 'editKecamatan'])->name('editKecamatan');
Route::delete('/hapusKecamatan/{id}', [AdminController::class, 'hapusKecamatan'])->name('hapusKecamatan');

Route::get('/dataKelurahan', [AdminController::class, 'dataKelurahan'])->name('dataKelurahan');
Route::post('/tambahKelurahan', [AdminController::class, 'tambahKelurahan'])->name('tambahKelurahan');
Route::put('/editKelurahan/{id}', [AdminController::class, 'editKelurahan'])->name('editKelurahan');
Route::delete('/hapusKelurahan/{id}', [AdminController::class, 'hapusKelurahan'])->name('hapusKelurahan');