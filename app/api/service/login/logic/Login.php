<?php

namespace app\api\service\login\logic;

use app\api\service\login\validate\Login AS validateLogin;
use think\Exception;
use think\Lang;

use app\api\service\login\service\Login AS serviceLogin;

class Login
{
    public $validCode;
    public $validCodeId;
    public $validateLogin;
    public static $loginInfo = [];

    public function __construct($loginName, $password, $validCode = '', $validCodeId = 0)
    {
        self::$loginInfo['user_name'] = $loginName;
        self::$loginInfo['pass_word'] = $password;
        $this->validCode = $validCode;
        $this->validCodeId = $validCodeId;
        $this->validateLogin = new validateLogin();
    }

    /**
     * 登录验证
     * @author:yanghuan
     * @datetime:2018/1/20 22:39
     * @throws Exception
     */
    public function validate()
    {
        //对会员名 和 密码进行基础验证
        if (!$this->validateLogin->scene('login')->check(self::$loginInfo)) {
            throw new Exception($this->validateLogin->getError(), 10000);
        }

        //当前登录的会员名是否有效
        $user = serviceLogin::checkUserName(self::$loginInfo['user_name']);
        if (empty($user)) {
            throw new Exception(Lang::get('MEMBERS_NOT_EXIST'), 10001);
        }

        //获取会员信息
        $userInfo = serviceLogin::userInfo(self::$loginInfo['user_name'], 'id,pass_salt');
        //当前登录的密码是否有效
        $user = serviceLogin::checkUserPassword(self::$loginInfo['pass_word'], $userInfo['pass_salt']);
        if (empty($user)) {
            throw new Exception(Lang::get('PASSWORD_FAILED'), 10002);
        }

        //验证码是否正确
        if (!captcha_check($this->validCode, $this->validCodeId)) {
            throw new Exception(Lang::get('CAPTCHA_FAILED'), 10003);
        }

        \think\Session::set('user_id', $userInfo['id']);
    }
}