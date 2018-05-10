<?php

namespace app\api\common;

use think\Controller;

/**
 * 后台-公共登录类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 11:29
 */
class BaseLogin extends Controller
{

    protected function _initialize()
    {
        parent::_initialize();

        //读取初始配置
        $domain = getConfig('domain');
        $this->assign('domain', $domain);

        //不需要进行登录验证的模块数组
        $notValidLoginModule = ['login'];
        //验证是否登录，没有在此数组里面的模块需要验证
        if (empty(\think\Session::has('user_id')) && !in_array($this->request->module(), $notValidLoginModule)) {
            $this->redirect('/login');
            exit;
        }


    }
}