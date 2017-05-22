<?php
namespace app\api\student\logic;

use app\api\student\model\Enroll as enrollModel;

/**
 * 学生报名类
 * Class Enroll
 * @package app\api\student\logic
 * @author yanghuan
 * @date 2017/3/28 11:28
 */
class Enroll
{
    /**
     * 学生列表
     * @author:yanghuna
     * @datetime:2017/3/28 11:09
     * @param array $condition 搜索条件
     * @return array
     */
    public function lists($condition = [])
    {
        $enrollModel = new enrollModel();
        $list = $enrollModel->where($condition)->order('stu_id','DESC')->paginate();
        $page = $list->render();
        return ['list' => $list ? $list->toArray() : '', 'page' => $page];
    }

    /**
     * 保存学生报名的信息
     * @author:yanghuna
     * @datetime:2017/3/28 11:02
     * @param $data
     * @return int|string
     */
    public function save($data)
    {
        $enrollModel = new enrollModel();
        $enrollModel->allowField(true)->save($data);
        return $enrollModel->stu_id;
    }
    
    /**
    *@desc 查询单条学员信息
    *@datetime:2017年4月3日下午8:04:11
    *@author:fupingdu
    *@variable
    *@return
    */
    public function find($id){
        return enrollModel::get($id);
    }
    
    /**
    *@desc 根据学员ID删除单个学员
    *@datetime:2017年4月3日下午10:44:35
    *@author:fupingdu
    *@variable
    *@return
    */
    public function del($id){
        return enrollModel::destroy($id);
    }
}