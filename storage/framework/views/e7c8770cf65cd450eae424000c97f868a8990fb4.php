<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Search Results</h2>

        <?php if($filteredHotels->isEmpty()): ?>
            <div class="alert alert-warning text-center" role="alert">
                No hotels found.
            </div>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php $__currentLoopData = $filteredHotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card h-100 shadow border-0 rounded-4">
                            <img src="<?php echo e($hotel->image ? asset('images/hotels/' . $hotel->image) : asset('images/hotels/')); ?>"
                                 class="card-img-top rounded-top-4" alt="<?php echo e($hotel->name); ?>" style="height: 200px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><?php echo e($hotel->name); ?></h5>

                                <ul class="list-unstyled small mb-3">
                                    <li><strong>Country:</strong> <?php echo e($hotel->country->name ?? '—'); ?></li>
                                    <li><strong>City:</strong> <?php echo e($hotel->city->name ?? '—'); ?></li>
                                    <li><strong>Price:</strong> <?php echo e(number_format($hotel->price_per_night, 0, ',', ' ')); ?> $SS / night</li>
                                    <li><strong>Rating:</strong> <?php echo e(number_format($hotel->rating, 1)); ?>/10</li>
                                </ul>

                                <p class="card-text flex-grow-1"><?php echo e(Str::limit($hotel->description, 100)); ?></p>

                                <a href="<?php echo e(route('hotel.show', $hotel->id)); ?>" class="btn btn-outline-primary mt-auto">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/search-results.blade.php ENDPATH**/ ?>