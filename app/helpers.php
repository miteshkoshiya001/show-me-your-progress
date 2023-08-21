<?php
if (!function_exists('createCircleImg')) {
    function createCircleImg($imagePath, $diameter,$newwidth,$newheight)
    {


        $width = imagesx($imagePath);
        $height = imagesy($imagePath);
        $image_s = imagecreatetruecolor($newwidth, $newheight);


        // Create a transparent PNG image
        $image = imagecreatetruecolor($diameter, $diameter);
        imagealphablending($image, false);
        imagesavealpha($image, true);
        $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $transparentColor);

        // Copy and resize the original image onto the new image
        imagecopyresampled($image, $image_s, 0, 0, 0, 0, $diameter, $diameter, $width, $height);

        // Create a mask for the circle
        $mask = imagecreatetruecolor($diameter, $diameter);
        imagealphablending($mask, false);
        imagesavealpha($mask, true);
        $transparentColor = imagecolorallocatealpha($mask, 0, 0, 0, 127);
        imagefill($mask, 0, 0, $transparentColor);
        imagefilledellipse($mask, round($diameter / 2), round($diameter / 2), $diameter, $diameter, imagecolorallocatealpha($mask, 255, 255, 255, 0));

        // Apply the mask to the circular image
        imagecopy($image, $mask, 0, 0, 0, 0, $diameter, $diameter);

        // Save the circular image as a PNG file
        $circleImagePath = 'img/uploads/circle.png';
        imagepng($image, public_path($circleImagePath));

        // Free memory
        imagedestroy($image_s);
        imagedestroy($image);
        imagedestroy($mask);

        return $circleImagePath;
    }
}

if (!function_exists('applyMasking')) {
    function applyMasking($backgroundImagePath, $circleImagePath, $positionX, $positionY)
    {
        $backgroundImage = imagecreatefrompng($backgroundImagePath);

        if ($backgroundImage === false) {
            return false;
        }

        // Preserve transparency
        imagesavealpha($backgroundImage, true);

        $circleImage = imagecreatefrompng($circleImagePath);

        if ($circleImage === false) {
            imagedestroy($backgroundImage);
            return false;
        }

        // Get circle image dimensions
        $circleWidth = imagesx($circleImage);
        $circleHeight = imagesy($circleImage);

        // Apply circular image on top of background
        imagecopy($backgroundImage, $circleImage, $positionX, $positionY, 0, 0, $circleWidth, $circleHeight);

        // Save output image as PNG
        $outputImagePath = 'img/uploads/output.png';
        imagepng($backgroundImage, public_path($outputImagePath));

        // Free memory
        imagedestroy($backgroundImage);
        imagedestroy($circleImage);

        return $outputImagePath;
    }

    if (!function_exists('addWatermark')) {
        function addWatermark($imagePath, $watermarkImagePath)
        {
            $image = imagecreatefrompng($imagePath);

            if ($image === false) {
                return false;
            }

            $watermark = imagecreatefrompng($watermarkImagePath);

            if ($watermark === false) {
                imagedestroy($image);
                return false;
            }

            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $watermarkWidth = imagesx($watermark);
            $watermarkHeight = imagesy($watermark);

            $margin = 10;
            $positionX = $imageWidth - $watermarkWidth - $margin;
            $positionY = $imageHeight - $watermarkHeight - $margin;

            imagecopy($image, $watermark, $positionX, $positionY, 0, 0, $watermarkWidth, $watermarkHeight);

            $outputImagePath = 'img/uploads/output_with_watermark.png';
            imagepng($image, public_path($outputImagePath));

            imagedestroy($image);
            imagedestroy($watermark);

            return $outputImagePath;
        }
    }

     function generateCommonSticker($tempImagePath, $commonCirclePath, $config)
    {
        $circleImageCommon = Image::make($tempImagePath)->fit(
            $config['temp_width'],
            $config['temp_height'],
            function ($constraint) {
                $constraint->upsize();
            }
        );
        $commonSticker = Image::make($commonCirclePath);
        $commonSticker->insert(
            $circleImageCommon,
            'top-left',
            $config['posx'],
            $config['posy']
        );

        return $commonSticker;
    }
}
