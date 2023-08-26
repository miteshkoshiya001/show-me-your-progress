<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AppUserRequest;
use App\Http\Resources\AppUserResource;
use App\Http\Resources\WalletHistoryResource;
use App\Models\MyCoupon;
use App\Models\Order;
use App\Models\WalletHistory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppUserRequest $request)
    {
        try {
            $appUser = AppUser::where('phone', $request->get('phone'))->orWhere('email', $request->get('email'))->first();
            if (!empty($appUser)) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' =>  __('messages.user_already_exists'),
                    'data' => []
                ]);
            }
            $appUser = new AppUser();
            $appUser->fill($request->validated())->save();
            if (!empty($request->file('avatar'))) {
                $file = $request->file('avatar');
                $path = 'user/' . $appUser['id'];
                $fileName = Helper::storeImage($file, $path);
                $appUser->avatar = $fileName;
                $appUser->save();
            }
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppUserRequest $request)
    {
        try {
            $appUser = AppUser::findOrFail($request->get('authUserId'));
            $pathImage = 'public/user/' . $appUser['id'] . '/' . $appUser['avatar'];
            $oldAvatar = $appUser->avatar;
            $appUser->fill($request->validated())->save();
            if (!empty($request->file('avatar'))) {
                $file = $request->file('avatar');
                $path = 'user/' . $appUser['id'];
                $fileName = Helper::storeImage($file, $path);
                if (!empty($fileName) && $oldAvatar != "") {
                    $pathImage = 'public/user/' . $appUser['id'] . '/' . $oldAvatar;
                    Helper::removeImage($pathImage);
                }
                $appUser->avatar = $fileName;
            }
            $appUser->save();
            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' =>  __('messages.user_edit_prodile_has_been_successfully'),
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }
            $appUser = AppUser::loginUser();
            if (empty($appUser)) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.password_invalid'),
                ]);
            }
            if ($appUser->status == 0) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.your_account_is_currently_inactive'),
                ]);
            }
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

    public function changePassword(Request $request, int $id)
    {
        try {
            if ($id == '') {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id')
                ]);
            }

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

            $appUser = AppUser::findorfail($id);
            if (!empty($appUser) && (Hash::check($request->get('current_password'), $appUser->password))) {
                $appUser->password = Hash::make($request->get('new_password'));
                $appUser->save();

                return response()->json([
                    'code' => Response::HTTP_CREATED,
                    'status' => true,
                    'message' => __('messages.your_password_has_been_changed_suucessfully'),
                    'data' => new AppUserResource($appUser)
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

    public function userLanguageUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'language' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $appUser = AppUser::findorfail(request()->authUserId);
            $appUser->language = in_array($request->get('language'), Helper::getLocales()) ? $request->get('language') : "en";
            $appUser->save();
            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.your_language_has_been_changed_suucessfully'),
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

    public function walletHistory(Request $request)
    {
        try {
            $walletHistory = WalletHistory::sort()->details()->where(['user_id' => $request->get('authUserId')])->paginate(20);
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.wallet_history_list'),
                'data' => new WalletHistoryResource($walletHistory),
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

    public function countUserDeliveredOrderCoupon()
    {
        try {
            $response['total_app_user'] = AppUser::where(['status' => 1, 'user_type' => config('constants.user_types.CUSTOMER')])->count();
            $response['total_scractched_coupon'] = MyCoupon::where(['status' => 1])->count();
            $response['total_delivered_order'] = Order::where(['status' => config('constants.order_status.delivered.value')])->count();
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.total_user_coupons_delivered_order'),
                'data' => $response,
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
}
