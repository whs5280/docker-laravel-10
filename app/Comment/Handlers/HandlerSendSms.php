<?php

namespace App\Comment\Handlers;

class HandlerSendSms extends Handler
{
    public function run($event)
    {
        $userId = $event->getUserId();

        printf("发送短信给用户[%s]\n", $userId);
    }
}
