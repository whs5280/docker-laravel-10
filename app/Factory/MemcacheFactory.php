<?php

namespace App\Factory;

class MemcacheFactory implements CacheFactory
{
    /**
     * @var
     */
    private static $_instance;

    /**
     * @return \Memcache
     */
    public function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new \Memcache();
        }
        return self::$_instance;
    }

    public function get()
    {
        printf("memcache get\n");
    }

    public function set()
    {
        printf("memcache get\n");
    }

    public function del()
    {
        printf("memcache get\n");
    }
}
