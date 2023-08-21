<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{

    public function index()
    {
        // Get all settings from the database
        $settings = Setting::all();

        return view('admin.setting', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingsData = $request->input('settings');

        foreach ($settingsData as $key => $value) {
            // Find the setting by key or create if it doesn't exist
            $setting = Setting::firstOrNew(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

}
