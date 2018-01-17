<?php

namespace app\api\console\cate\logic;

use think\Exception;
use app\api\console\cate\model\Cate AS modelCate;
use app\api\console\cate\service\Cate AS serviceCate;

/**
 * 分类管理
 * Class Cate
 * @package app\api\console\cate\logic
 */
class Cate
{
    public $cate;
    public $serviceCate;

    public function __construct()
    {
        $this->cate = new modelCate;
        $this->serviceCate = new serviceCate;
    }

    /**
     * 分类列表
     * @author:yanghuna
     * @datetime:2017/10/31 21:49
     * @param array $fields
     * @param array $map
     * @param string $order
     * @return array
     */
    public function getList($fields = [], $map = [], $order = 'id asc')
    {
        return modelCate::where($map)->field($fields)->order($order)->select()->toArray();
    }

    /**
     * 编辑/保存分类
     * @author:yanghuna
     * @datetime:2017/10/31 21:48
     * @param $data
     * @param string $scene 基础验证的场景
     * @return false|int
     * @throws Exception
     */
    public function save($data,$scene='save')
    {
        $checkResult = $this->serviceCate->check($data,$scene);
        if ($checkResult) {
            throw new Exception($checkResult);
        }

        $isUpdate = isset($data['id']) && $data['id'] ? true : false;
        return $this->cate->isUpdate($isUpdate)->save($data);
    }

    /**
     * 单独分类的信息
     * @author:yanghuna
     * @datetime:2017/10/31 21:49
     * @param int $id
     * @return bool|static
     */
    public function getInfo($id = 0)
    {
        return $id ? modelCate::get($id) : false;
    }
}