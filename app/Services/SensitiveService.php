<?php


namespace App\Services;


use DfaFilter\SensitiveHelper;

class SensitiveService
{
    protected static $_instance = null;

    protected static $defaultPath = [
        'dict/bk.txt',
        'dict/fd.txt'
    ];

    /**
     * 单例模式
     * @param array $wordPath
     * @return SensitiveHelper|object|null
     * @throws \DfaFilter\Exceptions\PdsBusinessException
     */
    public static function getInstance($wordPath = [])
    {
        if (!self::$_instance) {
            // 默认词库
            $defaultPath = self::handleDefaultPath();
            $paths = array_merge($defaultPath, $wordPath);
            self::$_instance = SensitiveHelper::init();
            if (!empty($paths)) {
                foreach ($paths as $path) {
                    self::$_instance->setTreeByFile($path);
                }
            }
        }

        return self::$_instance;
    }

    /**
     * 获取完整路径
     * @return array|string[]
     */
    static function handleDefaultPath()
    {
        return array_map(function ($path) {
            return storage_path($path);
        }, self::$defaultPath);
    }

    /**
     * 检测是否含有敏感词
     * @param $content
     * @return bool
     * @throws \DfaFilter\Exceptions\PdsBusinessException
     * @throws \DfaFilter\Exceptions\PdsSystemException
     */
    static function isLegal($content)
    {
        return self::getInstance()->islegal($content);
    }

    /**
     * 敏感词过滤
     * @param $content
     * @param string $replaceChar
     * @param bool $repeat
     * @param int $matchType
     * @return \DfaFilter\文本内容|mixed
     * @throws \DfaFilter\Exceptions\PdsBusinessException
     * @throws \DfaFilter\Exceptions\PdsSystemException
     */
    static function replace($content, $replaceChar = '', $repeat = false, $matchType = 1)
    {
        return self::getInstance()->replace($content, $replaceChar, $repeat, $matchType);
    }

    /**
     * 标记敏感词
     * @param $content
     * @param $startTag
     * @param $endTag
     * @param int $matchType
     * @return \DfaFilter\文本内容|mixed
     * @throws \DfaFilter\Exceptions\PdsBusinessException
     * @throws \DfaFilter\Exceptions\PdsSystemException
     */
    static function mark($content, $startTag, $endTag, $matchType = 1) {
        return self::getInstance()->mark($content, $startTag, $endTag, $matchType);
    }

    /**
     * 获取文本中的敏感词
     * @param $content
     * @param int $matchType
     * @param int $wordNum
     * @return array
     * @throws \DfaFilter\Exceptions\PdsBusinessException
     * @throws \DfaFilter\Exceptions\PdsSystemException
     */
    static function getBadWord($content, $matchType = 1, $wordNum = 0){
        return self::getInstance()->getBadWord($content, $matchType, $wordNum);
    }
}
