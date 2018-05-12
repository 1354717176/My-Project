<?php

namespace api\service\member\model;

use think\Model;
use api\nozzle\IMember;

class Member extends Model implements IMember
{
    protected $autoWriteTimestamp = 'datetime';
    protected $insert = ['reg_ip', 'login_time', 'login_ip'];
    protected $update = ['login_ip', 'login_time'];
    public $loginName = '';
    public $passWord = '';

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

    public function __call($method, $args)
    {
        $argsNum = func_num_args();
        switch ($argsNum) {
            case 1:
                $this->setLoginName($args[0]);
                break;
            case 2:
                $this->setLoginNameAndPassWord($args[0], $args[1]);
                break;
        }
    }

    public function setLoginName($loginName)
    {
        $this->loginName = $loginName;
    }

    public function setLoginNameAndPassWord($loginName, $passWord)
    {
        $this->loginName = $loginName;
        $this->passWord = $passWord;
    }

    public function getPassWord()
    {
        return $this->passWord;
    }

    public function getLoginName()
    {
        return $this->loginName;
    }
}