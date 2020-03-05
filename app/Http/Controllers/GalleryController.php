<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImage;
use App\Images;
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
        try {
            $file = $request->file('file');
            $file_store = $file->store($this->path);

            $images = Images::create([
                'user_id' => Auth::id(),
                'name' => $file->getClientOriginalName(),
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'path' => $file_store,
            ]);

            $response = response($images, 200);
        } catch (\Exception $e) {
            $response = response([
                'errors' => [
                    'file' => [
                        'some Error'
                    ]
                ]], 400);
        }

        return $response;
    }

    public function getAllImage()
    {
        try {
            $images = Images::where('user_id', Auth::id())->get();

            $response = response($images, 200);
        } catch (\Exception $e) {
            $response = response($e->getMessage(), 400);
        }

        return $response;
    }

    public function getImage($id)
    {
        try {
            $images = Images::find($id);
            if (! $images ) {
                throw new \Exception('File not found in DB');
            }

            if (!Storage::exists($images->path)) {
                throw new \Exception('File not found in storage');
            }
            $file = Storage::get($images->path);

            $response = response($file, 200)->header('Content-Type', $images->mime);
        } catch (\Exception $e) {
            $response = response($e->getMessage(), 400);
        }

        return $response;
    }

    public function deleteImage($id)
    {
        try {
            $image = Images::find($id);
            if (! $image ) {
                throw new \Exception('File not found in DB');
            }

            Storage::delete($image->path);
            $image->delete();

            $response = response('success', 200);
        } catch (\Exception $e) {
            $response = response('file not found', 400);
        }

        return $response;
    }
}
