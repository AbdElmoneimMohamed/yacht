<?php

namespace Utilities\Files;

use Illuminate\Http\Request;

trait UploadFiles
{
    public function uploadImage($image, $destinationPath)
    {
        $imageNameStr = $this->generateRandomString();
        $name         = $imageNameStr . time(). '.' .$image->getClientOriginalExtension();
        if (! \File::exists($destinationPath)) {
            \File::makeDirectory($destinationPath, 0777, true);
        }
        $image->move($destinationPath, $name);
        return $name;
    }

    function generateRandomString($length = 10)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
