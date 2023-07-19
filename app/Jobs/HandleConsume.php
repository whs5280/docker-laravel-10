<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\RabbitMqService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleConsume implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // 构造函数入生产
        $user = User::query()->whereKey(1)->first();
        $user->update([
            'name' => 'whs'
        ]);

        // 消息投递
        User::queuePush($user->id);
    }


    public function handle(): void
    {
        $mq = new RabbitMqService();

        // 消费者进程回调函数
        $callback = function ($message) use ($mq){
            try {

                $params = json_decode($message->body, true);
                logger()->info('参数', [$params]);
                // 手动确认消息
                $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
                // 写入数据库
                $mq->writeMessage($params['id'], $params['class'], 'update', 1);

            }catch (\Exception $e){

                logger()->error('生产者队列 error message: ' . $e->getMessage());
                // 拒绝消息，会把消息投递到错误队列
                $message->delivery_info['channel']->basic_reject($message->delivery_info['delivery_tag'], false);
            }
        };

        $mq->setQueueName('user_info');
        $mq->setRouteKey( '*.user.*');
        $mq->listen($callback);
    }
}
