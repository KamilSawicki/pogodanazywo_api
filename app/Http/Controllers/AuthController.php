<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse {
        try{
            $user = AuthService::login($request->toArray());
            return response()->json(['api_token' => $user]);
        }
        catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function register(Request $request) : JsonResponse {
        try{
            $user = AuthService::register($request->all());
            return response()->json(['user' => $user]);
        }
        catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }

    public function logout() : JsonResponse {
        try{
            AuthService::logout();
            return response()->json(true);
        }
        catch(\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
