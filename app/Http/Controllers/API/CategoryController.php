<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'search' => 'nullable|min:3',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }
            $categories = Category::active()->where(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')) {
                    $search = $request->get('search');
                    $query->whereHas('translations', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', "%$search%");
                    });
                }else{
                    $query->where('parent_id', 0);
                }
            })->orderBy('sorting', 'ASC')->get();
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => __('messages.category_list'),
                'data' => new CategoryResource($categories)
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
