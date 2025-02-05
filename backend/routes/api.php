<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout']);
    Route::apiResource('tickets', TicketController::class);
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('user');
});

