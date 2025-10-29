<?php $__env->startSection('page_title', 'Tambah Cerita Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.stories.index')); ?>" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Cerita
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="<?php echo e(route('admin.stories.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Cerita *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="<?php echo e(old('title')); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                >
            </div>

            <!-- Slug -->
            <div class="md:col-span-2">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL)</label>
                <input 
                    type="text" 
                    id="slug" 
                    name="slug" 
                    value="<?php echo e(old('slug')); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Kosongkan untuk generate otomatis"
                >
                <p class="text-sm text-gray-500 mt-1">Akan otomatis dibuat dari judul jika dikosongkan</p>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                ><?php echo e(old('description')); ?></textarea>
            </div>

            <!-- Visualization Type -->
            <div>
                <label for="visualization_type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Visualisasi *</label>
                <select 
                    id="visualization_type" 
                    name="visualization_type" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option value="chart" <?php echo e(old('visualization_type') == 'chart' ? 'selected' : ''); ?>>Chart (Grafik)</option>
                    <option value="map" <?php echo e(old('visualization_type') == 'map' ? 'selected' : ''); ?>>Map (Peta)</option>
                    <option value="scrollytelling" <?php echo e(old('visualization_type') == 'scrollytelling' ? 'selected' : ''); ?>>Scrollytelling</option>
                    <option value="infographic" <?php echo e(old('visualization_type') == 'infographic' ? 'selected' : ''); ?>>Infographic</option>
                </select>
            </div>

            <!-- Dataset -->
            <div>
                <label for="dataset_id" class="block text-sm font-medium text-gray-700 mb-2">Dataset (Opsional)</label>
                <select 
                    id="dataset_id" 
                    name="dataset_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">-- Pilih Dataset --</option>
                    <?php $__currentLoopData = $datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dataset->id); ?>" <?php echo e(old('dataset_id') == $dataset->id ? 'selected' : ''); ?>>
                            <?php echo e($dataset->title); ?> (<?php echo e($dataset->year); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Thumbnail -->
            <div>
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                <input 
                    type="file" 
                    id="thumbnail" 
                    name="thumbnail" 
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Chart Config -->
            <div>
                <label for="chart_config" class="block text-sm font-medium text-gray-700 mb-2">Konfigurasi Chart (JSON)</label>
                <textarea 
                    id="chart_config" 
                    name="chart_config" 
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                    placeholder='{"type": "bar", "data": {...}, "options": {...}}'
                ><?php echo e(old('chart_config')); ?></textarea>
                <p class="text-sm text-gray-500 mt-1">Format JSON untuk konfigurasi Chart.js</p>
            </div>

            <!-- Content -->
            <div class="md:col-span-2">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Cerita</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="10"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                ><?php echo e(old('content')); ?></textarea>
                <p class="text-sm text-gray-500 mt-1">Gunakan HTML untuk formatting</p>
            </div>

            <!-- Is Featured -->
            <div>
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1"
                        <?php echo e(old('is_featured') ? 'checked' : ''); ?>

                        class="mr-2"
                    >
                    <span class="text-sm font-medium text-gray-700">Tandai sebagai cerita unggulan</span>
                </label>
            </div>

            <!-- Is Published -->
            <div>
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="is_published" 
                        value="1"
                        <?php echo e(old('is_published', true) ? 'checked' : ''); ?>

                        class="mr-2"
                    >
                    <span class="text-sm font-medium text-gray-700">Publikasikan cerita</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="<?php echo e(route('admin.stories.index')); ?>" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan Cerita
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const slug = document.getElementById('slug');
        if (!slug.value || slug.value === '') {
            slug.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/admin/stories/create.blade.php ENDPATH**/ ?>