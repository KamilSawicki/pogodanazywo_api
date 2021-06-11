<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(User::all(), 200);
    }

    public function find(String $uuid): JsonResponse {
        try {
            $user = UserRepository::find($uuid);
            return response()->json($user, 200);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function delete(String $uuid): JsonResponse {
        $user = User::all()->find($uuid);
        $user->delete();
        return response()->json($user, 200);
    }

    public function create(Request $request): JsonResponse {
        return response()->json(UserRepository::create(new User($request->all())));
    }


}
