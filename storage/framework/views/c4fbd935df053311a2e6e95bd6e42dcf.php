<?php $__env->startSection('title', $dataset->title . ' - Dataset BPS'); ?>

<?php $__env->startSection('content'); ?>
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <span class="bg-white bg-opacity-20 px-4 py-2 rounded-full text-sm"><?php echo e($dataset->category); ?></span>
            <h1 class="text-4xl font-bold mt-4 mb-4"><?php echo e($dataset->title); ?></h1>
            <p class="text-xl text-blue-100"><?php echo e($dataset->description); ?></p>
            <div class="flex items-center text-blue-100 mt-6">
                <span>Tahun: <?php echo e($dataset->year); ?></span>
                <span class="mx-3">•</span>
                <span><?php echo e($dataset->source); ?></span>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <?php if($dataset->file_path): ?>
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-8">
                <h3 class="text-lg font-bold mb-2">Download Dataset</h3>
                <p class="text-gray-700 mb-4">File dataset tersedia untuk diunduh</p>
                <a href="<?php echo e(Storage::url($dataset->file_path)); ?>" download class="bg-blue-600 text-white px-6 py-3 rounded-lg inline-flex items-center hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download File
                </a>
            </div>
            <?php endif; ?>

            <?php if($dataset->data): ?>
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h3 class="text-2xl font-bold mb-4">Preview Data</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border">
                        <thead class="bg-gray-50">
                            <tr>
                                <?php if(count($dataset->data) > 0): ?>
                                    <?php $__currentLoopData = array_keys($dataset->data[0]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="px-4 py-2 border"><?php echo e($header); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = array_slice($dataset->data, 0, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="px-4 py-2 border"><?php echo e($cell); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if(count($dataset->data) > 10): ?>
                    <p class="text-sm text-gray-500 mt-4">Menampilkan 10 dari <?php echo e(count($dataset->data)); ?> baris data</p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if($dataset->stories->count() > 0): ?>
            <div class="mt-8">
                <h3 class="text-2xl font-bold mb-4">Cerita Terkait Dataset Ini</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php $__currentLoopData = $dataset->stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border rounded-lg p-4">
                        <h4 class="font-bold text-lg"><?php echo e($story->title); ?></h4>
                        <p class="text-gray-600 text-sm mt-2"><?php echo e(Str::limit($story->description, 100)); ?></p>
                        <a href="<?php echo e(route('story.detail', $story->slug)); ?>" class="text-blue-600 text-sm mt-2 inline-block">Baca →</a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/frontend/dataset-detail.blade.php ENDPATH**/ ?>