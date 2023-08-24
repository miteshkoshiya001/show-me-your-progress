<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use Illuminate\Http\Response;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\MyCoupon;
use Illuminate\Database\QueryException;
use App\Http\Resources\MyCouponResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\String_;
use Ramsey\Uuid\Type\Integer;
use App\Http\Requests\MyCouponRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $order = Order::fullDetail()->orderBy('id', 'desc')->where(['user_id' => request()->authUserId])->where(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status')) {
                    $statusIds = explode(',', $request->get('status'));
                    $query->whereIn('status', $statusIds);
                }
            })->paginate(20);
            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.order_list'),
                'data' => new OrderResource($order)
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
                'message' =>  __('messages.no_record_found'),
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
    public function store(OrderRequest $request)
    {
        try {
            $settings = Setting::where(['id' => 1])->first();
            if (isset($settings) && !empty($settings->min_item_count) && !empty($settings->min_order_amount)) {
                if ($request->order_total < $settings->min_order_amount && count($request->get('basket')) < $settings->min_item_count) {
                    return response()->json([
                        'code' => Response::HTTP_BAD_REQUEST,
                        'status' => false,
                        'message' => __('messages.minimum_order_amount_items', ['items' => $settings->min_item_count, 'amount' => $settings->min_order_amount]),
                        'data' => []
                    ]);
                }
            }

            $order = Order::create($request->all());
            if (!empty($order)) {
                if (!empty($request->use_wallet_amount)) {
                    $wallet = Wallet::where(['user_id' => request()->authUserId])->first();
                    if (!empty($wallet) && ($request->use_wallet_amount <=  $wallet->amount)) {
                        $wallet->amount = $wallet->amount - $request->use_wallet_amount;
                        $wallet->save();
                        WalletHistory::create([
                            'user_id' => request()->authUserId,
                            'amount' => $request->use_wallet_amount,
                            'type' => 'debit',
                            'order_id' => $order->id,
                        ]);
                    }
                    /* else {
                        $walletAmount = !empty($wallet->amount) ? $wallet->amount : 0;
                        return response()->json([
                            'code' => Response::HTTP_BAD_REQUEST,
                            'status' => false,
                            'message' => __('messages.maximum_amount_capacity_of_your_wallet_it') . $walletAmount,
                            'data' => []
                        ]);
                    } */
                }
                foreach ($request->get('basket') as $basket) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->order_numer = $order->order_id;
                    $orderItem->product_id = $basket['product_id'];
                    $orderItem->quantity = $basket['quantity'];
                    $orderItem->unit_id = $basket['unit_id'];
                    $orderItem->price = $basket['price'];
                    $orderItem->item_total = $basket['item_total'];
                    $orderItem->status = $request->status;
                    $orderItem->save();

                    // reduce stock of product
                    $itemProduct = Product::find($basket['product_id']);
                    if ($itemProduct) {
                        $itemProduct->stock = $itemProduct->stock - $basket['quantity'];
                        if ($itemProduct->stock < 0) {
                            $itemProduct->stock = 0;
                        }
                        $itemProduct->save();
                    }
                }
            }
            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.your_order_has_been_received'),
                'data' => new OrderResource($order)
            ]);
        } catch (QueryException $ex) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'error' => $ex->getMessage(),
                'data' => []
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' =>  __('messages.no_record_found'),
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
    public function update(Request $request, string $id)
    {
        //
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
            $order = Order::findOrFail($id);
            if (!empty($order)) {
                $order->status = 5;
                $order->cancel_by = request()->authUserId;
                $order->save();

                $orderItems = OrderItem::where(['order_id' => $id])->get();
                foreach ($orderItems as $orderItem) {
                    $orderItem->status = config('constants.order_status.cancelled.value');
                    $orderItem->save();
                    $product = Product::find($orderItem->product_id);
                    if (!empty($product)) {
                        $product->stock = $product->stock + $orderItem->quantity;
                        $product->save();
                    }
                }
                return response()->json([
                    'code' => Response::HTTP_CREATED,
                    'status' => true,
                    'message' => __('messages.your_order_has_been_cancelled'),
                    'data' => new OrderResource($order)
                ]);
            }
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.your_order_has_been_not_cancelled'),
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
                'message' =>  __('messages.no_record_found'),
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

    /* 
    *   Delivery person orders 
    */
    public function deliveryPersonOrders(Request $request)
    {
        try {
            $orders = Order::sort()->with(['user', 'deliveryAddress', 'orderItems'])->where('assigned_id', $request->get('authUserId'))->where(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status')) {
                    $statusIds = explode(',', $request->get('status'));
                    $query->where('status', $statusIds);
                }
            })->paginate(20);
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.assigned_delivery_person_order_list'),
                'data' => new OrderResource($orders)
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
                'message' =>  __('messages.no_record_found'),
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
    /* 
    * Order mark or as delivered
     */

    public function markOrAsDelivered(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'otp' => 'required|digits:5'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'data' => []]);
            }

            $order = Order::with(['user', 'deliveryAddress'])->where(['id' => $request->get('order_id'), 'assigned_id' => $request->get('authUserId')])->firstOrFail();
            if ($order->order_otp == $request->get('otp')) {
                $order->status = 4;
                $order->save();
                $orderItems = OrderItem::where(['order_id' => $request->get('order_id')])->get()->toArray();
                $orderItem = array_column($orderItems, 'product_id');
                $product = Product::select(['user_discount', 'id'])->whereIn('id', $orderItem)->get()->toArray();

                $totalDiscount = 0;

                $setting = Setting::first();
                if (!empty($setting) && !empty($setting->coupon_expiry_time)) {

                    foreach ($orderItems as $orderItem) {

                        $key = array_search($orderItem['product_id'], array_column($product, 'id'));
                        if ($key !== false) {
                            $singleProdut = $product[$key];
                            $totalDiscount += $singleProdut['user_discount'] * $orderItem['quantity'];
                        }
                    }

                    $date = Carbon::now()->addDays($setting->coupon_expiry_time)->format('Y-m-d');
                    MyCoupon::create([
                        'user_id' => $order->user_id,
                        'order_id' => $order->id,
                        'amount' => $totalDiscount,
                        'expiry_date' => $date,
                    ]);
                }

                return response()->json([
                    'code' => Response::HTTP_OK,
                    'status' => true,
                    'message' => __('messages.order_has_been_delivered_successfully'),
                    'data' => new OrderResource($order->makeHidden(['order_otp', 'order_items', 'order_date', 'address_id', 'assigned_id']))
                ]);
            }
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.invalid_otp'),
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
                'message' =>  __('messages.no_record_found'),
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


    public function myCoupons(Request $request)
    {
        try {
            $myCoupons = MyCoupon::sort()->orderByRaw('id DESC')->where('user_id', $request->get('authUserId'))->paginate(20);
            $wallet = Wallet::where('user_id', $request->get('authUserId'))->sum('amount');
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.my_coupon_list'),
                'data' => [
                    'wallet_amount' => !empty($wallet) ? $wallet : 0,
                    'coupons' => new MyCouponResource($myCoupons)
                ]
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
                'message' =>  __('messages.no_record_found'),
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

    public function couponMarkScratched(MyCouponRequest $request, String $id)
    {
        try {
            if ($id == 0) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => []
                ]);
            }

            $date = Carbon::now()->format('Y-m-d');
            $myCoupon = MyCoupon::findOrFail($id);

            if (!empty($myCoupon) && ($myCoupon->expiry_date < $date)) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.this_coupon_has_expired'),
                    'data' => []
                ]);
            }

            $myCoupon->status = 1;
            $myCoupon->save();

            $wallet = Wallet::where('user_id', $myCoupon->user_id)->first();
            if (!empty($wallet)) {
                $wallet->amount = $myCoupon->amount + ($wallet->amount);
            } else {
                $wallet = new Wallet();
                $wallet->amount = $myCoupon->amount;
                $wallet->user_id = $myCoupon->user_id;
            }
            $wallet->save();

            $walletHistory = new WalletHistory();
            $walletHistory->user_id = $myCoupon->user_id;
            $walletHistory->amount = $myCoupon->amount;
            $walletHistory->type = 'credit';
            $walletHistory->order_id = $myCoupon->order_id;
            $walletHistory->save();

            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' => __('messages.mark_coupon_as_Scratched_has_been_successfully'),
                'data' => new MyCouponResource($myCoupon)
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
                'message' =>  __('messages.no_record_found'),
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
