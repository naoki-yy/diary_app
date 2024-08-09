<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopPageController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/top', [TopPageController::class, 'init'])->name('top.init');
    Route::post('/top/add', [TopPageController::class, 'add'])->name('top.add');
});

require __DIR__ . '/auth.php';
