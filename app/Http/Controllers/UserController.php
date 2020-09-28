<?php


namespace App\Http\Controllers;


use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store()
    {
        $user = $this->userService
            ->storeUser();

        return new JsonResponse($user->toArray());
    }
}
