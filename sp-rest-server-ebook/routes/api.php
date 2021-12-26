<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
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

Route::resource('kategori', KategoriBukuController::class);
Route::resource('buku', BukuController::class);
