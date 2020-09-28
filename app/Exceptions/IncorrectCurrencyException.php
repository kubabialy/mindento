<?php


namespace App\Exceptions;


use Throwable;

class IncorrectCurrencyException extends \Exception
{
    public function __construct(string $currencyCode)
    {
        $message = sprintf('Provided currenct `%s` is incorrect', strtoupper($currencyCode));
        parent::__construct($message, 500);
    }
}
