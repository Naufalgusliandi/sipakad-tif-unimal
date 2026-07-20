<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SipakadApiController;

// Endpoint Public REST API SIPAKAD
Route::get('/mahasiswa', [SipakadApiController::class, 'getMahasiswa']);
Route::get('/mata-kuliah', [SipakadApiController::class, 'getMataKuliah']);
Route::get('/jadwal', [SipakadApiController::class, 'getJadwal']);