<?php

namespace app\console\log\controller;

use think\Db;
use think\Controller;

/**
 * 系统日志类
 * Class Lists
 * @package app\console\log\controller
 */
class Lists extends Controller
{
    //protected static $kcwcDbConf = 'mysql://root:root@192.168.0.228:3306/tiger_test#utf8';
    protected static $kcwcDbConf = 'mysql://dev:vgWN97n2s4@rm-bp1mxu4jq05n596y0o.mysql.rds.aliyuncs.com/tiger_200#utf8';
    protected static $kcwcConn; // 原数据连接

    protected function _initialize()
    {
        self::$kcwcConn = Db::connect(self::$kcwcDbConf);
    }

    /**
     * 生成code码,默认8位
     * @author:yanghuan
     * @datetime:2018/3/30 0030 15:52
     * @return string
     */
    public static function makeCode($number = 8)
    {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0, 25)]
            . strtoupper(dechex(date('m')))
            . date('d') . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));
        for (
            $a = md5($rand, true),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < $number;
            $g = ord($a[$f]),
            $d .= $s[($g ^ ord($a[$f + 8])) - $g & 0x1F],
            $f++
        ) ;
        return $d;
    }

    public static function code()
    {
        $makeCode = self::makeCode();
        $code = self::$kcwcConn->table('tg_activity_lottery_code')->where(['code' => $makeCode])->find();
        if (empty($code)) {
            return $makeCode;
        }
        self::code();
    }

    public function index()
    {
        /*//查询成都消费节的订单
        $pageSize = $this->request->param('page_size', 0);
        $order = self::$kcwcConn->table('tg_order')->where(['event_id' => 22, 'ticket_type' => 3])->limit($pageSize, 1)->order('order_id ASC')->select();
        if (empty($order)) {
            exit('success');
        }
        $order = $order[0];

        $code = self::$kcwcConn->table('tg_activity_lottery_code')->where(['event_id' => 22, 'tel' => $order['mobile']])->find();
        if (empty($code)) {

            $user = self::$kcwcConn->table('tg_admin_user')->where(['tel' => $order['mobile']])->find();

            //生成12位code_sn码
            $range = range('A', 'Z');
            shuffle($range);
            $codeSn = substr($range[0] . sha1(uniqid(mt_rand(), true)), 0, 12);

            $ticketUser = self::$kcwcConn->table('tg_ticket_user')->where(['order_id' => $order['order_id']])->select();
            $ticketId = !empty($ticketUser) ? array_column($ticketUser, 'tid') : 0;

            //创建半价购车券
            $data['event_id'] = 22;
            $data['ticket_id'] = @implode(',', $ticketId);
            $data['order_sn'] = $order['order_sn'];
            $data['code'] = self::code();
            $data['code_sn'] = $codeSn;
            $data['user_id'] = $user['id'];
            $data['nick_name'] = $user['nickname'];
            $data['nick_name_emoji'] = base64_encode($user['nickname']);
            $data['avatar'] = isset($user['avatar']) ? $user['avatar'] : 0;
            $data['tel'] = isset($user['tel']) ? $user['tel'] : 0;
            $data['create_time'] = date('Y-m-d H:i:s');

            $result = self::$kcwcConn->table('tg_activity_lottery_code')->fetchSql(true)->insert($data);
            file_put_contents('2.txt', $result . "\r\n", FILE_APPEND);

            $lotteryId = self::$kcwcConn->table('tg_activity_lottery_code')->insertGetId($data);

            //半价购车券状态
            $map['event_id'] = 22;
            $map['lottery_id'] = $lotteryId;
            $map['update_time'] = date('Y-m-d H:i:s');
            self::$kcwcConn->table('tg_activity_lottery_status')->insert($map);

            //短信
            $sms['event_id'] = 22;
            $sms['lottery_id'] = $lotteryId;
            $sms['tel'] = $data['tel'];
            $sms['sms'] = 0;
            $sms['update_time'] = date('Y-m-d H:i:s');
            self::$kcwcConn->table('tg_activity_lottery_sms')->insert($sms);
        }

        echo '<script>location.href="' . Url('index', ['page_size' => ++$pageSize], false, true) . '"</script>';*/
    }

    public function coupon()
    {
        /*$pageSize = $this->request->param('page_size', 0);
        $couponOrder = self::$kcwcConn->table('tg_coupon_order')->limit($pageSize, 1)->order('id ASC')->select();
        if (empty($couponOrder)) {
            exit('success');
        }
        $couponCode = self::$kcwcConn->table('tg_coupon_code')->where(['order_id' => $couponOrder[0]['id']])->field('id,order_id,coupon_id')->find();
        if (!empty($couponCode)) {
            self::$kcwcConn->table('tg_coupon_order')->where(['id' => $couponCode['order_id']])->update(['coupon_id' => $couponCode['coupon_id']]);
            $result = self::$kcwcConn->table('tg_coupon_order')->where(['id' => $couponCode['order_id']])->fetchSql(true)->update(['coupon_id' => $couponCode['coupon_id']]);
            file_put_contents('4.txt', $result . ";\r\n", FILE_APPEND);
        }

        echo '<script>location.href="' . Url('coupon', ['page_size' => ++$pageSize], false, true) . '"</script>';*/
    }

    function imgToWebp($file = '')
    {
        phpinfo();
        exit;
        $file = 'http://img.i.cacf.cn/content/1805/14/e24412671eb3a78e719a0a2e5d6b22be_s1080x719.jpg';
        $img = getimagesize($file);
        if ($img !== false) {
            $type = $img['mime'];
            if ($type == 'image/jpeg') {
                $file_source = imagecreatefromjpeg($file);
            } elseif ($type == 'image/png') {
                $file_source = imagecreatefrompng($file);
            } else {
                return false;
            }
            $i = strripos($file, '.');
            //$newFileName = substr($file, 0, $i + 1) . 'webp';
            $newFileName = time() . '.webp';
            imagewebp($file_source, $newFileName, 50);
            imagedestroy($file_source);
        }
    }
}