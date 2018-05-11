<?php

namespace app\api\factory;

use app\api\service\login\validate\Login AS validateLogin;
use app\api\service\login\logic\Login AS logicLogin;
use app\api\service\login\service\Login AS serviceLogin;

class FLogin
{

    public static function createValidateLogin()
    {
        return new validateLogin;
    }

    public static function createLogicLogin()
    {
        return new logicLogin;
    }

    public static function createServiceLogin()
    {
        return new serviceLogin;
    }
}