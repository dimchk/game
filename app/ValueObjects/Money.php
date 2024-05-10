<?php

namespace App\ValueObjects;

class Money
{
    private int|float $amount;
    private string $currency;

    public function __construct(int|float $amount, string $currency = '$')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): int|float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function __toString(): string
    {
        return $this->amount . $this->currency;
    }
}
