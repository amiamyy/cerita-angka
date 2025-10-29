<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Dataset;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $totalStories = Story::count();
        $totalDatasets = Dataset::count();
        $totalPages = Page::count();
        $totalViews = Story::sum('views');
        
        $recentStories = Story::latest()->take(5)->get();
        $popularStories = Story::orderBy('views', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalStories',
            'totalDatasets',
            'totalPages',
            'totalViews',
            'recentStories',
            'popularStories'
        ));
    }
}
