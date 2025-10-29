<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel - Cerita Angka BPS'); ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        :root {
            --bps-blue: #0066CC;
        }
        
        .sidebar-link.active {
            background-color: var(--bps-blue);
            color: white;
        }
    </style>
    
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen" x-data="{ sidebarOpen: true }">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-white shadow-lg transition-all duration-300">
            <div class="flex items-center justify-between p-6 border-b">
                <h1 :class="sidebarOpen ? 'block' : 'hidden'" class="text-xl font-bold" style="color: var(--bps-blue);">Admin Panel</h1>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <nav class="p-4">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link flex items-center p-3 rounded-lg mb-2 hover:bg-blue-50 <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : 'text-gray-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span :class="sidebarOpen ? 'ml-3' : 'hidden'">Dashboard</span>
                </a>
                
                <a href="<?php echo e(route('admin.stories.index')); ?>" class="sidebar-link flex items-center p-3 rounded-lg mb-2 hover:bg-blue-50 <?php echo e(request()->routeIs('admin.stories.*') ? 'active' : 'text-gray-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span :class="sidebarOpen ? 'ml-3' : 'hidden'">Cerita Data</span>
                </a>
                
                <a href="<?php echo e(route('admin.datasets.index')); ?>" class="sidebar-link flex items-center p-3 rounded-lg mb-2 hover:bg-blue-50 <?php echo e(request()->routeIs('admin.datasets.*') ? 'active' : 'text-gray-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                    <span :class="sidebarOpen ? 'ml-3' : 'hidden'">Dataset</span>
                </a>
                
                <a href="<?php echo e(route('admin.pages.index')); ?>" class="sidebar-link flex items-center p-3 rounded-lg mb-2 hover:bg-blue-50 <?php echo e(request()->routeIs('admin.pages.*') ? 'active' : 'text-gray-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    <span :class="sidebarOpen ? 'ml-3' : 'hidden'">Halaman</span>
                </a>
                
                <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="mt-8">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="sidebar-link flex items-center p-3 rounded-lg mb-2 hover:bg-red-50 text-red-600 w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span :class="sidebarOpen ? 'ml-3' : 'hidden'">Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm p-6 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-gray-800"><?php echo $__env->yieldContent('page_title', 'Dashboard'); ?></h2>
                <div class="flex items-center">
                    <span class="text-gray-600"><?php echo e(Auth::user()->name); ?></span>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6">
                <?php if(session('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
    
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/layouts/admin.blade.php ENDPATH**/ ?>