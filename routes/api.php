<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiDataAyamController;
use App\Http\Controllers\ApiDataOvkController;
use App\Http\Controllers\ApiDataPakanController;
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

Route::post('login', [ApiAuthController::class, 'login']);
//data ayam
Route::post('/data-ayam', [ApiDataAyamController::class, 'create']);
Route::get('/data-ayam', [ApiDataAyamController::class, 'read']);
Route::put('/data-ayam/{id}', [ApiDataAyamController::class, 'update']);
Route::delete('/data-ayam/{id}', [ApiDataAyamController::class, 'delete']);
//data pakan
Route::post('/data-pakan', [ApiDataPakanController::class, 'create']);
Route::get('/data-pakan', [ApiDataPakanController::class, 'read']);
Route::put('/data-pakan/{id}', [ApiDataPakanController::class, 'update']);
Route::delete('/data-pakan/{id}', [ApiDataPakanController::class, 'delete']);
//data ovk
Route::post('/data-ovk', [ApiDataOvkController::class, 'create']);
Route::get('/data-ovk', [ApiDataOvkController::class, 'read']);
Route::get('/data-ovk-last', [ApiDataOvkController::class, 'readIdTerakhir']);
Route::put('/data-ovk/{id}', [ApiDataOvkController::class, 'update']);
Route::delete('/data-ovk/{id}', [ApiDataOvkController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
