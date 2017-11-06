<?php

namespace app\api\common\logic;

use app\api\console\system\logic\Set as logicSet;
use think\Controller;
use think\Config;

class Deskbase extends Controller
{
    public function _initialize()
    {

        $this->logicSet = new logicSet;

        $config = $this->logicSet->lists([1,2]);
        if ($config) {
            Config::set($config);
        }
        $this->assign('config', Config::get());

        //域名配置
        $domain =  Config::get('domain');
        $this->assign('domain', $domain);
    }
}