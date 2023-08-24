<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PurchaseHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseHistoryRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchaseHistories = PurchaseHistory::sort()->where(function ($query) use ($request) {
            if ($request->has('today_date') && $request->get('today_date')) {
                $currentDate = Carbon::now()->format('Y-m-d');
                $query->whereDate('created_at', $currentDate);
            }

            if ($request->has('start_date') && $request->get('start_date') && $request->has('end_date') && $request->get('end_date')) {

                $query->whereDate('created_at', '>=', $request->get('start_date'))->whereDate('created_at', '<=', $request->get('end_date'));
            } else if ($request->has('start_date') && $request->get('start_date') && $request->get('end_date') == '') {

                $query->whereDate('created_at', $request->get('start_date'));
            }
        })->get();
        $products = Product::sort()->get();
        return view('admin.purchases.index', compact('purchaseHistories', 'products'));
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
    public function store(PurchaseHistoryRequest $request)
    {
        try {
            $product = Product::findOrFail($request->get('product_id'));
            $purchaseHistory = new PurchaseHistory();
            $purchaseHistory->product_id  = $request->get('product_id');
            $purchaseHistory->stock  = $request->get('stock');
            $purchaseHistory->description  = $request->get('description');
            $purchaseHistory->price  = $request->get('price');
            $purchaseHistory->save();

            $purchaseHistory->save($request->all());
            $product->stock = $product->stock + $request->get('stock');
            $product->save();
            return back()->with('success', __('messages.purchase_history_has_been_updated_successfully'));
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', 'Data not found');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
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
        //
    }
}
