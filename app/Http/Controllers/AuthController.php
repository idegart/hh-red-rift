<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthenticateService;

class AuthController extends Controller
{
    public function login(LoginRequest $request, AuthenticateService $authenticateService)
    {
        $user = $authenticateService->loginByLogin($request->input('login'));

        return response()->json([
            'user' => $user->login,
            'token' => $user->token,
            'until' => $user->token_ttl,
        ]);
    }
}
