<?php

namespace app\console\cate\controller;

use app\api\common\logic\Base;
use app\api\console\cate\logic\Cate AS logicCate;
use app\api\console\cate\service\Cate AS serviceCate;

/**
 * 分类列表页
 * Class Index
 * @package app\console\article\controller
 */
class Lists extends Base
{
    public $serviceCate;
    public $logicCate;

    public function _initialize()
    {
        parent::_initialize();
        $this->serviceCate = new serviceCate;
        $this->logicCate = new logicCate;
    }

    public function index()
    {

        $fields = 'id,name,sort,icon,parent_id,status';
        $map = [
            'status' => ['in', '0,2'],
            'type'=>1,
        ];
        $order = 'sort desc';
        $result = $this->logicCate->getList($fields, $map, $order);

        $list = $this->serviceCate->getTableDom($result);
        $this->assign('list',$list);

        return $this->fetch();
    }
}