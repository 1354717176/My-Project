<?php
namespace app\console\student\controller;

use app\api\student\logic\Enroll as enrollAPI;
use app\api\student\validate\Enroll as enrollValidate;
use app\api\common\controller\Base;
use think\Request;

/**
 * 学生报名类
 * Class Enroll
 * @package app\console\student\controller
 * @author yanghuan
 * @date 2017/3/28 11:26
 */
class Enroll extends Base
{
    /**
     * 学生列表
     * @author:yanghuna
     * @datetime:2017/3/28 11:15
     * @return mixed
     */
    public function index()
    {
        $condition = [];
        $enroll = new enrollAPI();
        $enrolls = $enroll->lists($condition);
        $this->assign('enrolls', $enrolls['list']);
        $this->assign('page', $enrolls['page']);
        return $this->fetch();
    }

    /**
     * 添加学生页面
     * @author:yanghuna
     * @datetime:2017/3/28 11:15
     * @return mixed
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 保存学生信息
     * @author:yanghuna
     * @datetime:2017/3/28 11:19
     * @return \think\response\Json
     */
    public function save()
    {

        $request = Request::instance();
        if ($request->isPost()) {
            $data['stu_name'] = $request->post('stu_name', '', 'trim');
            $data['stu_sex'] = $request->post('stu_sex', '', 'trim');
            $data['stu_age'] = $request->post('stu_age', '', 'trim');
            $data['stu_phone'] = $request->post('stu_phone', '', 'trim');
            $data['stu_qq'] = $request->post('stu_qq', '', 'trim');
            $data['stu_xueli'] = $request->post('stu_xueli');
            $data['stu_zhuanye'] = $request->post('stu_zhuanye');

            //检验数据格式
            $enrollValidate = new enrollValidate();
            if (!$enrollValidate->scene('save')->check($data)) {
                return ['code' => 50000, 'msg' => $enrollValidate->getError()];
            }

            $pri = new enrollAPI();
            $enroll = $pri->save($data);
            if ($enroll) {
                return json(['code' => 0, 'msg' => '添加学员成功']);
            } else {
                return json(['code' => 500001, 'msg' => '添加学员失败']);
            }
        }
    }
    
    /**
    *@desc 编辑报名信息
    *@datetime:2017年4月3日下午7:41:59
    *@author:fupingdu
    *@variable
    *@return
    */
    public function edit(){
        
        $request = Request::instance();
        $enroll = new enrollAPI();
        
        if ($request -> isGet()) {
            $id = $request->get('id',0,'trim');
            $enrollInfo = $enroll->find($id);
            $this->assign('enroll',$enrollInfo);
            return $this->fetch();
        }else{
            return ;
        }
    }
    
    /**
    *@desc 根据学员ID号删除单个学员
    *@datetime:2017年4月3日下午11:22:12
    *@author:fupingdu
    *@variable
    *@return
    */
    public function del(){
        $request = Request::instance();
        if ($request->isGet()) {
            $data['stu_id'] = $request->get('stu_id');
            
            $enroll = new enrollValidate();
            if (!$enroll->scene('del')->check($data)) {
                $result = ['code' => 500002, 'msg' => $enroll->getError(), 'data' => $data];
                return json($result);
            }
            
            $enroll = new enrollAPI();
            $stu_id = $enroll->del($data['stu_id']);
            dump($stu_id);
            exit;
            if ($stu_id) {
                return ['code'=>0,'msg'=>'删除成功','data'=>$stu_id];
            }else{
                return ['code'=>500003,'msg'=>'删除失败'];
            }
            
        }
    }
}