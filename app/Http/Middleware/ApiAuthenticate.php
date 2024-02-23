<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;
use JWTAuth;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        try {
            $jwt = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            $jwt = false;
        }
        if (Auth::check() || $jwt) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}
