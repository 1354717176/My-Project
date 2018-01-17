<?php

namespace app\api\console\note\logic;

use app\api\console\note\service\MemberNote as serviceMemberNote;

class MemberNote
{
    public function save($data)
    {
        $data['member_id'] = $data['id'];
        $serviceMemberNote = new serviceMemberNote;
        return $serviceMemberNote->save($data);
    }
}