<?php

namespace App\Tms\Commands;

use App\Tms\Container\TmsContainer;
use Illuminate\Console\Command;

class HandlerTms extends Command
{
    protected $signature = 'app:handler-tms';

    protected $description = 'test';

    public function handle()
    {
        printf("今日日期：%s\n", TmsContainer::getInstance()->getData());
        printf("参数1：%s - %s\n", 'test', intval(TmsContainer::getInstance()->check('test')));
        printf("参数2：%s - %s\n", 'mock', intval(TmsContainer::getInstance()->check('mock')));
        $this->info('end');
    }
}
