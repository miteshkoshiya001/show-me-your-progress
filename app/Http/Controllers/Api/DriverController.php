<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\RaceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Response;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $drivers = Driver::where(['race_type_id' => $request->rider_type_id ])->get();

            return response()->json([
                'code' => Response::HTTP_OK,
                'status' => true,
                'message' => "Driver List",
                'data' => new DriverResource($drivers)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
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
