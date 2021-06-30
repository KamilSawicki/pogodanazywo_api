<?php


namespace App\Services;


use App\Models\User;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * @throws Exception
     */
    public static function login(array $credentials): array {
        if(Auth::attempt($credentials)){
            $user = UserRepository::find(Auth::id());
            $api_token = Str::random('32');
            $user->api_token = Hash::make($api_token);
            UserRepository::update($user);
            return [
                'api_token' => $api_token,
                'user_id' => $user->id
            ];
        }
        else{
            throw new Exception('login_credentials_error');
        }
    }

    /**
     * @throws Exception
     */
    public static function authenticate(?string $apiToken, ?string $userId):User {
        $user = UserRepository::find($userId);
        if(Hash::check($apiToken, $user->api_token)) {
            Auth::setUser($user);
            return $user;
        }
        else {
            throw new Exception(__('auth_exception.invalid_api_token'));
        }
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public static function register(array $data): User {
        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]
        );

        if($validator->fails()){
            throw new Exception($validator->errors()->first());
        }
        else {
            return UserRepository::create(new User($validator->validated()));
        }
    }

    /**
     * @throws Exception
     */
    public static function logout() {
        $user = UserRepository::find(Auth::id());
        $user->api_token = null;
        Cookie::queue(Cookie::forget('user_id'));
        Cookie::queue(Cookie::forget('api_token'));
        UserRepository::update($user);
    }
}
