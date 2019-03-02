<?php

namespace App\Models;

use App\Telegram;
use App\Viber;
use App\Watsapp;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string created
 * @property string updated
 * @property int message_id
 * @property string wakeup
 * @property int messenger
 * @property int user_id
 * @property string message
 * @property string send_time
 * @property int try_count
 * @property int error_code
 * @property int error_message
 * @property int message_status
 */

class Messages extends Model
{

    const UPDATED_AT = 'updated';
    const CREATED_AT = 'created';

    const try_count = 5;

    const STATUS_NEW = 0;
    const STATUS_IN_PROCESS = 1;
    const STATUS_SEND = 2;
    const STATUS_ERROR = 3;

    public static $messengers = [
        'telegram' => 0,
        'viber' => 1,
        'watsapp' => 2,
    ];

    public static $messengers_desc = [
        0 => Telegram::class,
        1 => Viber::class,
        2 => Watsapp::class,
    ];
}