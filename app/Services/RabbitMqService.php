<?php


namespace App\Services;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqService
{
    protected $connection;

    public function __construct()
    {
        $config = [
            'host' => config('rabbitmq.host'),
            'port' => config('rabbitmq.port'),
            'user' => config('rabbitmq.user'),
            'password' => config('rabbitmq.password'),
            'vhost' => '/',     //默认虚拟主机
        ];

        return $this->connection = new AMQPStreamConnection(
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password'],
            $config['vhost']
        );
    }


    /**
     * 数据插入到mq队列中（生产者）
     * 注：队列 和 交换机的 durable必须保持一致
     * @param $queue .队列名称
     * @param $exchange .交换机
     * @param $routingKey .路由名称
     * @param $messageBody .消息体
     */
    public function push($queue, $exchange, $routingKey, $messageBody)
    {
        // 构建通道（mq的数据存储与获取是通过通道进行数据传输的）
        $channel = $this->connection->channel();

        // 声明队列, durable 代表持久化
        $channel->queue_declare($queue, false, true, false, false);

        // 指定交换机，若是路由的名称不匹配不会把数据放入队列中
        $channel->exchange_declare($exchange, 'direct', false, true, false);

        // 队列和交换器绑定/绑定队列和类型
        $channel->queue_bind($queue, $exchange, $routingKey);

        $config = [
            'content_type' => 'text/plain',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ];

        // 实例化消息推送类
        $message = new AMQPMessage($messageBody, $config);

        // 消息推送到路由名称为$exchange的队列当中
        $channel->basic_publish($message, $exchange, $routingKey);

        // 日志记录
        logger()->info('生产者消息', [$messageBody]);

        //关闭消息推送资源
        $channel->close();

        //关闭mq资源
        $this->connection->close();
    }


    /**
     * 消费者：取出消息进行消费，并返回
     * @param $queue .队列名称
     * @param $callback .回调函数
     * @return bool
     */
    public function pop($queue, $callback)
    {
        logger()->info('开始消费');

        // 连接到 RabbitMQ 服务器并打开通道
        $channel = $this->connection->channel();

        // 声明要获取内容的队列
        $channel->queue_declare($queue, false, true, false, false);

        // 获取消息队列的消息
        $msg = $channel->basic_get($queue);

        // ack机制，手动确定消息消费
        $channel->basic_ack($msg->delivery_info['delivery_tag']);

        //消息主题返回给回调函数
        $res = $callback($msg->body);
        if($res){

            logger()->info('ack验证');
            //ack验证，如果消费失败了，从新获取一次数据再次消费
            $channel->basic_ack($msg->getDeliveryTag());
        }

        logger()->info('ack消费完成');

        //关闭消息推送资源
        $channel->close();

        //关闭mq资源
        $this->connection->close();

        return true;
    }
}
