<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //    ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('/users/create',[RegisteredUserController::class,'create'])->name('register');
    Route::post('/register',[RegisteredUserController::class,'store'])->name('user.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    // 映画
    Route::get('/movies',[MovieController::class,'index'])->name('home');
    Route::get('/movies/{id}',[MovieController::class,'show'])->name('mv.show');
    Route::get('/admin/movies',[MovieController::class,'adminIndex'])->name('admin.home');
    Route::get('/admin/movies/{id}',[MovieController::class,'adminShow'])->whereNumber('id')->name('admin.movies.show');
    Route::get('/admin/movies/create',[MovieController::class,'adminCreate'])->name('mv.create');
    Route::post('/admin/movies/store',[MovieController::class,'adminStore'])->name('mv.store');
    Route::get('/admin/movies/{id}/edit',[MovieController::class,'adminEdit'])->name('mv.edit')->whereNumber('id');
    Route::patch('/admin/movies/{id}/update',[MovieController::class,'adminUpdate'])->name('mv.update');
    Route::get('/admin/movies/{id}/confirme',[MovieController::class,'adminConfirme'])->name('mv.confirme');
    Route::delete('/admin/movies/{id}/destroy',[MovieController::class,'adminDelete'])->name('mv.destroy');

    // 座席
    Route::get('/sheets',[SheetController::class,'index'])->name('sheets');


    // スケジュール
    Route::get('/admin/schedules',[ScheduleController::class,'adminIndex'])->name('admin.schedules.index');
    Route::get('/admin/schedules/{id}',[ScheduleController::class,'adminShow'])->name('admin.schedules.show');
    Route::get('/admin/movies/{id}/schedules/create',[ScheduleController::class,'adminCreate'])->name('admin.schedules.create');
    Route::post('/admin/movies/{id}/schedules/store',[ScheduleController::class,'adminStore'])->name('admin.schedules.store');
    Route::get('/admin/schedules/{scheduleId}/edit',[ScheduleController::class,'adminEdit'])->name('admin.schedules.edit');
    Route::patch('/admin/schedules/{id}/update',[ScheduleController::class,'adminUpdate'])->name('admin.schedules.update');
    Route::delete('/admin/schedules/{scheduleId}/destroy',[ScheduleController::class,'adminDelete'])->name('admin.schedules.delete');

    // 予約
    Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets',[ReservationController::class,'show'])->name('reservation.index');
    Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create',[ReservationController::class,'create'])->name('reservation.create');
    Route::post('/reservations/store',[ReservationController::class,'store'])->name('reservation.store');
    Route::get('/admin/reservations',[ReservationController::class,'adminIndex'])->name('admin.reservation.index');
    Route::get('/admin/reservations/create',[ReservationController::class,'adminCreate'])->name('admin.reservation.create');
    Route::post('/admin/reservations',[ReservationController::class,'adminStore'])->name('admin.reservation.store');
    Route::get('/admin/reservations/{id}/edit',[ReservationController::class,'adminEdit'])->name('admin.reservation.edit');
    Route::patch('/admin/reservations/{id}',[ReservationController::class,'adminUpdate'])->name('admin.reservation.update');
    Route::delete('/admin/reservations/{id}',[ReservationController::class,'adminDelete'])->name('admin.reservation.delete');
});
