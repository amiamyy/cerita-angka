@extends('layouts.admin')

@section('page_title', 'Edit Halaman')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.pages.index') }}" class="text-blue-600 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium mb-2">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Konten</label>
                <textarea name="content" rows="15" class="w-full px-4 py-2 border rounded-lg">{{ old('content', $page->content) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Meta Description</label>
                <input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Banner Image</label>
                @if($page->banner_image)
                    <img src="{{ Storage::url($page->banner_image) }}" class="h-32 mb-2 rounded">
                @endif
                <input type="file" name="banner_image" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Order</label>
                <input type="number" name="order" value="{{ old('order', $page->order) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ $page->is_published ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium">Publikasikan</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.pages.index') }}" class="px-6 py-2 border rounded-lg">Batal</a>
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg">Update</button>
        </div>
    </form>
</div>
@endsection
