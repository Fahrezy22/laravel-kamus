<?php

use App\Http\Controllers\KamusController;
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
Route::resource('kamus', KamusController::class )
->except('create', 'show', 'update', 'destroy');
Route::post('kamus/update', [KamusController::class, 'update'])->name('sentence.update');
Route::post('kamus/destroy', [KamusController::class, 'destroy'])->name('sentence.destroy');
Route::get('indonesia-kaili',[KamusController::class, 'translate'])->name('translate');
Route::get('search', [KamusController::class, 'search'])->name('search');
