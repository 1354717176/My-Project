<?php
namespace app\api\console\cate\validate;

use think\Validate;

/**
 * 后台-菜单校验
 * @author   yanghuan
 * @datetime 2017/3/9 18:47
 */
class Cate extends Validate
{
    protected $rule = [
        'name' => 'require|length:2,4',
        'id' => 'require',
    ];

    protected $message = [
        'name.require' => '分类名称必填',
        'name.length' => '分类名称2-4个字',
        'id.require' => '缺少参数',
    ];

    protected $scene = [
        'save' => ['name'], // 创建
        'status' => ['id'], // 更改状态
    ];
}
