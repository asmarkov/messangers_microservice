<?php

namespace App;

use App\Models\Messages;

interface IMessenger
{
    public function __construct(Messages $messages);

    public function send();
}