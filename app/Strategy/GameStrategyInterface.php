<?php

namespace App\Strategy;

use App\DTO\GameResultDto;

interface GameStrategyInterface
{
    public function simulate(): GameResultDto;

}
