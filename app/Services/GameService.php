<?php

namespace App\Services;

use App\Models\GameResult;
use App\Strategy\GameStrategyInterface;
use Illuminate\Database\Eloquent\Collection;

class GameService
{
    public function play(int $userId, GameStrategyInterface $gameStrategy): GameResult
    {
        $simulatingResult = $gameStrategy->simulate();
        $gameResult = new GameResult([
            'user_id' => $userId,
            'result' => $simulatingResult->getValue(),
            'result_state' => $simulatingResult->getResultState(),
            'prize' => $simulatingResult->getPrize()->getAmount(),
            'currency' => $simulatingResult->getPrize()->getCurrency(),
        ]);
        $gameResult->save();
        return $gameResult;
    }

    public function getHistory(int $userId): Collection
    {
        return GameResult::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }

}
