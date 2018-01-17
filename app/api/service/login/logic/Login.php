<?php

namespace app\api\service\login\logic;

use app\api\service\login\validate\Login AS validateLogin;
use think\Exception;
use think\Lang;

use app\api\service\member\model\Member AS modelMember;
use app\api\nozzle\Member AS interfaceMember;

class Login implements interfaceMember
{
    public $validCode;
    public static $loginInfo = [];
    public $validateLogin;

    public function __construct($loginName, $password, $validCode = '')
    {
        self::$loginInfo['user_name'] = $loginName;
        self::$loginInfo['pass_word'] = $password;
        $this->validCode = $validCode;
        $this->validateLogin = new validateLogin();
    }

    public function checkUserName($userName){
        $where['user_name'] = $userName;
        return modelMember::where($where)->field('id,status,pass_salt')->find();
    }

    public function validate()
    {
        if(!$this->validateLogin->scene('login')->check(self::$loginInfo)){
            throw new Exception($this->validateLogin->getError(),10000);
        }

        $user = $this->checkUserName(self::$loginInfo['user_name']);
        if(empty($user)){
            throw new Exception(Lang::get('MEMBERS_NOT_EXIST'),10001);
        }
    }
}