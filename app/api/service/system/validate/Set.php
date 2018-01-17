<?php

namespace app\api\console\system\validate;

use think\Validate;

class Set extends Validate
{
    protected $rule = [
        'tel'=>['require','regex'=>'1(3|4|7|5|8)(\d{9})$|400[0-9]{7}$|0[0-9]{2,3}-[0-9]{7,8}$'],
        'detail'=>'require',
    ];

    protected $message = [
        'tel.require' => '电话不能为空',
        'tel.regex' => '电话不正确',
        'detail.require' => '详情不能为空',
    ];

    protected $scene = [
        'set' => ['tel'],
        'detail'=>['detail'],
    ];
}