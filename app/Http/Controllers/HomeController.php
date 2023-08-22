<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\RaceType;
use App\Models\HeroImage;
use App\Models\UpcomingEvent;
use App\Models\UserSticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        // $raceTypes = RaceType::all();
        // $heroImages = HeroImage::all();
        // $events = UpcomingEvent::all();
        // $allSettings = Setting::all();
        // $settings=[];
        // foreach($allSettings as $setting){
        //     $settings[$setting->key]=$setting->value;
        // }

        // $userCount = User::where('user_type', 'user')->count();

        // $countsStkPath1 = UserSticker::select('stk_path_1', DB::raw('count(*) as count'))
        //     ->whereNotNull('stk_path_1')
        //     ->groupBy('stk_path_1')
        //     ->get();

        // $countsStkPath2 = UserSticker::select('stk_path_2', DB::raw('count(*) as count'))
        //     ->whereNotNull('stk_path_2')
        //     ->groupBy('stk_path_2')
        //     ->get();

        // $countsStkPath3 = UserSticker::select('stk_path_3', DB::raw('count(*) as count'))
        //     ->whereNotNull('stk_path_3')
        //     ->groupBy('stk_path_3')
        //     ->get();

        // $totalCounts = 0;

        // foreach ($countsStkPath1 as $count) {
        //     $totalCounts += $count->count;
        // }

        // foreach ($countsStkPath2 as $count) {
        //     $totalCounts += $count->count;
        // }

        // foreach ($countsStkPath3 as $count) {
        //     $totalCounts += $count->count;
        // }

        return view('front.home');
    }
}
