<?php

namespace app\console\log\controller;

use app\api\common\logic\Base;
use app\api\console\log\logic\Log AS logicLog;

/**
 * 系统日志类
 * Class Lists
 * @package app\console\log\controller
 */
class Lists extends Base
{

    public $logicLog;

    public function _initialize()
    {
        parent::_initialize();
        $this->logicLog = new logicLog;
    }

    public function index()
    {
        $result = $this->logicLog->lists();
        $this->assign('lists', $result['lists']);
        $this->assign('page', $result['page']);
        return $this->fetch();
    }

}