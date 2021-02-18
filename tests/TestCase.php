<?php

namespace Tests;

use App\Models\User;
use App\Services\Auth\AuthenticateService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function authenticateUser(): User
    {
        $user = User::factory()->create();

        /** @var AuthenticateService $authenticateService */
        $authenticateService = app()->make(AuthenticateService::class);

        $authenticateService->loginByUser($user);

        return $user;
    }
}
