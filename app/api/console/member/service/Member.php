<?php

namespace app\api\console\member\service;

use app\api\common\logic\Captcha AS logicCaptcha;
use app\api\console\login\validate\Login AS validateLogin;
use app\api\console\member\model\Member AS modelMember;

class Member
{

    /**
     * 8位随机字符串
     * @author:yanghuna
     * @datetime:2017/10/31 21:06
     * @return string
     */
    public static function passSalt()
    {
        return random(8);
    }

    /**
     * 密码加密
     * @author:yanghuna
     * @datetime:2017/10/31 21:07
     * @param string $passWord 密码
     * @param string $passSalt 8位随机字符串
     * @return string
     */
    public static function passWord($passWord = '', $passSalt = '')
    {
        return md5($passWord . ($passSalt ? $passSalt : self::passSalt()));
    }

    /**
     * 用户名 密码 基础验证
     * @author:yanghuna
     * @datetime:2017/10/31 2017/10/31
     * @param $data
     * @return array
     */
    public function checkBase($data)
    {
        $validate = new validateLogin();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
        return [];
    }

    /**
     * 检查用户名是否存在
     * @author:yanghuna
     * @datetime:2017/10/31 21:07
     * @param $userName
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function checkUserName($userName)
    {
        return modelMember::where('user_name', $userName)->field('pass_salt')->find();
    }

    /**
     * 检查密码是否正确
     * @author:yanghuna
     * @datetime:2017/10/31 21:10
     * @param $passWord
     * @param $passSalt
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function checkPassWord($passWord, $passSalt)
    {
        $passWord = self::passWord($passWord, $passSalt);
        return modelMember::where('pass_word', $passWord)->field('id,user_name,pass_word')->find();
    }

    /**
     * 检查验证码是否正确
     * @author:yanghuna
     * @datetime:2017/10/31 21:10
     * @param string $code
     * @param int $id
     * @return bool
     */
    public function checkCaptcha($code = '', $id = 0)
    {
        $captcha = new logicCaptcha;
        $captcha->id = $id;
        $captcha->code = $code;
        return $captcha->check();
    }

    /**
     * 检查token
     * @author:yanghuna
     * @datetime:2017/10/31 21:12
     * @param $token
     * @return int|string
     */
    public function checkToken($token)
    {
        return modelMember::where('token', $token)->count();
    }

    /**
     * 修改登录次数，记录登录时间,记录token
     * @author:yanghuna
     * @datetime:2017/10/31 21:09
     * @param $userId
     * @param $userName
     * @param $passWord
     * @return array|string
     */
    public function saveLoginInfo($userId, $userName, $passWord)
    {
        $data['id'] = $userId;
        $data['login_times'] = ['exp', 'login_times+1'];
        $data['token'] = sha1($userName . $passWord . self::passSalt());

        $modelMember = new modelMember;
        $result = $modelMember->allowField(true)->isUpdate(true)->save($data);
        return $result ? $data['token'] : [];
    }
}