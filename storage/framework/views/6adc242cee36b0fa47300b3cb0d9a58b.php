<?php $__env->startSection('page_title', 'Upload Dataset Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.datasets.index')); ?>" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="<?php echo e(route('admin.datasets.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Dataset *</label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg"><?php echo e(old('description')); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="IHK">Indeks Harga Konsumen (IHK)</option>
                    <option value="Kemiskinan">Kemiskinan</option>
                    <option value="Pertanian">Pertanian</option>
                    <option value="Ekonomi">Ekonomi</option>
                    <option value="Sosial">Sosial</option>
                    <option value="Demografi">Demografi</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                <input type="number" name="year" value="<?php echo e(old('year', date('Y'))); ?>" min="1900" max="<?php echo e(date('Y') + 1); ?>" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sumber</label>
                <input type="text" name="source" value="<?php echo e(old('source', 'BPS Bangkalan')); ?>" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload File Dataset</label>
                <input type="file" name="file" accept=".csv,.xlsx,.xls,.json" class="w-full px-4 py-2 border rounded-lg">
                <p class="text-sm text-gray-500 mt-1">Format: CSV, XLSX, XLS, JSON (Max 10MB)</p>
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published', true) ? 'checked' : ''); ?> class="mr-2">
                    <span class="text-sm font-medium text-gray-700">Publikasikan dataset</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="<?php echo e(route('admin.datasets.index')); ?>" class="px-6 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Upload Dataset</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/admin/datasets/create.blade.php ENDPATH**/ ?>