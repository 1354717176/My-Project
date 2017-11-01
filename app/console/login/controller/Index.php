<?php

namespace app\console\login\controller;

use app\api\common\logic\Base;
use app\api\common\logic\Captcha AS logicCaptcha;
use app\api\console\member\logic\Member AS logicMember;
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
        $captcha = new logicCaptcha();
        $captcha->id=1;
        $captchaSrc = $captcha->captcha();
        $this->assign('captcha', $captchaSrc);

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
            $data['code'] = $this->request->post('validCode', '');
            $data['code_id'] = $this->request->post('id', 0);
            $data['user_name'] = $this->request->post('loginName');
            $data['pass_word'] = $this->request->post('password');
            try {
                $logicMember = new logicMember;
                $logicMember->login($data);
                return json(['code' => 0, 'msg' => '登录成功', 'data' => []]);
            } catch (Exception $e) {
                return json(['code' => 1, 'msg' => $e->getMessage(), 'data' => []]);
            }
        }
    }

    /**
     * 退出
     * author: yanghuan
     * date:2017/3/22 20:09
     */
    public function out()
    {
        session('token', null);
        $this->redirect('/login');
        exit;
    }
}