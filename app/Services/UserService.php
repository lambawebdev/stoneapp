<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function createUser(array $dto): User
    {
        $user =  User::create($dto);
        Log::info('User created: {id}', ['id' => $user->id]);

        return $user;
    }
}
