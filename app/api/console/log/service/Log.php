<?php

namespace app\api\console\log\service;

use app\api\console\log\model\Log AS modelLog;

class Log
{
    public function lists($where = [], $pageSize = 20)
    {
        return modelLog::where($where)->order('id DESC')->paginate($pageSize);
    }

    public function save($data)
    {
        $modelLog = new modelLog;
        return $modelLog->save($data);
    }
}