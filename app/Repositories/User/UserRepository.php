<?php


namespace App\Repositories\User;


use App\Interfaces\UserInterface;
use App\ValueObjects\ID;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function store(UserInterface $user): void;
    public function findOne(ID $id): UserInterface;
    public function all(): Collection;
}
