<?php

namespace app\console\system\controller;

use app\api\common\logic\Base;
use app\api\console\system\logic\Set as logicSet;
use think\Db;
use think\Config;
use think\Exception;

class Set extends Base
{

     public $logicSet;

     public function _initialize()
     {
         parent::_initialize();
         $this->logicSet = new logicSet;

         $type = $this->request->get('type', 1);
         $config = $this->logicSet->lists($type);
         if($config){
             Config::set($config);
         }
         $this->assign('config',Config::get());
     }

    public function index()
    {
        $type = $this->request->get('type', 1);
        $this->assign('type',$type);
        return $this->fetch('index' . $type);
    }

    public function detail()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            try{
                $this->logicSet->save($param);
                Db::commit();
                return json(['code' => 0, 'msg' => '操作成功', 'data' => []]);
            }catch (Exception $e){
                Db::rollback();
                return json(['code' => 1, 'msg' => $e->getMessage(), 'data' => []]);
            }
        }
    }

}