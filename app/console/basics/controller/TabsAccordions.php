<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;

class TabsAccordions extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}