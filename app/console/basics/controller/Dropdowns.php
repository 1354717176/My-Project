<?php
namespace app\console\basics\controller;

use api\common\BaseLogin;

/**
 * 下拉列表
 * Class Dropdowns
 * @package app\console\basics\controller
 */
class Dropdowns extends BaseLogin
{
    public function index()
    {
        return $this->fetch();
    }
}