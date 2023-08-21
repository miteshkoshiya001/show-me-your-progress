<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbacksController extends Controller
{
    public function showFeedbacks()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.feedbacks', compact('feedbacks'));
    }

    public function destroy($id)
    {
        $driver = Feedback::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.feedbacks')->with('success', 'Feedback deleted successfully.');
    }
}
