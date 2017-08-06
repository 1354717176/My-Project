<?php
namespace app\api\login\validate;

use think\Validate;

/**
 * 后台-登录校验
 * @author   yanghuan
 * @datetime 2017/3/17 21:08
 */
class Login extends Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
    ];

    protected $message = [
        'username.require' => '请输入用户名',
        'password.require' => '请输入密码',
    ];

    protected $scene = [
        'login' => ['username', 'password'], //登录
    ];
}