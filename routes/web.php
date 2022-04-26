<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PublicController;

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

Route::get('/', [PublicController::class , "welcome"])->name('welcome');

//CREAZIONE EVENTO
Route::post('/event/store' , [EventController::class , "store"])->name('store');

//RICERCA PERE NOME
Route::post('/search' , [EventController::class , "search"])->name('search');

