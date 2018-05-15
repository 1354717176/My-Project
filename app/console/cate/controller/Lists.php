<?php

namespace app\console\cate\controller;

use api\common\BaseLogin;
use api\factory\FCate;

/**
 * 分类列表页
 * Class Lists
 * @package app\console\cate\controller
 */
class Lists extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}