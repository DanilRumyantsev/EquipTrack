<?php

use App\Http\Controllers\Api\DeviceHistoryController;
use App\Http\Controllers\Api\IpPhoneController;
use App\Http\Controllers\Api\PrinterController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// Sanctum CSRF (важно для SPA)
Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['status' => 'CSRF cookie set']);
})->middleware(EnsureFrontendRequestsAreStateful::class);

// Авторизация
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Регистрация (если нужна сессия)
Route::post('/register', [AuthController::class, 'register']);

// Получение пользователя
Route::get('/user', function (\Illuminate\Http\Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// printer, ipphone, history
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('printers', PrinterController::class);
    Route::apiResource('phones', IpPhoneController::class);
    Route::apiResource('histories', DeviceHistoryController::class);
});

/**
 * Страница при входе на сайт.
 */
Route::get('/{any?}', function () {
    return view('app');
})->where('any', '.*');
