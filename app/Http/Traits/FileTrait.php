<?php

namespace App\Http\Traits;

use Exception;
use Intervention\Image\Facades\Image;

Trait FileTrait {

    public function uploadImageBase64($image, $path, $name)
    {
        if (!$this->checkIfValidBase64($image)) {
             return;
        }
        $mimeType = explode("/", Image::make($image)->mime());

        if ($mimeType[0] != 'image') {
            throw new Exception("Images only are valid to be uploaded", 400);
        }
        $iconName = $name . "." . $mimeType[1];
        Image::make($image)->save($path . $iconName);

        return $iconName;
    }

    public function checkIfValidBase64($image)
    {
        if (strpos($image, 'base64,')) {
            $image = explode('base64,', $image)[1];
            return base64_decode($image, true);
        }
    }
}
