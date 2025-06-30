<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <a href="<?php echo e(route('hotel')); ?>" class="btn btn-outline-secondary mb-3">← Назад на главную</a>
        <h2 class="mb-4 text-center">Избранные отели</h2>

        <div class="row">
            <!-- Sidebar фильтры -->
            <div class="col-md-3 mb-4">
                <div class="bg-light p-3 rounded shadow-sm">
                    <h5 class="mb-3">Фильтр</h5>
                    <form method="GET" action="<?php echo e(route('search-results')); ?>">

                        <div class="mb-3">
                            <label for="country_id" class="form-label">Страна</label>
                            <select class="form-select" id="country_id" name="country_id">
                                <option value="">Все страны</option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>" <?php echo e(request('country_id') == $country->id ? 'selected' : ''); ?>>
                                        <?php echo e($country->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="sort_by" class="form-label">Сортировать</label>
                            <select class="form-select" name="sort_by" id="sort_by">
                                <option value="rating" <?php echo e(request('sort_by') == 'rating' ? 'selected' : ''); ?>>По оценке</option>
                                <option value="price" <?php echo e(request('sort_by') == 'price' ? 'selected' : ''); ?>>По цене</option>
                            </select>
                        </div>


                        <label class="form-label">Звёзды отеля</label>
                        <?php for($i = 5; $i >= 1; $i--): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="stars[]" value="<?php echo e($i); ?>"
                                       id="stars<?php echo e($i); ?>"
                                    <?php echo e(is_array(request('stars')) && in_array($i, request('stars')) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="stars<?php echo e($i); ?>">
                                    <?php echo e(str_repeat('★', $i)); ?>

                                </label>
                            </div>
                        <?php endfor; ?>

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="no_stars" value="1"
                                   id="no_stars" <?php echo e(request('no_stars') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="no_stars">Отели без звёзд</label>
                        </div>

                        <!-- Кнопки -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Применить фильтры</button>
                            <a href="<?php echo e(route('search-results')); ?>" class="btn btn-link w-100 text-decoration-none">Сбросить фильтры</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Карточки отелей -->
            <div class="col-md-9">
                <?php if($filteredHotels->isEmpty()): ?>
                    <div class="alert alert-warning text-center" role="alert">
                        Отели не найдены.
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php $__currentLoopData = $filteredHotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                            <div class="col-12">
                                <div class="card h-100 shadow-sm rounded-4 d-flex flex-row overflow-hidden">
                                    <img src="<?php echo e($hotel->image ? asset('storage/images/hotels/' . $hotel->image) : asset('storage/images/hotels/default.jpg')); ?>"
                                         class="rounded-start-4" style="width: 250px; object-fit: cover;" alt="<?php echo e($hotel->name); ?>">

                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="mb-2">
                                                <span class="badge bg-warning text-dark fw-bold">
                                                    <?php echo e(number_format($hotel->rating, 1)); ?>

                                                </span>
                                                <span class="ms-2 text-muted">
                                                    <?php echo e($hotel->stars ? str_repeat('★', $hotel->stars) : 'Без звёзд'); ?>

                                                </span>
                                            </div>
                                            <h5 class="card-title fw-bold"><?php echo e($hotel->name); ?></h5>
                                            <p class="text-muted small"><?php echo e($hotel->city->name ?? ''); ?>, <?php echo e($hotel->country->name ?? ''); ?></p>
                                            <p class="mb-2 small"><?php echo e(Str::limit($hotel->description, 100)); ?></p>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-primary fs-5">Цена за ночь <?php echo e(number_format($hotel->price_per_night, 0, ',', ' ')); ?> $</span>
                                            <a href="<?php echo e(route('booking.create', $hotel->id)); ?>" class="btn btn-outline-primary btn-sm">Забронировать</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/search-results.blade.php ENDPATH**/ ?>