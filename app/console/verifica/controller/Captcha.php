<?php

namespace app\console\verifica\controller;

use app\api\common\logic\Base;
use app\api\common\logic\Captcha AS logicCaptcha;
use think\Request;

/**
 * 验证码类
 * Class Index
 * @package app\console\captcha\controller
 */
class Captcha extends Base
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
            $id = $this->request->post('id');
            $this->captcha->id = ++$id;
            return json(['code' => 0, 'data' => ['url' => $this->captcha->captcha(), 'id' => $this->captcha->id], 'msg' => '请求成功111']);
        }
        return json(['code' => 10000, 'data' => [], 'msg' => '请求错误']);
    }

    /**
     * 验证用户输入的验证码
     * author:yanghuan
     * date:2017/8/8 20:58
     * @return \think\response\Json
     */
    public function check()
    {
        if ($this->request->isPost()) {
            $this->captcha->id = $this->request->post('id', 0);
            $this->captcha->code = $this->request->post('validCode');
            $result = $this->captcha->check();
            return json($result ? ['code' => 0, 'data' => [], 'msg' => '验证成功','valid'=>true] : ['code' => 10001, 'data' => [], 'msg' => '验证失败','valid'=>false]);
        }
        return json(['code' => 10002, 'data' => [], 'msg' => '请求错误']);
    }
}
