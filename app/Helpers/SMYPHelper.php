<?php

namespace App\Helpers;

use App\Models\User;

class SMYPHelper
{
    public static function countMembersByUserId($userId)
    {
        return User::where('parent_id', $userId)->count();
    }

}
