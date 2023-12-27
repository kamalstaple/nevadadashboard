<?php

use App\Http\Controllers\NavedaController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\NavedaController;

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

// Route::get('/location_comparistion', function () {
//     return view('location_comparistion');
// });

Route::get('/', [NavedaController::class , 'Home'])->name('/');
Route::get('/economical', [NavedaController::class , 'economical'])->name('/economical');
Route::get('/statewide', [NavedaController::class , 'mapdata'])->name('/statewide');
Route::get('/overview', [NavedaController::class , 'overviewpage'])->name('/overview');

Route::get('/location_comparistion', [NavedaController::class , 'locationcomparistion'])->name('/location_comparistion');

Route::post('/mr_portal', [NavedaController::class , 'mr_portal'])->name('/mr_portal');
Route::get('/download', [NavedaController::class , 'download'])->name('/download');



