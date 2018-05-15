<?php

namespace api\common;

use think\Controller;
use api\factory\FCate;

/**
 * 后台-公共登录类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 11:29
 */
class BaseLogin extends Controller
{

    protected $modelCate;
    protected $serviceCate;
    protected $logicCate;

    protected function _initialize()
    {
        parent::_initialize();

        //读取初始配置
        $domain = getConfig('domain');
        $this->assign('domain', $domain);

        //不需要进行登录验证的模块数组
        $notValidLoginModule = ['login'];

        //验证是否登录，没有在此数组里面的模块需要验证
        if (!in_array($this->request->module(), $notValidLoginModule)) {
            if (empty(\think\Session::has('user_id'))) {
                $this->redirect('/login');
                exit;
            }

            //显示系统顶部菜单
            $this->modelCate = FCate::createCate();
            $this->serviceCate = FCate::createServiceCate();
            $this->logicCate = FCate::createLogicCate();
            $this->modelCate->setProperty(0, 0);
            $topMenu = $this->logicCate->lists($this->modelCate, $this->serviceCate, getConfig('top_menu.number'));
            $this->assign('topMenu', $topMenu);
        } else {
            if (!empty(\think\Session::has('user_id'))) {
                $this->redirect('/');
                exit;
            }
        }
    }
}