<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('rooms/available', [RoomController::class, 'availableRooms']);
Route::post('patients/admit', [PatientController::class, 'admit']);
Route::post('patients/discharge', [PatientController::class, 'discharge']);
