<?php

namespace App\Http\Controllers;


use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminHeroImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $existingImages = HeroImage::orderBy('created_at', 'asc')->get();

        $errorMessages = []; // To store error messages for each image upload

        foreach ($request->file('images') as $index => $image) {
            if ($index < 4) {
                try {
                    if ($existingImages->count() > $index) {
                        // Update the existing image for this index
                        $existingImage = $existingImages[$index];
                        Storage::disk('public')->delete($existingImage->image_path);
                        $imagePath = $image->store('hero_images', 'public');
                        $existingImage->update(['image_path' => $imagePath]);
                    } else {
                        // Create a new image if there's no existing image for this index
                        $imagePath = $image->store('hero_images', 'public');
                        HeroImage::create([
                            'image_path' => $imagePath,
                        ]);
                    }
                } catch (\Exception $e) {
                    // Log the error for this image upload attempt
                    $errorMessages[] = "Error uploading image for index $index: " . $e->getMessage();
                }
            }
        }

        if (!empty($errorMessages)) {
            // Log all error messages and redirect back with a consolidated error message
            foreach ($errorMessages as $errorMessage) {
                Log::error($errorMessage);
            }
            return redirect()->back()->with('error', "Errors occurred while uploading images.");
        }

        return redirect()->route('admin.hero')->with('success', 'Images updated successfully.');
    }


    public function index(Request $request)
    {
        $existingImages = HeroImage::orderBy('created_at', 'asc')->get();

        return view('admin.hero-images', compact('existingImages'));
    }
}
