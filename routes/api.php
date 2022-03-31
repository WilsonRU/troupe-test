<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('citizen')->group(function(){

    Route::get('/', [App\Http\Controllers\Api\CitizenController::class, 'index']);

    Route::get('search/{cpf}', [App\Http\Controllers\Api\CitizenController::class, 'show']);

    Route::post('create', [App\Http\Controllers\Api\CitizenController::class, 'store']);
    Route::post('update', [App\Http\Controllers\Api\CitizenController::class, 'update']);
    Route::delete('delete/{id}', [App\Http\Controllers\Api\CitizenController::class, 'destroy']);
});