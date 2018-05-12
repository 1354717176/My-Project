<?php

namespace api\service\login\service;

class Login
{
    /**
     * 验证会员名是否存在
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/10 0010 16:57
     * @param $member 会员对象
     * @return mixed
     */
    public static function checkUserName($member)
    {
        $where['user_name'] = $member->getLoginName();
        return $member::where($where)->count();
    }

    /**
     * 验证密码是否正确
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/10 0010 16:57
     * @param $member 会员对象
     * @param $passSalt 会员密码加密的字符串
     * @return mixed
     */
    public static function checkUserPassword($member, $passSalt)
    {
        $where['pass_word'] = md5($member->getPassWord() . $passSalt);
        return $member::where($where)->count();
    }

    /**
     * 单一用户信息
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/10 0010 16:57
     * @param $member 会员对象
     * @param string $field 返回的字段
     * @return mixed
     */
    public static function userInfo($member, $field = '*')
    {
        $where['user_name'] = $member->getLoginName();
        return $member::where($where)->field($field)->find();
    }
}