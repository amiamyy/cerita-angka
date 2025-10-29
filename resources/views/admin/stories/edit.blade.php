@extends('layouts.admin')

@section('page_title', 'Edit Cerita')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.stories.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.stories.update', $story) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $story->title) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $story->slug) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $story->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Visualisasi *</label>
                <select name="visualization_type" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="chart" {{ $story->visualization_type == 'chart' ? 'selected' : '' }}>Chart</option>
                    <option value="map" {{ $story->visualization_type == 'map' ? 'selected' : '' }}>Map</option>
                    <option value="scrollytelling" {{ $story->visualization_type == 'scrollytelling' ? 'selected' : '' }}>Scrollytelling</option>
                    <option value="infographic" {{ $story->visualization_type == 'infographic' ? 'selected' : '' }}>Infographic</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dataset</label>
                <select name="dataset_id" class="w-full px-4 py-2 border rounded-lg">
                    <option value="">-- Pilih Dataset --</option>
                    @foreach($datasets as $dataset)
                        <option value="{{ $dataset->id }}" {{ $story->dataset_id == $dataset->id ? 'selected' : '' }}>
                            {{ $dataset->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                @if($story->thumbnail)
                    <img src="{{ Storage::url($story->thumbnail) }}" class="h-20 mb-2 rounded">
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Chart Config (JSON)</label>
                <textarea name="chart_config" rows="3" class="w-full px-4 py-2 border rounded-lg font-mono text-sm">{{ old('chart_config', json_encode($story->chart_config)) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                <textarea name="content" rows="10" class="w-full px-4 py-2 border rounded-lg">{{ old('content', $story->content) }}</textarea>
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ $story->is_featured ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Cerita Unggulan</span>
                </label>
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ $story->is_published ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Publikasikan</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.stories.index') }}" class="px-6 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
