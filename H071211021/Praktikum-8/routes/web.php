<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MahasiswaController::class, 'index']);
Route::post('tambah', [MahasiswaController::class, 'tambah']);
Route::post('edit/{nim}', [MahasiswaController::class, 'edit']);
Route::get('hapus/{nim}', [MahasiswaController::class, 'delete']);
