<?php

use App\Factory\Cache;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Cache.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'CacheFactory.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'RedisFactory.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'MemcacheFactory.php';

$cache = Cache::factory('redis');
$cache->get();
$cache->set();
$cache->del();

$cache2 = Cache::factory('memcache');
$cache2->get();
$cache2->set();
$cache2->del();
