<?php

namespace App\Http\Controllers;

use App\Models\RaceType;
use App\Models\HeroImage;
use App\Models\UserSticker;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // Assuming you have a logged-in user
        $userId = auth()->user()->id;

        // Fetch user stickers from the database
        $userStickers = UserSticker::where('user_id', $userId)->get();
        return view('front.profile', ['userStickers' => $userStickers]);
    }
}
