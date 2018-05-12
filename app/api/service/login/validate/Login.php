<?php
namespace api\service\login\validate;

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
        'user_name.require' => '{%PLEASE_ENTER_USERNAME}',
        'pass_word.require' => '{%PLEASE_ENTER_PASSWORD}',
    ];

    protected $scene = [
        'login' => ['user_name', 'pass_word'], //登录
    ];
}