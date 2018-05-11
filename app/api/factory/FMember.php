<?php

namespace app\api\factory;

use app\api\service\member\model\Member AS modelMember;
use app\api\service\member\validate\Member AS validateMember;
use app\api\service\member\logic\Member AS logicMember;
use app\api\service\member\service\Member AS serviceMember;

class FMember
{
    public static function createMember()
    {
        return new modelMember;
    }

    public static function createValidateMember()
    {
        return new validateMember;
    }

    public static function createLogicMember()
    {
        return new logicMember;
    }

    public static function createServiceMember()
    {
        return new serviceMember;
    }
}