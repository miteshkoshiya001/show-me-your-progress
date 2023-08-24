<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DeliveryAddress;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DeliveryAddressRequest;
use App\Http\Resources\AvailableZipcodeResource;
use App\Http\Resources\DeliveryAddressResourcce;
use App\Models\AvailableZipcode;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeliveryAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $deliveryAddress = DeliveryAddress::active()->where('user_id', request()->authUserId)->get();
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.delivery_address_list'),
                'data' => new DeliveryAddressResourcce($deliveryAddress)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => []
            ]);
        }
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
    public function store(DeliveryAddressRequest $request)
    {
        try {
            $request->validated();
            if ($request->zipcode != '') {
                $isZipAvailable = AvailableZipcode::where('zipcodes', 'like', '%' . $request->zipcode . '%')->count();
                if (!$isZipAvailable) {
                    return response()->json([
                        'code' => Response::HTTP_BAD_REQUEST,
                        'status' => false,
                        'message' => __('messages.no_delivery_to_this_zip_code'),
                        'data' => []
                    ]);
                }
            }
            $deliveryAddress = DeliveryAddress::create($request->all());
            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.your_delivery_address_has_been_created_successfully'),
                'data' => new DeliveryAddressResourcce($deliveryAddress)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => []
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
    public function update(DeliveryAddressRequest $request, string $id)
    {
        try {
            if ($id == '') {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => []
                ]);
            }

            $deliveryAddress = DeliveryAddress::findorFail($id);
            $deliveryAddress->fill($request->validated())->save();
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.your_delivery_address_has_been_updated_successfully'),
                'data' => new DeliveryAddressResourcce($deliveryAddress)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => []
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($id == '') {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => []
                ]);
            }

            $deliveryAddress = DeliveryAddress::findorFail($id)->delete();
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.your_delivery_address_has_been_deleted_successfully'),
                'data' => []
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => []
            ]);
        }
    }


    /**
     * Update the specified resource in mark as primary.
     */
    public function markAsPrimary(Request $request, string $id)
    {
        try {
            if ($id == '') {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => []
                ]);
            }

            $deliveryAddress = DeliveryAddress::findorFail($id);
            $findDeliveryAddress = DeliveryAddress::where('user_id', request()->authUserId)->update(['is_primary' => 0]);
            $deliveryAddress->is_primary = 1;
            $deliveryAddress->save();
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.your_delivery_address_primary_has_been_updated_successfully'),
                'data' => new DeliveryAddressResourcce($deliveryAddress)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => []
            ]);
        }
    }

    public function checkDeliveryStatus(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'zipcode' => 'required|digits:6'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => $validator->errors()->all(),
                    'data' => []
                ]);
            }
            $availableZipcode = AvailableZipcode::orderBy('id', 'desc')->first();
            if (empty($availableZipcode->zipcode) && ($availableZipcode->zipcode == false)) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.no_delivery_to_this_zip_code'),
                    'data' => []
                ]);
            }
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.delivery_can_be_done_on_this_zipcode'),
                'data' => new AvailableZipcodeResource($availableZipcode)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => []
            ]);
        }
    }
    
}
