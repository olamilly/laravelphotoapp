<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//get current authorized user info
Route::middleware('auth:sanctum')->get('/photoapp/user', function (Request $request) {
    return $request->user();
});


Route::get('/photo', [App\Http\Controllers\Api\apiPhotoController::class, 'read']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/photo', [App\Http\Controllers\Api\apiPhotoController::class, 'create']);

    Route::get('/photo/:id', [App\Http\Controllers\Api\apiPhotoController::class, 'getItem']);
    Route::patch('/photo/{id}', [App\Http\Controllers\Api\apiPhotoController::class, 'update']);
    Route::delete('/photo/{id}', [App\Http\Controllers\Api\apiPhotoController::class, 'delete']);
});


//login and register
Route::post("register","App\Http\Controllers\Api\apiAuthController@register");
Route::post("login","App\Http\Controllers\Api\apiAuthController@login");