<?php

use App\Http\Controllers\DatakaryawanController;
use App\Http\Controllers\DatakelembabanController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ListtugasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ResetpasswordController;
use App\Http\Controllers\SpeedometerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('general.homepage');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [HomepageController::class, 'loginview']);
    Route::post('/login', [LoginController::class, 'validation']);
    Route::get('/lupapassword', [LoginController::class, 'lupapasswordview']);
    Route::post('/lupapassword', [ResetpasswordController::class, 'reset']);
});


Route::post('/owner/datakelembaban', [DatakelembabanController::class, 'sensordata']);



Route::middleware(['auth'])->group(function () {
    Route::get('/owner/datakelembaban', [DatakelembabanController::class, 'datakelembabanview_owner']);
    Route::get('/owner/profil/gantiprofil', [ProfilController::class, 'gantiprofilview_owner']);
    Route::post('/owner/profil/gantiprofil', [ProfilController::class, 'validation']);
    Route::get('/owner/datakaryawan', [DatakaryawanController::class, 'datakaryawanview_owner']);
    Route::get('/owner/listtugas', [ListtugasController::class, 'listtugasview_owner']);
    Route::get('/owner/profil', [ProfilController::class, 'profilview_owner']);

    Route::get('/kepalakandang/datakelembaban', [DatakelembabanController::class, 'datakelembabanview_kepalakandang']);
    Route::get('/kepalakandang/listtugas', [ListtugasController::class, 'listtugasview_kepalakandang']);
    Route::get('/kepalakandang/datakaryawan', [DatakaryawanController::class, 'datakaryawanview_kepalakandang']);
    Route::get('/kepalakandang/profil', [ProfilController::class, 'profilview_kepalakandang']);
    Route::get('/kepalakandang/profil/gantiprofil', [ProfilController::class, 'gantiprofilview_kepalakandang']);
    Route::post('/kepalakandang/profil/gantiprofil', [ProfilController::class, 'validation']);


    Route::post('/updatecheckbox', [ListtugasController::class, 'updateCheckbox']);
    Route::get('/dataspeedometer', [DatakelembabanController::class, 'speedometer']);
    Route::get('/datatabel', [DatakelembabanController::class, 'datatabel']);
    Route::post('/createkaryawan', [DatakaryawanController::class, 'createdata']);
    Route::put('/updatekaryawan/{id_karyawan}', [DatakaryawanController::class, 'updatedata']);
    Route::get('/idkaryawan/{id_karyawan}', [DatakaryawanController::class, 'getidkaryawan']);
    Route::delete('/deletekaryawan/{id_karyawan}', [DatakaryawanController::class, 'deletedata']);
    Route::post('/createlisttugas', [ListtugasController::class, 'createdata']);
    Route::delete('/deletelisttugas/{id_tugas}', [ListtugasController::class, 'deletedata']);
    Route::get('/logout', [LoginController::class, 'logout']);
});
