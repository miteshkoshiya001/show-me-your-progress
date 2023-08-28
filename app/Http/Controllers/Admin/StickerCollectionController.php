<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\StickerCategory;
use App\Models\StickerCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\StickerCollectionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class StickerCollectionController extends Controller
{
    public function index()
    {
        $collections = StickerCollection::all();
        return view('admin.stickers.collection.index', compact('collections'));
    }

    public function create()
    {
        $stickerCategories = StickerCategory::active()->get(); // Get the active sticker categories
        $title=__('messages.create_sticker_collection');


        return view('admin.stickers.collection.create', compact('stickerCategories','title'));
    }

    public function store(StickerCollectionRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if (!empty($request->id)) {
                $stickerCollection = StickerCollection::find($request->id);
                $message = __('messages.sticker_collection_updated_successfully');
            } else {
                $stickerCollection = new StickerCollection();
                $message = __('messages.sticker_collection_created_successfully');
            }

            $stickerCollection->sticker_category_id = $validatedData['sticker_category_id'];
            $stickerCollection->status = $request->has('status') ? 1 : 0;
            $stickerCollection->is_premium = $request->has('is_premium') ? 1 : 0;
            $stickerCollection->is_default = $request->has('is_default') ? 1 : 0;

            // Save the translated attributes using the provided $validatedData
            foreach (config('translatable.locales') as $locale) {
                $stickerCollection->translateOrNew($locale)->name = $validatedData[$locale]['name'];
            }

            $stickerCollection->save();

            return redirect()->to(localized_route('sticker-collection.index'))->with('success', $message);
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', $exception->getMessage());
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }



    public function edit(int $id)
    {
        $title = __('messages.edit_collection');
        $stickerCollection = StickerCollection::find($id);
        $translations = $stickerCollection->getTranslationsArray();
        $stickerCollections = StickerCollection::active()->whereNot('id', $id)->orderBy('id', 'DESC')->get();
        $stickerCategories = StickerCategory::active()->get(); // Get the active sticker categories


        // You can retrieve other data as needed for your view

        return view('admin.stickers.collection.create', compact('stickerCollection', 'translations', 'title', 'stickerCollections', 'stickerCategories'));
    }



}
