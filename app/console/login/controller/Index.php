<?php

namespace app\console\login\controller;

use app\api\common\Base;
use app\api\service\login\logic\Login AS logicLogin;
use think\Exception;

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
        $loginName = $this->request->post('loginName', '');
        $password = $this->request->post('password', '');
        $validCode = $this->request->post('validCode', '');
        try {
            $login = new logicLogin($loginName, $password, $validCode);
            $login->validate();
            return djson(0, '操作成功');
        } catch (Exception $e) {
            return djson($e->getCode(), $e->getMessage());
        }
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