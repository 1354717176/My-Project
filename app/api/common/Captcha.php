<?php

namespace api\common;

class Captcha
{

    public $id;
    public $code;

    /**
     * 获得验证码
     * author:yanghuan
     * date:2017/8/6 12:01
     */
    public function captcha()
    {
        return captcha_src($this->id);
    }

    /**
     * 验证用户输入的验证码
     * author:yanghuan
     * date:2017/8/8 20:56
     */
    public function check()
    {
        return captcha_check($this->code, $this->id);
    }
}