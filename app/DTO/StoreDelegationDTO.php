<?php


namespace App\DTO;


use App\ValueObjects\ID;
use DateTimeImmutable;

final class StoreDelegationDTO
{
    private DateTimeImmutable $startDate;
    private DateTimeImmutable $endDate;
    private ID $userId;
    private string $countryCode;

    public function __construct(
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate,
        ID $userId,
        string $countryCode
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->userId = $userId;
        $this->countryCode = $countryCode;
    }

    public function startDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function endDate(): DateTimeImmutable
    {
        return $this->endDate;
    }

    public function userId(): ID
    {
        return $this->userId;
    }

    public function countryCode(): string
    {
        return $this->countryCode;
    }
}
