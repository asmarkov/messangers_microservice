<?php

namespace App\Exceptions;


class UndefinedMessengerException extends \Exception
{
    protected $message = 'Can\'t send message to undefined messenger.';

    public function __construct($code = 0, $previous = null)
    {
        parent::__construct($this->message, $code, $previous);
    }

}