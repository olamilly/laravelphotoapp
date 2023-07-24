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


Route::get('/photoapp', [App\Http\Controllers\Api\apiContentController::class, 'read']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/photoapp', [App\Http\Controllers\Api\apiContentController::class, 'create']);

    Route::get('/photoapp/{id}', [App\Http\Controllers\Api\apiContentController::class, 'getItem']);
    Route::patch('/photoapp/{id}', [App\Http\Controllers\Api\apiContentController::class, 'update']);
    Route::delete('/photoapp/{id}', [App\Http\Controllers\Api\apiContentController::class, 'delete']);
});


//login and register
Route::post("/photoapp/register","App\Http\Controllers\Api\apiAuthController@register");
Route::post("/photoapp/login","App\Http\Controllers\Api\apiAuthController@login");