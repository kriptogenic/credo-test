<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\ProfileController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('gift', [GiftController::class, 'store']);
    Route::put('gift/{gift}', [GiftController::class, 'update']);
    Route::delete('gift/{gift}', [GiftController::class, 'destroy']);
});
require __DIR__.'/auth.php';
