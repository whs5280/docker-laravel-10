# docker-laravel-10
Laravel10 rabbitMq服务

## 说明
    总结这段时间学习的rabbitMq, 写的一个mq服务

## 环境需求
* Composer
* PHP >= 8.1
* Mysql 8.0+

## 使用

#### 1. 生产者投递服务

```shell
$ php artisan app:rabbit-queue
生产者---开始投递
```

#### 2. 拉取消费者

```shell
$ php artisan queue:work
```

## todo
 
- 后期引入 `pm2` 作为守护进程
- 使用 docker-compose 引入环境
