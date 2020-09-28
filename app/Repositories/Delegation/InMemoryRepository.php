<?php


namespace App\Repositories\Delegation;


use App\Interfaces\DelegationInterface;
use App\Interfaces\UserInterface;
use App\Models\Delegation;
use App\ValueObjects\Cost;
use App\ValueObjects\ID;
use Illuminate\Support\Collection;

final class InMemoryRepository implements DelegationRepository
{
    private array $memory;

    public function __construct()
    {
        $this->memory = [
            new Delegation(
                new ID('3ef5c3f4-509b-4960-944c-eef8fa910a66'),
                new \DateTimeImmutable('2020-04-20 08:00:00'),
                new \DateTimeImmutable('2020-04-21 16:00:00'),
                'PL',
                new Cost('PLN', 20)
            ),
            new Delegation(
                new ID('c4b3aaab-cb8d-4f79-9c51-516dd051a308'),
                new \DateTimeImmutable('2020-04-24 20:00:00'),
                new \DateTimeImmutable('2020-04-28 16:00:00'),
                'DE',
                new Cost('PLN', 150)
            ),
        ];
    }

    public function store(DelegationInterface $delegation): void
    {
        $this->memory[] = $delegation;
    }

    public function findForUser(UserInterface $user): Collection
    {
        $collection = new Collection();

        foreach ($this->memory as $delegation) {
            if ($delegation->userId()->equals($user->id())) {
                $collection->add($delegation);
            }
        }

        return $collection;
    }
}
