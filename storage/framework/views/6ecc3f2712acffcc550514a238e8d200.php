<?php
    $editing = isset($product) && $product->exists;
    $galleryValue = old('gallery_input', $editing ? implode(PHP_EOL, $product->gallery ?? []) : '');
    $optionsValue = old('options_input', $editing
        ? collect($product->options ?? [])
            ->map(function ($option) {
                if (is_array($option)) {
                    $label = trim((string) ($option['label'] ?? $option['value'] ?? ''));

                    if ($label === '') {
                        return null;
                    }

                    return array_key_exists('price', $option) && $option['price'] !== null
                        ? $label.'|'.number_format((float) $option['price'], 2, '.', '')
                        : $label;
                }

                return trim((string) $option);
            })
            ->filter()
            ->implode(PHP_EOL)
        : '');
    $primaryImageValue = old('image', $product->image ?? '');
    $existingGallery = collect(old('gallery_input')
        ? preg_split('/[\r\n,]+/', old('gallery_input'))
        : ($editing ? ($product->gallery ?? []) : []))
        ->map(fn ($image) => trim((string) $image))
        ->filter()
        ->values();
?>

<form action="<?php echo e($editing ? route('admin.products.update', $product) : route('admin.products.store')); ?>" method="POST" enctype="multipart/form-data" class="admin-card admin-form-card">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <div class="admin-card-head">
        <h2><?php echo e($editing ? 'Edit Product' : 'Create Product'); ?></h2>
        <p>Manage the live menu without touching the storefront template.</p>
    </div>

    <div class="admin-form-grid three-col">
        <div>
            <label class="admin-label">Category</label>
            <select name="category_id" class="admin-input" required>
                <option value="">Select category</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if((string) old('category_id', $product->category_id ?? '') === (string) $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label class="admin-label">Name</label>
            <input type="text" name="name" class="admin-input" value="<?php echo e(old('name', $product->name ?? '')); ?>" required>
        </div>
        <div>
            <label class="admin-label">SKU</label>
            <input type="text" name="sku" class="admin-input" value="<?php echo e(old('sku', $product->sku ?? '')); ?>" placeholder="auto-generated if blank">
        </div>
        <div>
            <label class="admin-label">Slug</label>
            <input type="text" name="slug" class="admin-input" value="<?php echo e(old('slug', $product->slug ?? '')); ?>" placeholder="auto-generated if blank">
        </div>
        <div>
            <label class="admin-label">Base Price</label>
            <input type="number" step="0.01" min="0" name="price" class="admin-input" value="<?php echo e(old('price', $product->price ?? '')); ?>" required>
            <p class="admin-helper">For products with option pricing, this auto-syncs to the lowest option price when saved.</p>
        </div>
        <div>
            <label class="admin-label">Compare Price</label>
            <input type="number" step="0.01" min="0" name="compare_price" class="admin-input" value="<?php echo e(old('compare_price', $product->compare_price ?? '')); ?>">
        </div>
        <div>
            <label class="admin-label">Badge</label>
            <input type="text" name="badge" class="admin-input" value="<?php echo e(old('badge', $product->badge ?? '')); ?>" placeholder="Bestseller, Hot, Chef Pick">
        </div>
        <div>
            <label class="admin-label">Rating</label>
            <input type="number" step="0.1" min="0" max="5" name="rating" class="admin-input" value="<?php echo e(old('rating', $product->rating ?? 5)); ?>">
        </div>
        <div>
            <label class="admin-label">Review Count</label>
            <input type="number" min="0" name="review_count" class="admin-input" value="<?php echo e(old('review_count', $product->review_count ?? 0)); ?>">
        </div>
        <div>
            <label class="admin-label">Sort Order</label>
            <input type="number" min="0" name="sort_order" class="admin-input" value="<?php echo e(old('sort_order', $product->sort_order ?? 0)); ?>">
        </div>
    </div>

    <div class="admin-upload-grid mt-3">
        <div class="admin-upload-card">
            <label class="admin-label">Main Product Image</label>
            <div class="admin-upload-preview" data-image-preview-target data-asset-base="<?php echo e(rtrim(url('/'), '/')); ?>/">
                <?php if(filled($primaryImageValue)): ?>
                    <img src="<?php echo e(asset($primaryImageValue)); ?>" alt="Primary preview">
                <?php else: ?>
                    <span>Primary preview</span>
                <?php endif; ?>
            </div>
            <div class="mt-3">
                <input type="file" name="image_file" class="admin-input" accept="image/jpeg,image/png,image/webp" data-image-preview-input>
                <p class="admin-helper">Upload a new main image or leave this blank and use the asset path field below.</p>
                <?php $__errorArgs = ['image_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="admin-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="admin-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mt-3">
                <label class="admin-label">Asset Path Fallback</label>
                <input type="text" name="image" class="admin-input" value="<?php echo e($primaryImageValue); ?>" placeholder="assets/images/product-1.png" data-image-path-input>
                <p class="admin-helper">Useful for existing theme images already inside `public/assets/images`.</p>
            </div>
        </div>

        <div class="admin-upload-card">
            <label class="admin-label">Gallery Uploads</label>
            <input type="file" name="gallery_files[]" class="admin-input" accept="image/jpeg,image/png,image/webp" multiple data-gallery-preview-input>
            <p class="admin-helper">Upload extra images for the product slider. Uploaded files are saved in `assets/images/uploads/products`.</p>
            <?php if($errors->has('gallery_files') || $errors->has('gallery_files.*')): ?>
                <p class="admin-error"><?php echo e($errors->first('gallery_files') ?: $errors->first('gallery_files.*')); ?></p>
            <?php endif; ?>
            <div class="admin-gallery-preview mt-3" data-gallery-preview-target>
                <?php $__empty_1 = true; $__currentLoopData = $existingGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="admin-gallery-thumb">
                        <img src="<?php echo e(asset($image)); ?>" alt="Gallery preview">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="admin-gallery-empty">Upload additional product shots or keep a single strong image.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="admin-form-grid two-col mt-3">
        <div>
            <label class="admin-label">Short Description</label>
            <textarea name="short_description" class="admin-textarea" rows="4" required><?php echo e(old('short_description', $product->short_description ?? '')); ?></textarea>
        </div>
        <div>
            <label class="admin-label">Options</label>
            <textarea name="options_input" class="admin-textarea" rows="4" placeholder="Small|10.00&#10;Large|12.00"><?php echo e($optionsValue); ?></textarea>
            <p class="admin-helper">Use one option per line. Add a price with `Option|Price` when the product has size or portion pricing.</p>
        </div>
    </div>

    <div class="mt-3">
        <label class="admin-label">Full Description</label>
        <textarea name="description" class="admin-textarea" rows="6" required><?php echo e(old('description', $product->description ?? '')); ?></textarea>
    </div>

    <div class="mt-3">
        <label class="admin-label">Gallery Image Paths</label>
        <textarea name="gallery_input" class="admin-textarea" rows="5" placeholder="One image path per line"><?php echo e($galleryValue); ?></textarea>
        <p class="admin-helper">Manual paths are still supported and will be merged with any uploaded gallery images.</p>
    </div>

    <div class="admin-form-grid two-col mt-3">
        <label class="admin-check">
            <input type="checkbox" name="featured" value="1" <?php if(old('featured', $editing ? $product->featured : false)): echo 'checked'; endif; ?>>
            <span>Feature this item on the storefront</span>
        </label>
        <label class="admin-check">
            <input type="checkbox" name="is_active" value="1" <?php if(old('is_active', $editing ? $product->is_active : true)): echo 'checked'; endif; ?>>
            <span>Show this product live</span>
        </label>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn"><?php echo e($editing ? 'Save Product' : 'Create Product'); ?></button>
        <a href="<?php echo e(route('admin.products.index')); ?>" class="admin-btn admin-btn-muted">Back</a>
    </div>
</form>
<?php /**PATH /Users/solomon/Herd/max-kebab/resources/views/admin/partials/product-form.blade.php ENDPATH**/ ?>