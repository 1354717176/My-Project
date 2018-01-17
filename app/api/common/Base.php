<?php

namespace app\api\common;

use think\Controller;

/**
 * 后台-公共类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 11:29
 */
class Base extends Controller
{

    protected function _initialize()
    {
        parent::_initialize();

        //读取初始配置
        $domain = getConfig('domain');
        $this->assign('domain', $domain);

    }
}