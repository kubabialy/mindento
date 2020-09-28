<?php


namespace App\ValueObjects;


use App\Exceptions\Cost\AmountNegativeException;
use App\Exceptions\IncorrectCurrencyException;
use App\Helpers\CurrencyCodeHelper;

final class Cost
{
    private string $currency;

    /**
     * For the sake of this example it's assumed that $amount = 10
     * Means 10 units of given currency. $10, 10 euro or 10 PLN.
     */
    private int $amount;

    public function __construct(string $currency, int $amount)
    {
        if (!CurrencyCodeHelper::isCorrectCode($currency)) {
            throw new IncorrectCurrencyException($currency);
        }

        if ($amount < 0) {
            throw new AmountNegativeException();
        }

        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function amount(): int
    {
        return $this->amount;
    }
}
