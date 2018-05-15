<?php

namespace api\service\cate\logic;

use think\Exception;

/**
 * 分类管理
 * Class Cate
 * @package api\console\cate\logic
 */
class Cate
{
    public function lists($modelCate, $serviceCate, $pageSize)
    {
        $lists = $serviceCate->lists($modelCate, $pageSize);
        return $lists;
    }
}