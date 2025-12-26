<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Notifications\UserRegistered;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        $user->notify(new UserRegistered($user));

        return new UserResource($user);
    }
}
