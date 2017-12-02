<?php

namespace app\api\common\logic;

use think\Config;
use think\Controller;
use think\Session;
use app\api\console\member\service\Member AS serviceMember;
/**
 * 后台-公共类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/8
 * Time: 11:29
 */
class Base extends Controller
{
    protected $userInfo;
    protected $auth;
    protected $config;
    protected $file;

    protected function _initialize()
    {
       $this->config =  self::getConfig();

        //域名配置
        $this->assign('domain', $this->config['domain']);

        if($this->request->module() != 'login'){
            if(!Session::has('token')){
                $this->redirect('/login');
                exit;
            }

            $token = Session::get('token');
            $serviceMember = new serviceMember;
            $result = $serviceMember->checkToken($token);
            if(!$result){
                $this->redirect('/login');
                exit;
            }

            //pjax加载模版
            $this->setPjax();
        }
    }

    /**
     * 获取配置文件
     * @param $value 配置参数
     * author:yanghuan
     * date: 2017/8/3 20:45
     */
    protected function getConfig($value = '')
    {
        $config = Config::get($value);
        return $config;
    }



    /**
     * 配合前端进行的pjax请求而进行的模版加载设置
     * author:yanghuan
     * date:2017/10/19 22:47
     */
    protected function setPjax(){
        $this->view->config('tpl_cache', false);
        $layout = ($this->request->isPjax() || in_array($this->request->action(),['ie'])) ? false : '../../common/view/layout';
        $this->view->engine->layout($layout);
    }
}