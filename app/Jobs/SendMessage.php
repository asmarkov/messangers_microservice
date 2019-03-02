<?php

namespace App\Jobs;


use App\Models\Messages;
use App\SenderFactory;

class SendMessage extends Job
{


    protected $message;

    public $tries = Messages::try_count;

    /**
     * Create a new job instance.
     * @param $message Messages
     * @return void
     */
    public function __construct(Messages $message)
    {
        $this->message = $message;
        if(!is_null($message->wakeup)) {
            $delay = strtotime($message->wakeup)-time();
            if($delay > 0) {
                $this->delay($delay);
            }
        }
    }


    /**
     * @throws \Exception
     */
    public function handle()
    {
        $this->message->message_status = Messages::STATUS_IN_PROCESS;
        $this->message->save();
        try {
            $gate = SenderFactory::factory($this->message);
            $gate->send();
        }
        catch (\Exception $e) {
            $this->message->try_count++;
            $this->message->error_code = $e->getCode();
            $this->message->message_status = Messages::STATUS_ERROR;
            $this->message->error_message = $e->getMessage();
            $this->message->save();
            throw $e;
        }
        $this->message->try_count++;
        $this->message->message_status = Messages::STATUS_SEND;
        $this->message->save();

    }
}
