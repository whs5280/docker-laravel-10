<?php

namespace App\Tms\Container;

/**
 * @method static getData
 * @method static check(string $content)
 * Class TmsContainer
 * @package App\Demo
 */
class TmsContainer extends Container
{
    static function getInstance($container = 'tms')
    {
        return parent::getInstance($container);
    }
}
