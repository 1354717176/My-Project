<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/22
 * Time: 11:15
 */

namespace app\console\basics\controller;

use api\common\BaseLogin;

class Carousel extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}