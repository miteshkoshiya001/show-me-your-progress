<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function index()
    {
        return view('frontend.password-forgot');
    }

    public function passwordForgotSuccess()
    {
        return view('frontend.password-forgot-success');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function change(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "phone" => "sometimes|digits:10",
                "password" => "sometimes|same:confirmPassword",
                "confirmPassword" => "sometimes"
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'data' => []]);
            }
            $appUser = AppUser::where('phone', $request->phone)->first();
            if (empty($appUser)) {
                return response()->json(['status' => false, 'message' => __('messages.data_not_found'), 'data' => []]);
            }
            if (!empty($request->password) && !empty($request->confirmPassword)) {
                $appUser->password = Hash::make($request->password);
                $appUser->plain_pass = $request->password;
                $appUser->save();
            }
            return response()->json(['status' => true, 'message' => __('messages.password_has_been_reset_successfully'), 'data' => []]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }
}
