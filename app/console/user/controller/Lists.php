<?php
namespace app\console\user\controller;

use app\api\common\controller\Base;
use app\api\user\logic\Lists as userList;
use app\api\user\validate\Lists as userValidate;
use think\Request;

/**
 * 后台-会员列表
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/12
 * Time: 17:26
 */
class Lists extends Base
{
    /**
     * 普通/商家 会员列表，默认普通会员
     * @return mixed
     * author: yanghuan
     * date:
     */
    public function index()
    {
        $type = $this->request->get('type', 2);
        $condition['type'] = ['eq', $type];

        $user = new userList();
        $userList = $user->lists($condition);

        $this->assign('userList', $userList['list']['data']);
        $this->assign('page', $userList['page']);

        return $this->fetch();
    }

    /**
     * 添加会员
     * author: yanghuan
     * date:2017/3/12 17:58
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * 保存会员数据
     * author: yanghuan
     * date:2017/3/12 18:12
     */
    public function addSave()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $data['type'] = $request->post('type', '', 'trim');
            $data['user_name'] = $request->post('user_name', '', 'trim');
            $data['passalt'] = self::random(8);
            $data['password'] = $request->post('password', '', 'trim');
            $data['password_confirm'] = $request->post('password_confirm', '', 'trim');

            // 数据校验
            $user = new userValidate();
            if (!$user->scene('save')->check($data)) {
                $result = ['code' => 500000, 'msg' => $user->getError(), 'data' => $data];
                return json($result);
            }

            $data['password'] = md5($data['password'] . $data['passalt']);

            $user = new userList();
            $userId = $user->add($data);
            if ($userId) {
                return $userId == -1 ? ['code' => 500002, 'msg' => '会员名已经存在'] : ['code' => 0, 'msg' => '', 'data' => $userId];
            } else {
                return ['code' => 500001, 'msg' => '添加失败'];
            }
        }
    }


    /**
     * //删除会员
     * @return array|\think\response\Json
     * author: yanghuan
     * date:
     */
    public function del()
    {
        $request = Request::instance();
        if ($request->isGet()) {
            $data['id'] = $request->get('id');

            // 数据校验
            $user = new userValidate();
            if (!$user->scene('del')->check($data)) {
                $result = ['code' => 500002, 'msg' => $user->getError(), 'data' => $data];
                return json($result);
            }

            $user = new userList();
            $userId = $user->del($data['id']);
            if ($userId) {
                return ['code' => 0, 'msg' => '', 'data' => $userId];
            } else {
                return ['code' => 500003, 'msg' => '删除失败'];
            }
        }
    }

    /**
     * 编辑会员
     * author: yanghuan
     * date:2017/3/12 19:43
     */
    public function edit()
    {
        $request = Request::instance();
        $user = new userList();

        if ($request->isGet()) {
            $id = $request->get('id', 0, 'trim');
            $userInfo = $user->find($id);
            $this->assign('user', $userInfo);
            return $this->fetch();
        } else {

            $data['id'] = $request->post('id', '', 'trim');
            $data['type'] = $request->post('type', '', 'trim');
            $data['passalt'] = self::random(8);
            $data['password'] = $request->post('password', '', 'trim');

            if ($data['password']) {
                //密码不为空
                $data['password_confirm'] = $request->post('password_confirm', '', 'trim');

                // 数据校验
                $user = new userValidate();
                if (!$user->scene('edit')->check($data)) {
                    $result = ['code' => 500000, 'msg' => $user->getError(), 'data' => $data];
                    return json($result);
                }

                unset($data['password_confirm']);
                $data['password'] = md5($data['password'] . $data['passalt']);
            } else {

                //密码为空
                unset($data['password']);

                // 数据校验
                $user = new userValidate();
                if (!$user->scene('editNotPassword')->check($data)) {
                    $result = ['code' => 500000, 'msg' => $user->getError(), 'data' => $data];
                    return json($result);
                }

            }

            $user = new userList();
            $userId = $user->edit($data);
            if ($userId) {
                return ['code' => 0, 'msg' => '', 'data' => $userId];
            } else {
                return ['code' => 500001, 'msg' => '修改失败或没有变化'];
            }
        }
    }

    /**
     * 微信会员
     * author: yanghuan
     * date:2017/3/29 19:06
     */
    public function weixin()
    {
        $condition = [];
        $user = new userList();
        $userList = $user->weixin($condition);
        $this->assign('userList', $userList['list']);
        $this->assign('page', $userList['page']);

        return $this->fetch();
    }

}