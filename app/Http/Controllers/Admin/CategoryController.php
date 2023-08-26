<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use App\Models\Product;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'DESC')->where(function ($query) use ($request) {
            if ($request->has('start_date') && $request->get('start_date') && $request->has('end_date') && $request->get('end_date')) {

                $query->whereDate('created_at', '>=', $request->get('start_date'))->whereDate('created_at', '<=', $request->get('end_date'));
            } else if ($request->has('start_date') && $request->get('start_date') && $request->get('end_date') == '') {

                $query->whereDate('created_at', $request->get('start_date'));
            }
        })->get();
        return view('admin.category.index', compact('categories'));
    }
    public function sorting()
    {
        $categories = Category::where('parent_id', 0)->orderBy('sorting')->get();
        return view('admin.category.sort-category', compact('categories'));
    }

    public function create()
    {
        $categories = Category::Active()->orderBy('id', 'DESC')->get();
        $title = __('messages.add_category');
        $category = new Category();
        return view('admin.category.create', compact('title', 'categories', 'category'));
    }

    public function edit(int $id = 0)
    {
        $title = __('messages.edit_category');
        $category = Category::find($id);
        $translations = $category->getTranslationsArray();
        $categories = Category::active()->whereNot('id', $id)->orderBy('id', 'DESC')->get();
        return view('admin.category.create', compact('category', 'translations', 'title', 'categories'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $request->validated();
            if (!empty($request->id)) {
                $category = Category::find($request->id);
                $category->update($request->all());
                $message  =  __('messages.category_updated_successfully');
                $category->status = ($request->status ?? 0);
                // $category->is_important = ($request->is_important ?? 0);
            } else {
                $category = Category::create($request->all());
                $message  =  __('messages.category_created_successfully');
            }
            $category->save();
            return redirect()->to(localized_route('categories'))->with('success', $message);
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', $exception->getMessage());
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function updateSorting(Request $request)
    {
        try {

            // dd($request->all());
            foreach ($request->order as $key => $value) {
                Category::where(["id" => $value['id']])->update(['sorting' => $value['position']]);
            }
            return response()->json(['status' => true, 'message' => __('messages.sorting_successfully'), 'data' => []]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }

    public function productSortingList($id)
    {
        $category = Category::where(['parent_id' => $id])->get();
        if (count($category) > 0) {
            $categoryId = $category->pluck('id')->toArray();
        } else {
            $categoryId = [$id];
        }
        $products = Product::orderBy('sorting')->whereIn('category_id', $categoryId)->get();
        return view('admin.category.sort-products', compact('products'));
    }

    public function updateSortingProduct(Request $request)
    {
        try {
            foreach ($request->order as $key => $value) {
                Product::where(["id" => $value['id']])->update(['sorting' => $value['position']]);
            }
            return response()->json(['status' => true, 'message' => __('messages.sorting_successfully'), 'data' => []]);
        } catch (QueryException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        } catch (Exception $exception) {
            return response()->json(['status' => false, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }
}
