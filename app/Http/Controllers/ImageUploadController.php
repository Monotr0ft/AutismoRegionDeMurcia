<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('upload');
        $imageName = $image->getClientOriginalName();
        $imagePath = public_path('assets/img');
        $image->move($imagePath, $imageName);
        return [
            'url' => asset('assets/img/'.$imageName)
        ];
    }

    public function deleteImage(Request $request)
    {
        
    }

}
