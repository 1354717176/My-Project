<?php
namespace app\api\user\model;

use think\Model;

/**
 * 微信会员类
 * Class Weixin
 * @package app\api\user\model
 */
class Weixin extends Model
{
    protected $table = 'fm_wx_user';
    protected $autoWriteTimestamp = 'datetime';

    public function getSexAttr($value, $data)
    {
        $status = [1 => '男', 2 => '女'];
        return $status[$data['sex']];
    }
}