<?php

namespace App\Models;

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
 * @property int retry_count
 * @property int error_code
 * @property int error_message
 */

class Messages extends Model
{

    const UPDATED_AT = 'updated';
    const CREATED_AT = 'created';

    const try_count = 5;

    public static $messengers = [
        'telegram' => 0,
        'viber' => 1,
        'watsapp' => 2,
    ];
}