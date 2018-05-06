<?php
/**
 * 矢量图标
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/6
 * Time: 10:55
 */

namespace app\console\basics\controller;

use app\api\common\Base;

class Icon extends Base
{
    public function webicon()
    {
        return $this->fetch();
    }

    public function fontAwesome()
    {
        return $this->fetch();
    }

    public function stroke()
    {
        return $this->fetch();
    }

    public function glyphicons()
    {
        return $this->fetch();
    }

    public function ionicons()
    {
        return $this->fetch();
    }

    public function material()
    {
        return $this->fetch();
    }

    public function mfglabs()
    {
        return $this->fetch();
    }

    public function openiconic(){
        return $this->fetch();
    }

    public function themify(){
        return $this->fetch();
    }

    public function weather(){
        return $this->fetch();
    }

    public function octicons(){
        return $this->fetch();
    }
}