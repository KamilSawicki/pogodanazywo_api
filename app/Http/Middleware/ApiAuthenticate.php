<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;

class ApiAuthenticate
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
        try {
            $apiToken = $request->cookie('api_token');
            $userId = $request->cookie('user_id');
            $user = AuthService::authenticate($apiToken, $userId);
            $request->user = $user;
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'unauthorized'], 401);
        }
    }
}
