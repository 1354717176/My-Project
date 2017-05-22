<?php
namespace app\api\weixin\logic;

use app\api\weixin\model\WxUser as wxUserModel;
use think\Db;

/**
 * Class User 微信会员类
 * @package app\api\weixin\logic
 * @author yanghuan
 * @datetime 2017/3/26 9:41
 */
class WxUser
{
    /**
     * 关注微信公众号时，成为平台会员
     * @param array $data 会员的微信数据
     * @author yanghuan
     * @datetime 2017/3/26 9:42
     * @return mixed
     */
    public function add($data)
    {
        if ($data['subscribe']) {

            $data['subscribe_time'] = date('Y-m-d H:i:s', $data['subscribe_time']);

            //实例化 微信会员模型，并且添加会员
            $wxUserModel = new wxUserModel($data);
            $wxUserModel->allowField(true)->save();
            return $wxUserModel->id;
        }
        return false;
    }

    /**
     * 查询微信会员是否存在
     * @param string $openid 微信会员openid
     * @author yanghuan
     * @datetime 2017/3/26 10:08
     * @return mixed
     */
    public function exist($openid)
    {
        if ($openid) {
            $wxUserModel = new wxUserModel();
            $result = $wxUserModel->field('id')->where('openid', $openid)->find();
            return $result ? $result->id : false;
        }
        return false;
    }

    /**
     * 关注微信公众号时，是否已关注，已关注的就更新信息
     * @param array $data 会员的微信数据
     * @author yanghuan
     * @datetime 2017/3/26 10:25
     * @return mixed
     */
    public function edit($data, $id)
    {
        if ($data['subscribe'] && $id) {
            $data['subscribe_time'] = date('Y-m-d H:i:s', $data['subscribe_time']);
            //实例化 微信会员模型，并且更新会员
            $wxUserModel = new wxUserModel();
            $wxUserModel->allowField(true)->save($data, ['id' => $id]);
            return true;
        }
        return false;
    }
}