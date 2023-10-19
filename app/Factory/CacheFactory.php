<?php

namespace App\Factory;

interface CacheFactory
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @return mixed
     */
    public function set();

    /**
     * @return mixed
     */
    public function del();
}
