<?php

namespace app\api\console\member\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'user_name' => 'require|length:1,30',
        'pass_word' => 'confirm:confrim_pass_word',
        'number'=>'require|integer|between:0,100000',
        'mobile'=>['require','regex'=>'1(3|4|7|5|8)(\d{9})$'],
        'true_name'=>'require',
        'adviser_id'=>'require|egt:1',
        'room'=>'require|in:1,2',
        'roomNum'=>'require|between:1,7',
        'house'=>'require|between:1,7',
    ];

    protected $message = [
        'user_name.require' => '用户名不能为空',
        'user_name.length' => '长度应在1-30位之间',
        'pass_word.confirm' => '两次密码输入不一样',
        'number.require' => '名额不能为空',
        'number.integer' => '名额为整数',
        'number.between' => '名额在0-100000之间',
        'mobile.require' => '请输入正确的手机号',
        'mobile.regex' => '请输入正确的手机号',
        'true_name.require' => '姓名必填',
        'adviser_id.require' => '置业顾问必填',
        'adviser_id.egt' => '置业顾问必填',
        'room.require' => '意向户型必填',
        'room.in' => '意向户型必填',
        'roomNum.require' => '楼栋必填',
        'roomNum.between' => '楼栋必填',
        'house.require' => '户型必填',
        'house.between' => '户型必填',
    ];

    protected $scene = [
        'system_member' => ['user_name', 'pass_word'], //登录
        'member1' => ['user_name', 'pass_word','number'], //置业顾问添加/编辑
        'member5_room0' => ['mobile', 'true_name','adviser_id','room'], //意向户型没选
        'member5_room1' => ['mobile', 'true_name','adviser_id','room','roomNum'], //意向户型选的楼栋
        'member5_room2' => ['mobile', 'true_name','adviser_id','room','house'], //意向户型选的户型
    ];
}