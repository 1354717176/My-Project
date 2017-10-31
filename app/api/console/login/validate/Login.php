<?php
namespace app\api\console\login\validate;

use think\Validate;

/**
 * 后台-登录校验
 * @author   yanghuan
 * @datetime 2017/3/17 21:08
 */
class Login extends Validate
{
    protected $rule = [
        'user_name' => 'require',
        'pass_word' => 'require',
    ];

    protected $message = [
        'user_name.require' => '请输入用户名',
        'pass_word.require' => '请输入密码',
    ];

    protected $scene = [
        'login' => ['user_name', 'pass_word'], //登录
    ];
}