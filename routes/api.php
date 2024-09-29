<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/appointments', [AppointmentController::class, 'getAllAppointments']);
Route::post('/appointments', [AppointmentController::class, 'createAppointment']);
Route::get('/appointments/{id}', [AppointmentController::class, 'getAppointment']);
Route::patch('/appointments/{id}', [AppointmentController::class, 'updateAppointment']);
Route::delete('/appointments/{id}', [AppointmentController::class, 'deleteAppointment']);
