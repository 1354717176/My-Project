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
            $image->thumb(150, 150)->save(ROOT_PATH . 'static' . DS . 'upload' . DS . date('Ymd')  . DS .  $imgName[0] . '.thumb.' . $imgExt);
            return ['code' => 0, 'msg' => '文件上传成功', 'data' => DS . 'static' . DS . 'upload' . DS . $info->getSaveName()];
        } else {
            return ['code' => 1, 'msg' => '文件上传失败', 'data' => $this->getError()];
        }
    }
    return ['code' => 1, 'msg' => '文件资源为空', 'data' => []];
}