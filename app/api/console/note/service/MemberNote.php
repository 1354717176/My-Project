<?php

namespace app\api\console\note\service;

use app\api\console\note\model\MemberNote as modelMemberNote;

class MemberNote
{
    public function save($data){
        $modelMemberNote = new modelMemberNote;
        $modelMemberNote->allowField(true)->save($data);
        return $modelMemberNote->id;
    }
}