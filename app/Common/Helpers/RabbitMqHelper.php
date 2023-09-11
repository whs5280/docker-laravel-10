<?php


namespace App\Common\Helpers;

class RabbitMqHelper
{
    /**
     * 测试使用
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function TestAMQP()
    {
        $mq = app()->make('MQ');
        $mq->exchange_name = 'test';
        $mq->queue_name    = 'test';
        $mq->route_key     = 'message';

        return $mq;
    }

    /**
     * ES 异步更新
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function DBMigrateEsAMQP()
    {
        $mq = app()->make('MQ');
        $mq->exchange_name = 'db_migrate_es';
        $mq->queue_name    = 'db_migrate_es';
        $mq->route_key     = 'message';

        return $mq;
    }
}
