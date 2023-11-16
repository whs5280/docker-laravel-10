<?php

namespace App\Console\Commands\Demo;

use App\Services\Demo\TextSimilarityService;
use Illuminate\Console\Command;

class TextSimilarity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:text-similarity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '文本相似度（余弦定理）';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $text1 = '';
        $text2 = '';
        $obj = new TextSimilarityService($text1, $text2);
        echo $obj->run();
    }
}
