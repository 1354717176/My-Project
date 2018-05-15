<?php

namespace api\service\cate\service;

class Cate
{

    /**
     * 获取分类列表
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/12 0012 15:22
     * @param $cate modelCate对象
     */
    public function lists($cate, $pageSize)
    {
        $lists = $cate::where(['parent_id' => $cate->getParentId(), 'type' => $cate->getType(), 'status' => 1])->paginate($pageSize);

        $data = [];
        switch ($cate->getType()) {
            case 0:
                //系统菜单需要区分显示位置
                if (!empty($lists)) {
                    foreach ($lists as $item) {
                        if (empty($item['show_place'])) {
                            $data['menu_show'][] = $item;
                        } else {
                            $data['menu_hide'][] = $item;
                        }
                    }
                }
                break;
            default:
                $data = $lists;
                break;
        }
        return $data;
    }

    /**
     * 分类总记录数
     * @version:
     * @author:yanghuan
     * @datetime:2018/5/12 0012 15:32
     * @param int $parentId 父类id
     * @param $type  菜单类型
     * @param $cate modelCate对象
     * @return mixed
     */
    public function count($parentId, $type, $cate)
    {
        return $cate->where(['parent_id' => $parentId, 'type' => $type, 'status' => 1])->count();
    }
}