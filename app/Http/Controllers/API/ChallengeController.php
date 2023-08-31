<?php

namespace App\Http\Controllers\API;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ChallengeMember;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChallengeRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\ChallengeUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $challenges = Challenge::active()->get();

            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.challenge_list'),
                'data' => $challenges
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function show(string $id)
    {
        try {
            $challenge = Challenge::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => __('messages.found'),
                'data' => $challenge,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => [],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }
    }


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

            // Store member IDs in ChallengeMember table
            $memberIds = explode(',', $request->input('member_ids'));
            foreach ($memberIds as $memberId) {
                $challengeMember = new ChallengeMember();
                $challengeMember->challenge_id = $challenge->id;
                $challengeMember->member_id = $memberId;
                $challengeMember->save();
            }

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

    public function update(ChallengeUpdateRequest $request, $id)
    {
        try {
            $challenge = Challenge::findOrFail($id);

            // Update the challenge attributes
            $challenge->video_link = $request->input('video_link');
            $challenge->status = $request->input('status');

            // Get the authenticated user's default language
            $userLanguage = $request->authUserLocale;

            // Update the translatable fields
            $challenge->translateOrNew($userLanguage)->title = $request->input('title');
            $challenge->translateOrNew($userLanguage)->description = $request->input('description');

            // Update the image if provided
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('challenges', 'public');
                $imageFileName = pathinfo($imagePath, PATHINFO_BASENAME);
                $challenge->image = $imageFileName;
            }

            $challenge->save();

            // Update challenge members if member_ids are provided
            $memberIds = $request->input('member_ids', []);
            $challenge->members()->syncWithoutDetaching($memberIds);

            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.challenge_updated'),
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
    public function destroy($id)
    {
        try {
            $challenge = Challenge::findOrFail($id);

            // Delete the challenge
            $challenge->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.challenge_deleted'),
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
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
