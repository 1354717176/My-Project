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
        $groupId = $this->request->param('group_id', 4);
        $this->assign('group_id',$groupId);

        $id = $this->request->param('id', 0);
        if ($this->request->isPost()) {
            $data['id'] = $id;
            $data['group_id'] = $groupId;
            $data['team'] = $this->request->post('team',0);
            $data['status'] = $this->request->post('status',1);
            $data['number'] = $this->request->post('number',0);
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

            $fetch = $groupId == 4 ? '' : $this->request->action() . $groupId;
            return $this->fetch($fetch);
        }
    }

    /**
     * 删除会员
     * @author:yanghuna
     * @datetime:2017/11/3 22:10
     * @return \think\response\Json
     */
    public function delete()
    {
        if ($this->request->isPost()) {
            $id = $this->request->post('id', 0);
            $this->logicMember->delete($id,3);
            return json(['code' => 0, 'msg' => '操作成功', 'data' => []]);
        }
    }
}