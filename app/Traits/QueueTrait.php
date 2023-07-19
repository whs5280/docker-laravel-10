<?php


namespace App\Traits;


use App\Services\RabbitMqService;

trait QueueTrait
{
    protected function queuePush($id)
    {
        $service = new RabbitMqService();
        
        $service->setExchangeName('user_info');
        $service->setQueueName('user_info');
        $service->setRouteKey( '*.user.*');

        $service->push([
            'class_name' => $this->getMorphClass(),
            'id'         => $id
        ]);
        $service->writeMessage($id, $this->getMorphClass(), 'update');
    }
}
