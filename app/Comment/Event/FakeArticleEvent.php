<?php

namespace App\Comment\Event;

use App\Comment\Contracts\Eventable;

class FakeArticleEvent extends Eventable
{
    private $userId;

    private $articleId;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param $articleId
     * @return $this
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    private $action;
}
