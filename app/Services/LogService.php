<?php

namespace App\Services;

class LogService
{
    protected static \Aliyun_Log_Client $client;

    protected static string $project;

    public function __construct($driver)
    {
        $config = match ($driver) {
            'aliyun' => config('logging.aliyun'),
            default  => config("logging.aliyun"),
        };

        self::$client = new \Aliyun_Log_Client($config['endpoint'], $config['accessKeyId'], $config['accessKey']);
        self::$project = $config['project'];
    }

    public static function log($level, $message, array $context = []) : void
    {
        try {
            $logstore = config('logging.aliyun.logstore');
            $topic  = config('app.name');
            $source = config('app.name');

            $contents = [
                'level' => $level,
                'message' => $message,
                'context' => $context,
            ];

            $contents = json_encode($contents, JSON_UNESCAPED_UNICODE);

            $request = new \Aliyun_Log_Models_PutLogsRequest(self::$project, $logstore, $topic, $source, $contents);
            $response = self::$client->putLogs($request);
            var_dump($response);

        } catch (\Exception $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
        }
    }

    public static function debug($message, array $context = []) : void
    {
        self::log('debug', $message, $context);
    }

    public static function info($message, array $context = []) : void
    {
        self::log('info', $message, $context);
    }

    public static function send() : void
    {
        try {
            $request = new \Aliyun_Log_Models_ListLogstoresRequest(self::$project);
            $response = self::$client->ListLogstores($request);
            var_dump($response);

        } catch (\Aliyun_Log_Exception $e) {
            var_dump($e);
        }
    }
}
