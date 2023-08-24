<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Wallet;
use App\Models\AppUser;
use Illuminate\Http\Request;
use App\Models\WalletHistory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = AppUser::orderBy('id', 'desc')->where(function ($query) use ($request) {
            if ($request->has('today_date') && $request->get('today_date')) {
                $currentDate = Carbon::now()->format('Y-m-d');
                $query->whereDate('created_at', $currentDate)->where(['user_type' => config('constants.user_types.CUSTOMER')]);
            }
            
            if ($request->has('start_date') && $request->get('start_date') && $request->has('end_date') && $request->get('end_date')) {

                $query->whereDate('created_at', '>=', $request->get('start_date'))->whereDate('created_at', '<=', $request->get('end_date'));
            } else if ($request->has('start_date') && $request->get('start_date') && $request->get('end_date') == '') {

                $query->whereDate('created_at', $request->get('start_date'));
            }
            if ($request->has('total_response') && $request->get('total_response') && $request->get('type') == '') {

                $query->where(['user_type' => config('constants.user_types.CUSTOMER')]);
            }

            if ($request->has('total_response') && $request->get('total_response') && $request->has('type') && $request->get('type')) {
                $query->where(['user_type' => config('constants.user_types.DELIVERY_PERSON')]);
            }
        })->get();
        return view('admin.users.index', compact('users'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Found',
                'data' => AppUser::findOrFail($id),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'No record found',
                'data' => [],
            ]);
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

    public function walletHistory(String $id)
    {
        try {
            $wallet = Wallet::where(['user_id' => $id])->first();
            $walletHistories = WalletHistory::where(['user_id' => $id])->orderBy('created_at', 'DESC')->get();
            $result['status'] = true;
            $result['message'] = __('messages.wallet_history');
            $result['data'] = ['content' => view('admin.users.wallet-history', compact('walletHistories', 'wallet', 'id'))->render()];
        } catch (\Exception $exception) {
            $result['message'] = $exception->getMessage();
        }
        return response()->json($result);
    }

    public function updateWallet(request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'amount' => 'required|numeric',
                'userWalletId' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'data' => []]);
            }

            $wallet = Wallet::where(['id' => $request->walletId])->first();
            if (!empty($wallet)) {
                $wallet->amount = $wallet->amount + $request->amount;
                $wallet->save();
            } else {
                $wallet = new Wallet();
                $wallet->amount = $request->amount;
                $wallet->user_id = $request->userWalletId;
                $wallet->save();
            }

            if ($request->amount < 0) {
                $type = 'debit';
            } else {
                $type = 'credit';
                // $type = 'credit';
            }

            WalletHistory::create([
                "user_id" => $request->userWalletId,
                "amount" => $request->amount,
                "type" => $type,
                "order_id" => 0
            ]);
            return response()->json(['status' => true, 'message' => __('messages.wallet_amount_has_been_updated_successfully'), 'data' => []]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => __('messages.something_went_wrong'), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }
}
