<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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


// Musician registration and login routes
Route::get('/musician/register', [MusicianController::class, 'showRegistrationForm']);
Route::post('/musician/register', [MusicianController::class, 'register']);
Route::get('/musician/login', [MusicianController::class, 'showLoginForm']);
Route::post('/musician/login', [MusicianController::class, 'login']);
Route::get('/musician/logout', [MusicianController::class, 'logout']);
Route::get('/musician/upload', [MusicianController::class, 'showFileUploadForm']);
Route::post('/musician/store', [MusicianController::class, 'store'])->name('audio.store');

Route::get('/admin/login', [AdminController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::get('/admin/musician/approve/{musician}', 'AdminController@approveMusician');
Route::get('/admin/file/approve/{file}', [AdminController::class, 'approveFile']);

Route::get('/user/login', [UserController::class, 'index']);