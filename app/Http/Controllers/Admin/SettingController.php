<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::where('id', 1)->first();
        return view('admin.setting.index', compact('settings'));
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
    public function store(SettingRequest $request)
    {
        try {
            $request->validated();

            Setting::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'min_item_count' => $request->min_item_count,
                    'min_order_amount' => $request->min_order_amount,
                    'coupon_expiry_time' => $request->coupon_expiry_time,
                    'privacy_policy_url' => $request->privacy_policy_url,
                    'terms_and_conditions' => $request->terms_and_conditions,
                ]
            );
            return back()->with('success', __('messages.setting_has_been_updated_successfully'));
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
