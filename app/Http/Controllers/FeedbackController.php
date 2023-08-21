<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function submitFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'feedback' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $feedback = new Feedback();
        $feedback->email = $request->input('email');
        $feedback->feedback = $request->input('feedback');
        $feedback->save();

        return response()->json(['message' => 'Feedback submitted successfully']);
    }
}
