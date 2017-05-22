<?php
namespace app\api\student\model;

use think\Model;

/**
 * 学生-模型类
 * Class Enroll
 * @package app\api\student\model
 * @author yanghuan
 * @date 2017/3/28 10:42
 */
class Enroll extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $table = 'fm_student';

    public function getStuSexAttr($value, $data)
    {
        $status = [0 => '帅哥', 1 => '美女'];
        return $status[$data['stu_sex']];
    }

    public function getStuXueliAttr($value, $data)
    {
        $status = [0 => '本科', 1 => '大专', 2 => '中专', 3 => '高中', 4 => '初中', 5 => '初中以下', 6 => '社会人士'];
        return $status[$data['stu_xueli']];
    }

    public function getStuZhuanyeAttr($value, $data)
    {
        $status = [0 => '普通话技能班', 1 => '办公技能班', 2 => 'UI设计师就业班', 3 => 'JAVA软件工程师就业班', 4 => 'Web前端工程师就业班', 5 => 'PHP软件工程师就业班', 6 => 'Android软件工程师就业班', 7 => '大数据工程师就业班', 8 => '营销推广电商就业班',9=>'教师资格证'];
        return $status[$data['stu_zhuanye']];
    }
}