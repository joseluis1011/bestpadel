<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GetRegistros;
use App\Http\Controllers\API\PostMensajes;



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
Route::get('show/{id}',[GetPistas::class, 'show']);


Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout',[AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('show/{dia}/{pista}',[GetRegistros::class, 'show']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('store',[GetRegistros::class, 'store']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('editarperfil',[AuthController::class, 'editarperfil']);
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile',[GetRegistros::class, 'index']);
});

Route::post('mensajes',[PostMensajes::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
