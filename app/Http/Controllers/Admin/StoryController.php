<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stories = Story::with('dataset')->latest()->paginate(15);
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        $datasets = Dataset::published()->get();
        return view('admin.stories.create', compact('datasets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:stories',
            'description' => 'nullable|string',
            'dataset_id' => 'nullable|exists:datasets,id',
            'visualization_type' => 'required|in:chart,map,scrollytelling,infographic',
            'chart_config' => 'nullable|json',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->has('chart_config')) {
            $validated['chart_config'] = json_decode($request->chart_config, true);
        }

        Story::create($validated);

        return redirect()->route('admin.stories.index')->with('success', 'Cerita berhasil ditambahkan!');
    }

    public function edit(Story $story)
    {
        $datasets = Dataset::published()->get();
        return view('admin.stories.edit', compact('story', 'datasets'));
    }

    public function update(Request $request, Story $story)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:stories,slug,' . $story->id,
            'description' => 'nullable|string',
            'dataset_id' => 'nullable|exists:datasets,id',
            'visualization_type' => 'required|in:chart,map,scrollytelling,infographic',
            'chart_config' => 'nullable|json',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($story->thumbnail) {
                Storage::disk('public')->delete($story->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->has('chart_config')) {
            $validated['chart_config'] = json_decode($request->chart_config, true);
        }

        $story->update($validated);

        return redirect()->route('admin.stories.index')->with('success', 'Cerita berhasil diupdate!');
    }

    public function destroy(Story $story)
    {
        if ($story->thumbnail) {
            Storage::disk('public')->delete($story->thumbnail);
        }
        
        $story->delete();

        return redirect()->route('admin.stories.index')->with('success', 'Cerita berhasil dihapus!');
    }
}
