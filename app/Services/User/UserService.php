<?php


namespace App\Services\User;


use App\Models\User;
use App\Repositories\User\UserRepository;
use App\ValueObjects\ID;
use Ramsey\Uuid\Uuid;

final class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function storeUser(): User
    {
        $user = new User(
            new ID(Uuid::uuid4()->toString())
        );

        $this->userRepository->store($user);

        return $user;
    }
}
