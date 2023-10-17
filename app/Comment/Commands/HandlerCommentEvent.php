<?php

namespace App\Comment\Commands;

use App\Comment\Event\FakeArticleEvent;
use App\Comment\Handlers\HandlerArticleAttr;
use App\Comment\Handlers\HandlerNotifyMessage;
use App\Comment\Handlers\HandlerSendSms;
use Illuminate\Console\Command;

class HandlerCommentEvent extends Command
{
    protected $signature = 'app:handler-comment-event';

    protected $description = 'test';

    public function handle()
    {
        $fakeEvent = (new FakeArticleEvent())
            ->setUserId('10086')
            ->setArticleId('123456')
            ->setAction('add');

        $handler = new HandlerArticleAttr();
        $handler->next(new HandlerNotifyMessage())
            ->next(new HandlerSendSms());

        $handler->start($fakeEvent);
    }
}
