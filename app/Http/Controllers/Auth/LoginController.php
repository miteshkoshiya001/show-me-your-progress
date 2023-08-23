<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if the input is a valid email address
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->username,
                'password' => $request->password,
            ];
        } else {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('index.show')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['message' => 'Invalid username or password.'])->withInput();
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
    public function storeSelectedUserType(Request $request)
    {
        $userType = $request->input('user_type');
        Session::put('selected_user_type', $userType);
        return response()->json(['message' => 'User type stored in session']);
    }
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $existingUser = User::where('email', $googleUser->email)->first();
            $referralCode = Str::upper(Str::random(6));


            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $newUser = new User();
                $newUser->username = $googleUser->name;
                $newUser->email = $googleUser->email;
                $newUser->google_id = $googleUser->id;
                $newUser->referral_code = $referralCode;
                $newUser->password = Hash::make("123456");

                // Retrieve and set the user type from the session
                $selectedUserType = session('selected_user_type');
                $newUser->user_type = $selectedUserType;

                if ($newUser->save()) {
                    Auth::login($newUser);
                } else {
                    return redirect()->route('login.show')->with('error', 'An error occurred during login. Please try again.');
                }
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect()->route('login.show')->with('error', 'An error occurred during login. Please try again.');
        }
    }
}
