<?php

namespace app\api\common\logic;

use think\Config;
use think\Controller;
use think\Request;
use think\Session;
use think\Db;

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

    protected function _initialize()
    {
       $this->config =  self::getConfig();

        //域名配置
        $this->assign('domain', $this->config['domain']);

        //pjax加载模版
        $this->setPjax();
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
     * 随机字符串
     * @param $length
     * @param string $chars
     * @return string
     * author: yanghuan
     * date:2017/3/12 18:01
     */
    protected static function random($length, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz')
    {
        $hash = '';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }

    /**
     * 配合前端进行的pjax请求而进行的模版加载设置
     * author:yanghuan
     * date:2017/10/19 22:47
     */
    protected function setPjax(){
        $this->view->config('tpl_cache', false);
        $layout = $this->request->isPjax() ? false : '../../common/view/layout';
        $this->view->engine->layout($layout);
    }
}