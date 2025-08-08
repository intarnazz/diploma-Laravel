<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestQueryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['auth:api']]);

Route::post('/authorization', [UserController::class, 'login'])->name('login');
Route::post('/registration', [UserController::class, 'reg']);
Route::get('/image/{image}', [ImageController::class, 'get']);
Route::prefix('/inquiry')->group(function () {
    Route::get('/{inquiry}', [InquiryController::class, 'get']);
    Route::get('/', [InquiryController::class, 'all']);
});
Route::prefix('/portfolio')->group(function () {
    Route::get('/{portfolio}', [PortfolioController::class, 'get']);
    Route::get('/', [PortfolioController::class, 'all']);
});
Route::prefix('/service')->group(function () {
    Route::get('/{service}', [ServiceController::class, 'get']);
    Route::get('/', [ServiceController::class, 'all']);
});
Route::prefix('/guest-query')->group(function () {
    Route::post('/', [GuestQueryController::class, 'add']);
});
Route::prefix('/contact')->group(function () {
    Route::get('/', [ContactController::class, 'all']);
    Route::patch('/', [ContactController::class, 'patch']);
});

// AUTHORIZATION = AUTHORIZATION = AUTHORIZATION = AUTHORIZATION
Route::middleware('auth:api')->group(function () {
    Route::post('/profile', [UserController::class, 'profile']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::prefix('/chat')->group(function () {
        Route::get('/{chat}', [ChatController::class, 'get']);
        Route::get('/', [ChatController::class, 'all']);
    });
    Route::prefix('/message')->group(function () {
        Route::get('/{chat}', [MessageController::class, 'all']);
        Route::post('/', [MessageController::class, 'add']);
    });
    Route::prefix('/guest-query')->group(function () {
        Route::get('/{guestQuery}', [GuestQueryController::class, 'get']);
        Route::get('/', [GuestQueryController::class, 'all']);
    });
});


