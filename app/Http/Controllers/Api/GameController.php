<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserIdRequest;
use App\Http\Resources\GameResultResource;
use App\Services\GameService;
use App\Strategy\DefaultGameStrategy;

class GameController extends Controller
{
    public function __construct(protected GameService $gameService)
    {
    }

    public function play(UserIdRequest $request, DefaultGameStrategy $gameStrategy)
    {
        return new GameResultResource($this->gameService->play($request->validated('user_id'), $gameStrategy));
    }

    public function history(int $userId)
    {
        return GameResultResource::collection($this->gameService->getHistory($userId));
    }

}
