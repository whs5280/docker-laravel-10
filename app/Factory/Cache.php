<?php

namespace App\Factory;

class Cache
{
    /**
     * @param string $driver
     * @return RedisFactory|\Memcache
     * @throws \Exception
     */
    public static function factory(string $driver)
    {
        if (is_null($driver)) {
            throw new \Exception('driver cannot be null');
        }

        $factory = null;

        switch ($driver) {
            case 'redis':
                $factory = new RedisFactory();
                break;
            case 'memcache':
                $factory = new MemcacheFactory();
                break;
            // 添加其他驱动的处理逻辑
            default:
                throw new \Exception('unsupported driver');
        }

        return $factory;
    }
}
