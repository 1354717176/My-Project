<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;

/**
 * 排版
 * Class Typography
 * @package app\console\basics\controller
 */
class Typography extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}