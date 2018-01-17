<?php

namespace app\api\console\log\model;

use think\Model;

class Log extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $updateTime = false;
    protected $insert = ['ip'];

    protected function setIpAttr()
    {
        return request()->ip();
    }
}