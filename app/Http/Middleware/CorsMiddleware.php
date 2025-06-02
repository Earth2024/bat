<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Define allowed origins
        $allowedOrigins = ['https://api.deriv.com', 'https://remita.net', 'https://ngpay.ng'];

        if (in_array($request->header('Origin'), $allowedOrigins)) {
            $response->header('Access-Control-Allow-Origin', $request->header('Origin'));
            $response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
            $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }

        return $response;
    }
}
