<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AyamController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PengeluaranAyamController;
use App\Http\Controllers\PengeluaranPakanController;
use App\Http\Controllers\PengeluaranVaksinController;
use App\Http\Controllers\PengeluaranGajiController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PenghasilanController;



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

Route::get('/datapendapatan', [PendapatanController::class, 'index']);
Route::get('/datapendapatan/{id}', [PendapatanController::class, 'detailpendapatan']);
Route::post('/datapendapatan', [PendapatanController::class, 'store']);
Route::put('/datapendapatan/{id}', [PendapatanController::class, 'update']);
Route::delete('/datapendapatan/{id}', [PendapatanController::class, 'destroy']);

Route::get('/datapengeluaranayam', [PengeluaranAyamController::class, 'index']);
Route::get('/datapengeluaranayam/{id}', [PengeluaranAyamController::class, 'pengeluaranayamdetail']);
Route::post('/datapengeluaranayam', [PengeluaranAyamController::class, 'store']);
Route::put('/datapengeluaranayam/{id}', [PengeluaranAyamController::class, 'update']);
Route::delete('/datapengeluaranayam/{id}', [PengeluaranAyamController::class, 'destroy']);

Route::get('/datapengeluaranpakan', [PengeluaranPakanController::class, 'index']);
Route::get('/datapengeluaranpakan/{id}', [PengeluaranPakanController::class, 'pengeluaranpakandetail']);
Route::post('/datapengeluaranpakan', [PengeluaranPakanController::class, 'store']);
Route::put('/datapengeluaranpakan/{id}', [PengeluaranPakanController::class, 'update']);
Route::delete('/datapengeluaranpakan/{id}', [PengeluaranPakanController::class, 'destroy']);

Route::get('/datapengeluaranvaksin', [PengeluaranVaksinController::class, 'index']);
Route::get('/datapengeluaranvaksin/{id}', [PengeluaranVaksinController::class, 'pengeluaranvaksindetail']);
Route::post('/datapengeluaranvaksin', [PengeluaranVaksinController::class, 'store']);
Route::put('/datapengeluaranvaksin/{id}', [PengeluaranVaksinController::class, 'update']);
Route::delete('/datapengeluaranvaksin/{id}', [PengeluaranVaksinController::class, 'destroy']);

Route::get('/datapengeluarangaji', [PengeluaranGajiController::class, 'index']);
Route::get('/datapengeluarangaji/{id}', [PengeluaranGajiController::class, 'pengeluarangajidetail']);
Route::post('/datapengeluarangaji', [PengeluaranGajiController::class, 'store']);
Route::put('/datapengeluarangaji/{id}', [PengeluaranGajiController::class, 'update']);
Route::delete('/datapengeluarangaji/{id}', [PengeluaranGajiController::class, 'destroy']);

route::post('/addiddistribusi', [PendapatanController::class, 'addiddistribusi']);
route::delete('/deleteiddistribusi/{id}', [PendapatanController::class, 'deleteiddistribusi']);

Route::post('/addidayam', [PengeluaranAyamController::class, 'addidayam']);
Route::delete('/deleteidayam/{id}', [PengeluaranAyamController::class, 'deleteidayam']);

Route::post('/addidpakan', [PengeluaranPakanController::class, 'addipakan']);
Route::delete('/deleteidpakan/{id}', [PengeluaranPakanController::class, 'deleteipakan']);

Route::post('/addidvaksin', [PengeluaranVaksinController::class, 'addidvaksin']);
Route::delete('/deleteidvaksin/{id}', [PengeluaranVaksinController::class, 'deleteidvaksin']);

Route::post('/addidgaji', [PengeluaranGajiController::class, 'addidgaji']);
Route::delete('/deleteidgaji/{id}', [PengeluaranGajiController::class, 'deleteidgaji']);

Route::get('/datapenghasilan', [PenghasilanController::class, 'index']);
Route::post('/datapenghasilan', [PenghasilanController::class, 'store']);
Route::put('/datapenghasilan/{id}', [PenghasilanController::class, 'update']);
Route::delete('/datapenghasilan/{id}', [PenghasilanController::class, 'destroy']);
