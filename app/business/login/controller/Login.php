<?php
namespace app\business\login\controller;

use app\api\login\validate\Login as loginValidate;
use app\api\user\logic\User;
use think\Request;
use think\Session;
use think\Controller;

/**
 * 商户中心-登录类
 * Created by PhpStorm.
 * User: yanghuan
 * Date: 2017/3/22
 * Time: 20:31
 */
class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 登录验证
     * @author yanghuan
     * @datetime 2017/3/22 21:02
     */
    public function login()
    {
        $request = Request::instance();
        if ($request->isPost()) {
            $data['username'] = $request->post('username');
            $data['password'] = $request->post('password');

            $loginValidate = new loginValidate();
            if (!$loginValidate->scene('login')->check($data)) {
                return ['code' => 50000, 'msg' => $loginValidate->getError()];
            }

            $user = new User();
            $userInfo = $user->userInfoByUserName($data['username']);
            if ($userInfo) {

                //目前只有商户管理员才能登录这里
                if (!in_array($userInfo['type'],[1])) {
                    return ['code' => 50003, 'msg' => '当前用户不能登录这里'];
                }

                $userName = $data['username'];
                $password = md5($data['password'] . $userInfo['passalt']);
                $result = $user->userInfoByPassword($userName, $password);
                if ($result) {
                    Session::set('businessUser', $userInfo);
                    return ['code' => 0, 'url' => Url(DS, '', false, true)];
                }
                return ['code' => 50002, 'msg' => '用户名或密码不正确'];
            }
            return ['code' => 50001, 'msg' => '会员不存在'];
        }
    }

    /**
     * 退出
     * author: yanghuan
     * date:2017/3/22 20:09
     */
    public function out(){
        Session::delete('businessUser');
        $this->redirect(Url('/login/login/', '', false, true));
    }
}