<?php

namespace App\Console\Commands;

use App\Jobs\HandleConsume;
use App\Models\User;
use App\Services\RabbitMqService;
use Illuminate\Console\Command;

class RabbitQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbit-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'rabbitMq 的队列推送';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 测试
        dispatch(new HandleConsume());

        $this->info('生产者---开始投递');
    }
}
