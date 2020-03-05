<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImage;
use App\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private $path = 'images';
    public function index()
    {
        return view('gallery');
    }

    public function postImage(PostImage $request)
    {
        $file = $request->file('file');
        $file_store = $file->store($this->path);

        $images = Images::create([
            'user_id' => Auth::id(),
            'name' => $file->getClientOriginalName(),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'path' => $file_store,
        ]);

        return response($images, 200);
    }

    public function getAllImage()
    {
        $images = Images::where('user_id', Auth::id())->get();

        return response($images, 200);
    }

    public function getImage($id)
    {
        $images = Images::find($id);
        if ($images) {
            $file = Storage::get($images->path);
            return response($file, 200)->header('Content-Type', $images->mime);
        } else {
            return response('file not found', 400);
        }
    }

    public function deleteImage($id) {
        $image = Images::find($id);
        if ($image) {
            Storage::delete($image->path);
            $image->delete();

            return response('success', 200);
        } else {
            return response('file not found', 400);
        }
    }
}
