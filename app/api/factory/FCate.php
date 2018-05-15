<?php

namespace api\factory;

use api\service\cate\model\Cate AS modelCate;
use api\service\cate\validate\Cate AS validateCate;
use api\service\cate\logic\Cate AS logicCate;
use api\service\cate\service\Cate AS serviceCate;

class FCate
{
    public static function createCate()
    {
        return new modelCate;
    }

    public static function createValidateCate()
    {
        return new validateCate;
    }

    public static function createLogicCate()
    {
        return new logicCate;
    }

    public static function createServiceCate()
    {
        return new serviceCate;
    }
}