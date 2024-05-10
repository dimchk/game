<?php

namespace App\Services;

use Ramsey\Uuid\Uuid;

class TokenService
{
    public static function generate(): string
    {
        return substr(hash('sha256', Uuid::uuid4()->toString()), 0, 8);
    }

}
