<?php
namespace app\business\store\controller;

use app\api\common\controller\Base;
/**
 * 测试权限是否验证成功类
 * @author yanghuan
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/23
 * Time: 20:00
 */
class Store extends Base
{

    public function index()
    {
        return $this->fetch();
    }
}