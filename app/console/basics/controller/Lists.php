<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;

class Lists extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}