<?php

namespace App\Factory;

use Illuminate\Support\Facades\Redis;

class RedisFactory implements CacheFactory
{
    /**
     * @var
     */
    private static $_instance;

    /**
     * @return Redis
     */
    public function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new Redis();
        }
        return self::$_instance;
    }

    public function get()
    {
        printf("redis get\n");
    }

    public function set()
    {
        printf("redis set\n");
    }

    public function del()
    {
        printf("redis del\n");
    }
}
