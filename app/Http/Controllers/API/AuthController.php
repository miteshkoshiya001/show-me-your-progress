<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Helpers\Helper;
use App\Models\AppUser;
use App\Models\Category;
use App\Models\MyCoupon;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AppUserRequest;
use App\Http\Resources\AppUserResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WalletHistoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AppUserRequest $request)
    {
        // dd($request->all());
        try {
            // Check if the user already exists
            $appUser = AppUser::whereNotNull('username')
                ->where(function ($query) use ($request) {
                    $query->where('username', $request->get('username'))
                        ->orWhere('email', $request->get('email'));
                })
                ->first();


            if (!empty($appUser)) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.user_already_exists'),
                    'data' => []
                ]);
            }
            $referralCode = $request->input('referral_code');
            $parentUser = null;
            if (empty($referralCode)) {
                // Check if the user_category_id exists in user_categories table with status=1
                $userCategoryId = $request->get('user_category_id');
                $validUserCategory = Category::where('id', $userCategoryId)
                    ->where('status', 1)
                    ->exists();

                if (!$validUserCategory) {
                    return response()->json([
                        'code' => Response::HTTP_BAD_REQUEST,
                        'status' => false,
                        'message' => __('messages.invalid_user_category'),
                        'data' => []
                    ]);
                }
            }


            if (!empty($referralCode)) {
                // Find the parent user with the given referral code
                $parentUser = AppUser::where('referral_code', $referralCode)->first();
                if (!$parentUser) {
                    return response()->json([
                        'code' => Response::HTTP_BAD_REQUEST,
                        'status' => false,
                        'message' => __('messages.invalid_referral_code'),
                    ]);
                }
            }

            $parentId = !empty($parentUser) ? $parentUser->id : 0;
            $request['parent_id'] = $parentId;
            // Create a new AppUser instance
            $appUser = new AppUser();
            $appUser->fill($request->all())->save();
            // $appUser->save($request->all());

            // Handle avatar upload
            if (!empty($request->file('avatar'))) {
                $file = $request->file('avatar');
                $path = 'user/' . $appUser['id'];
                $fileName = Helper::storeImage($file, $path);
                $appUser->avatar = $fileName;
                $appUser->save();
            }

            // Make the API token visible
            $appUser->makeVisible('api_token');

            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' =>  __('messages.registered_successfully'),
                'data' => new AppUserResource($appUser)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'QueryException' => $ex->getMessage(),
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' =>  __('messages.no_record_found'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
            ]);
        }
    }
    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $appUser = AppUser::findorfail($request->get('authUserId'));
            if (!empty($appUser) && (Hash::check($request->get('current_password'), $appUser->password))) {
                $appUser->password = Hash::make($request->get('new_password'));
                $appUser->save();

                return response()->json([
                    'code' => Response::HTTP_CREATED,
                    'status' => true,
                    'message' => __('messages.your_password_has_been_changed_suucessfully'),
                    'data' => []
                ]);
            }

            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.the_current_password_you_entered_is_incorrect'),
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
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
    public function getParentMembers(Request $request)
    {
        try {
            $parentUserId = $request->authUserId; // Get the ID of the user from the token
            // dd($parentUserId);
            $parentMembers = AppUser::where('parent_id', $parentUserId)->get();
            // dd($parentMembers);
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.parent_members_list'),
                'data' => AppUserResource::collection($parentMembers)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
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
    //     // Other methods remain unchanged

    //     /**
    //      * Update the specified resource in storage.
    //      */
    //     public function update(AppUserRequest $request)
    //     {
    //         try {
    //             // Find the user by authUserId
    //             $appUser = AppUser::findOrFail($request->get('authUserId'));

    //             // Handle avatar upload and deletion of old avatar
    //             $oldAvatar = $appUser->avatar;
    //             $pathImage = 'public/user/' . $appUser['id'] . '/' . $appUser['avatar'];
    //             $appUser->fill($request->validated())->save();
    //             if (!empty($request->file('avatar'))) {
    //                 $file = $request->file('avatar');
    //                 $path = 'user/' . $appUser['id'];
    //                 $fileName = Helper::storeImage($file, $path);
    //                 if (!empty($fileName) && $oldAvatar != "") {
    //                     $pathImage = 'public/user/' . $appUser['id'] . '/' . $oldAvatar;
    //                     Helper::removeImage($pathImage);
    //                 }
    //                 $appUser->avatar = $fileName;
    //             }
    //             $appUser->save();

    //             return response()->json([
    //                 'code' => Response::HTTP_CREATED,
    //                 'status' => true,
    //                 'message' =>  __('messages.user_edit_prodile_has_been_successfully'),
    //                 'data' => new AppUserResource($appUser)
    //             ]);
    //         } catch (QueryException $ex) {
    //             return response()->json([
    //                 'code' => Response::HTTP_BAD_REQUEST,
    //                 'status' => false,
    //                 'message' => __('messages.something_went_wrong'),
    //             ]);
    //         } catch (ModelNotFoundException $exception) {
    //             return response()->json([
    //                 'code' => Response::HTTP_BAD_REQUEST,
    //                 'status' => false,
    //                 'message' =>  __('messages.no_record_found'),
    //             ]);
    //         } catch (\Exception $exception) {
    //             return response()->json([
    //                 'code' => Response::HTTP_BAD_REQUEST,
    //                 'status' => false,
    //                 'message' => $exception->getMessage(),
    //             ]);
    //         }
    //     }

    //     // Other methods remain unchanged

    //     /**
    //      * Remove the specified resource from storage.
    //      */
    public function login(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            // Attempt to log in the user
            $appUser = AppUser::loginUser();
            if (empty($appUser)) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.password_invalid'),
                ]);
            }

            // Check if user status is active
            if ($appUser->status == 0) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.your_account_is_currently_inactive'),
                ]);
            }

            // Make the API token visible
            $appUser->makeVisible('api_token');

            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.login_successfully'),
                'data' => new AppUserResource($appUser)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
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

    //     // Other methods remain unchanged
}
