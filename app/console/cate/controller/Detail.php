<?php

namespace app\console\cate\controller;

use app\api\common\logic\Base;
use app\api\console\cate\logic\Cate AS logicCate;
use app\api\console\cate\service\Cate AS serviceCate;


class Detail extends Base
{

    public $serviceCate;
    public $logicCate;

    public function _initialize()
    {
        parent::_initialize();
        $this->serviceCate = new serviceCate;
        $this->logicCate = new logicCate;
    }

    public function index()
    {
        //直接添加子菜单
        $parentId = $this->request->get('parent_id', 0);
        //编辑菜单
        $id = $this->request->get('id', 0);
        $this->assign('id', $id);

        $info = $this->logicCate->getInfo($id);
        $this->assign('info', $info);

        $fields = 'id,name,sort,icon,parent_id,status';
        $order = 'sort desc';
        $map = ['status' => ['in', '0,2'], 'type' => 1];
        $result = $this->logicCate->getList($fields, $map, $order);

        $resultList[0]['parent_id'] = 0;
        foreach ($result as $key => $item) {
            $resultList[$item['id']] = $item;
            if ($item['id'] == $id) {
                unset($result[$key]);
            }
        }

        $cate = $this->serviceCate->getSelectDom($result, ($parentId ? $parentId : $resultList[$id]['parent_id']));
        $this->assign('cate', $cate);

        return $this->fetch();
    }

    public function save()
    {
        if ($this->request->post()) {
            $data['id'] = $this->request->post('id', 0);
            $data['parent_id'] = $this->request->post('parent_id', 0);
            $data['name'] = $this->request->post('name', 0);
            $data['module'] = $this->request->module();
            $data['controller'] = $this->request->controller();
            $data['action'] = $this->request->action();

            $checkResult = $this->serviceCate->check($data);
            if ($checkResult) {
                return json(['code' => 1, 'msg' => $checkResult, 'data' => []]);
            }

            $this->logicCate->save($data);
            return json(['code' => 0, 'msg' => '操作成功', 'data' => []]);
        }
        return json(['code' => 1, 'msg' => '请求错误', 'data' => []]);
    }

    public function status()
    {
        if ($this->request->post()) {
            $data['id'] = $this->request->post('id', 0);
            $data['status'] = $this->request->post('status', 0);
            $this->logicCate->save($data);
            return json(['code' => 0, 'msg' => '操作成功', 'data' => []]);
        }
        return json(['code' => 1, 'msg' => '请求错误', 'data' => []]);

    }
}