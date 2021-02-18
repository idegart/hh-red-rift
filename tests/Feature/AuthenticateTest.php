<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function user_can_login(): void
    {
        $user = User::factory()->create();

        $this->postJson(route('v1.login', [
            'login' => $user->login,
        ]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'user',
                'token',
                'until',
            ]);
    }
}
