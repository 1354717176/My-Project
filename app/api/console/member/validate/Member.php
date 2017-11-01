<?php

namespace app\api\console\member\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'user_name' => 'require|alphaDash|length:5,30',
        'pass_word' => 'confirm:confrim_pass_word',
    ];

    protected $message = [
        'user_name.require' => '用户名不能为空',
        'user_name.alphaDash' => '请输入字母数字和下划线',
        'user_name.length' => '长度应在5-30位之间',
        'pass_word.confirm' => '两次密码输入不一样',
    ];

    protected $scene = [
        'system_member' => ['user_name', 'pass_word'], //登录
    ];
}