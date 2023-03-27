<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;


class ApiController extends Controller
{
    public function getImage($client_id, $filename)
    {
        $path = Storage::disk('public')->path("images/$client_id/$filename");
        $file = File::get($path);
        $type = File::mimeType($path);
        
        if (!file_exists($path)) {
            return null;
        }
        
        return (new Response($file, 200))->header('Content-Type', $type);
    }
}