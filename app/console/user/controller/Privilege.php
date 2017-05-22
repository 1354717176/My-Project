<?php

namespace app\console\user\controller;

use app\api\common\controller\Base;
use app\api\menu\logic\Menu as menuApi;
use app\api\user\logic\Privilege as privilegeApi;
use app\api\user\logic\Role as roleApi;
use think\Request;

/**
 * 后台-会员-角色权限类
 * Class Privilege
 * @package app\console\user\controller
 */
class Privilege extends Base
{

    /**
     * 权限列表
     * @author:yanghuna
     * @datetime:2017/3/14 15:27
     */
    public function lists()
    {
        $request = Request::instance();
        $roleId = $request->get('roleid');
        if (!$roleId) {
            return ['code' => 50001, 'msg' => '缺少参数'];
        }

        $role = new roleApi();
        $roleInfo = $role->queryRole($roleId);
        $this->assign('rolecode', $roleInfo['role_code']);

        //查询角色已有权限
        $rolePrivilege = $role->queryRolePrivilege($roleInfo['role_code']);
        $this->assign('roleprivilege', $rolePrivilege ? json_encode($rolePrivilege) : 0);

        $menu = new menuApi();
        $fields = 'id,code,name,listorder,icon,parent_id,status';
        $map = [
            'status' => ['in', '1,2'],
        ];
        $order = 'listorder desc';
        $result = $menu->getList($fields, $map, $order);

        // 生成树形DOM
        $pri = new privilegeApi();
        $list = $pri->getTableDom($result);
        $this->assign('list', $list);

        return $this->fetch();
    }

    /**
     * 保存选择的权限
     * @author:yanghuna
     * @datetime:2017/3/16 14:05
     */
    public function save()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $data['code'] = $request->post('code/a'); //权限编码
            $data['role_code'] = $request->post('role_code'); //角色编码

            if ($data['code'] && $data['role_code']) {
                $pri = new privilegeApi();
                $result = $pri->save($data);
                return json($result ? ['code' => 0, 'msg' => '添加成功'] : ['code' => 50003, 'msg' => '添加失败']);
            }
            return json(['code' => 50002, 'msg' => '缺少参数']);
        }
        return json(['code' => 50000, 'msg' => '请求类型错误']);
    }
}