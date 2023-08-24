<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\AvailableZipcode;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\AvailableZipcodeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AvailableZipcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $availableZipcodes = AvailableZipcode::where('id', 1)->first();
        return view('admin.available-zipcodes.index', compact('availableZipcodes'));
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
    public function store(AvailableZipcodeRequest $request)
    {
        try {
            $request->validated();

            AvailableZipcode::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'zipcodes' => $request->zipcodes
                ]
            );
            return redirect()->to(localized_route('available.zipcodes'))->with('success', __('messages.available_zipcodes_has_been_updated_successfully'));
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
