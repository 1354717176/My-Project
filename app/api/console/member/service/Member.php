<?php

namespace app\api\console\member\service;

use app\api\common\logic\Captcha AS logicCaptcha;
use app\api\console\member\model\Member AS modelMember;

class Member
{
    public static function passSalt()
    {
        return random(8);
    }

    public static function passWord($passWord = '', $passSalt = '')
    {
        return md5($passWord . ($passSalt ? $passSalt : self::passSalt()));
    }

    public function checkUserName($userName)
    {
        return modelMember::where('user_name', $userName)->field('pass_salt')->find()->toArray();
    }

    public function checkPassWord($member)
    {
        $passWord = self::passWord($member['pass_word'], $member['pass_salt']);
        return modelMember::where('pass_word', $passWord)->count();
    }

    public function checkCaptcha($code = '', $id = 0)
    {
        $captcha = new logicCaptcha;
        $captcha->id = $id;
        $captcha->code = $code;
        return $captcha->check();
    }

    public function saveLoginInfo($userName)
    {
        $data['login_times'] = ['exp', 'login_times+1'];
        return modelMember::where('user_name', $userName)->isUpdate(true)->save($data);
    }
}