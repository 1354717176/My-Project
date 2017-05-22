<?php
namespace app\api\user\logic;

use think\Db;


/**
 * 后台-角色管理类
 * Class Role
 * @package app\api\user\logic
 */
class Role
{
    /**
     * 角色列表
     * @author:yanghuna
     * @datetime:2017/3/13 15:19
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function lists()
    {
        $pri = Db::name('role')->select();
        return $pri;
    }

    /**
     * 为角色添加会员
     * @author:yanghuna
     * @datetime:2017/3/13 15:20
     */
    public function add($data)
    {
        $pri = Db::name('user_role')->insertAll($data);
        return $pri;
    }

    /**
     * 查询角色，单条信息
     * @author:yanghuna
     * @datetime:2017/3/13 15:33
     * @param roleId 角色编号
     */
    public function queryRole($roleId)
    {
        $role = Db::name('role')->where('role_id', $roleId)->find();
        return $role;
    }

    /**
     * 查询角色具有的用户
     * @author:yanghuna
     * @datetime:2017/3/14 14:14
     */
    public function look($roleCode)
    {
        $userInfo = [];
        $userId = Db::name('user_role')->field('ur_id,user_id')->where('role_code', $roleCode)->where('status', 0)->select();
        if ($userId) {
            foreach ($userId as $key => $ur) {
                $userInfo[$key]['ur_id'] = $ur['ur_id'];
                $userInfo[$key]['user_id'] = $ur['user_id'];

                $user = Db::name('user')->field('user_name')->where('id', $ur['user_id'])->find();
                $userInfo[$key]['user_name'] = $user['user_name'];
            }
        }
        return ['list' => $userInfo];
    }

    /**
     * 删除角色具有的用户
     * @author:yanghuna
     * @datetime:2017/3/14 14:33
     */
    public function del($urId)
    {
        return Db::name('user_role')->where('ur_id', $urId)->setField('status', 1);
    }

    /**
     * 查询角色权限
     * @author:yanghuna
     * @datetime:2017/3/16 15:13
     * @param $roleCode 角色编码
     */
    public function queryRolePrivilege($roleCode)
    {
        $result = Db::name('user_privilege')->where('role_code', $roleCode)->select();
        return $result ? $result : false;
    }

    /**
     * 添加角色
     * @author yanghuan
     * @datetime 2017/3/18 19:55
     */
    public function addRole($data)
    {
        $count = $this->queryRoleExist($data['role_code'], $data['role_name']);
        return $count ? -1 : Db::name('role')->insertGetId($data);
    }

    /**
     * 根据角色名称或者角色编码查询角色是否存在
     * @author yanghuan
     * @datetime 2017/3/18 20:40
     * @param $roleCode 角色编码
     * @param $roleName 角色名称
     */
    public function queryRoleExist($roleCode, $roleName)
    {
        return Db::name('role')->where('role_code', $roleCode)->whereOr('role_name', $roleName)->count();
    }

    /**
     * 编辑角色
     * @author yanghuan
     * @datetime 2017/3/18 21:09
     */
    public function editRoleSave($data)
    {
        $roleCode = $roleName = '';

        //解决当未改变角色名称或角色编码就点击提交按钮，与数据库已存在的角色名或角色编码 出现的冲突
        if ($data['old_role_code'] == $data['role_code']) {
            unset($data['old_role_code'], $data['role_code']);
        } else {
            unset($data['old_role_code']);
            $roleCode = $data['role_code'];
        }

        if ($data['old_role_name'] == $data['role_name']) {
            unset($data['old_role_name'], $data['role_name']);
        } else {
            unset($data['old_role_name']);
            $roleName = $data['role_name'];
        }

        //角色编码和角色名称都不存在时，程序到此为止
        if (!isset($data['role_code']) && !isset($data['role_name'])) {
            return -2;
        }

        $count = $this->queryRoleExist($roleCode, $roleName);
        if (!$count) {

            //删除数组里面的角色编号
            $roleId = $data['role_id'];
            unset($data['role_id']);

            return Db::name('role')->where('role_id', $roleId)->update($data);
        }
        return -1;
    }

    /**
     * 删除角色，此操作会删除角色下的会员，不会删除真实会员
     * @author yanghuan
     * @datetime 2017/3/18 21:41
     * @param $roleId 角色编号
     */
    public function delRole($roleId)
    {
        Db::startTrans();

        //查询角色编码
        $roleInfo = $this->queryRole($roleId);
        $role_code = $roleInfo['role_code'];

        //删除角色会员表里面的会员
        Db::name('user_role')->where('role_code', $role_code)->delete();

        //删除角色
        $result = Db::name('role')->where('role_id', $roleId)->delete();
        if ($result) {
            Db::commit();
            return $result;
        } else {
            Db::rollback();
            return false;
        }
    }
}