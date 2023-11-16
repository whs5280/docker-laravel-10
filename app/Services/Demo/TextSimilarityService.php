<?php

namespace App\Services\Demo;

class TextSimilarityService
{
    /**
     * [排除的词语]
     *
     * @var string[]
     */
    private array $excludeArr = array('的', '了', '和', '呢', '啊', '哦', '恩', '嗯', '吧');

    /**
     * [词语分布数组]
     *
     * @var array
     */
    private array $words = array();

    /**
     * [分词后的数组一]
     *
     * @var array
     */
    private array $segList1 = array();

    /**
     * [分词后的数组二]
     *
     * @var array
     */
    private array $segList2 = array();

    /**
     * [分词两段文字]
     *
     * TextSimilarityService constructor.
     * @param $text1
     * @param $text2
     */
    public function __construct($text1, $text2)
    {
        $this->segList1 = $this->segment($text1);
        $this->segList2 = $this->segment($text2);
    }

    /**
     * [外部调用]
     *
     * @return string
     */
    public function run()
    {
        $this->analyse();
        $rate = $this->handle();
        return $rate ? $rate : 'errors';
    }

    /**
     * [分析两段文字]
     */
    private function analyse()
    {
        foreach ($this->segList1 as $v) {
            if (!in_array($v, $this->excludeArr)) {
                if (!array_key_exists($v, $this->words)) {
                    $this->words[$v] = array(1, 0);
                } else {
                    $this->words[$v][0] += 1;
                }
            }
        }

        foreach ($this->segList2 as $v) {
            if (!in_array($v, $this->excludeArr)) {
                if (!array_key_exists($v, $this->words)) {
                    $this->words[$v] = array(0, 1);
                } else {
                    $this->words[$v][1] += 1;
                }
            }
        }
    }

    /**
     * [余弦公式]
     *
     * @return float|int
     */
    private function handle()
    {
        $sum = $sumT1 = $sumT2 = 0;
        foreach ($this->words as $word) {
            $sum += $word[0] * $word[1];
            $sumT1 += pow($word[0], 2);
            $sumT2 += pow($word[1], 2);
        }
        return $sum / (sqrt($sumT1 * $sumT2));
    }

    /**
     * 分词
     * @param $text
     * @return array
     */
    private function segment($text)
    {
        $outText = array();
        //实例化
        $so = scws_new();
        //字符集
        $so->set_charset('utf8');
        //处理
        $so->send_text($text);

        //便利出需要的数组
        while ($res = $so->get_result()) {
            foreach ($res as $v) {
                $outText[] = isset($v['word']) ? strtoupper($v['word']) : "";
            }
        }
        //关闭
        $so->close();

        return $outText;
    }
}
