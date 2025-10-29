<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pages = Page::orderBy('order')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages',
            'content' => 'nullable|string',
            'meta_description' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil ditambahkan!');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            'meta_description' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('banner_image')) {
            if ($page->banner_image) {
                Storage::disk('public')->delete($page->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diupdate!');
    }

    public function destroy(Page $page)
    {
        if ($page->banner_image) {
            Storage::disk('public')->delete($page->banner_image);
        }
        
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus!');
    }
}
