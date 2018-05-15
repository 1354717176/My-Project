<?php

namespace api\service\cate\model;

use think\Model;

class Cate extends Model
{
    protected $autoWriteTimestamp = 'datetime';

    public $type;
    public $parentId;

    public function __call($method, $args)
    {
        $argsNum = count($args);
        switch ($argsNum) {
            case 1:
                $funcNameArr = explode(':', $args[0]);
                $funcName = 'set' . $funcNameArr[0];
                $funcParam = $funcNameArr[1];
                $this->$funcName($funcParam);
                break;
            case 2:
                $this->setTypeAndParentId($args[0], $args[1]);
                break;
        }
    }

    public function setType($type)
    {
        $this->type = (int)$type;
    }

    public function setTypeAndParentId($type, $parentId)
    {
        $this->type = (int)$type;
        $this->parentId = (int)$parentId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getParentId()
    {
        return $this->parentId;
    }
}