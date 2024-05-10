<?php

use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile/{token}', [ProfileController::class, 'profilePage'])->name('profile');
Route::post('/profile/invalidate', [ProfileController::class, 'invalidate'])->name('invalidate');
Route::post('/profile/renew', [ProfileController::class, 'renew'])->name('renew');

require __DIR__ . '/auth.php';
