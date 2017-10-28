<?php

namespace app\api\console\cate\service;

use app\api\console\cate\logic\Cate AS logicCate;
use app\api\console\cate\validate\Cate AS validateCate;
use think\Exception;

class Cate
{
    public $cate;

    public function __construct()
    {
        $this->cate = new logicCate;
    }

    public function check($data = [])
    {
        $validateCate = new validateCate;
        if (!$validateCate->scene('save')->check($data)) {
            return $validateCate->getError();
        }
        return [];
    }

    public function save($data=[]){
        return $this->cate->save($data);;
    }

}