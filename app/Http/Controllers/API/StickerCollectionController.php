<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StickerCollection;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\StickerCollectionResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StickerCollectionController extends Controller
{

public function index(Request $request)
{
    try {
        $collections = StickerCollection::where('status', 1)->orderBy('id', 'ASC')->get();
        return response()->json([
            'code' => Response::HTTP_OK,
            'status' => true,
            'message' => __('messages.sticker_collection_list'),
            'data' => new StickerCollectionResource($collections)
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
