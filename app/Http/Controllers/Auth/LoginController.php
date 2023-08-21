<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showAdminLoginForm()
    {
        return view('admin.login'); // Replace with your admin login form view
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('index.show')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['message' => 'Invalid email or password.'])->withInput();
    }
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user is an admin (assuming 'admin' is the user_type for admin users)
            if ($user->user_type === 'admin') {
                // You can perform additional admin-specific actions here upon successful login
                return redirect()->route('admin.index')->with('success', 'Admin logged in!');
            } else {
                // If not an admin, logout the user and show an error message

                return back()->withErrors(['message' => 'Invalid email or password.'])->withInput();
            }
        }

        return back()->withErrors(['message' => 'Invalid email or password.'])->withInput();
    }



    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index.show');
    }
    public function adminLogout()
    {
        Auth::logout(); // Log out the user

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = new User();
                $newUser->name = $googleUser->name;
                $newUser->email = $googleUser->email;
                $newUser->google_id = $googleUser->id;
                $newUser->password = Hash::make("123456");
                // Add any other user details you want to save

                if ($newUser->save()) {
                    Auth::login($newUser);
                } else {
                    Log::error('Failed to save new user to the database');
                    return redirect()->route('login.show')->with('error', 'An error occurred during login. Please try again.');
                }
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            Log::error('Error during Google login callback: ' . $e->getMessage());
            return redirect()->route('login.show')->with('error', 'An error occurred during login. Please try again.');
        }
    }
}
