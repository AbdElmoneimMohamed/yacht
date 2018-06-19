<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use App\Http\Controllers\Controller;

class AppBaseController extends Controller
{
    public function sendResponse($result, $code = 200)
    {
        return response()->json($result, $code);
    }

    public function sendError($errors, $code = 400)
    {
        $errorMessage = "";
        foreach ($errors as $key=>$error) {
            $errorMessage = $errors[$key][0];
            break;
        }
        return response()->json(["message" => "failed", "errors" => $errorMessage], $code);
    }

    public function sendErrorMessage($errorMessage, $code = 400)
    {
        return response()->json(["message" => "failed", "errors" => $errorMessage], $code);
    }

}
