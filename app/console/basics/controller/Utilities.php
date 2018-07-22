<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;


/**
 * 辅助类
 * Class Colors
 * @package app\console\basics\controller
 */
class Utilities extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}