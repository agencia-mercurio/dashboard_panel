<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateService extends Authenticate
{
    protected function authenticate(Request $request, array $guards)
    {
        $token = $request->bearerToken();

        if (!$token) {
            throw new AuthenticationException('Unauthenticated');
        }

        $payload = Auth::guard('sanctum')->payload();

        if (!isset($payload['client_id']) || !isset($payload['user_id'])) {
            throw new AuthenticationException('Invalid token');
        }

        return $this->authenticateViaBearerToken($request, $guards);
    }
}