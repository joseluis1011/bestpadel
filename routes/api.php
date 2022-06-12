<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GetPistas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GetRegistros;
use App\Http\Controllers\API\PostMensajes;
use App\Http\Controllers\API\Torneos;
use App\Http\Controllers\API\userTorneo;
use App\Http\Controllers\API\UserController;
use App\Models\Registros;
use App\Models\userTorneo as userTorneoModel;
use App\Http\Resources\RegistrosResource;
use App\Http\Resources\userTorneoResource;
use Illuminate\Support\Facades\Auth;

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
Route::get('getTorneos',[Torneos::class, 'index']);
Route::get('getUsers',[UserController::class, 'index']);
Route::get('getAllRegistros',[GetRegistros::class, 'getAllRegistros']);
Route::post('destroy', [GetRegistros::class, 'destroy']);
Route::post('destroy/torneo', [Torneos::class, 'destroy']);

Route::get('/registros', function () {
    return RegistrosResource::collection(Registros::all());
});

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout',[AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('show/{dia}/{pista}/{mes}',[GetRegistros::class, 'show']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('store',[GetRegistros::class, 'store']);
});
Route::middleware('auth:sanctum')->get('/userTorneoID', [userTorneo::class, 'userTorneo']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('store/userTorneo',[userTorneo::class, 'store']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('editarperfil',[AuthController::class, 'editarperfil']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('destroy/userTorneo',[userTorneo::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile',[GetRegistros::class, 'index']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('store/torneos',[Torneos::class, 'store']);
});

Route::post('mensajes',[PostMensajes::class, 'store']);
Route::get('mensajes', [PostMensajes::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
