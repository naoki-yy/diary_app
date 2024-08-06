<?php

use App\Http\Controllers\TopPageController;
use Illuminate\Support\Facades\Route;

Route::get('/top', [TopPageController::class, 'init'])->name('top.init');
Route::post('/top/add', [TopPageController::class, 'add'])->name('top.add');
