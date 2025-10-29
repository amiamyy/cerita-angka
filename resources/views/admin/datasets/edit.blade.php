@extends('layouts.admin')

@section('page_title', 'Edit Dataset')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.datasets.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.datasets.update', $dataset) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $dataset->title) }}" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $dataset->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="IHK" {{ $dataset->category == 'IHK' ? 'selected' : '' }}>IHK</option>
                    <option value="Kemiskinan" {{ $dataset->category == 'Kemiskinan' ? 'selected' : '' }}>Kemiskinan</option>
                    <option value="Pertanian" {{ $dataset->category == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                    <option value="Ekonomi" {{ $dataset->category == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                    <option value="Sosial" {{ $dataset->category == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                    <option value="Demografi" {{ $dataset->category == 'Demografi' ? 'selected' : '' }}>Demografi</option>
                    <option value="Lainnya" {{ $dataset->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                <input type="number" name="year" value="{{ old('year', $dataset->year) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sumber</label>
                <input type="text" name="source" value="{{ old('source', $dataset->source) }}" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">File Saat Ini</label>
                @if($dataset->file_path)
                    <p class="text-sm text-gray-600 mb-2">{{ basename($dataset->file_path) }}</p>
                @endif
                <input type="file" name="file" accept=".csv,.xlsx,.xls,.json" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ $dataset->is_published ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Publikasikan</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.datasets.index') }}" class="px-6 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection
