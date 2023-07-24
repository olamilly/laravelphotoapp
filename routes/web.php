<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/newpost', [App\Http\Controllers\postController::class, 'index'])->name('newpost');
Route::post('/save', [App\Http\Controllers\postController::class, 'create'])->name('savepost');
Route::post('/delete', [App\Http\Controllers\postController::class, "delete"])->name("delete");
Route::post('/updated', [App\Http\Controllers\postController::class, "update"])->name("updated");


Route::get('/user', [App\Http\Controllers\webUserController::class, "read"])->name("profile");
Route::get('/user/edituser/{id}', [App\Http\Controllers\webUserController::class, "editpage"])->name("edituser")->middleware('auth');
Route::post('/user/updateuser', [App\Http\Controllers\webUserController::class, "update"])->name("updateuser")->middleware('auth');
Route::post('/user/deleteuser', [App\Http\Controllers\webUserController::class, "delete"])->name("deleteuser")->middleware('auth');