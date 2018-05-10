<?php

namespace app\api\service\login\logic;

use think\Exception;
use think\Lang;

use app\api\service\login\validate\Login AS validateLogin;
use app\api\service\login\service\Login AS serviceLogin;

class Login
{

    /**
     * 登录验证
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/10 0010 16:56
     * @param $member 会员对象
     * @param string $validCode 验证码code
     * @param int $validCodeId 验证码id
     * @throws Exception
     */
    public function validate($member, $validCode = '', $validCodeId = 0)
    {
        //对会员名 和 密码进行基础验证
        $validateLogin = new validateLogin();
        if (!$validateLogin->scene('login')->check(['user_name' => $member->getLoginName(), 'pass_word' => $member->getPassWord()])) {
            throw new Exception($validateLogin->getError(), 10000);
        }

        //当前登录的会员名是否有效
        $user = serviceLogin::checkUserName($member);
        if (empty($user)) {
            throw new Exception(Lang::get('MEMBERS_NOT_EXIST'), 10001);
        }

        //获取会员信息
        $userInfo = serviceLogin::userInfo($member, 'id,pass_salt');

        //当前登录的密码是否有效
        $user = serviceLogin::checkUserPassword($member, $userInfo['pass_salt']);
        if (empty($user)) {
            throw new Exception(Lang::get('PASSWORD_FAILED'), 10002);
        }

        //验证码是否正确
        if (!captcha_check($validCode, $validCodeId)) {
            throw new Exception(Lang::get('CAPTCHA_FAILED'), 10003);
        }

        \think\Session::set('user_id', $userInfo['id']);
    }

    /**
     * 退出登录
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/10 0010 17:09
     */
    public function outLogin()
    {
        \think\Session::delete('user_id');
    }
}