<?php
namespace app\desk\index\controller;

use app\api\common\controller\Common;

/**
 * 网站首页类
 * Class Index
 * @author yanghuan
 * @datetime 2017/3/20 19:47
 * @package app\desk\sign\controller
 */
class Index extends Common
{
    /**
     * 网站首页
     * @author:yanghuna
     * @datetime:2017/3/29 19:45
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }
}