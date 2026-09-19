<?php

use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CustomerProfileController;
use App\Http\Controllers\Api\V1\PublicController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('me', [AuthController::class, 'me']);
        });
    });

    Route::prefix('public')->group(function () {
        Route::get('settings', [PublicController::class, 'settings']);
        Route::get('destinations', [PublicController::class, 'destinations']);
        Route::get('destinations/featured', [PublicController::class, 'featuredDestinations']);
        Route::get('destinations/{slug}', [PublicController::class, 'destination']);
    });

    Route::middleware('auth:sanctum')->prefix('customer')->group(function () {
        Route::get('profile', [CustomerProfileController::class, 'show']);
        Route::put('profile', [CustomerProfileController::class, 'update']);
    });

    Route::middleware(['auth:sanctum', 'role:super_admin'])->prefix('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('users', [AdminController::class, 'users']);
        Route::get('roles', [AdminController::class, 'roles']);
        Route::get('destinations', [AdminController::class, 'destinations']);
        Route::post('destinations', [AdminController::class, 'storeDestination']);
        Route::get('destinations/{id}', [AdminController::class, 'showDestination']);
        Route::put('destinations/{id}', [AdminController::class, 'updateDestination']);
        Route::delete('destinations/{id}', [AdminController::class, 'deleteDestination']);
        Route::get('suppliers', [AdminController::class, 'suppliers']);
        Route::post('suppliers', [AdminController::class, 'storeSupplier']);
        Route::get('suppliers/{id}', [AdminController::class, 'showSupplier']);
        Route::put('suppliers/{id}', [AdminController::class, 'updateSupplier']);
        Route::post('suppliers/{id}/verify', [AdminController::class, 'verifySupplier']);
        Route::post('suppliers/{id}/reject', [AdminController::class, 'rejectSupplier']);
        Route::get('settings', [AdminController::class, 'settings']);
        Route::put('settings', [AdminController::class, 'updateSettings']);
        Route::get('audit-logs', [AdminController::class, 'auditLogs']);
    });
});
