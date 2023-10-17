<?php

namespace App\Tms\Container;

abstract class Container
{
    private static $_instance;

    private static $name;

    public static function getInstance($name)
    {
        if (!self::$_instance) {
            self::$name = $name;
            self::$_instance = app()->make($name);
        }

        return static::$_instance;
    }

    public static function __callStatic($method, $arguments)
    {
        $instance = self::getInstance(self::$name);

        if (!$instance) {
            throw new \Exception('A singleton has not been set.');
        }

        return $instance->$method(...$arguments);
    }
}
