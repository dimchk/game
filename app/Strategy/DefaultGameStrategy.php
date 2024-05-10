<?php

namespace App\Strategy;

use App\DTO\GameResultDto;
use App\Enums\GameResultState;
use App\ValueObjects\Money;

class DefaultGameStrategy implements GameStrategyInterface
{

    public function simulate(): GameResultDto
    {
        $value = rand(1, 1000);
        $resultState = $value % 2 == 0 ? GameResultState::WIN : GameResultState::LOSE;
        $moneyValue = $resultState === GameResultState::WIN
            ? match (true) {
                $value > 900 => $value * 0.7,
                $value > 600 => $value * 0.5,
                $value > 300 => $value * 0.3,
                default => $value * 0.1
            }
            : 0;
        return new GameResultDto($value, $resultState, new Money($moneyValue));
    }
}
