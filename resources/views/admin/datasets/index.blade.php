@extends('layouts.admin')

@section('page_title', 'Kelola Dataset')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Daftar Dataset</h2>
    <a href="{{ route('admin.datasets.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Upload Dataset
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sumber</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($datasets as $dataset)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $dataset->title }}</div>
                    <div class="text-sm text-gray-500">{{ Str::limit($dataset->description, 50) }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $dataset->category }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $dataset->year }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $dataset->source }}</td>
                <td class="px-6 py-4">
                    @if($dataset->is_published)
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Published</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Draft</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm font-medium">
                    <div class="flex items-center space-x-3">
                        @if($dataset->file_path)
                            <a href="{{ Storage::url($dataset->file_path) }}" target="_blank" class="text-green-600 hover:text-green-900" title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                        @endif
                        <a href="{{ route('admin.datasets.edit', $dataset) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.datasets.destroy', $dataset) }}" method="POST" onsubmit="return confirm('Yakin hapus dataset ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                    Belum ada dataset. <a href="{{ route('admin.datasets.create') }}" class="text-blue-600">Upload dataset pertama</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $datasets->links() }}
</div>
@endsection
