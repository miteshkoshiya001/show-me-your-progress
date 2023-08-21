<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function getUsers()
    {
        $users = User::where('user_type', 'user')->get();

        return view('admin.users', compact('users'));
    }

    public function showRegistrationForm()
    {
        return view('register'); // Replace with your registration form view
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new user record
        User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.show')->with('success', 'Registration Success! Please log in.');
    }
}
