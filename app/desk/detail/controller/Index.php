<?php

namespace app\desk\detail\controller;

use app\api\common\logic\Deskbase;

/**
 * 查看详情
 * Class Detail
 * @package app\desk\detail\controller
 */
class Index extends Deskbase
{
    public function index()
    {
        return $this->fetch();
    }
}