<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\AppUser;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\PurchaseHistory;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }


    public function analytics(Request $request)
    {
        try {

            $currentDate = Carbon::now()->format('Y-m-d');
            $count['totalOrders'] = Order::where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                }
            })->count();
            $count['totalCustomer'] = AppUser::where(['user_type' => config('constants.user_types.CUSTOMER')])->where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('created_at', '>=', $request->get('startDate'))->whereDate('created_at', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('created_at', $request->get('startDate'));
                }
            })->count();
            $count['totalProducts'] = Product::where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('created_at', '>=', $request->get('startDate'))->whereDate('created_at', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('created_at', $request->get('startDate'));
                }
            })->count();
            $count['totalCategories'] = Category::where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('created_at', '>=', $request->get('startDate'))->whereDate('created_at', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('created_at', $request->get('startDate'));
                }
            })->count();
            $count['totalDeliveryPersons'] = AppUser::where(['user_type' => config('constants.user_types.DELIVERY_PERSON')])->where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('created_at', '>=', $request->get('startDate'))->whereDate('created_at', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('created_at', $request->get('startDate'));
                }
            })->count();
            $count['totalPayment'] = Order::where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                }
            })->sum('order_total');
            $count['totalPurchase'] = PurchaseHistory::where(function ($query) use ($request) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('created_at', '>=', $request->get('startDate'))->whereDate('created_at', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('created_at', $request->get('startDate'));
                }
            })->sum('price');
            $count['totalOrderPending'] = Order::whereStatus(config('constants.order_status.pending.value'))->where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                } else {
                    $query->whereDate('order_date', $currentDate);
                }
            })->count();
            $count['totalOrderInProgress'] = Order::whereStatus(config('constants.order_status.in progress.value'))->where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                } else {
                    $query->whereDate('order_date', $currentDate);
                }
            })->count();
            $count['totalOrderConfirmed'] = Order::whereStatus(config('constants.order_status.confirmed.value'))->where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                } else {
                    $query->whereDate('order_date', $currentDate);
                }
            })->count();
            $count['totalOrderShipped'] = Order::whereStatus(config('constants.order_status.shipped.value'))->where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                } else {
                    $query->whereDate('order_date', $currentDate);
                }
            })->count();
            $count['totalOrderDelivered'] = Order::whereStatus(config('constants.order_status.delivered.value'))->where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                } else {
                    $query->whereDate('order_date', $currentDate);
                }
            })->count();
            $count['totalOrderCancelled'] = Order::whereStatus(config('constants.order_status.cancelled.value'))->where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('order_date', '>=', $request->get('startDate'))->whereDate('order_date', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('order_date', $request->get('startDate'));
                } else {
                    $query->whereDate('order_date', $currentDate);
                }
            })->count();
            $count['todayNewCustomer'] = AppUser::where(['user_type' => config('constants.user_types.CUSTOMER')])->whereDate('created_at', $currentDate)->count();
            $count['todayOrder'] = Order::whereDate('order_date', $currentDate)->count();
            $count['todayPayment'] = Order::whereDate('order_date', $currentDate)->sum('order_total');
            $count['todayPurchase'] = PurchaseHistory::whereDate('created_at', $currentDate)->sum('price');

            $orderItems = OrderItem::where(function ($query) use ($request, $currentDate) {
                if ($request->has('startDate') && $request->get('startDate') && $request->has('endDate') && $request->get('endDate')) {
                    $query->whereDate('created_at', '>=', $request->get('startDate'))->whereDate('created_at', '<=', $request->get('endDate'));
                } else if ($request->has('startDate') && $request->get('startDate') && $request->get('startDate') != '') {
                    $query->whereDate('created_at', $request->get('startDate'));
                }else{
                    $query->whereDate('created_at', $currentDate);
                }
            })->get()->toArray();
            $orderItem = array_column($orderItems, 'product_id');
            $product = Product::select(['user_discount', 'id', 'price', 'actual_price', 'user_discount'])->whereIn('id', $orderItem)->get()->toArray();

            $profitLoss = 0;
            foreach ($orderItems as $orderItem) {
                $key = array_search($orderItem['product_id'], array_column($product, 'id'));
                if ($key !== false) {
                    $singleProdut = $product[$key];
                    $profitLoss += ($singleProdut['price'] * $orderItem['quantity']) - ($singleProdut['actual_price'] * $orderItem['quantity']) - ($singleProdut['user_discount'] * $orderItem['quantity']);
                    // dd(($singleProdut['price'] * $orderItem['quantity']) - ($singleProdut['actual_price'] * $orderItem['quantity']) - ($singleProdut['user_discount'] * $orderItem['quantity']));
                }
            }
            $count['totalProfitLoss'] = number_format($profitLoss, 2);


            return response()->json(['status' => true, 'message' => __('messages.coiunt_successfully'), 'data' => [$count]]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => __('messages.something_went_wrong'), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }
}
