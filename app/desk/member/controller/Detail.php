<?php

namespace app\desk\member\controller;

use think\Controller;
use app\api\console\member\logic\Member AS logicMember;
use think\Db;
use think\Exception;

class Detail extends Controller
{
    public function index()
    {
        if ($this->request->isPost()) {
            $data['group_id']=5;
            $data['true_name'] = $data['user_name'] = $this->request->post('true_name','');
            $data['mobile'] = $this->request->post('mobile','');
            $data['age'] = $this->request->post('age/d',0);
            $data['areaid'] = $this->request->post('areaid/d',0);
            $data['channels'] = $this->request->post('channels/d',0);
            $data['adviser_id'] = $this->request->post('adviser_id/d',0);
            $data['room_num'] = $this->request->post('roomNum/d',0);
            $data['house'] = $this->request->post('house/d',0);
            $data['note'] = $this->request->post('note','');

            $logicMember =new logicMember;

            try{
                $logicMember->save($data);
                Db::commit();
                return json(['code' => 0, 'msg' => '提交信息成功', 'data' => []]);
            }catch (Exception $e){
                Db::rollback();
                return json(['code' => 1, 'msg' => $e->getMessage(), 'data' => []]);
            }
        }
        return json(['code' => 1, 'msg' => '提交失败', 'data' => []]);
    }
}