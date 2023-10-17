<?php

namespace App\Tms\Services;

use Carbon\Carbon;

class TmsService
{
    function check($content)
    {
        if ($content == 'mock') {
            return true;
        }
        return false;
    }

    public static function getData()
    {
        return Carbon::now()->toDateTimeString();
    }
}
