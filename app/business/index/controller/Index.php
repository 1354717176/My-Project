<?php
namespace app\business\index\controller;

use app\api\common\controller\Base;
use app\api\menu\logic\Menu as menuApi;

/**
 * 商户中心首页类
 * Class Index
 * @package app\console\index\controller
 */
class Index extends Base
{
    /**
     * 商户中心首页
     * @author:yanghuna
     * @datetime:2017/3/22 20:30
     * @return mixed
     */
    public function index()
    {
        $auth = $this->auth;

        $menu = new menuApi();

        $fields = 'id,name,listorder,icon,parent_id,status,module,controller,action,parameter';

        //菜单搜索条件
        $map['status'] = ['in', '1,2'];
        $auth ? $map['code'] = ['in', implode(',', $auth)] : '';

        $order = 'listorder desc';
        $result = $menu->getList($fields, $map, $order);

        // 生成树形DOM
        $tree = $menu->getTree($result);
        $menuTree = json_encode($tree);

        // 模板赋值
        $this->assign('result', $result);
        $this->assign('menu', $menuTree);
        return $this->fetch();
    }

    public function main()
    {
        return $this->fetch();
    }
}
