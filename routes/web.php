<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataIbuController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\DataJadwalPosyanduController;
use App\Http\Controllers\DataJenisVitaminController;
use App\Http\Controllers\DataJenisImunisasiController;
use App\Http\Controllers\DataCheckUpController;
use App\Http\Controllers\DataCheckImunisasiController;
use App\Http\Controllers\DataCheckVitaminController;


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

Route::get('/', function () {
    $data['for']='pengguna-ortu';
    return view('login',$data);
})->middleware('checkIfAuthenticated');


Route::get('/admin', function () {
    $data['for']='pengguna-admin';
    return view('login',$data);
})->middleware('checkIfAuthenticated');

Route::post('login', [PenggunaController::class, 'checkLogin'])->name('checklogin');
Route::middleware(['isLoggedIn'])->group(function () {
    
    
    Route::get('logout', [PenggunaController::class, 'logout'])->name('log-out');
    Route::get('home', [HomeController::class, 'index'])->name('dashboard');

    Route::get('dataibu', [DataIbuController::class, 'views'])->name('master-ibu');
    Route::get('dataanak', [DataAnakController::class, 'views'])->name('master-anak');
    Route::get('dataposyandu', [DataPosyanduController::class, 'views'])->name('master-posyandu');
    Route::get('datajadwalposyandu', [DataJadwalPosyanduController::class, 'views'])->name('master-jadwal-posyandu');
    Route::get('datajenisvitamin', [DataJenisVitaminController::class, 'views'])->name('master-jenis-vitamin');
    Route::get('datajenisimunisasi', [DataJenisImunisasiController::class, 'views'])->name('master-jenis-imunisasi');
    Route::get('datacheckup', [DataCheckUpController::class, 'views'])->name('master-check-up');
    Route::get('datacheckup/js', [DataCheckUpController::class, 'index']);
    Route::get('datacheckimunisasi', [DataCheckImunisasiController::class, 'views'])->name('master-check-imunisasi');
    Route::get('datacheckvitamin', [DataCheckVitaminController::class, 'views'])->name('master-check-vitamin');
    

});


