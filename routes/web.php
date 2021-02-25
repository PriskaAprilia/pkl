<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome'); 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\NegaraController;
Route::resource('admin/negara', NegaraController::class);

use App\Http\Controllers\ProvinsiController;
Route::resource('admin/provinsi', ProvinsiController::class);

use App\Http\Controllers\KotaController;
Route::resource('admin/kota', KotaController::class);

use App\Http\Controllers\KecamatanController;
Route::resource('admin/kecamatan', KecamatanController::class);

use App\Http\Controllers\KelurahanController;
Route::resource('admin/kelurahan', KelurahanController::class);

use App\Http\Controllers\RwController;
Route::resource('admin/rw', RwController::class);

use App\Http\Controllers\TrackingController;
Route::resource('admin/tracking', TrackingController::class);

use App\Http\Controllers\FrontendController;
Route::resource('anya', FrontendController::class);

