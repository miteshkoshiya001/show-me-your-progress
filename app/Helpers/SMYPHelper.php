<?php

namespace App\Helpers;

use App\Models\User;

class SMYPHelper
{
    public static function getMemberCountAndData($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return null; // User not found
        }

        $memberCount = $user->members()->count();
        $members = $user->members()->get();

        return [
            'memberCount' => $memberCount,
            'members' => $members,
        ];
    }
}
