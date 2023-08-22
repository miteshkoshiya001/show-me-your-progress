<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    public function getUsers()
    {
        $users = User::where('user_type', 'user')->get();

        return view('admin.users', compact('users'));
    }
    // RegisterController.php

    public function checkReferralCodeValidity(Request $request)
    {
        $referralCode = $request->input('referral_code');

        // Validate the referral code format (alphanumeric, 6 characters)
        $validator = Validator::make(['referral_code' => $referralCode], [
            'referral_code' => 'required|regex:/^[a-zA-Z0-9]{6}$/'
        ]);

        if ($validator->fails()) {
            return response()->json(['valid' => false]);
        }

        // Check if the referral code exists in the database
        $isValidReferralCode = User::where('referral_code', $referralCode)->exists();

        return response()->json(['valid' => $isValidReferralCode]);
    }

    public function showRegistrationForm()
    {
        $referralCode = Str::upper(Str::random(6));

        // Store the referral code in the session
        session(['generated_referral_code' => $referralCode]);
        return view('register', compact('referralCode'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_type' => 'required|in:parent,child,trainer,trainee',
            'parent_id' => 'nullable|exists:users,id',
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'nullable',
            'referral_code' => 'required|unique:users|regex:/^[a-zA-Z0-9]{6}$/',
        ], [
            'referral_code.regex' => 'The referral code must be 6 characters long and contain only letters and numbers.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new user record
        User::create([
            'user_type' => $request->input('user_type'),
            'parent_id' => $request->input('parent_id'),
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'referral_code' => $request->input('referral_code'),
        ]);

        return redirect()->route('login.show')->with('success', 'Registration Success! Please log in.');
    }
}
