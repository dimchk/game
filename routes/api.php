<?php

use App\Http\Controllers\Api\GameController;
use App\Http\Middleware\AuthenticateToken;
use Illuminate\Support\Facades\Route;

Route::post('game/play', [GameController::class, 'play'])->middleware(AuthenticateToken::class);
Route::get('game/history/{user_id}', [GameController::class, 'history'])->middleware(AuthenticateToken::class);;
