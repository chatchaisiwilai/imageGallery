<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery');
    }

    public function postImage(Request $request)
    {
        $file = $request->file('file');
        return $file->getClientOriginalName();
    }
}
