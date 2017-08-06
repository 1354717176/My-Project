<?php

namespace app\console\captcha\controller;

use app\api\common\logic\Base;
use app\api\common\logic\Captcha AS logicCaptcha;
use think\Request;

/**
 * 验证码类
 * Class Index
 * @package app\console\captcha\controller
 */
class Index extends Base
{
    protected $captcha;

    public function __construct(Request $request = null)
    {
        $this->captcha = new logicCaptcha();
        parent::__construct($request);
    }

    /**
     * 获取验证码
     * author:yanghuan
     * date:2017/8/6 12:19
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $this->captcha->id = $this->request->post('id');
            return json(['code' => 0, 'data' => $this->captcha->captcha(), 'msg' => '请求成功']);
        }
        return json(['code' => 10000, 'data' => [], 'msg' => '请求错误']);
    }
}
