<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Sticker;
use App\Models\RaceType;
use App\Models\HeroImage;
use App\Helpers\SMYPHelper;
use App\Models\UserSticker;
use Illuminate\Http\Request;
use App\Models\UpcomingEvent;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $loggedInUser = auth()->user();

        if ($loggedInUser->user_type === 'parent' || $loggedInUser->user_type === 'trainer' || $loggedInUser->user_type === 'teacher') {
            $parentId = $loggedInUser->id; // Assuming parent_id or trainer_id field name
            $userData = SMYPHelper::getUsersCountAndData($parentId);

            $userCount = $userData['userCount'];
            $usersData = $userData['usersData'];

            return view('front.home', compact('userCount', 'usersData'));
        } elseif (in_array($loggedInUser->user_type, ['child', 'student', 'trainee'])) {
            // Fetch stickers based on user type
            if ($loggedInUser->user_type === 'child') {
                $parentStickers = Sticker::where('user_type', 'parent')->get();
                return view('front.home', compact('parentStickers'));
            } elseif ($loggedInUser->user_type === 'trainee') {
                $trainerStickers = Sticker::where('user_type', 'trainer')->get();
                return view('front.home', compact('trainerStickers'));
            } elseif ($loggedInUser->user_type === 'student') {
                $teacherStickers = Sticker::where('user_type', 'teacher')->get();
                return view('front.home', compact('teacherStickers'));
            }
        } else {
            return view('front.home')->with('message', 'Access denied.');
        }
    }
}
