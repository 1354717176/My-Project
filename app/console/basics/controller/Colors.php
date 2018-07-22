<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;


/**
 * 配色方案
 * Class Colors
 * @package app\console\basics\controller
 */
class Colors extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}