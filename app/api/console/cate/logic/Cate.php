<?php

namespace app\api\console\cate\logic;

use think\Db;
use Tree\Tree;
use think\Url;
use app\api\console\cate\model\Cate AS modelCate;

/**
 * 分类管理
 * Class Cate
 * @package app\api\console\cate\logic
 */
class Cate
{
    public $cate;

    public function __construct()
    {
        $this->cate = new modelCate;
    }

    public function getList($fields = [], $map = [], $order = 'id asc')
    {
        return modelCate::where($map)->field($fields)->order($order)->select()->toArray();
    }

    public function save($info = [])
    {
        $isUpdate = isset($info['id']) && $info['id'] ? true : false;
        return $this->cate->isUpdate($isUpdate)->save($info);
    }

    public function getInfo($id = 0)
    {
        return $id ? modelCate::get($id) : false;
    }
}