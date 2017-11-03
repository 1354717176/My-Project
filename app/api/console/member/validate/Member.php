<?php

namespace app\api\console\member\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'user_name' => 'require|length:1,30',
        'pass_word' => 'confirm:confrim_pass_word',
        'number'=>'require|integer|between:0,100000',
    ];

    protected $message = [
        'user_name.require' => '用户名不能为空',
        'user_name.length' => '长度应在1-30位之间',
        'pass_word.confirm' => '两次密码输入不一样',
        'number.require' => '名额不能为空',
        'number.integer' => '名额为整数',
        'number.between' => '名额在0-100000之间',
    ];

    protected $scene = [
        'system_member' => ['user_name', 'pass_word'], //登录
        'member1' => ['user_name', 'pass_word','number'], //置业顾问添加/编辑
    ];
}