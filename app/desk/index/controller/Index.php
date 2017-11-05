<?php

namespace app\desk\index\controller;

use think\Controller;
use think\Config;
use app\api\console\member\logic\Member AS logicMember;
use app\api\common\logic\Deskbase;

/**
 * 网站首页类
 * Class Index
 * @author yanghuan
 * @datetime 2017/3/20 19:47
 * @package app\desk\sign\controller
 */
class Index extends Deskbase
{

    /**
     * 网站首页
     * @author:yanghuna
     * @datetime:2017/3/29 19:45
     * @return mixed
     */
    public function index()
    {
        $user=[];
        $logicMember =new logicMember;
        $result = $logicMember->lists(['group_id'=>1,'status'=>1],1000);
        if(!$result['lists']->isEmpty()){
            foreach ($result['lists'] as $key=>$item){
                $user[$key]['value']=$item['id'];
                $user[$key]['title']=$item['user_name'];
            }
        }
        $this->assign('user',json_encode($user));
        $this->assign('random',random(8));

        return $this->fetch();
    }
}