<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function out( $data = null, $status = '', $error = null, $code =200)
    {
       return \response()->json(
              [
                    'status' => $status,
                    'data' => $data,
                    'error' => $error
              ], $code
        );
    }
}