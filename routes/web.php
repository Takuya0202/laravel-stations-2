<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3',[PracticeController::class,'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

// 映画
Route::get('/movies',[MovieController::class,'index'])->name('home');
Route::get('/movies/{id}',[MovieController::class,'show'])->name('mv.show');
Route::get('/admin/movies',[MovieController::class,'adminIndex'])->name('admin.home');
Route::get('/admin/movies/{id}',[MovieController::class,'adminShow'])->whereNumber('id')->name('admin.mv.show');
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
