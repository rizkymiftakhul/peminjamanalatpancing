<?php

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class ImageHelper
{
    /**
     * Get image URL from storage path
     *
     * @param string|null $path
     * @param string|null $default
     * @return string
     */
    public static function getImageUrl(?string $path, ?string $default = null): string
    {
        if (!$path) {
            return $default ?? asset('images/no-image.png');
        }

        return URL::to('/storage/' . $path);
    }
}
