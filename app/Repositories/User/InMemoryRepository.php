<?php


namespace App\Repositories\User;


use App\Interfaces\UserInterface;
use App\Models\User;
use App\ValueObjects\ID;
use Illuminate\Support\Collection;

final class InMemoryRepository implements UserRepository
{
    /**
     * @var User[]
     */
    private array $memory;

    public function __construct()
    {
        $this->memory = [
            new User(new ID('3ef5c3f4-509b-4960-944c-eef8fa910a66')),
            new User(new ID('c4b3aaab-cb8d-4f79-9c51-516dd051a308')),
        ];
    }

    public function store(UserInterface $user): void
    {
        $this->memory[] = $user;
    }

    public function all(): Collection
    {
        return collect($this->memory);
    }

    public function findOne(ID $id): UserInterface
    {
        foreach ($this->memory as $user) {
            if ($user->id()->equals($id)) {
                return $user;
            }
        }
    }
}
