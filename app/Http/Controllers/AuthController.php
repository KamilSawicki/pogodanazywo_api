<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse {
        try{
            $data = AuthService::login($request->toArray());
            return response()->json([true])
                ->withCookie(cookie()->forever('api_token', $data['api_token']))
                ->withCookie(cookie()->forever('user_id', $data['user_id']));
        }
        catch(Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function register(Request $request) : JsonResponse {
        try{
            $user = AuthService::register($request->all());
            return response()->json(['user' => $user]);
        }
        catch(Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function logout() : JsonResponse {
        try{
            AuthService::logout();
            return response()->json(true);
        }
        catch(Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
