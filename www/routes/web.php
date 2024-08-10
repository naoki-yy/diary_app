<?php

use App\Http\Controllers\TopPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {


    Route::get('/top', [TopPageController::class, 'init'])->name('top.init');
    Route::post('/top/add', [TopPageController::class, 'add'])->name('top.add');

    Route::post('/diary/{diary}/edit', [TopPageController::class, 'edit'])->name('diary.update');
    Route::post('/diary/{diary}/delete', [TopPageController::class, 'destroy'])->name('diary.delete');

    Route::get('/chart', [TopPageController::class, 'init'])->name('top.chart');
});

require __DIR__ . '/auth.php';
