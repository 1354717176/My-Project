<?php

namespace app\console\login\controller;

use app\api\common\logic\Base;
use app\api\common\logic\Captcha AS logicCaptcha;
use app\api\console\member\logic\Member AS logicMember;
use app\api\console\member\service\Member AS serviceMember;

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

            $serviceMember = new serviceMember;

            $code = $this->request->post('validCode', '');
            $id = $this->request->post('id', 0);
            $result = $serviceMember->checkCaptcha($code, $id);
            if(!$result){
                return json(['code'=>1,'msg'=>'验证码错误','data'=>[]]);
            }

            $data['user_name'] = $this->request->post('user_name');
            $data['pass_word'] = $this->request->post('pass_word');

        }
    }

    /**
     * 退出
     * author: yanghuan
     * date:2017/3/22 20:09
     */
    public function out()
    {
        /* Session::delete('adminUser');
         $this->redirect(Url('/login/login/', '', false, true));*/
    }
}