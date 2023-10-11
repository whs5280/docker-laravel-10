<?php

namespace App\Console\Commands;

use App\Services\SensitiveService;
use Illuminate\Console\Command;

class HandlerSensitive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:handler-sensitive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '敏感词过滤功能';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $content = '10.11，开始搞白色革命！！！';
        $isLegal = SensitiveService::isLegal($content);
        $this->info("word is legal: {$isLegal}");

        $legalContent = SensitiveService::getBadWord($content);
        $this->info(print_r($legalContent, true));
    }
}
