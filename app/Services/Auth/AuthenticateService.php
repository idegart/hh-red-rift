<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Str;

class AuthenticateService
{
    /**
     * @param string $login
     * @return User
     */
    public function loginByLogin(string $login): User
    {
        /** @var User $user */
        $user = User::query()->where('login', '=', $login)->firstOrFail();

        return $this->loginByUser($user);
    }

    /**
     * @param User $user
     * @return User
     */
    public function loginByUser(User $user): User
    {
        $user->token = Str::random();
        $user->token_ttl = now()->addHour();

        $user->save();

        return $user;
    }

    public function validateToken(string $token): ?User
    {
        return User::query()
            ->where('token', '=', $token)
            ->where('token_ttl', '>', now())
            ->first();
    }
}