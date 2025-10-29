@extends('layouts.frontend')

@section('title', 'Dataset - BPS Kabupaten Bangkalan')

@section('content')
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold mb-4">Dataset BPS Bangkalan</h1>
        <p class="text-xl text-blue-100">Akses data statistik lengkap Kabupaten Bangkalan</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($datasets as $dataset)
            <div class="bg-white rounded-lg p-6 hover:shadow-lg transition" data-aos="fade-up">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">{{ $dataset->category }}</span>
                <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2">{{ $dataset->title }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($dataset->description, 80) }}</p>
                <p class="text-xs text-gray-500 mb-4">Tahun: {{ $dataset->year }} | {{ $dataset->source }}</p>
                <a href="{{ route('dataset.detail', $dataset->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Lihat Detail →
                </a>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada dataset tersedia</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $datasets->links() }}
        </div>
    </div>
</section>
@endsection
