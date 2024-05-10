<?php

use App\Http\Controllers\Web\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisteredUserController::class, 'create'])->name('main');
Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
