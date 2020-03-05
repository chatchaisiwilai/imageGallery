<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dis_usage_compositions = Images::selectRaw('mime, sum(size) as sum, count(id) as count')
            ->where('user_id', Auth::id())
            ->groupBy('mime')->get();

        $data = [
            'disk_usage_overview_size' => Images::where('user_id', Auth::id())->sum('size'),
            'disk_usage_overview_count' => Images::where('user_id', Auth::id())->count(),
            'disk_usage_compositions' => $dis_usage_compositions,
        ];

        return view('home', $data);
    }
}
