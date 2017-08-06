<?php

namespace app\api\common\logic;

use think\Controller;

class Captcha extends Controller
{

    public $id;

    /**
     * 获得验证码
     * author:yanghuan
     * date:2017/8/6 12:01
     */
    public function captcha()
    {
        return captcha_src($this->id);
    }
}