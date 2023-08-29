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
            $challenge->image = $request->input('image');
            $challenge->status = $request->input('status');

            // Store the translatable fields for each locale
            foreach ($request->input('title') as $locale => $title) {
                $challenge->translateOrNew($locale)->title = $title;
            }

            foreach ($request->input('description') as $locale => $description) {
                $challenge->translateOrNew($locale)->description = $description;
            }

            $challenge->save();

            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.challenge_created'),
                'data' => $challenge
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'QueryException' => $ex->getMessage(),
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
