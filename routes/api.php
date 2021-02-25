<?php


use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinsiController;
use App\Http\Controllers\Api\ApiController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API PROVINSI
Route::resource('provinsi',ProvinsiController::class);

//API KASUS
Route::get('tracking',[ApiController::class, 'index']);
Route::get('indonesia/provinsi',[ApiController::class, 'provinsi']);
Route::get('indonesia/kota',[ApiController::class, 'kota']);
Route::get('indonesia/kecamatan',[ApiController::class, 'kecamatan']);
Route::get('indonesia/kelurahan',[ApiController::class, 'kelurahan']);
Route::get('provinsi2/{id}',[ApiController::class, 'provinsi2']);
Route::get('/global',[ApiController::class, 'global']);