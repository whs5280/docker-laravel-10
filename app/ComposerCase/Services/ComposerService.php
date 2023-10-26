<?php

/**
 * "Carbon\\": "../../vendor/nesbot/carbon/src/Carbon"
 * 这里参考 根目录的 `autoload_psr4.php`文件 在 `composer.json` 文件配置
 */
namespace App\ComposerCase\Services;

use Carbon\Carbon;

class ComposerService
{
    public static function currentTime()
    {
        return Carbon::now()->toDateTimeString();
    }
}
