<?php

namespace App\Comment\Handlers;

abstract class Handler
{
    /**
     * @var Handler
     */
    private $nextHandler;

    /**
     * @param $event
     * @return mixed
     */
    abstract public function run($event);

    /**
     * 下一个
     * @param Handler $handler
     * @return Handler
     */
    public function next(Handler $handler)
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * 启动
     * @param $event
     */
    public function start($event)
    {
        $this->run($event);
        if (!is_null($this->nextHandler)) {
            $this->nextHandler->start($event);
        }
    }
}
