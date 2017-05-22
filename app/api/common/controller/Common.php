<?php
namespace app\api\common\controller;

use think\Controller;
use think\Request;

/**
 * 前台-公共类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/20
 * Time: 19:45
 */
class Common extends Controller
{
    protected $request = '';

    protected function _initialize()
    {
        $this->request = Request::instance();
        $this->assign('module', $this->request->module());
    }
}