<?php

use App\Http\Controllers\DatakelembabanController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ResetpasswordController;
use App\Http\Controllers\SpeedometerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('general.homepage');
});
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [HomepageController::class, 'loginview']);
    Route::post('/login', [LoginController::class, 'validation']);
});

Route::get('/lupapassword', [LoginController::class, 'lupapasswordview']);
Route::post('/lupapassword', [ResetpasswordController::class, 'reset']);

Route::post('/owner/datakelembaban', [DatakelembabanController::class, 'sensordata']);

Route::middleware(['auth'])->group(function() {
    
    
    Route::get('/owner/datakelembaban', [DatakelembabanController::class, 'datakelembabanview']);
    Route::get('/kepalakandang/datakelembaban', [DatakelembabanController::class, 'datakelembabanview']);

    Route::get('/owner/speedometer', [DatakelembabanController::class, 'speedometer']);
    
    Route::get('/owner/profil', [ProfilController::class, 'profilview']);
    Route::get('/kepalakandang/profil', [ProfilController::class, 'profilview']);

    Route::get('/owner/profil/gantiprofil', [ProfilController::class, 'gantiprofilview']);
    Route::post('/owner/profil/gantiprofil', [ProfilController::class, 'validation']);


    Route::get('/logout', [LoginController::class, 'logout']);
});
