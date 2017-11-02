<?php

namespace app\api\console\Log\logic;

use app\api\console\Log\service\Log AS serviceLog;
use think\Exception;
use think\Request;

class Log
{
    public $serviceLog;

    public function __construct()
    {
        $this->serviceLog = new serviceLog;
    }

    public function lists($where = [])
    {
        $lists = $this->serviceLog->lists($where);
        $page = $lists->render();
        return ['lists' => $lists, 'page' => $page];
    }

    public function save($message = '', $userName = '', $userId = 0)
    {
        $data['message'] = $message;
        $data['url'] = Request::instance()->url();
        $data['user_name'] = $userName ? $userName : session('user.user_name');
        $data['user_id'] = $userId ? $userId : session('user.user_id');

        $result = $this->serviceLog->save($data);
        if (!$result) {
            throw new Exception('日志写入失败');
        }

        return [];
    }
}