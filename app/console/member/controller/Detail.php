<?php

namespace app\console\member\controller;

use app\api\common\logic\Base;
use app\api\console\member\logic\Member AS logicMember;
use think\Exception;

class Detail extends Base
{
    public $logicMember;

    public function _initialize()
    {
        parent::_initialize();
        $this->logicMember = new logicMember;
    }

    public function index()
    {
        $id = $this->request->param('id', 0);
        if ($this->request->isPost()) {
            $data['id'] = $id;
            $data['user_name'] = $this->request->post('user_name');
            $data['pass_word'] = $this->request->post('pass_word');
            $data['confrim_pass_word'] = $this->request->post('confrim_pass_word');
            try {
                $this->logicMember->save($data);
                return json(['code' => 0, 'msg' => '操作成功', 'data' => []]);
            } catch (Exception $e) {
                return json(['code' => 1, 'msg' => $e->getMessage(), 'data' => []]);
            }

        } else {
            $result = $this->logicMember->find($id);
            $this->assign('info', $result);
            return $this->fetch();
        }
    }
}