<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index (Request $request) {
        $categories = Category::active()->get()->toArray();
        $categoriesName = array_column($categories, 'name');
        $categoriesNames = implode(',', $categoriesName);
        return view('landing', compact('categoriesNames'));
    }
    
    public function tnc () {
        return view('terms-conditions');
    }

    public function privacyPolicy () {
        return view('privacy-policy');
    }
}
