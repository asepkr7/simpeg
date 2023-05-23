<?php

use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UsersController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('dashboard.petugas');
});
Route::get('/pegawai', function () {
    return redirect()->route('dashboard.pegawai');
});
Route::get('/petugas', function () {
    return redirect()->route('dashboard.petugas');
});
Route::get('/pegawai/dashboard',fn()=> view('dashboard'))->name('dashboard.pegawai');

Route::get('/petugas/dashboard',fn()=> view('dashboard'))->name('dashboard.petugas');
Route::resource('petugas/data-pegawai',PegawaiController::class);
// Route::get('/pegawai/data-pegawai', [PegawaiController::class,'index']);
// Route::get('petugas/data-pegawai/create', [PegawaiController::class,'create']);
// Route::post('petugas/data-pegawai/store', [PegawaiController::class,'store']);
// Route::get('petugas/data-pegawai/edit/{pegawai}', [PegawaiController::class,'edit']);
// Route::delete('petugas/data-pegawai/delete{nip}', [PegawaiController::class,'destroy']);

// Route::get('/petugas/data-pegawai','PegawaiController')->name('data-pegawai.index');
Route::resource('/petugas/users',UsersController::class);
