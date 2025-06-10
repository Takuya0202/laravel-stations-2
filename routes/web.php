<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
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

Route::get('/movies',[MovieController::class,'index'])->name('home');
Route::get('/admin/movies',[MovieController::class,'adminIndex'])->name('admin.home');
Route::get('/admin/movies/create',[MovieController::class,'adminCreate'])->name('mv.create');
Route::post('/admin/movies/store',[MovieController::class,'adminStore'])->name('mv.store');
Route::get('/admin/movies/{id}/edit',[MovieController::class,'adminEdit'])->name('mv.edit')->whereNumber('id');
Route::patch('/admin/movies/{id}/update',[MovieController::class,'adminUpdate'])->name('mv.update');
Route::get('/admin/movies/{id}/confirme',[MovieController::class,'adminConfirme'])->name('mv.confirme');
Route::delete('/admin/movies/{id}/destroy',[MovieController::class,'adminDelete'])->name('mv.destroy');
