<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;

class BadgesLabels extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}