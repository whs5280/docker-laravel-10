<?php

namespace App\Comment\Handlers;

use App\Comment\Event\FakeArticleEvent;

class HandlerArticleAttr extends Handler
{
    /**
     * @param $event
     * @return mixed|void
     */
    public function run($event)
    {
        $articleId = $event->getArticleId();

        /**
         * Add 事件
         */
        if ($event->getAction() == 'add') {

            printf("文章[%s]评论数 `comment_count` + 1\n", $articleId);

        }

        /**
         * Del 事件
         */
        if ($event->getAction() == 'del') {

            printf("文章[%s]评论数 `comment_count` - 1\n", $articleId);

        }
    }
}
