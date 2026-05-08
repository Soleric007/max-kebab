<?php
    $title = 'Contact Us | Max Kebab';
    $description = 'Visit, call, or send a message to Max Kebab at 53 Harborough Rd, Kingsthorpe, Northampton NN2 7SH.';
?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.page-hero', [
        'pageTitle' => 'Contact Us',
        'pageSubtitle' => 'Visit the shop, place an order, or ask us a question',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us'],
        ],
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="contact-us-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">Visit The Shop</h3>
                        </div>
                        <div class="contact-item-info">
                            <div class="contact-info-list">
                                <h3>Address</h3>
                                <p><?php echo e($brand['address']); ?></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Service</h3>
                                <p><?php echo e($brand['service_modes']); ?></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Directions</h3>
                                <p><a href="<?php echo e($brand['map_url']); ?>" target="_blank" rel="noopener">Open in Google Maps</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">Call Us</h3>
                        </div>
                        <div class="contact-item-info">
                            <div class="contact-info-list">
                                <h3>Phone</h3>
                                <p><a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>"><?php echo e($brand['phone_display']); ?></a></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Best For</h3>
                                <p>Orders, delivery checks, collections, and quick questions</p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Hours</h3>
                                <p><?php echo e($brand['hours_note']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">What To Expect</h3>
                        </div>
                        <div class="contact-item-info">
                            <?php $__currentLoopData = $brand['highlights']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="contact-info-list">
                                    <h3><?php echo e($loop->iteration); ?>.</h3>
                                    <p><?php echo e($highlight); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-8 order-5 order-lg-0 pb-30">
                    <div class="comment-area">
                        <div class="sub-section-title">
                            <h3 class="color-white">Leave A Message</h3>
                            <p>We will get back to you as soon as we can.</p>
                        </div>
                        <div class="comment-form mt-30">
                            <form action="<?php echo e(route('contact.send')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" placeholder="Name*" value="<?php echo e(old('name')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email*" value="<?php echo e(old('email')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone*" value="<?php echo e(old('phone')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="subject" class="form-control" placeholder="Subject*" value="<?php echo e(old('subject')); ?>" required>
                                            </div>
                                            <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <textarea name="message" class="form-control" rows="8" placeholder="Your Message*"><?php echo e(old('message')); ?></textarea>
                                            </div>
                                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <div class="form-check agree-label">
                                                <input name="terms" class="form-check-input" type="checkbox" id="contactTerms" value="1" required>
                                                <label class="form-check-label" for="contactTerms">
                                                    I understand this form is for enquiries, delivery questions, and order arrangements.
                                                </label>
                                            </div>
                                            <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <button class="btn full-width" type="submit">
                                            Send A Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 order-4 order-lg-0 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">Shop Details</h3>
                        </div>
                        <div class="contact-item-info">
                            <div class="contact-info-list">
                                <h3>Address</h3>
                                <p><?php echo e($brand['address']); ?></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Phone</h3>
                                <p><a href="tel:<?php echo e(preg_replace('/\s+/', '', $brand['phone'])); ?>"><?php echo e($brand['phone_display']); ?></a></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Order Type</h3>
                                <p><?php echo e($brand['service_modes']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="map-section p-tb-100 bg-black">
        <div class="container">
            <div class="google-map-content">
                <iframe src="https://www.google.com/maps?q=53%20Harborough%20Rd,%20Kingsthorpe,%20Northampton%20NN2%207SH,%20United%20Kingdom&output=embed" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/solomon/Herd/max/max-kebab/resources/views/pages/contact.blade.php ENDPATH**/ ?>