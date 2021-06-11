<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(User::all(), 200);
    }

    public function delete(String $uuid): JsonResponse {
        $user = User::all()->find($uuid);
        $user->delete();
        return response()->json($user, 200);
    }
}
