<?php


namespace App\Repositories\Delegation;


use App\Interfaces\DelegationInterface;
use App\Interfaces\UserInterface;
use Illuminate\Support\Collection;

interface DelegationRepository
{
    public function store(DelegationInterface $delegation): void;
    public function findForUser(UserInterface $user): Collection;
}
