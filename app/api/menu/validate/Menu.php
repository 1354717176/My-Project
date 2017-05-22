<?php
namespace app\api\menu\validate;

use think\Validate;

/**
 * 后台-菜单校验
 * @author   yanghuan
 * @datetime 2017/3/9 18:47
 */
class Menu extends Validate
{
    protected $rule = [
        'id' => 'number',
        'parent' => 'number',
        'name' => 'require|length:6,12',
        'module' => 'require|alpha',
        'controller' => 'alpha',
        'action' => 'alpha',
        'status' => 'require|in:0,1,2',
    ];

    protected $message = [
        'id.number' => '缺少ID',
        'parent.number' => '上级菜单必填',
        'name.require' => '菜单名称必填',
        'name.length' => '菜单名称2-4个字',
        'module.require' => '模块名字必填',
        'module.alpha' => '模块名字必须为英文字符',
        'controller.alpha' => '控制器名字必须为英文字符',
        'action.alpha' => '方法名字必须为英文字符',
        'status.require' => '状态必须',
        'status.in' => '状态参数错误',
    ];

    protected $scene = [
        'save' => ['parent', 'name', 'module', 'controller', 'action', 'status'], // 创建
        'update' => ['id', 'parent', 'name', 'module', 'controller', 'action', 'status'], // 修改
    ];
}
