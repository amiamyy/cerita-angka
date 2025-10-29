<?php $__env->startSection('page_title', 'Tambah Halaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.pages.index')); ?>" class="text-blue-600 inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="<?php echo e(route('admin.pages.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium mb-2">Judul *</label>
                <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Slug</label>
                <input type="text" name="slug" value="<?php echo e(old('slug')); ?>" class="w-full px-4 py-2 border rounded-lg">
                <p class="text-sm text-gray-500 mt-1">Kosongkan untuk generate otomatis</p>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Konten</label>
                <textarea name="content" rows="15" class="w-full px-4 py-2 border rounded-lg"><?php echo e(old('content')); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Meta Description</label>
                <input type="text" name="meta_description" value="<?php echo e(old('meta_description')); ?>" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Banner Image</label>
                <input type="file" name="banner_image" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Order (urutan tampil)</label>
                <input type="number" name="order" value="<?php echo e(old('order', 0)); ?>" class="w-full px-4 py-2 border rounded-lg">
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published', true) ? 'checked' : ''); ?> class="mr-2">
                    <span class="text-sm font-medium">Publikasikan</span>
                </label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="<?php echo e(route('admin.pages.index')); ?>" class="px-6 py-2 border rounded-lg">Batal</a>
            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg">Simpan</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mchyns/Documents/simantis/cerita-angka/resources/views/admin/pages/create.blade.php ENDPATH**/ ?>