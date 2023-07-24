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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/photoapp', [App\Http\Controllers\Api\apidataController::class, 'create']); 
    Route::patch('/photoapp/{id}', [App\Http\Controllers\Api\apidataController::class, 'update']);
    Route::delete('/photoapp/{id}', [App\Http\Controllers\Api\apidataController::class, 'delete']);
});

Route::get('/photoapp', [App\Http\Controllers\Api\apidataController::class, 'read']); 
//Route::get('/photoapp', [App\Http\Controllers\Api\apidataController::class, 'search']);

Route::post("/photoapp/register","App\Http\Controllers\Api\apiAuthController@register");
Route::post("/photoapp/login","App\Http\Controllers\Api\apiAuthController@login");