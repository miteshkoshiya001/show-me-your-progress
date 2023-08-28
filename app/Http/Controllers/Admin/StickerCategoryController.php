<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\StickerCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StickerCategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class StickerCategoryController extends Controller
{
    public function index()
    {
        $stickerCategories = StickerCategory::all();
        return view('admin.stickers.index', compact('stickerCategories'));
    }

    public function create()
    {
        $title = __('messages.sticker_category');

        return view('admin.stickers.create', compact('title'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:sticker_categories',
    //         'status' => 'required|in:0,1',
    //     ]);

    //     StickerCategory::create($request->all());

    //     return redirect()->route('sticker-categories.index')->with('success', 'Sticker category created successfully.');
    // }

    public function store(StickerCategoryRequest $request)
    {
        try {
            $request->validated();
            if (!empty($request->id)) {
                $stickerCategory = StickerCategory::find($request->id);
                $stickerCategory->update($request->all());
                $message = __('messages.sticker_category_updated_successfully');
                $stickerCategory->status = ($request->status ?? 0);
            } else {
                $stickerCategory = StickerCategory::create($request->all());
                $message = __('messages.sticker_category_created_successfully');
            }
            $stickerCategory->save();
            return redirect()->to(localized_route('sticker-categories'))->with('success', $message);
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', $exception->getMessage());
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function edit(int $id)
    {
        $title = __('messages.edit_sticker_category');
        $stickerCategory = StickerCategory::find($id);
        $translations = $stickerCategory->getTranslationsArray();
        $stickercategories = StickerCategory::active()->whereNot('id', $id)->orderBy('id', 'DESC')->get();

        // You can retrieve other data as needed for your view

        return view('admin.stickers.create', compact('stickerCategory', 'translations', 'title', 'stickercategories'));
    }


    public function destroy(StickerCategory $stickerCategory)
    {
        $stickerCategory->delete();

        return redirect()->route('sticker-categories.index')->with('success', 'Sticker category deleted successfully.');
    }
}
