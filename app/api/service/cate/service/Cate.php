<?php

namespace app\api\console\cate\service;

use app\api\console\cate\validate\Cate AS validateCate;
use Tree\Tree;

class Cate
{

    /**
     * 基础验证
     * @author:yanghuna
     * @datetime:2017/10/31 21:49
     * @param $data
     * @param $scene 需要验证的场景
     * @return array
     */
    public function check($data, $scene)
    {
        $validateCate = new validateCate;
        if (!$validateCate->scene($scene)->check($data)) {
            return $validateCate->getError();
        }
        return [];
    }

    /**
     * 分类列表树
     * @author:yanghuna
     * @datetime:2017/10/31 21:50
     * @param array $result
     * @return bool|string
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
            $status = $value['status'];
            $value['icon'] = $value['icon'] ? '<i class="fa fa-' . $value['icon'] . '"></i>' : '';
            $value['status'] = $status == 0 ? '<span class="label label-success">显示</span>' : '<span class="label label-danger">禁用</span>';
            $value['manage'] = '<a data-pjax=""  role="button" href="' . Url("/cate/detail", ["parent_id" => $value['id']], false, false) . '" class="btn btn-success" target="_blank"><i class="icon wb-plus" aria-hidden="true"></i> 添加子分类</a> ';
            $value['manage'] .= '<a data-pjax="" role="button" href="' . Url("/cate/detail", ["id" => $value['id']], false, false) . '" class="btn btn-info" target="_blank"><i class="icon wb-pencil" aria-hidden="true"></i> 编辑</a> ';
            $value['manage'] .= '<a role="button" class="btn btn-warning enable" data-status="' . ($status == 0 ? 2 : 0) . '" data-id="' . $value['id'] . '"><i class="icon ' . ($status == 0 ? 'fa-ban' : 'wb-check') . '" aria-hidden="true"></i> ' . ($status == 0 ? '禁用' : '启用') . ' </a> ';
            $value['manage'] .= '<a role="button" class="btn btn-danger delete" data-status="1" data-id="' . $value['id'] . '"><i class="icon wb-close" aria-hidden="true"></i> 删除</a>';
            $list[] = $value;
        }
        $htmlDom = "<tr>
                        <td>
                            <input type='text' name='sort[\$id]' value='\$sort' class='form-control' style='width: 40px'>
                        </td>
                        <td>
                            \$id
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
     * 分类下拉列表
     * @author:yanghuna
     * @datetime:2017/10/31 21:50
     * @param array $result
     * @param int $selectId
     * @return bool|string
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
}