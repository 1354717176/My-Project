<?php

namespace app\console\login\controller;

use think\Controller;
use api\factory\FLogin;

/**
 * 退出登录
 * Class Off
 * @package app\api\service\login\logic
 */
class Off extends Controller
{
    public function index()
    {
        FLogin::createLogicLogin()->offLogin();
        $this->redirect('/login');
    }
}