@extends('layouts.frontend')

@section('title', $dataset->title . ' - Dataset BPS')

@section('content')
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm">{{ $dataset->category }}</span>
            <h1 class="text-4xl font-bold mt-4 mb-4">{{ $dataset->title }}</h1>
            <p class="text-xl text-blue-100">{{ $dataset->description }}</p>
            <div class="flex items-center text-blue-100 mt-6">
                <span>Tahun: {{ $dataset->year }}</span>
                <span class="mx-3">•</span>
                <span>{{ $dataset->source }}</span>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            @if($dataset->file_path)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-8">
                <h3 class="text-lg font-bold mb-2">Download Dataset</h3>
                <p class="text-gray-700 mb-4">File dataset tersedia untuk diunduh</p>
                <a href="{{ Storage::url($dataset->file_path) }}" download class="bg-blue-600 text-white px-6 py-3 rounded-lg inline-flex items-center hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download File
                </a>
            </div>
            @endif

            @if($dataset->data)
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h3 class="text-2xl font-bold mb-4">Preview Data</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-50">
                            <tr>
                                @if(count($dataset->data) > 0)
                                    @foreach(array_keys($dataset->data[0]) as $header)
                                        <th class="px-4 py-2 border">{{ $header }}</th>
                                    @endforeach
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(array_slice($dataset->data, 0, 10) as $row)
                            <tr>
                                @foreach($row as $cell)
                                    <td class="px-4 py-2 border">{{ $cell }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($dataset->data) > 10)
                    <p class="text-sm text-gray-500 mt-4">Menampilkan 10 dari {{ count($dataset->data) }} baris data</p>
                @endif
            </div>
            @endif

            @if($dataset->stories->count() > 0)
            <div class="mt-8">
                <h3 class="text-2xl font-bold mb-4">Cerita Terkait Dataset Ini</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($dataset->stories as $story)
                    <div class="border rounded-lg p-4">
                        <h4 class="font-bold text-lg">{{ $story->title }}</h4>
                        <p class="text-gray-600 text-sm mt-2">{{ Str::limit($story->description, 100) }}</p>
                        <a href="{{ route('story.detail', $story->slug) }}" class="text-blue-600 text-sm mt-2 inline-block">Baca →</a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
