<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\WishlistRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\WishlistResource;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Models\TrendingOffer;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // best selling product
            if($request->has('best_selling') && $request->get('best_selling') == 1) {
                $mostSoldProducts = OrderItem::select('product_id', \DB::raw('COUNT(product_id) as count'))->has('product')
                    ->groupBy('product_id')
                    ->orderBy('count', 'desc')
                    ->take(6)
                    ->get();
                if (!$mostSoldProducts->isEmpty()) {
                    $productIds = array_column($mostSoldProducts->toArray(), 'product_id');
                    $products = Product::active()->fullDetail()->whereIn('id', $productIds)->orderBy('sorting', 'asc')->get();
                    if (!empty($products)) {
                        return response()->json([
                            'code' => Response::HTTP_OK,
                            'status' => true,
                            'is_product_list' => true,
                            'message' =>  __('messages.product_list'),
                            'data' => new ProductResource($products)
                        ]);
                    }
                }
            }
            // exclusive offers
            if($request->has('exclusive_offer') && $request->get('exclusive_offer') == 1) {
                $categories = TrendingOffer::select(['category_id'])->whereNot('category_id', 0)->get();
                if (!$categories->isEmpty()) {
                    $categoryIds = array_column($categories->toArray(), 'category_id');
                    // Merge category_id parameters into the request
                    $request->merge([
                        'category_id' => implode(',', $categoryIds)
                    ]);
                }
            }
            $categories = [];
            if ($request->has('category_id') && $request->get('category_id')) {
                $categoryIds = explode(",", $request->get('category_id'));
                if (count($categoryIds) == 1) {
                    $categories = Category::active()->sort()->where('parent_id', $request->get('category_id'))->where(function ($query) use ($request) {

                        $search = $request->get('search');
                        if ($request->has('search') && $request->get('search')) {
                            $query->whereHas('translations', function ($subQuery) use ($search) {
                                $subQuery->where('name', 'like', "%$search%");
                            });
                        }
                    })->get();
                    if (count($categories) >= 1) {
                        $products = Product::has('category')->active()->fullDetail()->orderBy('sorting', 'asc')->where(['category_id' => $request->get('category_id')])->get();
                        $categories = $categories->concat($products);
                        return response()->json([
                            'code' => Response::HTTP_OK,
                            'status' => true,
                            'is_product_list' => false,
                            'message' =>  __('messages.subcategory_list'),
                            'data' => new CategoryResource($categories)
                        ]);
                    }
                }
            }
            $products = Product::has('category')->active()->fullDetail()->orderBy('sorting', 'asc')->where(function ($query) use ($request) {
                if ($request->has('search') && $request->get('search')) {
                    $search = $request->get('search');
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->whereHas('translations', function ($transQuery) use ($search) {
                            $transQuery->where('title', 'like', "%$search%")
                                ->orWhere('description', 'like', "%$search%");
                        })
                            ->orWhereHas('category.translations', function ($catTransQuery) use ($search) {
                                $catTransQuery->where('name', 'like', "%$search%");
                            });
                    });
                }
                if ($request->has('category_id') && $request->get('category_id')) {
                    $query->whereIn('category_id', explode(',', $request->get('category_id')));
                }
            })->get();
            if (!empty($products)) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'status' => true,
                    'is_product_list' => true,
                    'message' =>  __('messages.product_list'),
                    'data' => new ProductResource($products),
                    // 'categories' => new CategoryResource($categories),
                ]);
            }
        } catch (QueryException $exception) {
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

    /* 
    * Product detail
    */
    public function detail(int $id)
    {
        try {
            if (!$id) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => [],
                ]);
            }
            $products = Product::active()->fullDetail()->findorfail($id);
            if (!empty($products)) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'status' => true,
                    'message' =>  __('messages.product_detail'),
                    'data' => new ProductResource($products)
                ]);
            }
        } catch (QueryException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => [],
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => [],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }
    }

    /* 
        Add to wishlist product
    */
    public function addToWishlist(WishlistRequest $request, String $id)
    {
        try {
            if (!$id) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => [],
                ]);
            }
            Product::findOrFail($id);
            $wishlist = new Wishlist();
            $wishlist->user_id = $request->get('authUserId');
            $wishlist->product_id = $id;
            $wishlist->save();

            return response()->json([
                'code' => Response::HTTP_CREATED,
                'status' => true,
                'message' =>  __('messages.product_added_to_wishlist_successfully'),
                'data' => new WishlistResource($wishlist)
            ]);
        } catch (QueryException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => [],
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => [],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }
    }

    public function removeFromWishlist(WishlistRequest $request, String $id)
    {
        try {
            if (!$id) {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'status' => false,
                    'message' => __('messages.invalid_id'),
                    'data' => [],
                ]);
            }
            $wishlist = Wishlist::findOrFail($id);
            $wishlist->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' =>  __('messages.product_remove_to_wishlist_successfully'),
                'data' => []
            ]);
        } catch (QueryException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => [],
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => [],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }
    }

    public function wishlist(Request $request)
    {
        try {
            $wishlist = Wishlist::sort()->fullDetail()->where(['user_id' => $request->get('authUserId')])->paginate(20);
            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' =>  __('messages.add_to_wishlist_list'),
                'data' => new WishlistResource($wishlist)
            ]);
        } catch (QueryException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.something_went_wrong'),
                'data' => [],
            ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => __('messages.no_record_found'),
                'data' => [],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [],
            ]);
        }
    }
}
