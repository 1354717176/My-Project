<?php
namespace app\api\user\validate;

use think\Validate;

/**
 * 后台-角色校验
 * @author   yanghuan
 * @datetime 2017/3/12 18:28
 */
class Role extends Validate
{
    protected $rule = [
        'user_id' => 'require',
        'role_id' => 'require',
        'role_name' => 'require|length:6,24',
        'role_code' => 'require|regex:[a-zA-Z_]*',
    ];

    protected $message = [
        'user_id.require' => '会员编号必须',
        'role_id' => '角色编号必填',
        'role_name.require' => '角色名称必填',
        'role_name.length' => '角色名称2-8个字',
        'role_code.require' => '角色编码必填',
        'role_code.regex' => '角色编码只能输入字母和下划线',
    ];

    protected $scene = [
        'save' => ['role_code', 'user_id'], // 保存
        'saveRole' => ['role_code', 'role_name'],
        'editSaveRole' => ['role_id', 'role_code', 'role_name']
    ];
}