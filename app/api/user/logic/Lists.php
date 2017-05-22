<?php
namespace app\api\user\logic;

use think\Db;
use app\api\user\model\User as userModel;
use app\api\user\model\Weixin as weixinModel;

/**
 * 后台-会员列表
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/12
 * Time: 17:35
 */
class lists
{
    /**
     * 会员列表
     * author: yanghuan
     * date:2017/3/12 17:38
     * @param $condition 搜索条件
     * @return Array
     */
    public function lists($condition = [])
    {
        $userModel = new userModel();
        $list = $userModel->where($condition)->order('id', 'DESC')->paginate();
        if (!$list->isEmpty()) {
            $page = $list->render();
            return ['list' => $list ? $list->toArray() : '', 'page' => $page];
        }
        return false;

    }

    /**
     * 创建会员
     * @param $data
     * author: yanghuan
     * date:2017/3/12 17:54
     */
    public function add($data)
    {
        $exists = $this->exists($data['user_name']);
        if (empty($exists)) {
            $userModel = new userModel();
            $userModel->allowField(true)->save($data);
            return $userModel->id;
        }
        return -1;
    }

    /**
     * 删除会员
     * @param $id 会员编号
     * author: yanghuan
     * date:2017/3/12 19:37
     */
    public function del($id)
    {
        return userModel::destroy($id);
    }

    /**
     * 查询单条会员数据
     * author: yanghuan
     * date:2017/3/12 19:44
     */
    public function find($id)
    {
        return userModel::get($id);
    }

    /**
     * 编辑会员
     * @param $data
     * author: yanghuan
     * date:2017/3/12 19:56
     */
    public function edit($data)
    {
        $userModel = new userModel();
        return $userModel->allowField(true)->update($data);
    }

    /**
     * 查询会员是否存在
     * @author:yanghuna
     * @datetime:2017/3/28 9:18
     * @param $userName 会员名
     */
    public function exists($userName)
    {
        $userModel = new userModel();
        return $userModel->where('user_name', $userName)->count();
    }

    /**
     * 总记录数
     * @author:yanghuna
     * @datetime:2017/3/28  9:46
     */
    public function count($condition)
    {
        $userModel = new userModel();
        return $userModel->where($condition)->count();
    }

    /**
     * 微信会员列表
     * author: yanghuan
     * date:2017/3/29 19:10
     * @param $condition 搜索条件
     * @return Array
     */
    public function weixin($condition = [])
    {

        $lists = [];
        $weixinModel = new weixinModel();
        $list = $weixinModel->where($condition)->order('id', 'DESC')->paginate();
        if (!$list->isEmpty()) {
            $listArr = $list->toArray();
            foreach ($listArr['data'] as $item) {
                $item['headimgurl'] = substr($item['headimgurl'], 0, -1) . '46';
                $lists[] = $item;
            }
            $page = $list->render();
            return ['list' => $lists ? $lists : '', 'page' => $page];
        }
        return false;
    }
}