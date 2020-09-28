<?php


namespace App\Exceptions\Cost;


class AmountNegativeException extends \Exception
{
    protected $message = 'Provided amount is negative';
}
