<?php
namespace app\console\index\controller;

use app\api\common\controller\Base;
use app\api\menu\logic\Menu as menuApi;

/**
 * 后台首页类
 * Class Index
 * @package app\console\index\controller
 */
class Index extends Base
{
    /**
     * 后台首页
     * @author:yanghuna
     * @datetime:2017/3/8 14:36
     * @return mixed
     */
    public function index()
    {
        /*$menu = new menuApi();
        $fields = 'id,name,listorder,icon,parent_id,status,module,controller,action,parameter';
        $map = [
            'status' => ['in', '1,2'],
        ];
        $order = 'listorder desc';
        $result = $menu->getList($fields, $map, $order);

        // 生成树形DOM
        $tree = $menu->getTree($result);
        $menuTree = json_encode($tree);

        // 模板赋值
        $this->assign('result', $result);
        $this->assign('menu', $menuTree);*/
        dump(1);
        exit;
        $this->assign('menu', '');
        return $this->fetch();
    }

    public function main()
    {
        return $this->fetch();
    }
}
