<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TopPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {


    Route::get('/top', [TopPageController::class, 'init'])->name('top.init');
    Route::post('/top/add', [TopPageController::class, 'add'])->name('top.add');

    Route::post('/diary/{diary}/edit', [TopPageController::class, 'edit'])->name('diary.update');
    Route::post('/diary/{diary}/delete', [TopPageController::class, 'destroy'])->name('diary.delete');

    Route::get('/chart', [ChartController::class, 'init'])->name('top.chart');

    Route::get('/account/edit', [UserController::class, 'init'])->name('account.edit');

    Route::get('/invite/send', [InvitationController::class, 'init'])->name('invite.send');
    Route::post('/invite/email', [InvitationController::class, 'send'])->name('invite.email');

});

require __DIR__ . '/auth.php';
