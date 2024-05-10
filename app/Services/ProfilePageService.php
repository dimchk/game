<?php

namespace App\Services;

use App\DTO\RegistrationDto;
use App\Models\GameResult;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfilePageService
{
    public function create(RegistrationDto $registrationDto): User
    {
        $user = User::create([
            'username' => $registrationDto->getUsername(),
            'phone' => $registrationDto->getPhone(),
            'token' => TokenService::generate(),
            'token_expires_at' => Carbon::now()->addDays(7),
        ]);
        return $user;
    }

    public function invalidate(int $userId): void
    {
        $user = User::find($userId);
        if (!$user) {
            throw new ModelNotFoundException('User not found');
        }
        $user->delete();
    }

    public function renew(int $userId): User
    {
        $user = User::find($userId);
        if (!$user) {
            throw new ModelNotFoundException('User not found');
        }
        GameResult::where('user_id', $user->id)->delete();
        $user->token_expires_at = Carbon::now()->addDays(7);
        $user->token = TokenService::generate();
        $user->save();
        return $user;
    }

    public function getByToken(string $token): User
    {
        $user = User::where('token', $token)->first();
        if (!$user || $user->token_expires_at < Carbon::now()) {
            throw new ModelNotFoundException('User not found');
        }
        return $user;
    }
}
