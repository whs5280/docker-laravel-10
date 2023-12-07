<?php


namespace App\Services\Demo;


use JetBrains\PhpStorm\NoReturn;

class ProcessService
{
    private array $workers;
    private int $index;
    private $tasks;

    public function __construct()
    {
    }

    /**
     * 添加进程任务
     * @param callable $task
     * @return void
     */
    public function task(callable $task): void
    {
        $this->tasks[$this->index] = $task;
        $this->index++;
    }

    /**
     * 创建子进程
     * @return void
     */
    private function fork(): void
    {
        for ($i = 0; $i < $this->index; $i++) {
            $pid = pcntl_fork();
            $pid === -1 && exit('fork error');

            if ($pid > 0) {
                $this->workers[$pid] = [
                    'status' =>  0,
                    'index'  =>  $i,
                    'pid'    =>  $pid
                ];
            } else {
                $pid = posix_getpid();
                posix_kill($pid, SIGKILL);
                exit('一定要退出，否则子进程会继承上下文继续执行');
            }
        }
    }

    /**
     * @return void
     */
    #[NoReturn] public function run() : void
    {
        $this->fork();
        while (true) {
            usleep(100000);
            foreach ($this->workers as &$worker) {
                if (array_sum(array_column($this->workers, 'status')) >= $this->index) {
                    exit("done\n");
                }
                $res = pcntl_waitpid($worker['pid'], $status);
                if ($res > 0) {
                    $worker['status'] = 1;
                }
            }
        }
    }
}
