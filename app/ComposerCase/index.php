<?php

# 这里不需要`composer install`, `composer dumpautoload`即可

require __DIR__ . '/vendor/autoload.php';

$currentTime = \App\ComposerCase\Services\ComposerService::currentTime();

printf('current time is %s', $currentTime);

# shell为 `php app/ComposerCase/index.php`
