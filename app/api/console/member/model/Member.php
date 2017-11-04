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

    public function getStatusTextAttr($value,$data)
    {
        $status = [1=>'启用',2=>'禁用'];
        return $status[$data['status']];
    }

    public function getTeamTextAttr($value,$data)
    {
        $team = [1=>'华南城',2=>'中原',3=>'九鼎'];
        return $team[$data['team']];
    }

    public function memberNote()
    {
        return $this->hasOne('MemberNote','member_id');
    }
}