@extends('layouts.frontend')

@section('title', $story->title . ' - Cerita Angka BPS')

@section('content')
<!-- Hero Banner -->
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-4">
                <span class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-full text-sm">
                    {{ ucfirst($story->visualization_type) }}
                </span>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $story->title }}</h1>
            <p class="text-xl text-blue-100 mb-6">{{ $story->description }}</p>
            <div class="flex items-center text-blue-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <span>{{ $story->views }} views</span>
                <span class="mx-3">•</span>
                <span>{{ $story->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Visualization Content -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            @if($story->visualization_type === 'chart')
                <!-- Chart Visualization -->
                <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
                    <canvas id="mainChart" class="w-full" style="max-height: 500px;"></canvas>
                </div>
            @elseif($story->visualization_type === 'map')
                <!-- Map Visualization -->
                <div class="bg-white rounded-lg shadow-lg mb-8">
                    <div id="map" class="w-full" style="height: 600px; border-radius: 0.5rem;"></div>
                </div>
            @elseif($story->visualization_type === 'scrollytelling')
                <!-- Scrollytelling -->
                <div class="scrollytelling mb-8">
                    @if($story->content)
                        {!! $story->content !!}
                    @else
                        <section class="flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 p-12 rounded-lg">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-gray-800 mb-4">Mulai Scroll untuk Melihat Cerita</h2>
                                <p class="text-gray-600">Visualisasi data akan muncul saat Anda scroll ke bawah</p>
                            </div>
                        </section>
                    @endif
                </div>
            @elseif($story->visualization_type === 'infographic')
                <!-- Infographic -->
                <div class="mb-8">
                    @if($story->thumbnail)
                        <img src="{{ Storage::url($story->thumbnail) }}" alt="{{ $story->title }}" class="w-full rounded-lg shadow-lg">
                    @endif
                </div>
            @endif

            <!-- Story Content -->
            <div class="prose prose-lg max-w-none mb-12">
                {!! $story->content !!}
            </div>

            <!-- Dataset Info -->
            @if($story->dataset)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Sumber Data</h3>
                <p class="text-gray-700 mb-2">{{ $story->dataset->title }}</p>
                <p class="text-sm text-gray-600">{{ $story->dataset->source }} - Tahun {{ $story->dataset->year }}</p>
                <a href="{{ route('dataset.detail', $story->dataset->slug) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm mt-3 inline-block">
                    Lihat Dataset Lengkap →
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Related Stories -->
@if($relatedStories->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Cerita Terkait</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedStories as $related)
            <div class="bg-white rounded-lg p-6 hover:shadow-lg transition">
                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded">{{ ucfirst($related->visualization_type) }}</span>
                <h3 class="text-lg font-bold text-gray-800 mt-3 mb-2">{{ $related->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($related->description, 80) }}</p>
                <a href="{{ route('story.detail', $related->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Baca Selengkapnya →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@section('scripts')
<script>
@if($story->visualization_type === 'chart' && $story->chart_config)
    // Initialize Chart
    const ctx = document.getElementById('mainChart').getContext('2d');
    const chartConfig = @json($story->chart_config);
    
    new Chart(ctx, {
        type: chartConfig.type || 'bar',
        data: chartConfig.data || {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Data Sample',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(0, 102, 204, 0.5)',
                borderColor: 'rgba(0, 102, 204, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: chartConfig.title || 'Visualisasi Data'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            ...chartConfig.options
        }
    });
@endif

@if($story->visualization_type === 'map')
    // Initialize Map
    const map = L.map('map').setView([-7.0470, 112.7533], 10); // Bangkalan coordinates
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // Add marker for Bangkalan
    L.marker([-7.0470, 112.7533]).addTo(map)
        .bindPopup('<b>{{ $story->title }}</b><br>{{ $story->description }}')
        .openPopup();
    
    // You can add more markers based on your data
    @if($story->dataset && $story->dataset->data)
        const dataPoints = @json($story->dataset->data);
        // Add markers for each data point if coordinates are available
        // Example: dataPoints.forEach(point => { ... })
    @endif
@endif

@if($story->visualization_type === 'scrollytelling')
    // Scrollytelling effects
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const sections = document.querySelectorAll('.scrollytelling section');
        
        sections.forEach((section, index) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrolled >= sectionTop - window.innerHeight / 2 && scrolled < sectionTop + sectionHeight) {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }
        });
    });
@endif
</script>
@endsection
