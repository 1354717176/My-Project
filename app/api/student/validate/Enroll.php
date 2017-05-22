<?php
namespace app\api\student\validate;

use think\Validate;

/**
 * 学生-校验类
 * Class Enroll
 * @package app\api\menu\validate
 */
class Enroll extends Validate
{
    protected $rule = [
        'stu_name' => 'require|length:6,60',
        'stu_sex' => 'require',
        'stu_age' => 'require|number|regex:[0-9]{1,2}',
        'stu_phone' => ['require','regex' => '/^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/'],
        'stu_qq' => 'require|regex:[0-9]{5,18}',
        'stu_xueli' => 'require',
        'stu_zhuanye' => 'require',
    ];

    protected $message = [
        'stu_name.require' => '请输入姓名',
        'stu_name.length' => '姓名应在2-20个字之间',
        'stu_sex.require' => '请选择性别',

        'stu_age.require' => '请输入年龄',
        'stu_age.number' => '年龄必须为数字',
        'stu_age.regex' => '请正确填写您的年龄',

        'stu_phone.require' => '请输入手机号码',
        'stu_phone.regex' => '请正确填写您的手机号码',

        'stu_qq.require' => '请输入QQ',
        'stu_qq.regex' => '请正确填写您的QQ号码',

        'stu_xueli.require' => '请选择学历',
        'stu_zhuanye.require' => '请选择专业',
    ];

    protected $scene = [
        'save' => ['stu_name', 'stu_sex', 'stu_age', 'stu_phone', 'stu_qq', 'stu_xueli', 'stu_zhuanye'], // 创建
        //'update' => ['id', 'parent', 'name', 'module', 'controller', 'action', 'status'], // 修改
        'del' => ['stu_id'],
    ];
}