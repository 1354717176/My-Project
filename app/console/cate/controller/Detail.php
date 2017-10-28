<?php

namespace app\console\cate\controller;

use app\api\common\logic\Base;
use app\api\console\cate\service\Cate AS serviceCate;


class Detail extends Base
{

    public $cate;
    public function _initialize()
    {
        parent::_initialize();
        $this->cate = new serviceCate;
    }

    public function index()
    {
        return $this->fetch();
    }

    public function save()
    {
        $data['parent_id'] = $this->request->post('parent_id',0);
        $data['name'] = $this->request->post('name',0);
        $data['module'] = $this->request->module();
        $data['controller'] = $this->request->controller();
        $data['action'] = $this->request->action();

        $checkResult = $this->cate->check($data);
        if($checkResult){
            return json(['code'=>1,'msg'=>$checkResult,'data'=>[]]);
        }

        $this->cate->save($data);
        return json(['code'=>0,'msg'=>'操作成功','data'=>[]]);
    }
}