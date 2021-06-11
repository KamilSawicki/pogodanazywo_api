<?php


namespace App\Services;


use App\Models\User;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @throws Exception
     */
    public static function login(array $credentials): String {
        if(Auth::attempt($credentials)){
            $user = UserRepository::find(Auth::id());
            $api_token = Str::random('32');
            $user->api_token = $api_token;
            UserRepository::update($user);
            return $api_token;
        }
        else{
            throw new Exception(__('auth_exception.credentials_error'));
        }
    }

    /**
     * @throws Exception
     */
    public static function authenticate(?string $apiToken):User {
        try {
            $user = UserRepository::findByApiToken($apiToken);
            Auth::setUser($user);
            return $user;
        }
        catch (Exception $e) {
            throw new Exception(__('auth_exception.invalid_api_token'));
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws Exception
     */
    public static function register(array $data): User {
        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email|unique:users',
                'name' => 'required|string|min:5',
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
        $user = Auth::user();
        $user->api_token = null;
        UserRepository::update($user);
    }
}
