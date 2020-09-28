<?php


namespace App\Interfaces;


use App\Http\Resources\DelegationResource;
use App\ValueObjects\Cost;
use DateTimeImmutable;

interface DelegationInterface
{
    public function start(): DateTimeImmutable;

    public function end(): DateTimeImmutable;

    public function country(): string;

    public function cost(): Cost;

    public function toResource(): DelegationResource;
}
