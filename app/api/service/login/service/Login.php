<?php

namespace app\api\service\login\service;

use app\api\nozzle\Member AS interfaceMember;
use app\api\service\member\model\Member AS modelMember;

class Login implements interfaceMember
{
    /**
     * 验证会员名是否存在
     * @author:yanghuan
     * @datetime:2018/1/20 20:49
     * @param string $userName 会员名
     * @return int|string
     */
    public static function checkUserName($userName = '')
    {
        $where['user_name'] = $userName;
        return modelMember::where($where)->count();
    }

    /**
     * 验证密码是否正确
     * @author:yanghuan
     * @datetime:2018/1/20 21:25
     * @param $password 密码
     * @param $passSalt 密码字符串
     * @return int|string
     */
    public static function checkUserPassword($password, $passSalt)
    {
        $where['pass_word'] = md5($password . $passSalt);
        return modelMember::where($where)->count();
    }

    /**
     * 单一用户信息
     * @author:yanghuna
     * @datetime:2018/1/20 21:29
     * @param string $userName 会员名
     * @param string $field 要返回的字段
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function userInfo($userName = '', $field = '*')
    {
        $where['user_name'] = $userName;
        return modelMember::where($where)->field($field)->find();
    }
}