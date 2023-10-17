<?php

namespace App\Comment\Contracts;

class Eventable
{
    /**
     * userId
     */
    public function getUserId(){}

    /**
     * articleId
     */
    public function getArticleId(){}

    /**
     * action
     */
    public function getAction(){}
}
