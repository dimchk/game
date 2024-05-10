<?php

namespace App\DTO;

use App\Http\Requests\RegistrationRequest;

class RegistrationDto
{
    public function __construct(protected string $username, protected string $phone)
    {
    }

    public static function fromRequest(RegistrationRequest $request): self
    {
        return new self($request->validated('username'), $request->validated('phone'));
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }


}
