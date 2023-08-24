<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\TrendingOffer;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\TrendingOfferRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Category;

class TrendingOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trendingOffers = TrendingOffer::orderBy('id', 'desc')->get();
        return view('admin.trending-offers.index', compact('trendingOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __('messages.add_trending_offer');
        $trendingOffer = new TrendingOffer();
        $categories = Category::active()->sort()->get();
        return view('admin.trending-offers.create', compact('title', 'trendingOffer', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrendingOfferRequest $request)
    {
        try {
            $request->validated();
            if (!empty($request->is_pop_up == 1)) {
                TrendingOffer::isPopUp()->update(['is_pop_up' => 0]);
            }
            if (!empty($request->id)) {
                $trendingOffer = TrendingOffer::findorfail($request->id);
                $pathImage = 'public/trending-offers/' . $request->id . '/' . $trendingOffer->banner;
                $trendingOffer->update($request->all());
                $fileName = $trendingOffer->banner;
                $trendingOffer->status = ($request->status ?? 0);
                $trendingOfferId = $request->id;
                $message = __('messages.trending_offer_updated_successfully');
            } else {
                $trendingOffer = TrendingOffer::create($request->all());
                $trendingOfferId = $trendingOffer['id'];
                $fileName = null;
                $message = __('messages.trending_offer_create_successfully');
            }

            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $path = 'trending-offers/' . $trendingOfferId;
                $fileName = Helper::storeImage($file, $path);

                if (!empty($request->id) && !empty($fileName)) {
                    Helper::removeImage($pathImage);
                }
            }
            $trendingOffer->is_pop_up = ($request->is_pop_up ?? 0);
            $trendingOffer->banner = $fileName;
            $trendingOffer->save();
            return redirect()->to(localized_route('trending.offers'))->with('success', $message);
        } catch (QueryException $exception) {
            return back()->with('error', $exception->getMessage());
        } catch (ModelNotFoundException $exception) {
            return back()->with('error', $exception->getMessage());
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
        $title = __('messages.edit_trending_offer');
        $trendingOffer = TrendingOffer::findorfail($id);
        $categories = Category::active()->sort()->get();
        return view('admin.trending-offers.create', compact('title', 'trendingOffer', 'categories'));
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
