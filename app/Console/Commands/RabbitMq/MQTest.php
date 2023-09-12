<?php


namespace App\Console\Commands\RabbitMq;

use App\Common\Helpers\RabbitMqHelper;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;

class MQTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbit-queue-test-listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '的消费';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mq = RabbitMqHelper::TestAMQP();

        $mq->listen(function (AMQPMessage $message) {
            try {
                $data = json_decode($message->body, 1);

                $id = $data['id'];
                $className = $data['className'];

                $this->info('参数', [$id, $className]);

                $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
                echo "ok：$id\r\n";

            } catch (\Exception $exception) {

                echo $exception->getMessage() . "\r\n";
                $message->delivery_info['channel']->basic_reject($message->delivery_info['delivery_tag'], false);

            }
        });
    }
}
