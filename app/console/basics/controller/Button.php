<?php

namespace app\console\basics\controller;

use app\api\common\Base;


/**
 * 按钮
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/6
 * Time: 10:25
 */
class Button extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}