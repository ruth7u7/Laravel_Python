<?php

use App\Http\Controllers\PeliculaController;
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

//PELÍCULA

Route::get('/show', [PeliculaController::class, 'show']);
// Route::get('/get/{n_id_pelicula}', [PeliculaController::class, 'get']);
Route::get('/get/{n_id_pelicula}','App\Http\Controllers\PeliculaController@get');
Route::post('/store', [PeliculaController::class, 'store']);