<?php

namespace app\console\verifica\controller;

use app\api\common\logic\Captcha AS logicCaptcha;
use think\Controller;

/**
 * 验证码类
 * Class Index
 * @package app\console\captcha\controller
 */
class Captcha extends Controller
{
    protected $captcha;

    public function __construct()
    {
        $this->captcha = new logicCaptcha();
        parent::__construct();
    }

    /**
     * 获取验证码
     * author:yanghuan
     * date:2017/8/6 12:19
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $id = $this->request->post('id');
            $this->captcha->id = ++$id;
            return json(['code' => 0, 'data' => ['url' => $this->captcha->captcha(), 'id' => $this->captcha->id], 'msg' => '请求成功']);
        }
        return json(['code' => 10000, 'data' => [], 'msg' => '请求错误']);
    }

}
