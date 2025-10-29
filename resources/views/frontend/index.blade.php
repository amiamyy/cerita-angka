@extends('layouts.frontend')

@section('title', 'Cerita Angka - BPS Kabupaten Bangkalan')

@section('content')
<!-- Hero Section -->
<section class="bps-gradient text-white py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Cerita Angka</h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Data Statistik BPS Bangkalan dalam Narasi Visual yang Menarik
            </p>
            <p class="text-lg text-blue-100 mb-8">
                Mengubah data kompleks menjadi kisah yang mudah dipahami melalui visualisasi interaktif, 
                infografis, dan scrollytelling yang modern.
            </p>
            <a href="{{ route('stories') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition inline-block">
                Jelajahi Cerita Data
            </a>
        </div>
    </div>
</section>

<!-- Featured Stories -->
@if($featuredStories->count() > 0)
<section class="py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center" data-aos="fade-up">Cerita Unggulan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredStories as $story)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                    @if($story->thumbnail)
                        <img src="{{ Storage::url($story->thumbnail) }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    @endif
                </div>
                
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full">
                            {{ ucfirst($story->visualization_type) }}
                        </span>
                        <span class="text-gray-400 text-sm ml-auto">{{ $story->views }} views</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $story->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($story->description, 100) }}</p>
                    
                    <a href="{{ route('story.detail', $story->slug) }}" class="text-blue-600 font-semibold hover:text-blue-800 inline-flex items-center">
                        Baca Cerita
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Stories -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-800" data-aos="fade-up">Cerita Terbaru</h2>
            <a href="{{ route('stories') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestStories as $story)
            <div class="border rounded-lg p-6 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded">{{ ucfirst($story->visualization_type) }}</span>
                <h3 class="text-lg font-bold text-gray-800 mt-3 mb-2">{{ $story->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($story->description, 80) }}</p>
                <a href="{{ route('story.detail', $story->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Baca Selengkapnya →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Datasets Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-800" data-aos="fade-up">Dataset Terbaru</h2>
            <a href="{{ route('datasets') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($datasets as $dataset)
            <div class="bg-white rounded-lg p-6 hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
                <span class="text-xs text-gray-500">{{ $dataset->category }}</span>
                <h3 class="text-lg font-bold text-gray-800 mt-2 mb-2">{{ $dataset->title }}</h3>
                <p class="text-sm text-gray-600 mb-4">Tahun: {{ $dataset->year }}</p>
                <a href="{{ route('dataset.detail', $dataset->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Lihat Detail →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bps-gradient text-white">
    <div class="container mx-auto px-6 text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Mulai Jelajahi Data Sekarang</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Temukan insight menarik dari data statistik BPS Bangkalan melalui visualisasi yang interaktif dan mudah dipahami.
        </p>
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="{{ route('stories') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition">
                Lihat Cerita Data
            </a>
            <a href="{{ route('datasets') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                Akses Dataset
            </a>
        </div>
    </div>
</section>
@endsection
