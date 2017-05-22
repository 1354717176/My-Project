<?php
namespace app\console\team\controller;
use app\api\common\controller\Base;
use app\api\team\logic\Team as teamAPI;
use think\Request;
/**
 * @desc 后台招生团队管理
 * @author Administrator
 *
 */
class Team extends Base{
    /**
     * @desc 加载首页列表
     * @return 返回招生团队首页视图
     */
    public function index(){
        $team = new teamAPI();
        $teams = $team -> index();
        $this -> assign('teams',$teams);
        return $this -> fetch();
    }
    
    /**
     * @desc 加载添加视图
     * @return 返回招生团队视图
     */
    public function add(){
        return $this -> fetch();
    }
    
    /**
     * @desc 写入表单数据至数据库
     * @return 写入成功或失败
     */
    public function save(){
        $request = Request::instance();
        if ($request -> isPost()) {
            $data['t_name'] = $request -> post('t_name','','trim');
            $data['t_sex'] = $request -> post('t_sex','','trim');
            $data['t_age'] = $request -> post('t_age','','trim');
            $data['t_zhuanye'] = $request -> post('t_zhuanye','','trim');
            $data['t_xueli'] = $request -> post('t_xueli','','trim');
            $data['t_phone'] = $request -> post('t_phone','','trim');
            $data['t_qq'] = $request -> post('t_qq','','trim');
            $data['t_address'] = $request -> post('t_address','','trim');
            $data['t_school'] = $request -> post('t_school','','trim');
            $data['t_is_biye'] = $request -> post('t_is_biye','','trim');
            $data['t_id_card'] = $request -> post('t_id_card','','trim');
            $data['t_now_address'] = $request -> post('t_now_address','','trim');
            
            $pri = new teamAPI();
            $team = $pri -> save($data);
            if ($team) {
                return json(['code' => 0,'msg' => '添加招生团队成功']);
            }else {
                return json(['code' => 0,'msg' => '添加招生团队失败']);
            }
        }
    }
}