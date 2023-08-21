<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function generateCommonSticker($tempImagePath, $commonCirclePath, $config)
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
