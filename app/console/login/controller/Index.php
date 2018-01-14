<?php

namespace app\console\login\controller;

use app\api\common\logic\Base;

/**
 * 后台-登录类
 * Created by PhpStorm.
 * User: yanghuan
 * Date: 2017/3/8
 * Time: 11:23
 */
class Index extends Base
{

    public function index()
    {
        //显示验证码
        $this->assign('captcha', captcha_src());
        return $this->fetch();
    }

    /**
     * 登录验证
     * @author yanghuan
     * @datetime 2017/3/17 21:06
     */
    public function login()
    {
    }

    /**
     * 退出
     * author: yanghua
     * date:2017/3/22 20:09
     */
    public function out()
    {
    }

}