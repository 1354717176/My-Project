<?php

/**
 * 随机字符串
 * @param $length
 * @param string $chars
 * @return string
 * author: yanghuan
 * date:2017/3/12 18:01
 */
function random($length, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz')
{
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 上传文件
 * author:yanghuan
 * date:2017/10/25 20:55
 * @param $file 文件资源
 */
function upload($file)
{
    if ($file) {
        $image = \think\Image::open($file);
        $info = $file->move(ROOT_PATH . 'static' . DS . 'upload');
        if ($info) {
            $imgInfo = $info->getFilename();
            $imgExt = $info->getExtension();
            $imgName = explode('.', $imgInfo);
            $image->thumb(150, 150)->save(ROOT_PATH . 'static' . DS . 'upload' . DS . date('Ymd') . DS . $imgName[0] . '.thumb.' . $imgExt);
            return ['code' => 0, 'msg' => '文件上传成功', 'data' => DS . 'static' . DS . 'upload' . DS . $info->getSaveName()];
        } else {
            return ['code' => 1, 'msg' => '文件上传失败', 'data' => $this->getError()];
        }
    }
    return ['code' => 1, 'msg' => '文件资源为空', 'data' => []];
}

function timeToDate($time = 0, $type = 6)
{
    if (!$time) $time = time();
    $types = array('Y-m-d', 'Y', 'm-d', 'Y-m-d', 'm-d H:i', 'Y-m-d H:i', 'Y-m-d H:i:s');
    if (isset($types[$type])) $type = $types[$type];
    $date = '';
    if ($time > 2147212800) {
        if (class_exists('DateTime')) {
            $D = new DateTime('@' . ($time - 3600 * intval(str_replace('Etc/GMT', '', $GLOBALS['CFG']['timezone']))));
            $date = $D->format($type);
        }
    }
    return $date ? $date : date($type, $time);
}

function dateToTime($date)
{
    $time = strtotime($date);
    if ($time === false) {
        if (class_exists('DateTime')) {
            $D = new DateTime($date);
            $time = $D->format('U');
        }
    }
    return $time;
}

function dSubstr($string, $length, $suffix = '', $start = 0, $charset = 'UTF-8')
{
    if ($start) {
        $tmp = dSubstr($string, $start);
        $string = substr($string, strlen($tmp));
    }
    $strlen = strlen($string);
    if ($strlen <= $length) return $string;
    $string = str_replace(array('&quot;', '&lt;', '&gt;'), array('"', '<', '>'), $string);
    $length = $length - strlen($suffix);
    $str = '';
    if ($charset == 'UTF-8') {
        $n = $tn = $noc = 0;
        while ($n < $strlen) {
            $t = ord($string{$n});
            if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1;
                $n++;
                $noc++;
            } elseif (194 <= $t && $t <= 223) {
                $tn = 2;
                $n += 2;
                $noc += 2;
            } elseif (224 <= $t && $t <= 239) {
                $tn = 3;
                $n += 3;
                $noc += 2;
            } elseif (240 <= $t && $t <= 247) {
                $tn = 4;
                $n += 4;
                $noc += 2;
            } elseif (248 <= $t && $t <= 251) {
                $tn = 5;
                $n += 5;
                $noc += 2;
            } elseif ($t == 252 || $t == 253) {
                $tn = 6;
                $n += 6;
                $noc += 2;
            } else {
                $n++;
            }
            if ($noc >= $length) break;
        }
        if ($noc > $length) $n -= $tn;
        $str = substr($string, 0, $n);
    } else {
        for ($i = 0; $i < $length; $i++) {
            $str .= ord($string{$i}) > 127 ? $string{$i} . $string{++$i} : $string{$i};
        }
    }
    $str = str_replace(array('"', '<', '>'), array('&quot;', '&lt;', '&gt;'), $str);
    return $str == $string ? $str : $str . $suffix;
}

function getConfig($value = '')
{
    $config = [];
    if (is_array($value) && $value) {
        foreach ($value as $item) {
            $config[$item] = \Think\Config::get($item);
        }
    } else {
        $config = \Think\Config::get($value);
    }
    return $config;
}

function djson($code, $msg, $data = [], $ext = [])
{
    return json(array_merge(['code' => $code, 'msg' => $msg, 'data' => $data], $ext));
}