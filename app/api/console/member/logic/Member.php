<?php

namespace app\api\console\member\logic;

use app\api\console\member\model\Member as modelMember;

class Member
{
    public $modelMember;

    public function __construct()
    {
        $this->modelMember = new modelMember;
    }

    public function save($data = [])
    {

    }
}