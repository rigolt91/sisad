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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get-datas', [App\Http\Controllers\GetDataGraficaController::class, 'responseData']);

Route::get('/info-alarma', function(){
    $getInfo = new App\Http\Controllers\GetInfoAlarmaController(1);
});

Route::get('/get-all-data', [App\Http\Controllers\Alarma\GetAllAlarmaController::class, 'getData']);
