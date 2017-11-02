<?php

namespace app\api\console\member\logic;

use app\api\console\member\model\Member as modelMember;
use app\api\console\member\service\Member AS serviceMember;
use app\api\console\log\logic\Log AS logicLog;
use think\Exception;

class Member
{
    public $modelMember;
    public $serviceMember;
    public $logicLog;

    public function __construct()
    {
        $this->modelMember = new modelMember;
        $this->serviceMember = new serviceMember;
        $this->logicLog = new logicLog;
    }

    /**
     * 编辑/保存会员信息
     * @author:yanghuna
     * @datetime:2017/11/1 23:28
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function save($data = [])
    {
        $result = $this->serviceMember->checkMemberBase($data, 'system_member');
        if ($result) {
            throw new Exception($result);
        }

        $result = $this->serviceMember->find($data['id']);
        if (!$result) {
            throw new Exception('用户信息不存在');
        }

        //检查新的用户名是否存在
        if ($data['user_name'] != $result['user_name'] && isset($data['id']) && $data['id']) {
            $check = $this->serviceMember->checkUserName($data['user_name']);
            if ($check && $data['id'] != $check['id']) {
                throw new Exception('用户名已存在');
            }
        }

        if ($data['pass_word'] == '' && $data['confrim_pass_word'] == '') {
            unset($data['pass_salt'], $data['pass_word']);
        } else {
            $data['pass_salt'] = serviceMember::passSalt();
            $data['pass_word'] = serviceMember::passWord($data['pass_word'], $data['pass_salt']);
            $data['token'] = serviceMember::token($data['user_name'] . $data['pass_word'], $data['pass_salt']);
        }
        $this->serviceMember->save($data);

        //记录操作日志
        $message=[4=>'编辑管理员信息',1=>'编辑置业顾问信息'];
        $this->logicLog->save($message[$result['group_id']]);

        return true;
    }

    /**
     * 登录
     * @author:yanghuna
     * @datetime:2017/11/1 23:28
     * @param $data
     * @throws Exception
     */
    public function login($data)
    {

        $result = $this->serviceMember->checkBase($data);
        if ($result) {
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

        //记录登录日志
        $this->logicLog->save('成功登录系统', $user['user_name'],$user['id']);

        session('token', $result);
        session('user', ['user_name'=>$user['user_name'],'user_id'=>$user['id']]);
    }

    /**
     * 会员列表
     * @author:yanghuna
     * @datetime:
     * @param array $where
     * @param int $pageSize
     * @return array
     */
    public function lists($where = [], $pageSize = 20)
    {
        $lists = modelMember::where($where)->paginate($pageSize);
        $page = $lists->render();
        return ['lists' => $lists, 'page' => $page];
    }

    /**
     * 会员单条信息
     * @author:yanghuna
     * @datetime:2017/11/1 23:29
     * @param $id
     * @return array|static
     */
    public function find($id)
    {
        if ($id) {
            return $this->serviceMember->find($id);
        }
        return [];
    }
}