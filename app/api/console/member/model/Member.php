<?php

namespace app\api\console\member\model;

use think\Model;

class Member extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $insert = ['reg_ip','login_time','login_ip'];
    protected $update = ['login_ip','login_time'];

    protected function setRegIpAttr()
    {
        return request()->ip();
    }

    protected function setLoginIpAttr()
    {
        return request()->ip();
    }

    protected function setLoginTimeAttr()
    {
        return timetodate();
    }
}