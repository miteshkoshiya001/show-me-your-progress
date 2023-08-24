<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\TrendingOffer;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\TrendingOfferResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TrendingOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $trendingOffers = TrendingOffer::active()->orderBy('id', 'desc')->get();
            if (!empty($trendingOffers)) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'status' => true,
                    'message' =>  __('messages.trending_offer_list'),
                    'data' => new TrendingOfferResource($trendingOffers->makeHidden(['title', 'banner']))
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

    public function getPopUp()
    {
        try {
            $trendingOffer = TrendingOffer::active()->isPopUp()->firstorfail();
            if (!empty($trendingOffer)) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'status' => true,
                    'message' =>  __('messages.is_pop_up_in_trending_offers'),
                    'data' => new TrendingOfferResource($trendingOffer->makeHidden(['title', 'banner', 'is_pop_up']))
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
}
