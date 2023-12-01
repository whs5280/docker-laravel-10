<?php

namespace App\Console\Commands;


use App\Models\User;
use App\Services\LogService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Mock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // SLS日志服务
        (new LogService('aliyun'))->debug('智能抢单系统[取消订单]', ['orderId' => '10086']);
    }
}


