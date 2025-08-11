<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!$request->user() || $request->user()->status !== 'active') {
        if (!$request->user() || ($request->user()->status && $request->user()->status !== 'active')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized or inactive account'
            ], 401);
        }

        return $next($request);
    }
}
