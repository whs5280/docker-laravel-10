<?php

namespace App\Comment\Handlers;

class HandlerNotifyMessage extends Handler
{
    public function run($event)
    {
        $userId = $event->getUserId();
        $articleId = $event->getArticleId();

        /**
         * Add 事件
         */
        if ($event->getAction() == 'add') {

            printf("系统消息: 用户ID[%s]评论你的文章[%s]\n", $userId, $articleId);

        }

        /**
         * Del 事件
         */
        if ($event->getAction() == 'del') {

            printf("系统消息: 用户ID[%s]删除对你文章[%s]的评论\n", $userId, $articleId);

        }
    }
}
