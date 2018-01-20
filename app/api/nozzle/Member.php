<?php

namespace app\api\nozzle;

interface Member
{
    public static function checkUserName($userName);

    public static function checkUserPassword($password, $passSalt);
}