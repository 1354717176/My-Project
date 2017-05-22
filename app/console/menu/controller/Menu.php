<?php
namespace app\console\menu\controller;

use app\api\common\controller\Base;
use app\api\menu\logic\Menu as menuApi;
use app\api\menu\validate\Menu as menuValidate;
use think\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 9:54
 */
class Menu extends Base
{
    /**
     * 菜单列表
     * @author:yanghuna
     * @datetime:2017/3/9 14:31
     * @return mixed
     */
    public function index()
    {
        $menu = new menuApi();
        $fields = 'id,name,listorder,icon,parent_id,status';
        $map = [
            'status' => ['in', '1,2'],
        ];
        $order = 'listorder desc';
        $result = $menu->getList($fields, $map, $order);

        // 生成树形DOM
        $list = $menu->getTableDom($result);

        // 模板赋值
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 创建菜单
     * @author:yanghuna
     * @datetime:2017/3/9 14:31
     */
    public function create()
    {

        $request = Request::instance();
        $parentId = $request->get('parentid', 0, 'trim');

        // 获取数据
        $menu = new menuApi();
        $fields = 'id,name,listorder,parent_id,status';
        $map = [
            'status' => ['in', '1,2'],
        ];
        $order = 'listorder desc';
        $result = $menu->getList($fields, $map, $order);

        //获取一级菜单
        $parentMenu = $menu->getParentMenu();
        $this->assign('parentMenu', json_encode($parentMenu));

        //一级菜单显示图标选择
        foreach ($parentMenu as $item) {
            $id[] = $item['id'];
        }
        if (in_array($parentId, $id)) {
            $this->assign('showIcon', 1);
        }

        // 生成树形DOM
        $categorys = $menu->getSelectDom($result, $parentId);

        // 模板赋值
        $this->assign('categorys', $categorys);
        return $this->fetch();
    }

    /**
     * 保存创建菜单
     * @author   yanghuan
     * @datetime 2017/3/9 18:46
     */
    public function save()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $info['parent_id'] = $request->post('parent', 0, 'intval');
            $info['name'] = $request->post('name', '', 'trim');
            $info['module'] = $request->post('module', '', 'trim');
            $info['controller'] = $request->post('controller', '', 'trim');
            $info['action'] = $request->post('action', '', 'trim');
            $info['parameter'] = $request->post('parameter', '', 'trim');
            $info['remark'] = $request->post('remark', '', 'trim');
            $info['status'] = $request->post('status', '', 'trim');
            $info['icon'] = $request->post('icon', '', 'trim');

            // 数据校验
            $menu = new menuValidate();
            if (!$menu->scene('save')->check($info)) {
                $result = ['code' => 500000, 'msg' => $menu->getError(), 'data' => ''];
                return json($result);
            }

            // 保存数据
            $menu = new menuApi();
            $result = $menu->insertInfo($info);
            if (!$result) {
                return json(['code' => 500000, 'msg' => '数据提交出错，请重试', 'data' => '']);
            }
            return json(['code' => 0, 'msg' => '菜单创建成功', 'data' => '']);
        }

        return json(['code' => 500000, 'msg' => '提交方法错误', 'data' => '']);
    }


    /**
     * 编辑
     * @author   yanghuan
     * @datetime 2017/3/9 20:25
     */
    public function edit()
    {
        $request = Request::instance();
        $id = $request->param('id', 0, 'intval');

        // 获取下拉数据
        $menu = new menuApi();
        $fields = 'id,name,listorder,parent_id,status';
        $map = [
            'status' => ['in', '1,2'],
        ];
        $order = 'listorder desc';
        $result = $menu->getList($fields, $map, $order);
        foreach ($result as $item) {
            $resultList[$item['id']] = $item;
        }

        // 生成树形DOM
        $categorys = $menu->getSelectDom($result, $resultList[$id]['parent_id']);


        // 获取表单数据
        $map = [
            'id' => $id,
            'status' => ['in', '1,2'],
        ];
        $info = $menu->getInfo($map);

        // 模板赋值
        $this->assign('categorys', $categorys);
        $this->assign('info', $info);

        //获取一级菜单
        $parentMenu = $menu->getParentMenu();
        $this->assign('parentMenu', json_encode($parentMenu));

        return $this->fetch();
    }

    /**
     * 更新数据
     * @author   yanghuan
     * @datetime 2017/3/9 20:34
     */
    public function update()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $info['id'] = $request->param('id', 0, 'intval');
            $info['parent_id'] = $request->post('parent_id', 0, 'intval');
            $info['name'] = $request->post('name', '', 'trim');
            $info['module'] = $request->post('module', '', 'trim');
            $info['controller'] = $request->post('controller', '', 'trim');
            $info['action'] = $request->post('action', '', 'trim');
            $info['parameter'] = $request->post('parameter', '', 'trim');
            $info['remark'] = $request->post('remark', '', 'trim');
            $info['status'] = $request->post('status', '', 'trim');
            $info['icon'] = $request->post('icon', '', 'trim');

            // 数据校验
            $menu = new menuValidate();
            if (!$menu->scene('update')->check($info)) {
                $result = ['code' => 500000, 'msg' => $menu->getError(), 'data' => ''];
                return json($result);
            }

            // 保存数据
            $menu = new menuApi();
            $map = [
                'id' => $info['id'],
            ];
            unset($info['id']);
            $result = $menu->updateInfo($info, $map);
            if (!$result) {
                return json(['code' => 500001, 'msg' => '数据提交出错，请重试', 'data' => '']);
            }
            return json(['code' => 0, 'msg' => '菜单编辑成功', 'data' => '']);
        }
    }

    /**
     * 删除
     * @author   yanghuan
     * @datetime 2017/3/9 2017/3/9
     */
    public function delete()
    {
        $request = Request::instance();
        $id = $request->param('id', 0, 'intval');

        $menu = new menuApi();
        $result = $menu->deleteInfo($id);

        if ($result['code']) {
            return json(['code' => $result['code'], 'msg' => $result['msg'], 'data' => '']);
        }
        return json(['code' => 0, 'msg' => $result['msg'], 'data' => '']);
    }
}