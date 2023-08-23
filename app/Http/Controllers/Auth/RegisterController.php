<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
        $user = User::where('referral_code', $referralCode)->first();
        if ($user) {
            // Determine user type based on referring user's type
            if ($user->user_type === 'parent') {
                $userType = 'child';
            } elseif ($user->user_type === 'trainer') {
                $userType = 'trainee';
            } else {
                // Invalid referring user type
                return response()->json(['valid' => false]);
            }
            return response()->json(['valid' => true, 'user_type' => $userType]);
        }

        return response()->json(['valid' => false]);
    }



    public function showRegistrationForm(Request $request)
    {
        $referralCode = $request->query('referral_code');

        if ($referralCode) {
            // Check if the provided referral code is valid
            $isValidReferralCode = User::where('referral_code', $referralCode)->exists();

            if ($isValidReferralCode) {
                // Store the valid referral code in the session
                session(['generated_referral_code' => $referralCode]);
            } else {
                // Invalid referral code, proceed without storing it
                session()->forget('generated_referral_code');
            }
        } else {
            // No referral code provided, generate a new one only if not already generated
            if (!session()->has('generated_referral_code')) {
                $referralCode = Str::upper(Str::random(6));
                session(['generated_referral_code' => $referralCode]);
            } else {
                $referralCode = session('generated_referral_code');
            }
        }

        return view('register', compact('referralCode'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'nullable',
            // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'referral_code' => 'nullable|regex:/^[a-zA-Z0-9]{6}$/',
        ], [
            'referral_code.regex' => 'The referral code must be 6 characters long and contain only letters and numbers.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if a referral code is provided in the URL
        $referralCode = $request->referral_code;

        if ($referralCode) {
            // Find the user with the provided referral code
            $referringUser = User::where('referral_code', $referralCode)->first();
            if ($referringUser) {
                // Referring user found, set user type based on user_type
                if ($referringUser->user_type === 'parent') {
                    $userType = 'child';
                } elseif ($referringUser->user_type === 'trainer') {
                    $userType = 'trainee';
                }
            } else {
                // Invalid referral code, redirect back with an error message
                return back()->withErrors(['referral_code' => 'Invalid referral code'])->withInput();
            }
        } else {
            // No referral code provided, use the selected user type
            $userType = $request->input('user_type');
        }


        // Create a new user record
        $user = User::create([
            'user_type' => $userType,
            'username' => $request->input('username'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'referral_code' => Str::upper(Str::random(6)),
            'parent_id' => $referringUser->id ?? null // Set referral code
        ]);
        if ($request->has('cropped_image_data')) {
            $croppedImageData = $request->input('cropped_image_data');
            // $binaryImageData = base64_decode($croppedImageData);
            $binaryImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));

            // Debug: Save the decoded data to a file to check if it's a valid image
            // $tempImagePath = storage_path('app/public/temp_image.png');
            // file_put_contents($tempImagePath, $binaryImageData);
            $fileName =  'avatars/' .time() . '.png';
            Storage::disk('public')->put($fileName, $binaryImageData);

            $user->avatar = $fileName;
            $user->save();
        }
        return redirect()->route('login.show')->with('success', 'Registration Success! Please log in.');
    }
}
