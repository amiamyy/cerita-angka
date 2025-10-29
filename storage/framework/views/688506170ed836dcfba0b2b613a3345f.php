<?php $__env->startSection('title', 'Dataset - BPS Kabupaten Bangkalan'); ?>

<?php $__env->startSection('content'); ?>
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold mb-4">Dataset BPS Bangkalan</h1>
        <p class="text-xl text-blue-100">Akses data statistik lengkap Kabupaten Bangkalan</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-lg p-6 hover:shadow-lg transition" data-aos="fade-up">
                <div class="text-blue-600 mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                    </svg>
                </div>
                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded"><?php echo e($dataset->category); ?></span>
                <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2"><?php echo e($dataset->title); ?></h3>
                <p class="text-sm text-gray-600 mb-2"><?php echo e(Str::limit($dataset->description, 80)); ?></p>
                <p class="text-xs text-gray-500 mb-4">Tahun: <?php echo e($dataset->year); ?> | <?php echo e($dataset->source); ?></p>
                <a href="<?php echo e(route('dataset.detail', $dataset->slug)); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                    Lihat Detail →
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada dataset tersedia</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-8">
            <?php echo e($datasets->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/frontend/datasets.blade.php ENDPATH**/ ?>