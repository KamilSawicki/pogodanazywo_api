<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionalApiAuthenticate
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
            if(!is_null($apiToken) && !is_null($userId)) {
                $user = AuthService::authenticate($apiToken, $userId);
                Auth::login($user);
            }
            $request->user = $user;
            return $next($request);
        } catch (\Exception $e) {
            return $next($request);
        }
    }
}
