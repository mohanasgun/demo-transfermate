<?php

use App\Http\Controllers\ListController;
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
// List page for authors and books.
Route::get('/', [ListController::class, 'index']);

// Fetch data of authors and books.
Route::post('/list', [ListController::class, 'list'])->name('list');
