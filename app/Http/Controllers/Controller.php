<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function add_message(Request $request)
    {
        $request_data = $request->all();
        if (isset($request_data['user_id'])) {
            $request_data = [$request_data];
        }
        foreach ($request_data as $value) {

            try {
                $validator = Validator::make($value, [
                    'user_id' => 'required|numeric',
                ]);
                $user_id_valid = $validator->validate();
                $validator = Validator::make($value, [
                    'wakeup' => 'date',
                    'messenger' => ['required', Rule::in(array_flip(Messages::$messengers))],
                    'message' => [
                        'bail',
                        'required',
                        Rule::unique('messages', 'message')->where('user_id', $user_id_valid['user_id'])
                    ]
                ]);
                $valid_data = $validator->validate();
            }
            catch (\Exception $e) {
                continue;
            }
            $message = new Messages();
            $message->message = $valid_data['message'];
            $message->user_id = $user_id_valid['user_id'];
            $message->wakeup = $valid_data['wakeup'] ?? null;
            $message->messenger = Messages::$messengers[$valid_data['messenger']];
            $message->message_status = Messages::STATUS_NEW;
            $message->save();

            dispatch(new SendMessage($message));
        }
    }
}
