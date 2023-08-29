<?php

namespace App\Http\Controllers\API;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChallengeController extends Controller
{

    public function store(ChallengeRequest $request)
    {
        try {
            $challenge = new Challenge();
            $challenge->video_link = $request->input('video_link');
            $challenge->status = $request->input('status');

            // Get the authenticated user's default language
            $userLanguage = $request->authUserLocale;

            // Store the title and description in the user's default language
            $challenge->translateOrNew($userLanguage)->title = $request->input('title');
            $challenge->translateOrNew($userLanguage)->description = $request->input('description');

            // Store the image file in storage and get the file name
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('challenges', 'public'); // 'challenges' is the storage path
                $imageFileName = pathinfo($imagePath, PATHINFO_BASENAME);
                $challenge->image = $imageFileName;
            }

            $challenge->save();

            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.challenge_created'),
                'data' => $challenge
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }


}
