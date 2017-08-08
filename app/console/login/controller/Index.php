<?php

namespace app\console\login\controller;

use app\api\login\validate\Login as loginValidate;
use app\api\common\logic\Base;
use app\api\user\logic\User;
use think\Url;
use think\Session;

/**
 * 后台-登录类
 * Created by PhpStorm.
 * User: yanghuan
 * Date: 2017/3/8
 * Time: 11:23
 */
class Index extends Base
{

    protected $config;

    public function _initialize()
    {
        $this->config = parent::getConfig('domain');
    }

    public function index()
    {
        $this->assign('domain', $this->config);
        $this->assign('captcha',captcha_src(1));
        return $this->fetch();
    }

    /**
     * 登录验证
     * @author yanghuan
     * @datetime 2017/3/17 21:06
     */
    public function login()
    {
        if ($this->request->isPost()) {
            $data['username'] = $this->request->post('username');
            $data['password'] = $this->request->post('password');

            $loginValidate = new loginValidate();
            if (!$loginValidate->scene('login')->check($data)) {
                return ['code' => 50000, 'msg' => $loginValidate->getError()];
            }

            $user = new User();
            $userInfo = $user->userInfoByUserName($data['username']);
            if ($userInfo) {

                //目前只有超级管理员才能登录这里
                if (!in_array($userInfo['type'], [0])) {
                    return ['code' => 50003, 'msg' => '当前用户不能登录这里'];
                }

                $userName = $data['username'];
                $password = md5($data['password'] . $userInfo['passalt']);
                $result = $user->userInfoByPassword($userName, $password);
                if ($result) {
                    Session::set('adminUser', $userInfo);
                    return ['code' => 0, 'url' => Url::build(DS, '', false, true)];
                }
                return ['code' => 50002, 'msg' => '用户名或密码不正确'];
            }
            return ['code' => 50001, 'msg' => '会员不存在'];
        }
    }

    /**
     * 退出
     * author: yanghuan
     * date:2017/3/22 20:09
     */
    public function out()
    {
        Session::delete('adminUser');
        $this->redirect(Url('/login/login/', '', false, true));
    }
}