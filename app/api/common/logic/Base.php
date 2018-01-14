<?php

namespace app\api\common\logic;

use think\Controller;

/**
 * 后台-公共类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 11:29
 */
class Base extends Controller
{

    protected function _initialize()
    {
        //读取初始配置
        $config = getConfig(['domain', 'not_pjax_module']);
        $this->assign('domain', $config['domain']);

        //非登录页面需要pjax加载
        $isPjax = $this->request->isPjax();
        $currentModel = $this->request->module();
        $currentAction = $this->request->action();
        $this->setPjax($isPjax, $currentModel, $currentAction, $config['not_pjax_module']);

    }
}