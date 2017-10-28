<?php

namespace app\console\cate\controller;

use app\api\common\logic\Base;

/**
 * 分类列表页
 * Class Index
 * @package app\console\article\controller
 */
class Lists extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}