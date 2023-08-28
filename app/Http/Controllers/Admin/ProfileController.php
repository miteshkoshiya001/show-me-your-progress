<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.edit-profile.index');
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        // Validate the form data
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
        ]);

        if ($request->newPassword !== $request->newPassword_confirmation) {
            return response()->json([
                'status' => false,
                'message' => 'Password confirmation does not match.',
            ]);
        }
        // Check if the current password matches
        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Current password is incorrect.',
            ]);
        }

        // Update the password
        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully.',
        ]);
    }
}
