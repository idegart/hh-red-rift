<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\Auth\AuthenticateService;
use Auth;
use Closure;
use Illuminate\Http\Request;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        /** @var AuthenticateService $authenticateService */
        $authenticateService = app()->make(AuthenticateService::class);

        if (!$token) {
            abort(401, "Unauthorized");
        }

        $user = $authenticateService->validateToken($token);

        if (!$user) {
            abort(401, "Unauthorized");
        }

        Auth::login($user);

        return $next($request);
    }
}
