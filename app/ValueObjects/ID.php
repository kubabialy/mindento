<?php


namespace App\ValueObjects;


final class ID
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ID $id): bool
    {
        return $this->value() === $id->value();
    }
}
