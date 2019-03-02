<?php

namespace App;

use App\Models\Messages;
use App\Exceptions\UndefinedMessengerException;

class SenderFactory
{
    private function __construct()
    {

    }

    /**
     * @param Messages $message
     * @return Messengers
     * @throws UndefinedMessengerException
     * @throws \Exception
     */

    public static function factory(Messages $message): Messengers
    {
        if (!array_key_exists($message->messenger, Messages::$messengers_desc)) {
            throw new UndefinedMessengerException(0);
        }
        if (!class_exists(Messages::$messengers_desc[$message->messenger])) {
            throw new \Exception("Class " . Messages::$messengers_desc[$message->messenger] . " not found", 1);
        }
        $class = Messages::$messengers_desc[$message->messenger];
        return new $class($message);
    }
}