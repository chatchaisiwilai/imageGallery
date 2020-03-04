<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'disk_usage_overview_size' => Images::sum('size'),
            'disk_usage_overview_count' => Images::count(),
            'disk_usage_compositions' => Images::selectRaw('mime, sum(size) as sum, count(id) as count')->groupBy('mime')->get()
        ];
        return view('home', $data);
    }
}
