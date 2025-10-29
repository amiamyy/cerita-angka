<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Cerita Angka - BPS Kabupaten Bangkalan'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Website visualisasi data interaktif BPS Kabupaten Bangkalan'); ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Leaflet for Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
        :root {
            --bps-blue: #0066CC;
            --bps-light-blue: #E6F2FF;
            --bps-dark: #1a202c;
        }
        
        .bps-gradient {
            background: linear-gradient(135deg, var(--bps-blue) 0%, #0052A3 100%);
        }
        
        .scrollytelling {
            position: relative;
            overflow-y: scroll;
            scroll-snap-type: y mandatory;
        }
        
        .scrollytelling section {
            min-height: 100vh;
            scroll-snap-align: start;
        }
    </style>
    
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center">
                        <span class="text-2xl font-bold" style="color: var(--bps-blue);">Cerita Angka</span>
                        <span class="ml-2 text-sm text-gray-600">BPS Bangkalan</span>
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="<?php echo e(route('home')); ?>" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="<?php echo e(route('stories')); ?>" class="text-gray-700 hover:text-blue-600 transition">Cerita Data</a>
                    <a href="<?php echo e(route('datasets')); ?>" class="text-gray-700 hover:text-blue-600 transition">Dataset</a>
                    <a href="<?php echo e(route('about')); ?>" class="text-gray-700 hover:text-blue-600 transition">Tentang</a>
                </div>
                
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                <a href="<?php echo e(route('home')); ?>" class="block py-2 text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="<?php echo e(route('stories')); ?>" class="block py-2 text-gray-700 hover:text-blue-600">Cerita Data</a>
                <a href="<?php echo e(route('datasets')); ?>" class="block py-2 text-gray-700 hover:text-blue-600">Dataset</a>
                <a href="<?php echo e(route('about')); ?>" class="block py-2 text-gray-700 hover:text-blue-600">Tentang</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bps-gradient text-white mt-20">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Cerita Angka</h3>
                    <p class="text-blue-100">Menyajikan data statistik BPS Kabupaten Bangkalan melalui narasi visual yang menarik dan interaktif.</p>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo e(route('stories')); ?>" class="text-blue-100 hover:text-white">Cerita Data</a></li>
                        <li><a href="<?php echo e(route('datasets')); ?>" class="text-blue-100 hover:text-white">Dataset</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="text-blue-100 hover:text-white">Tentang Kami</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <p class="text-blue-100">BPS Kabupaten Bangkalan</p>
                    <p class="text-blue-100">Jawa Timur, Indonesia</p>
                    <p class="text-blue-100 mt-2">Email: bps3526@bps.go.id</p>
                </div>
            </div>
            
            <div class="border-t border-blue-400 mt-8 pt-8 text-center text-blue-100">
                <p>&copy; 2024 BPS Kabupaten Bangkalan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>