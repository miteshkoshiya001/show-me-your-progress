<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommonActionController extends Controller
{
    public function destroy(Request $request)
    {
        try {
            $model = (new $request->object);
            $item = $model::findOrFail($request->id);
            $r = $model::find($request->id)->delete();
            if (get_class($model) == "App\Models\Category") {
                $pathImage = 'public/categories/' .$request->id. '/'. $item->image;
            }
            if (get_class($model) == "App\Models\AppUser") {
                $pathImage = 'public/user/' .$request->id. '/'. basename($item->avatar);
            }
            if (get_class($model) == "App\Models\TrendingOffer") {
                $pathImage = 'public/trending-offers/' .$request->id. '/'. basename($item->banner);
            }
            if (get_class($model) == "App\Models\ProductImages") {
                $pathImage = 'public/products/' .$item->product_id. '/'. $item->image;
            }
            if (get_class($model) == "App\Models\Product") {
                $productImages = ProductImages::where('product_id', $request->id)->get();
                foreach($productImages as $productImage){
                    $pathImage = 'public/products/' .$request->id. '/'. $productImage['image'];
                    if (!empty($pathImage)) {
                        Helper::removeImage($pathImage);
                    }
                }
            }
            if (!empty($pathImage)) {
                Helper::removeImage($pathImage);
            }
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Record deleted successfully',
                'data' => $r
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => 'Record deleted successfully',
                'data' => []
            ]);
        }
    }
}
