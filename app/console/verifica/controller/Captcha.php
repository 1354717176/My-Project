<?php

namespace app\console\verifica\controller;

use think\Controller;

/**
 * 验证码类
 * Class Index
 * @package app\console\captcha\controller
 */
class Captcha extends Controller
{
    /**
     * 获取验证码
     * author:yanghuan
     * date:2017/8/6 12:19
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $id = $this->request->post('id/d');
            $id++;
            return json(['code' => 0, 'data' => ['url' => captcha_src($id), 'id' => $id], 'msg' => '请求成功']);
        }
        return json(['code' => 10000, 'data' => [], 'msg' => '请求错误']);
    }

}
