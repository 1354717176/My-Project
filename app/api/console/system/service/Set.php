<?php

namespace app\api\console\system\service;

use app\api\console\system\model\Set as modelSet;
use app\api\console\system\validate\Set as validateSet;

class Set
{

    public $modelSet;
    public function __construct()
    {
        $this->modelSet = new modelSet;
    }

    public function save($data)
    {
        $this->modelSet->allowField(true)->isUpdate(false)->saveAll($data);
    }

    public function delete($key=[]){
        $this->modelSet->allowField(true)->where('key', 'IN', $key)->delete();
    }

    public function lists($type){
        return $this->modelSet->field('key,value')->where('type','IN',$type)->select()->toArray();
    }

    public function checkSetBase($data,$scene){
        $validate = new validateSet();
        if (!$validate->scene($scene)->check($data)) {
            return $validate->getError();
        }
        return [];
    }
}