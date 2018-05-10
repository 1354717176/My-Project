<?php

namespace app\api\factory;

class FMember
{
    public static function createMember()
    {
        return new \app\api\service\member\model\Member();
    }
}