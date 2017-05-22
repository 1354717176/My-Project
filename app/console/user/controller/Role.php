<?php
namespace app\console\user\controller;

use app\api\common\controller\Base;
use app\api\user\logic\Role as roleApi;
use app\api\user\validate\Role as roleValidate;
use app\api\user\logic\Lists as userList;
use think\Request;

/**
 * 后台-会员-角色权限类
 * Class Privilege
 * @package app\console\user\controller
 */
class Role extends Base
{
    /**
     * 角色列表
     * @author:yanghuna
     * @datetime:2017/3/13 15:01
     */
    public function lists()
    {
        $pri = new roleApi();
        $role = $pri->lists();
        $this->assign('role', $role);
        return $this->fetch();
    }

    /**
     * 为角色添加会员
     * @author:yanghuna
     * @datetime:2017/3/13 15:16
     */
    public function add()
    {
        $request = Request::instance();
        $roleId = $request->get('roleid');
        if ($roleId) {
            $pri = new roleApi();
            $role = $pri->queryRole($roleId);
            $this->assign('role', $role);
            return $this->fetch();
        }
        return json(['code' => 500001, 'msg' => '缺少roleid']);
    }

    /**
     * 会员列表
     * @author:yanghuna
     * @datetime:2017/3/13 19:32
     */
    public function userList()
    {
        $condition['type'] = ['neq', 0];
        $user = new userList();
        $userList = $user->lists($condition);
        return ['data' => $userList['list']['data']];
    }

    /**
     * 保存角色会员数据
     * @author:yanghuna
     * @datetime:2017/3/13 15:29
     */
    public function save()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $data['user_id'] = $request->post('user_id', '', 'trim');
            $data['role_code'] = $request->post('role_code', '', 'trim');

            // 数据校验
            $pri = new roleValidate();
            if (!$pri->scene('save')->check($data)) {
                return json(['code' => 500000, 'msg' => $pri->getError(), 'data' => $data]);
            }

            foreach (explode(',', $data['user_id']) as $key => $item) {
                $userData[$key]['user_id'] = $item;
                $userData[$key]['role_code'] = $data['role_code'];
            }

            $pri = new roleApi();
            $role = $pri->add($userData);
            if ($role) {
                return json(['code' => 0, 'msg' => '添加成功']);
            } else {
                return json(['code' => 500001, 'msg' => '添加失败']);
            }
        }
    }

    /**
     * 查看角色具有的用户
     * @author:yanghuna
     * @datetime:2017/3/14 14:11
     */
    public function look()
    {
        $request = Request::instance();
        $roleId = $request->get('roleid');
        if ($roleId) {
            $pri = new roleApi();
            $role = $pri->queryRole($roleId);

            $user = $pri->look($role['role_code']);
            $this->assign('user', $user);
            return $this->fetch();
        }
        return json(['code' => 500001, 'msg' => '缺少roleid']);
    }

    /**
     * 删除角色具有的用户
     * @author:yanghuna
     * @datetime:2017/3/14 14:37
     */
    public function del()
    {
        $request = Request::instance();
        $urId = $request->get('urid');
        if ($urId) {
            $pri = new roleApi();
            $result = $pri->del($urId);
            return json($result ? ['code' => 0, 'msg' => '删除成功'] : ['code' => 500002, 'msg' => '删除失败']);
        }
        return json(['code' => 500001, 'msg' => '缺少urid']);
    }

    /**
     * 添加角色
     * @author yanghuan
     * @datetime 2017/3/18 19:57
     */
    public function addRole()
    {
        return $this->fetch();
    }

    /**
     * 保存角色
     * @author yanghuan
     * @datetime 2017/3/18 20:13
     */
    public function addRoleSave()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $data['role_name'] = $request->post('role_name', '', 'trim');
            $data['role_code'] = $request->post('role_code', '', 'trim');

            // 数据校验
            $pri = new roleValidate();
            if (!$pri->scene('saveRole')->check($data)) {
                return json(['code' => 500000, 'msg' => $pri->getError(), 'data' => $data]);
            }

            //把角色编码转成大写模式
            $data['role_code'] = strtoupper($data['role_code']);

            $pri = new roleApi();
            $role = $pri->addRole($data);

            if ($role) {
                if ($role == -1) {
                    return json(['code' => 500003, 'msg' => '角色名称或者角色编码已存在']);
                }
                return json(['code' => 0, 'msg' => '添加成功']);
            } else {
                return json(['code' => 500001, 'msg' => '添加失败']);
            }
        }
        return json(['code' => 500002, 'msg' => '请求类型错误']);
    }

    /**
     * 修改角色
     * @author yanghuan
     * @datetime 2017/3/18 21:02
     */
    public function editRole()
    {
        $request = Request::instance();
        if ($request->isGet()) {
            $roleId = $request->get('roleid');
            if ($roleId) {
                $pri = new roleApi();
                $role = $pri->queryRole($roleId);
                $this->assign('role', $role);
                return $this->fetch();
            }
            return json(['code' => 500001, 'msg' => '缺少参数']);
        }
        return json(['code' => 500000, 'msg' => '请求类型错误']);
    }

    /**
     * 保存修改角色的数据
     * @author yanghuan
     * @datetime 2017/3/18 21:04
     * @return mixed
     */
    public function editRoleSave()
    {
        $request = Request::instance();
        if ($request->isPost()) {

            $data['role_id'] = $request->post('role_id');

            $data['old_role_name'] = $request->post('old_role_name', '', 'trim');
            $data['role_name'] = $request->post('role_name', '', 'trim');

            $data['old_role_code'] = $request->post('old_role_code', '', 'trim');
            $data['role_code'] = $request->post('role_code', '', 'trim');

            // 数据校验
            $pri = new roleValidate();
            if (!$pri->scene('editSaveRole')->check($data)) {
                return json(['code' => 500000, 'msg' => $pri->getError(), 'data' => $data]);
            }

            //把角色编码转成大写模式
            $data['role_code'] = strtoupper($data['role_code']);

            $pri = new roleApi();
            $role = $pri->editRoleSave($data);

            if ($role) {
                if ($role == -1) {
                    return json(['code' => 500003, 'msg' => '角色名称或者角色编码已存在']);
                }
                return json(['code' => 0, 'msg' => '修改成功']);
            } else {
                return json(['code' => 500001, 'msg' => '修改失败']);
            }
        }
        return json(['code' => 500000, 'msg' => '请求类型错误']);
    }

    /**
     * 删除角色
     * @author yanghuan
     * @datetime 2017/3/18 21:38
     */
    public function delRole()
    {
        $request = Request::instance();
        if ($request->isGet()) {
            $roleId = $request->get('roleid');
            if ($roleId) {
                $pri = new roleApi();
                $role = $pri->delRole($roleId);
                return json($role ? ['code' => 0, 'msg' => '删除成功'] : ['code' => 500002, 'msg' => '删除失败']);
            }
            return json(['code' => 500001, 'msg' => '缺少参数']);
        }
        return json(['code' => 500000, 'msg' => '请求类型错误']);
    }
}