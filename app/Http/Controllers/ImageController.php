<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessResponse;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function get(Image $image)
    {
        return response()->file(Storage::disk('public')->path($image->path));
    }

    public function add(Request $request)
    {
        $file = $request->file('file');
        $fileName = uniqid('file_', true) . '.' . $file->getClientOriginalExtension() . 'webp';
        $path = $file->storeAs('public', $fileName);
        $image = Image::create([
            'path' => $path,
            'title' => $request->title ? $request->title : null,
            'alt' => $request->alt ? $request->alt : null,
            'style' => $request->style ? $request->style : null,
        ]);
        $image->save();
        return new SuccessResponse($image);
    }
}
