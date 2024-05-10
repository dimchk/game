<?php

namespace App\DTO;

use App\Enums\GameResultState;
use App\ValueObjects\Money;

class GameResultDto
{
    public function __construct(protected int $value, protected GameResultState $resultState, protected Money $prize)
    {
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getResultState(): GameResultState
    {
        return $this->resultState;
    }

    public function getPrize(): Money
    {
        return $this->prize;
    }


}
