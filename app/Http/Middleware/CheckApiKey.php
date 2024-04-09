<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = env('API_KEY') == $request->header('Api-Key');

        if (! $apiKey) {
            throw new UnauthorizedHttpException('', 'API Key inválida');
        }

        return $next($request);
    }
}
