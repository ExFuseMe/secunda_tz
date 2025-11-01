<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckApiKeyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $tokenFromConfig = Config::get('access.apiKey');

        if (empty($token) || $token != $tokenFromConfig) {
            throw new AccessDeniedHttpException("Invalid API key");
        }

        return $next($request);
    }
}
