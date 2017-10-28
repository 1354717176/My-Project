<?php
namespace app\console\article\controller;

use app\api\common\logic\Base;

class Detail extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function save()
    {
        $file = $this->request->file('img');
        $imgPath = upload($file);
        return json($imgPath);
    }
}