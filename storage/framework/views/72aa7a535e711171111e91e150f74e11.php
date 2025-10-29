<?php $__env->startSection('title', 'Cerita Data - BPS Kabupaten Bangkalan'); ?>

<?php $__env->startSection('content'); ?>
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold mb-4">Cerita Data</h1>
        <p class="text-xl text-blue-100">Jelajahi data statistik dalam narasi visual yang menarik</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden" data-aos="fade-up">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                    <?php if($story->thumbnail): ?>
                        <img src="<?php echo e(Storage::url($story->thumbnail)); ?>" alt="<?php echo e($story->title); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    <?php endif; ?>
                </div>
                
                <div class="p-6">
                    <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full"><?php echo e(ucfirst($story->visualization_type)); ?></span>
                    <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2"><?php echo e($story->title); ?></h3>
                    <p class="text-gray-600 mb-4"><?php echo e(Str::limit($story->description, 100)); ?></p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500"><?php echo e($story->views); ?> views</span>
                        <a href="<?php echo e(route('story.detail', $story->slug)); ?>" class="text-blue-600 font-semibold hover:text-blue-800">
                            Baca →
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500">Belum ada cerita tersedia</p>
            </div>
            <?php endif; ?>
        </div>

        <div class="mt-8">
            <?php echo e($stories->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/frontend/stories.blade.php ENDPATH**/ ?>