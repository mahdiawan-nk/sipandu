<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataIbuController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\DataJadwalPosyanduController;
use App\Http\Controllers\DataJenisVitaminController;
use App\Http\Controllers\DataJenisImunisasiController;
use App\Http\Controllers\DataCheckUpController;
use App\Http\Controllers\DataCheckImunisasiController;
use App\Http\Controllers\DataCheckVitaminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenggunaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::middleware('api')->group(function () {
    Route::resource('/dataibu', DataIbuController::class, ['as' => 'ibu', 'except' => ['create', 'edit']]);
    Route::resource('/dataanak', DataAnakController::class, ['as' => 'anak', 'except' => ['create', 'edit']]);
    Route::get('/search', [DataAnakController::class, 'search'])->name('search');
    Route::resource('/dataposyandu', DataPosyanduController::class, ['as' => 'posyandu', 'except' => ['create', 'edit']]);
    Route::resource('/datajadwalposyandu', DataJadwalPosyanduController::class, ['as' => 'jadwalposyandu', 'except' => ['create', 'edit']]);
    Route::resource('/datajenisvitamin', DataJenisVitaminController::class, ['as' => 'jenisvitamin', 'except' => ['create', 'edit']]);
    Route::resource('/datajenisimunisasi', DataJenisImunisasiController::class, ['as' => 'jenisimunisasi', 'except' => ['create', 'edit']]);
    Route::resource('/datacheckup', DataCheckUpController::class, ['as' => 'checkup', 'except' => ['create', 'edit']]);
    Route::resource('/datacheckimunisasi', DataCheckImunisasiController::class, ['as' => 'checkimunisasi', 'except' => ['create', 'edit']]);
    Route::resource('/datacheckvitamin', DataCheckVitaminController::class, ['as' => 'checkvitamin', 'except' => ['create', 'edit']]);
    Route::get('/cardstatistik', [HomeController::class, 'statistikcard'])->name('cardstatistik');
    Route::resource('/pengguna', PenggunaController::class, ['as' => 'pengguna', 'except' => ['create', 'edit']]);
});
