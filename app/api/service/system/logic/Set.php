<?php

namespace app\api\console\system\logic;

use app\api\console\system\service\Set as serviceSet;
use think\Db;
use think\Exception;

class Set
{

    public $serviceSet;

    public function __construct()
    {
        $this->serviceSet = new serviceSet;
    }

    public function save($param)
    {
        $scene=[1=>'set',2=>'detail'];
        $result = $this->serviceSet->checkSetBase($param,$scene[$param['type']]);
        if($result){
            throw new Exception($result);
        }

        $data = [];
        $paramKeys = array_keys($param);
        foreach ($paramKeys as $key => $value) {
            if($key == 'type'){
                continue;
            }
            $data[$key]['key'] = $value;
            $data[$key]['value'] = $param[$value];
            $data[$key]['type'] = $param['type'];
        }

        Db::startTrans();

        if ($paramKeys) {
            $this->serviceSet->delete($paramKeys);
        }
        $this->serviceSet->save($data);
    }

    public function lists($type){
        $data=[];
        $result = $this->serviceSet->lists($type);
        if($result){
            foreach ($result as $item){
                $data[$item['key']] = $item['value'];
            }
            return $data;
        }
        return [];
    }
}