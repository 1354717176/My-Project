<?php

namespace app\console\basics\controller;

use api\common\BaseLogin;

/**
 * 进度条
 * Class ProgressBars
 * @package app\console\basics\controller
 */
class ProgressBars extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}