<?php

namespace app\console\login\controller;

use app\api\common\BaseLogin;
use app\api\service\login\logic\Login AS logicLogin;
use think\Exception;
use app\api\factory\FMember;

/**
 * 后台-登录类
 * Created by PhpStorm.
 * User: yanghuan
 * Date: 2017/3/8
 * Time: 11:23
 */
class Index extends BaseLogin
{
    public $login;

    public function _initialize()
    {
        parent::_initialize();
        $this->login = new logicLogin();
    }

    public function index()
    {
        //显示验证码
        $this->assign('captcha', captcha_src(1));
        return $this->fetch();
    }

    /**
     * 登录操作
     * @author yanghuan
     * @datetime 2017/3/17 21:06
     */
    public function login()
    {
        $loginName = $this->request->post('loginName', '');
        $passWord = $this->request->post('password', '');
        $validCode = $this->request->post('validCode', '');
        $validCodeId = $this->request->post('id/d', 0);
        try {
            //实例化对象并设置属性
            $member = FMember::createMember();
            $member->setProperty($loginName, $passWord);

            $this->login->validate($member, $validCode, $validCodeId);
            return djson(0, '操作成功');
        } catch (Exception $e) {
            return djson($e->getCode(), $e->getMessage());
        }
    }

    /**
     * 退出
     * author: yanghuan
     * date:2017/3/22 20:09
     */
    public function out()
    {
        $this->login->outLogin();
        $this->redirect('/login');
    }

}