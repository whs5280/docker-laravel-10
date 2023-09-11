<?php

namespace App\Console\Commands;


use App\Common\Helpers\RabbitMqHelper;
use Illuminate\Console\Command;

class RabbitQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbit-queue-test';

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
        $mq = RabbitMqHelper::TestAMQP();
        $mq->send([
            'class_name' => 'Test',
            'id'         => '100',
        ]);

        $this->info('生产者---开始投递');
    }
}
