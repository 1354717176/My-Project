<?php

namespace app\console\member\controller;

use app\api\common\logic\Base;
use app\api\console\member\logic\Member AS logicMember;

/**
 * 会员(管理员 置业顾问 客户)类
 * Class Member
 * @package app\console\member\controller
 */
class Lists extends Base
{

    public $logicMember;

    public function _initialize()
    {
        parent::_initialize();
        $this->logicMember = new logicMember;
    }

    public function index()
    {
        $groupId = $this->request->get('group_id', 4);
        $result = $this->logicMember->lists(['group_id' => $groupId,'status'=>['IN',($groupId==4 ? 0 : '1,2')]]);
        $this->assign('lists', $result['lists']);
        $this->assign('page', $result['page']);

        $fetch = $groupId == 4 ? '' : $this->request->action() . $groupId;
        return $this->fetch($fetch);
    }

}