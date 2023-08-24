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

        return view('admin.index');
    }
}
