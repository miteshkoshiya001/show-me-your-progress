<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminOrderResource;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\AppUser;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::sort()->get();
        $deliveryPersons = AppUser::select(['id', 'name'])->sort()->active()->where('user_type', config('constants.user_types.DELIVERY_PERSON'))->get()->toArray();
        return view('admin.orders.index', compact('orders', 'deliveryPersons'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $orderItems = OrderItem::where(['order_numer' => $request->order_id])->get();
            $data['status'] = true;
            $data['message'] = __('messages.order_details_successfully');
            $data['data'] = ['content' => view('admin.orders.order-details', compact('orderItems'))->render()];
            return response()->json($data);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => __('messages.something_went_wrong'), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
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
        //
    }

    public function orderList(Request $request)
    {
        $orders = Order::fullDetail()->sort()->where(function ($query) use ($request) {
            if ($request->has('status') && $request->get('status') != '') {
                $query->where('status', $request->get('status'));
            } else {
                $query->where('status', '!=', config('constants.order_status.cancelled.value'));
            }

            if ($request->has('start_date') && $request->get('start_date') && $request->has('end_date') && $request->get('end_date')) {

                $query->whereDate('created_at', '>=', $request->get('start_date'))->whereDate('created_at', '<=', $request->get('end_date'));
            } else if ($request->has('start_date') && $request->get('start_date') && $request->get('end_date') == '') {

                $query->whereDate('created_at', $request->get('start_date'));
            }

            if ($request->has('today_date') && $request->get('today_date')) {
                $currentDate = Carbon::now()->format('Y-m-d');
                $query->whereDate('created_at', $currentDate);
            }
        })->get();
        return response()->json([
            'status' => true,
            'message' => "Order list",
            'data' => AdminOrderResource::collection($orders),
        ]);
    }

    public function statusChange(Request $request)
    {
        try {
            $ids = explode(',', $request->get('id'));
            if ($request->status == config('constants.order_status.shipped.value')) {
                foreach ($ids as $id) {
                    $order = Order::where('id', $id)->update([
                        'status' => $request->status,
                        'order_otp' => Helper::generateOTP(5),
                    ]);
                    OrderItem::where(['order_id' => $id])->update([
                        'status' => $request->status,
                    ]);
                }
            } else {
                $order = Order::whereIn('id', explode(',', $request->get('id')))->update([
                    'status' => $request->status
                ]);
                OrderItem::whereIn('order_id', explode(',', $request->get('id')))->update([
                    'status' => $request->status,
                ]);
                // dd($request->get('id'));
                if ($request->status == config('constants.order_status.cancelled.value')) {
                    $orderItems = OrderItem::where(['order_id' => $request->get('id')])->get();
                    foreach ($orderItems as $orderItem) {
                        $product = Product::find($orderItem->product_id);
                        if (!empty($product)) {
                            $product->stock = $product->stock + $orderItem->quantity;
                            $product->save();
                        }
                    }
                }
            }
            return response()->json(['status' => true, 'message' => __('messages.order_status_change_successfully'), 'data' => [$order]]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => __('messages.something_went_wrong'), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }

    public function assignedId(Request $request)
    {
        try {
            $orderIds = [];
            if ($request->id && !empty($request->id)) {
                $orderIds = explode(',', $request->id);
                if (!empty($orderIds)) {
                    Order::whereIn('id', $orderIds)->update(['assigned_id' => $request->assignedId]);
                }
            }
            return response()->json(['status' => true, 'message' => __('messages.order_assigned_delivery_has_been_successfully'), 'data' => []]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => __('messages.something_went_wrong'), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }
}
