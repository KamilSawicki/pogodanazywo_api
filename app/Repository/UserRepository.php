<?php


namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public static function all() : Collection {
        return User::all();
    }

    /**
     * @throws \Exception
     */
    public static function find(string $uuid) : User {
        $user = User::all()->find($uuid);

        if(is_null($user)){
            throw new \Exception(__('user_exception.not_found'));
        }
        else{
            return $user->first();
        }
    }

    /**
     * @throws \Exception
     */
    public static function findMany(array $uuid) : Collection {
        $users = User::all()->find($uuid);

        if(is_null($users)){
            throw new \Exception(__('user_exception.not_found'));
        }
        else{
            return $users;
        }
    }

    /**
     * @throws \Exception
     */
    public static function delete(array $uuids) : Collection {
        $user = User::all()->find($uuids);

        if($user->isEmpty()){
            throw new \Exception(__('user_exception.not_found'));
        }
        else{
            return $user->first();
        }
    }

    public static function create(User $user) : User {
        $user->save();
        return $user;
    }

    public static function update(User $user) : User {
        $user->save();
        return $user;
    }

    /**
     * @throws \Exception
     */
    public static function findByApiToken(?string $apiToken) : User {
        $user = User::all()->where('api_token', $apiToken);

        if($user->isEmpty()){
            throw new \Exception(__('user_exception.not_found'));
        }
        else{
            return $user->first();
        }
    }
}
