<?php

namespace App\Helpers;

use App\Models\User;

class SMYPHelper
{
    public static function getUsersCountAndData($parentId)
    {
        $users = User::where('parent_id', $parentId)->get();
        $userCount = $users->count();

        return [
            'userCount' => $userCount,
            'usersData' => $users,
        ];
    }

}
