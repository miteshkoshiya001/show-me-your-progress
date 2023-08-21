<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStickerController extends Controller
{
    public function index()
    {
        $stickers = Sticker::has('driver')->get();
        $drivers = Driver::all();

        return view('admin.stickers', compact('stickers', 'drivers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'sticker_template' => 'required|image|mimes:jpeg,png,jpg,gif',
            'template_x' => 'required|numeric',
            'template_y' => 'required|numeric',
            'template_width' => 'required|numeric',
            'template_height' => 'required|numeric',
        ]);

        // $stickerTemplatePath = $request->file('sticker_template')->store('public/sticker_templates');
        $stickerTemplatePath = $request->file('sticker_template')->store('stickers', 'public');

        // Remove "public/" from the path to be stored in the database
        $stickerTemplatePath = str_replace('public/', '', $stickerTemplatePath);

        Sticker::create([
            'driver_id' => $request->input('driver_id'),
            'sticker_template' => $stickerTemplatePath,
            'template_x' => $request->input('template_x'),
            'template_y' => $request->input('template_y'),
            'template_width' => $request->input('template_width'),
            'template_height' => $request->input('template_height'),
        ]);

        return redirect()->route('admin.stickers.index')->with('success', 'Sticker added successfully.');
    }


    public function edit($id)
    {
        $sticker = Sticker::findOrFail($id);
        $drivers = Driver::all();
        return view('admin.stickers', compact('sticker', 'drivers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'template_x' => 'required|integer|min:1',
            'template_y' => 'required|integer|min:1',
            'template_width' => 'required|integer|min:1',
            'template_height' => 'required|integer|min:1',
            'sticker_template' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $sticker = Sticker::findOrFail($id);

        // Delete old image if a new image is uploaded
        if ($request->hasFile('sticker_template')) {
            Storage::disk('public')->delete($sticker->sticker_template);
        }

        // Update sticker details
        $sticker->driver_id = $request->driver_id;
        $sticker->template_x = $request->template_x;
        $sticker->template_y = $request->template_y;
        $sticker->template_width = $request->template_width;
        $sticker->template_height = $request->template_height;

        // Update sticker image if a new image is uploaded
        if ($request->hasFile('sticker_template')) {
            $stickerTemplatePath = $request->file('sticker_template')->store('stickers', 'public');
            $sticker->sticker_template = $stickerTemplatePath;
        }

        $sticker->save();

        return redirect()->route('admin.stickers.index')->with('success', 'Sticker updated successfully.');
    }


    public function destroy($id)
    {
        $sticker = Sticker::findOrFail($id);
        $sticker->delete();

        return redirect()->route('admin.stickers.index')->with('success', 'Sticker deleted successfully.');
    }
}
