<?php
namespace app\api\user\logic;

use app\api\common\controller\Base;
use think\Db;

/**
 * 会员类
 * Class User
 * @package app\api\user\logic
 * @author yanghuan
 * @datetime 2017/3/17 21:14
 */
class User
{
    /**
     * 根据会员名查询会员信息
     * @author yanghuan
     * @datetime 2017/3/17 21:20
     * @param $username 会员名
     */
    public function userInfoByUserName($username)
    {
        if (!$username) {
            return false;
        }

        return Db::name('user')->field('id,type,user_name,passalt')->where('user_name', $username)->find();
    }

    /**
     * 根据用户名和密码查询会员是否存在
     * @author yanghuan
     * @datetime 2017/3/17 21:25
     * @param $username 用户名
     * @param $password 密码
     */
    public function userInfoByPassword($username, $password)
    {
        if ($username && $password) {
            return Db::name('user')->where('user_name', $username)->where('password', $password)->count();
        }
        return false;
    }
}