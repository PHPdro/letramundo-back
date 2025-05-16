<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::apiResource('/students', \App\Http\Controllers\StudentController::class)
    ->middleware('auth:sanctum')
    ->only(['store', 'show', 'update', 'destroy']);

Route::get('/students', [\App\Http\Controllers\StudentController::class, 'showAll'])
    ->middleware('auth:sanctum')
    ->name('students.showAll');

Route::post('/test', [\App\Http\Controllers\StudentController::class, 'test']);

Route::get('/themes', [\App\Http\Controllers\ThemeController::class, 'show'])
    ->middleware('auth:sanctum')
    ->name('themes.show');

Route::put('/students/{id}/progress', [\App\Http\Controllers\ProgressController::class, 'update'])
    ->middleware('auth:sanctum')
    ->name('progress.update');