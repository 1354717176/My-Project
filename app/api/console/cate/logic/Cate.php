<?php
namespace app\api\console\cate\logic;

use think\Db;
use Tree\Tree;
use think\Url;
use app\api\console\cate\model\Cate AS modelCate;

/**
 * 分类管理
 * Class Cate
 * @package app\api\console\cate\logic
 */
class Cate
{
    public $cate;
    public function __construct()
    {
        $this->cate = new modelCate;
    }

    /**
     * 获取列表
     * @author   yanghuan
     * @datetime 2017/3/9 9:53
     * @param    array $fields 字段
     * @param    array $map 筛选条件
     * @param    integer $page 页码
     * @param    integer $pageSize 每页数量
     * @param    array $order 排序条件
     * @return   array                列表
     */
    public function getList($fields = [], $map = [], $order = 'id asc')
    {
        return Db::name('menu')->field($fields)->where($map)->order($order)->select();
    }

    /**
     * 获取表格
     * @author   liuke
     * @datetime 2017-02-06T11:57:10+0800
     * @param    array $result 数据集
     * @return   mixed               表格DOM结构
     */
    public function getTableDom($result = [])
    {
        if (empty($result)) {
            return false;
        }
        $tree = new Tree();
        $tree->icon = ['&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ '];
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $list = [];
        foreach ($result as $value) {
            $value['icon'] = $value['icon'] ? '<i class="fa fa-' . $value['icon'] . '"></i>' : '';
            $value['status'] = $value['status'] == 1 ? '<span class="label label-primary">显示</span>' : '<span class="label">不显示</span>';
            $value['manage'] = '
                <a href="' . Url('/menu/menu/create', ['parentid' => $value['id']], false, true) . '" class="btn btn-primary btn-xs btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="添加子菜单">
                    <i class="fa fa-sort-amount-asc"></i>
                </a>
                <a href="' . Url('/menu/menu/edit', ['id' => $value['id']], false, true) . '" class="btn btn-primary btn-xs btn-circle" type="button" data-toggle="tooltip" data-placement="top" title="编辑">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="javascript:;" data-id="' . $value['id'] . '" class="btn btn-warning btn-xs btn-circle delete" type="button" data-toggle="tooltip" data-placement="top" title="删除">
                    <i class="fa fa-trash-o"></i>
                </a>';
            $list[] = $value;
        }
        $htmlDom = "<tr>
                        <td>
                            \$id
                        </td>
                        <td>
                            <input type='text' name='listorders[\$id]' value='\$listorder' class='form-control input-sm text-center'>
                        </td>
                        <td>
                            \$spacer \$icon&nbsp;\$name
                        </td>
                        <td>\$status</td>
                        <td>\$manage</td>
                    </tr>";
        $tree->init($list);
        return $tree->get_tree(0, $htmlDom);
    }

    /**
     * 获取树形结构数组
     * @author   yanghuan
     * @datetime 2017/3/9 10:14
     * @param    array &$data 数据
     * @param    integer $pid 父级ID
     * @param    integer $level 层级
     * @return   array               树形数组
     */
    public static function getTree(&$data, $pid = 0, $level = 1)
    {

        $treeList = $items = [];
        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $v['url'] = Url::build($v['module'] . '/' . $v['controller'] . '/' . $v['action'], $v['parameter'], false, true);
                unset($v['module'], $v['controller'], $v['action'], $v['parameter']);
                //unset($data[$k]);
                $items = self::getTree($data, $v['id'], $level + 1);

                // 后台菜单只支持三层，超出的层级不显示
                $items && $level < 3 && $v['items'] = $items;
                $treeList['menu_' . $v['id']] = $v;
            }
        }
        return $treeList;
    }

    /**
     * 获取下拉项DOM结构
     * @author   yanghuan
     * @datetime 2017/3/9 14:33
     * @param    array $result 数据集
     * @param    integer $selectId 选中项
     * @return   mixed                 下拉DOM结构
     */
    public function getSelectDom($result = [], $selectId = 0)
    {
        if (empty($result)) {
            return false;
        }

        // 生成树结构
        $tree = new Tree();
        $tree->icon = ['&nbsp;│', '&nbsp;├─', '&nbsp;└─'];
        $tree->nbsp = '&nbsp;&nbsp;';
        $list = [];
        foreach ($result as $value) {
            $value['selected'] = $value['id'] == $selectId ? ' selected' : '';
            $list[] = $value;
        }

        $htmlDom = "<option value='\$id'\$selected>\$spacer \$name</option>";
        $tree->init($list);
        return $tree->get_tree(0, $htmlDom);
    }

    /**
     * 创建/编辑分类
     * @author   yanghuan
     * @datetime 2017/10/28 15:55
     * @param    array $info 信息
     * @return   bool                保存状态
     */
    public function save($info = [])
    {
        return $this->cate->save($info);
    }

    /**
     * 获取信息
     * @author   yanghuan
     * @datetime 2017/3/9 20:28
     * @param    integer $map 查询条件
     * @return   array               信息
     */
    public function getInfo($map = [])
    {
        return Db::name('menu')->where($map)->find();
    }

    /**
     * 获取一级分类编号
     * @author:yanghuna
     * @datetime:2017/3/9 20:29
     */
    public function getParentMenu()
    {
        $result = Db::name('menu')->field('id')->where('parent_id', 0)->select();
        return $result;
    }

    /**
     * 更新数据
     * @author   yanghuan
     * @datetime 2017/3/9 20:35
     * @param    array $info 数据
     * @param    array $map 条件
     * @param    integer $uid UID
     * @return   integer             更新条数
     */
    public function updateInfo($info = [], $map = [])
    {
        // 补全数据
        $info['update_time'] = date('Y-m-d H:i:s');
        $info['code'] = strtoupper($info['module'] . ($info['controller'] ? '_' . $info['controller'] : '') . ($info['action'] ? '_' . $info['action'] : ''));

        // 保存菜单信息
        return Db::name('Menu')->where($map)->update($info);
    }

    /**
     * 删除信息
     * @author   yanghuan
     * @datetime 2017/3/9 20:46
     * @param    integer $id 删除ID
     */
    public function deleteInfo($id = 0)
    {
        // 判断下层是否有子集
        $map = [
            'parent_id' => $id,
            'status' => ['gt', 0],
        ];
        $count = Db::name('menu')->where($map)->count();
        if ($count) {
            return ['msg' => '该菜单下还有子菜单，无法删除！', 'code' => 500000];
        }

        // 更新数据
        $map = [
            'id' => $id,
            'status' => ['gt', 0],
        ];
        $data = [
            'update_time' => date('Y-m-d H:i:s'),
            'status' => 0,
        ];
        $updateStatus = Db::name('menu')->where($map)->update($data);
        if (!$updateStatus) {
            return ['msg' => '数据提交出错，请重试', 'code' => 500001];
        }
        return ['msg' => '', 'code' => 0];
    }
}