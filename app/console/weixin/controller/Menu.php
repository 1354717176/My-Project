<?php
namespace app\console\weixin\controller;

use app\api\common\controller\Base;
use think\Request;

/**
 * 后台-会员列表
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/12
 * Time: 17:26
 */
class Menu extends Base
{

    public function index()
    {
        return $this->fetch();
    }

    /**
     * 保存微信菜单
     * @author yanghuan
     * @datetime 2017/4/3 8:57
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $menu = $firstMenu = [];
            $flag = false;
            $parentMenu = $this->request->post('parent_menu/a');
            $childMenu = $this->request->post('child_menu/a');
            foreach ($parentMenu as $k => $v) {
                if ($v) {
                    if (isset($childMenu[$k])) {
                        foreach ($childMenu[$k] as $m => $n) {
                            if ($n) {
                                $m ?: $firstMenu['button'][$k]['name'] = $v;
                                $firstMenu['button'][$k]['sub_button'][$m]['type'] = 'click';
                                $firstMenu['button'][$k]['sub_button'][$m]['key'] = '';
                                $firstMenu['button'][$k]['sub_button'][$m]['name'] = $n;
                            } else {
                                $flag = true;
                                break;
                            }
                        }
                        if ($flag) {
                            break;
                        }
                    } else {
                        //一级菜单
                        $firstMenu['button'][$k]['type'] = 'click';
                        $firstMenu['button'][$k]['key'] = '';
                        $firstMenu['button'][$k]['name'] = $v;
                    }
                    $menu = $firstMenu;
                } else {
                    $flag = true;
                    break;
                }
            }
            return json($flag ? ['code' => 50001, 'msg' => '微信菜单为必填项'] : ['code' => 0, 'msg' => '保存成功', 'data' => $menu]);
        } else {
            return json(['code' => 50000, 'msg' => '请求类型不正确']);
        }
    }
}