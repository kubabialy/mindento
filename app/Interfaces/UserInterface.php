<?php


namespace App\Interfaces;


use App\ValueObjects\ID;
use Illuminate\Contracts\Support\Arrayable;

interface UserInterface extends Arrayable
{
    public function id(): ID;
}
