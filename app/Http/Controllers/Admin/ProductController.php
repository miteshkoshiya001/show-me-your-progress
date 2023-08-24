<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\UOM;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\ProductImages;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc')->where(function ($query) use ($request) {
            if ($request->has('start_date') && $request->get('start_date') && $request->has('end_date') && $request->get('end_date')) {

                $query->whereDate('created_at', '>=', $request->get('start_date'))->whereDate('created_at', '<=', $request->get('end_date'));
            } else if ($request->has('start_date') && $request->get('start_date') && $request->get('end_date') == '') {

                $query->whereDate('created_at', $request->get('start_date'));
            }
        })->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __('messages.add_product');
        $categories = Category::active()->orderBy('id', 'desc')->get();
        $uoms = UOM::orderBy('id', 'desc')->get();
        return view('admin.products.create', compact('title', 'categories', 'uoms'));
    }

    /**
     * Store a newly created resource in storage. ProductRequest
     */
    public function store(ProductRequest $request)
    {
        try {
            $request->validated();

            if (!empty($request->id)) {
                $product = Product::find($request->id);
                $product->status = ($request->status ?? 0);
                $product->update($request->all());
                $productId = $request->id;
                $message  =  __('messages.product_has_been_update_successfully');
            } else {
                $productId = Product::create($request->all())->id;
                $message  =  __('messages.product_has_been_created_successfully');
            }
            session()->flash('success', $message);
            return response()->json(['status' => true, 'message' => $message, 'data' => ['product_id' => $productId]]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
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
        $title = __('messages.edit_product');
        $product = Product::find($id);
        $translations = $product->getTranslationsArray();
        $categories = Category::active()->orderBy('id', 'desc')->get();
        $uoms = UOM::orderBy('id', 'desc')->get();
        return view('admin.products.create', compact('title', 'categories', 'uoms', 'product', 'translations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function storeImages(Request $request, string $id = null)
    {
        try {
            if (!empty($id) && !empty($request->file('product_images'))) {
                foreach ($request->file('product_images') as $key => $image) {
                    $path = 'products/' . $id;
                    $fileName = Helper::storeImage($image[$key], $path);

                    if (!empty($fileName)) {
                        ProductImages::create(['product_id' => $id, 'image' => $fileName]);
                    }
                }
                return response()->json(['status' => true, 'message' => __('messages.product_image_has_been_store_successfully'), 'data' => []]);
            }
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function productImages(Request $request, $id)
    {
        $productImages = ProductImages::where('product_id', $id)->get();
        if (!$productImages->isEmpty()) {
            return response()->json(['status' => true, 'message' => 'Images found', 'data' => $productImages]);
        }
        return response()->json(['status' => false, 'message' => 'Images not nound', 'data' => []]);
    }
}
