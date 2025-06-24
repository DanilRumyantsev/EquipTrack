<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Авторизация/Регистрация и выход.
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/test-auth', function (Request $request) {
    return response()->json([
        'is_authenticated' => $request->isAuthenticated(),
        'user' => $request->user(),
    ]);
})->middleware('auth:sanctum');
