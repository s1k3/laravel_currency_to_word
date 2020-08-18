<?php


namespace S1K3\Bangla\Number\To\Word;


use Exception;
use Throwable;

class InvalidAmountException extends Exception
{

    public function __construct($message = "Invalid amount", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . "{$this->message}";
}
}