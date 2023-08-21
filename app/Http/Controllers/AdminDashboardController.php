<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use App\Models\Feedback;
use App\Models\RaceType;
use App\Models\UserSticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('user_type', 'user')->count();
        $totalDrivers = Driver::count();
        $totalRiderCategories = RaceType::count();
        $totalFeedbacks = Feedback::count();

        $countsStkPath1 = UserSticker::select('stk_path_1', DB::raw('count(*) as count'))
            ->whereNotNull('stk_path_1')
            ->groupBy('stk_path_1')
            ->get();

        $countsStkPath2 = UserSticker::select('stk_path_2', DB::raw('count(*) as count'))
            ->whereNotNull('stk_path_2')
            ->groupBy('stk_path_2')
            ->get();

        $countsStkPath3 = UserSticker::select('stk_path_3', DB::raw('count(*) as count'))
            ->whereNotNull('stk_path_3')
            ->groupBy('stk_path_3')
            ->get();

        $totalCounts = 0;

        foreach ($countsStkPath1 as $count) {
            $totalCounts += $count->count;
        }

        foreach ($countsStkPath2 as $count) {
            $totalCounts += $count->count;
        }

        foreach ($countsStkPath3 as $count) {
            $totalCounts += $count->count;
        }

        return view('admin.index', compact('totalUsers', 'totalDrivers', 'totalRiderCategories', 'totalCounts', 'totalFeedbacks'));
    }
}
