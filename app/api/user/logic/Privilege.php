<?php

namespace app\api\user\logic;

use Tree\Tree;
use think\Db;

/**
 * 后台-权限管理类
 * Class Privilege
 * @package app\api\user\logic
 */
class Privilege
{
    /**
     * 权限列表
     * @author   liuke
     * @datetime 2017-02-06T11:57:10+0800
     * @param    array $result 数据集
     * @return   mixed               表格DOM结构
     */
    public function getTableDom($result = [], $selectCode = 'SYSTEM')
    {
        if (empty($result)) {
            return false;
        }
        $tree = new Tree();
        $tree->icon = ['&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ '];
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $htmlDom = "<tr>
                        <td class='text-center'>
                            <input type='checkbox' name='code[]' value='\$code' class='i-checks'>
                        </td>
                        <td>
                            \$spacer &nbsp;\$name
                        </td>
                    </tr>";
        $tree->init($result);
        return $tree->get_tree(0, $htmlDom);
    }

    /**
     * 保存选择的权限
     * @author:yanghuna
     * @datetime:2017/3/16 14:15
     */
    public function save($data)
    {
        Db::startTrans();
        $map = [];
        foreach ($data['code'] as $key => $item) {
            $map[$key]['role_code'] = $data['role_code'];
            $map[$key]['pri_code'] = $item;
        }

        Db::name('user_privilege')->where('role_code', $data['role_code'])->delete();

        $result = Db::name('user_privilege')->insertAll($map);
        if ($result) {
            Db::commit();
            return $result;
        }
        Db::rollback();
        return false;
    }
}