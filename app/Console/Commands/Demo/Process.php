<?php

namespace App\Console\Commands\Demo;

use App\Services\Demo\ProcessService;
use Illuminate\Console\Command;
use JetBrains\PhpStorm\NoReturn;

class Process extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    #[NoReturn] public function handle()
    {
        $process = new ProcessService();
        for ($x = 0; $x < 5; $x++) {
            $process->task(function ($i) use ($x) {
                $this->logger($x);
            });
        }
        $process->run();
    }

    public function logger($param)
    {
        logger()->info(sprintf("time-: %s", $param));
    }
}
