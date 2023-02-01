<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function cimageShow(Request $request)
    {
        $path = env('COVER_DIR') . $request->id;
        if (!file_exists($path)) {
            // return response()->json(['error' => 'File not found'], 404);
            return abort(404);
        }
        
        header('Content-Type: ' . mime_content_type($path));
        readfile($path);
    }

    public function uimageShow(Request $request)
    {
        $path = env('PROFILE_DIR') . $request->id;
        if (!file_exists($path)) {
            return abort(404);
        }
        // return response()->file($path);
        
        header('Content-Type: ' . mime_content_type($path));
        readfile($path);
    }

    public function fileShow(Request $request)
    {
        $path = env('EBOOKS_DIR') . $request->id;
        if (!file_exists($path)) {
            return abort(404);
        }
        // return response()->file($path);
        return response()->file($path);
    }

    public function filesShow(Request $request)
    {
        $path = env('EBOOKS_DIR') . $request->file;
        if (!file_exists($path)) {
            return abort(404);
        }
        // return response()->file($path);
        return response()->file($path);
    }
}
