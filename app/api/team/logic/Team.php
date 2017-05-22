<?php
namespace app\api\team\logic;
use think\Db;

/**
 * @desc 后台招生团队管理
 * @author Administrator
 *
 */
class Team{
    
    /**
     * @desc 招生团队管理列表首页
     */
    public function index(){
        $team = Db::name('team') -> select();
        return $team;
    }
    
    /**
     * @desc 创建一个招生团队
     * @param unknown $data 数据对象
     * @return 
     */
    public function save($data){
        $team = Db::name('team') -> insertGetId($data);
        return $team;
    }
}