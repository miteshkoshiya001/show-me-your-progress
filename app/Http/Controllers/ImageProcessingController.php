<?php

namespace App\Http\Controllers;

use App\Models\Sticker;
use App\Models\UserSticker;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ImageProcessingController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|string',
            'driver_id' => 'required|integer', // Validate driver_id
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Decode the base64 image data
        $base64Image = $request->input('image');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        // Create a temporary file to store the decoded image data
        $tempImagePath = tempnam(sys_get_temp_dir(), 'temp_image_') . '.png';
        file_put_contents($tempImagePath, $imageData);

        // Load the overlay image

        // Common watermark image
        $watermarkImagePath = public_path('img/watermark.png'); // Change this to the actual path of your watermark image
        $watermarkImage = Image::make($watermarkImagePath);
        // dd($watermarkImagePath);


        $driverStickers = Sticker::where('driver_id', $request->input('driver_id'))->get();

        $generatedImages = [];
        foreach ($driverStickers as $key => $sticker) {
            // Use Intervention Image to create a circular image
            $circleImage = Image::make($tempImagePath)->fit(
                $sticker->template_width,
                $sticker->template_height,
                function ($constraint) {
                    $constraint->upsize();
                }
            );
            $overlayImagePath = public_path('storage/' . $sticker->sticker_template);

            // Apply overlay masking using the template image
            $backgroundImage = Image::make($overlayImagePath);
            $backgroundImage->insert($circleImage, 'top-left', $sticker->template_x, $sticker->template_y);

            // Calculate the position to place the watermark at the center of the background image
            $watermarkX = ($backgroundImage->width() - $watermarkImage->width()) / 2;
            $watermarkY = ($backgroundImage->height() - $watermarkImage->height()) / 2;

            // Resize the watermark image to have a height half of the background image's height
            $watermarkImage->resize(null, $backgroundImage->height() / 2, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Apply watermark overlay at the center position
            $backgroundImageWithWatermark = clone $backgroundImage;
            $backgroundImageWithWatermark->insert($watermarkImage, 'center');

            $folderName = uniqid();
            $userId = $request->user()->id; // Replace with how you get the user ID
            $imageDirectory = 'img/uploads/' . $userId . '/' . $request->input('driver_id') . '/' . $folderName;
            $imagePath = public_path($imageDirectory);
            if (!is_dir($imagePath)) {
                mkdir($imagePath, 0777, true);
            }
            $imageName = uniqid() . '.png';
            $folderPath = 'img/uploads/' . $folderName;
            if (!is_dir(public_path($folderPath))) {
                mkdir(public_path($folderPath), 0777, true);
            }

            $outputImagePath = $imageDirectory . '/' . $imageName;

            $backgroundImage->save(public_path($outputImagePath));

            $outputImagePathWithWatermark = $folderPath .'/'.'wm_'.uniqid();
            $backgroundImageWithWatermark->save(public_path($outputImagePathWithWatermark),50);


            if ($key == 0) {
                $generatedImages['stk_path_1'] = $outputImagePath;
                $generatedImages['stk_path_4'] = $outputImagePathWithWatermark;
            }
            if ($key == 1) {
                $generatedImages['stk_path_2'] = $outputImagePath;
                $generatedImages['stk_path_5'] = $outputImagePathWithWatermark;
            }

            // Add the processed image and common sticker paths to an array
            $processedImages[] = [
                'sticker_id' => $sticker->id,
                'processedImageURL' => asset($outputImagePath),
                'processedImageWithWatermarkURL' => asset($outputImagePathWithWatermark)
            ];
        }

        // Generate common stickers
        $commonSticker = ImageHelper::generateCommonSticker(
            $tempImagePath,
            public_path(config('constants.common_stickers.austria.path')),
            config('constants.common_stickers.austria')
        );

        $commonOutputPath = 'img/uploads/' . $folderName . '/common_' . uniqid() . '.png';
        $commonSticker->save(public_path($commonOutputPath));

        $commonOutputPathWithWatermark = 'img/uploads/' . $folderName . '/common_output_with_watermark.png';
        $commonStickerWithWatermark = clone $commonSticker;
        $commonStickerWithWatermark->insert($watermarkImage, 'center');
        $commonStickerWithWatermark->save(public_path($commonOutputPathWithWatermark));
        $processedImages[] = [
            'processedImageURL' => asset($commonOutputPath),
            'processedImageWithWatermarkURL' => asset($commonOutputPathWithWatermark),
        ];
        $generatedImages['stk_path_3'] = $commonOutputPath;
        $generatedImages['stk_path_6'] = $commonOutputPathWithWatermark;

        /* Common Sticker Generate */
        $userSticker = new UserSticker();
        $userSticker->driver_id = $request->input('driver_id');
        $userSticker->user_id = $request->user()->id;
        $userSticker->stk_path_1 = $generatedImages['stk_path_1'] ?? null;
        $userSticker->stk_path_2 = $generatedImages['stk_path_2'] ?? null;
        $userSticker->stk_path_3 = $generatedImages['stk_path_3'] ?? null;
        $userSticker->stk_path_4 = $generatedImages['stk_path_4'] ?? null;
        $userSticker->stk_path_5 = $generatedImages['stk_path_5'] ?? null;
        $userSticker->stk_path_6 = $generatedImages['stk_path_6'] ?? null;


        $userSticker->save();
        // Delete the temporary image
        unlink($tempImagePath);

        return response()->json([
            'message' => 'Images processed successfully',
            'processedImages' => $processedImages,
        ]);
    }

    public function getDriverStickers($driverId)
    {
        $stickers = Sticker::where('driver_id', $driverId)->get();

        return response()->json([
            'status' => 'success',
            'data' => $stickers,
        ]);
    }
}
