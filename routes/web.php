<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $currentDate = date('d-m-Y');
    echo $currentDate;;
});


Route::get("/read_chip",[\App\Http\Controllers\ReadChipController::class,"read_chip"])->name("read_chip");
Route::get("/thong_ke",[\App\Http\Controllers\ReadChipController::class,"thong_ke_chip"]);
