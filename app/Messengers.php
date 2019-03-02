<?php

namespace App;

use App\Models\Messages;

abstract class Messengers implements IMessenger
{
    protected $message;

    public function __construct(Messages $message)
    {
        $this->message = $message;
    }

}