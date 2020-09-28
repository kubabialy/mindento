<?php


namespace App\Models;


use App\Http\Resources\DelegationResource;
use App\Interfaces\DelegationInterface;
use App\ValueObjects\Cost;
use App\ValueObjects\ID;
use DateTimeImmutable;

class Delegation implements DelegationInterface
{
    private ID $userId;
    private DateTimeImmutable $start;
    private DateTimeImmutable $end;
    private string $country;
    private Cost $cost;

    public function __construct(
        ID $userId,
        DateTimeImmutable $start,
        DateTimeImmutable $end,
        string $country,
        Cost $cost
    ) {
        $this->userId = $userId;
        $this->start = $start;
        $this->end = $end;
        $this->country = $country;
        $this->cost = $cost;
    }

    public function userId(): ID
    {
        return $this->userId;
    }

    public function start(): DateTimeImmutable
    {
        return $this->start;
    }

    public function end(): DateTimeImmutable
    {
        return $this->end;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function cost(): Cost
    {
        return $this->cost;
    }

    public function toResource(): DelegationResource
    {
        return new DelegationResource($this);
    }

}
