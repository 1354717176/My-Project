<?php

namespace app\api\console\member\logic;

use app\api\console\member\model\Member as modelMember;
use app\api\console\member\service\Member AS serviceMember;
use think\Exception;

class Member
{
    public $modelMember;
    public $serviceMember;

    public function __construct()
    {
        $this->modelMember = new modelMember;
        $this->serviceMember = new serviceMember;
    }

    public function save($data = [])
    {

    }

    public function login($data)
    {

        $result = $this->serviceMember->checkBase($data);
        if($result){
            throw new Exception($result);
        }

        $result = $this->serviceMember->checkUserName($data['user_name']);
        if (!$result) {
            throw new Exception('用户名不正确');
        }

        $user = $this->serviceMember->checkPassWord($data['pass_word'], $result['pass_salt']);
        if (!$user) {
            throw new Exception('密码不正确');
        }

        $result = $this->serviceMember->checkCaptcha($data['code'], $data['code_id']);
        if (!$result) {
            throw new Exception('验证码不正确');
        }

        $result = $this->serviceMember->saveLoginInfo($user['id'], $user['user_name'], $user['pass_word']);
        if (!$result) {
            throw new Exception('网络错误，请重试');
        }

        session('token', $result);
    }
}