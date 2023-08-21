<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sticker;
use Illuminate\Http\Request;

class StickerApiController extends Controller
{
    public function getStickersByDriver($driverId)
    {
        $stickers = Sticker::where('driver_id', $driverId)->get();

        if ($stickers->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No stickers available for selected driver.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $stickers,
            'common' => config('constants.common_stickers')
        ]);
    }
    }
