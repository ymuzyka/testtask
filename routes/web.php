<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [RegisterController::class, 'index'])->name('register.index');
Route::post('/', [RegisterController::class, 'register'])->name('register.user');

Route::get('/link/{link}', [LinkController::class, 'index'])->name('link.index');
Route::put('/link', [LinkController::class, 'create'])->name('link.create');
Route::post('/link/{link}', [LinkController::class, 'deactivate'])->name('link.deactivate');

Route::post('/game', [GameController::class, 'play'])->name('game.play');
Route::get('/game', [GameController::class, 'getHistory'])->name('game.get_history');
