<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Page;
use App\Models\Dataset;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredStories = Story::published()->featured()->latest()->take(3)->get();
        $latestStories = Story::published()->latest()->take(6)->get();
        $datasets = Dataset::published()->latest()->take(4)->get();
        
        return view('frontend.index', compact('featuredStories', 'latestStories', 'datasets'));
    }

    public function stories()
    {
        $stories = Story::published()->latest()->paginate(12);
        return view('frontend.stories', compact('stories'));
    }

    public function storyDetail($slug)
    {
        $story = Story::where('slug', $slug)->published()->firstOrFail();
        $story->incrementViews();
        $relatedStories = Story::where('id', '!=', $story->id)
            ->where('visualization_type', $story->visualization_type)
            ->published()
            ->latest()
            ->take(3)
            ->get();
        
        return view('frontend.story-detail', compact('story', 'relatedStories'));
    }

    public function datasets()
    {
        $datasets = Dataset::published()->latest()->paginate(12);
        return view('frontend.datasets', compact('datasets'));
    }

    public function datasetDetail($slug)
    {
        $dataset = Dataset::where('slug', $slug)->published()->firstOrFail();
        return view('frontend.dataset-detail', compact('dataset'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->published()->firstOrFail();
        return view('frontend.page', compact('page'));
    }

    public function about()
    {
        return view('frontend.about');
    }
}
