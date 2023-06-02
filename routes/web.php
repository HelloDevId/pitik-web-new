<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AyamController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PendapatanController;

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

route::get('/', function () {
    return view('admin.pages.index');
});

route::get('/index', function () {
    return view('admin.pages.index');
});

route::get('/dataayam', [AyamController::class, 'index']);
route::post('/dataayam', [AyamController::class, 'store']);
route::put('/dataayam/{id}', [AyamController::class, 'update']);
route::delete('/dataayam/{id}', [AyamController::class, 'destroy']);

route::get('/datadistribusi', [DistribusiController::class, 'index']);
route::post('/datadistribusi', [DistribusiController::class, 'store']);
route::put('/datadistribusi/{id}', [DistribusiController::class, 'update']);
route::delete('/datadistribusi/{id}', [DistribusiController::class, 'destroy']);

route::get('/datatenagakerja', [GajiController::class, 'index']);
route::post('/datatenagakerja', [GajiController::class, 'store']);
route::put('/datatenagakerja/{id}', [GajiController::class, 'update']);
route::delete('/datatenagakerja/{id}', [GajiController::class, 'destroy']);

route::get('/dataovk', [VaksinController::class, 'index']);
route::post('/dataovk', [VaksinController::class, 'store']);
route::put('/dataovk/{id}', [VaksinController::class, 'update']);
route::delete('/dataovk/{id}', [VaksinController::class, 'destroy']);

route::get('/datapakan', [PakanController::class, 'index']);
route::post('/datapakan', [PakanController::class, 'store']);
route::put('/datapakan/{id}', [PakanController::class, 'update']);
route::delete('/datapakan/{id}', [PakanController::class, 'destroy']);

route::get('/datapengeluaran', [PengeluaranController::class, 'index']);
route::get('/datapengeluaran/{id}', [PengeluaranController::class, 'detailpengeluaran']);
route::post('/datapengeluaran', [PengeluaranController::class, 'store']);
route::put('/datapengeluaran/{id}', [PengeluaranController::class, 'update']);
route::delete('/datapengeluaran/{id}', [PengeluaranController::class, 'destroy']);

route::post('/addidayam', [PengeluaranController::class, 'addidayam']);
route::post('/addidpakan', [PengeluaranController::class, 'addidpakan']);
route::post('/addidvaksin', [PengeluaranController::class, 'addidvaksin']);
route::post('/addidgaji', [PengeluaranController::class, 'addidgaji']);

// route::put('/updateidayam/{id}', [PengeluaranController::class, 'updateidpakan']);
// route::put('/updateidpakan/{id}', [PengeluaranController::class, 'updateidpakan']);
// route::put('/updateidvaksin/{id}', [PengeluaranController::class, 'updateidvaksin']);
// route::put('/updateidgaji/{id}', [PengeluaranController::class, 'updateidgaji']);

route::delete('/deleteidayam/{id}', [PengeluaranController::class, 'deleteidayam']);
route::delete('/deleteidpakan/{id}', [PengeluaranController::class, 'deleteidpakan']);
route::delete('/deleteidvaksin/{id}', [PengeluaranController::class, 'deleteidvaksin']);
route::delete('/deleteidgaji/{id}', [PengeluaranController::class, 'deleteidgaji']);

Route::get('/datapendapatan', [PendapatanController::class, 'index']);
Route::get('/datapendapatan/{id}', [PendapatanController::class, 'detailpendapatan']);
Route::post('/datapendapatan', [PendapatanController::class, 'store']);
Route::put('/datapendapatan/{id}', [PendapatanController::class, 'update']);
Route::delete('/datapendapatan/{id}', [PendapatanController::class, 'destroy']);

route::post('/addiddistribusi', [PendapatanController::class, 'addiddistribusi']);
route::delete('/deleteiddistribusi/{id}', [PendapatanController::class, 'deleteiddistribusi']);



