<?php

namespace App\Models;

use App\Interfaces\UserInterface;
use App\ValueObjects\ID;

class User implements UserInterface
{
    private ID $id;

    public function __construct(ID $id)
    {
        $this->id = $id;
    }

    public function id(): ID
    {
        return $this->id;
    }

    public function toArray()
    {
        return [
            'id' => $this->id()->value()
        ];
    }
}
