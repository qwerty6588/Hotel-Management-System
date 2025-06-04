<?php $__env->startSection('content'); ?>
    <section id="search-results" class="py-5">
        <div class="container">
            <!-- Search Form (same as your existing one) -->
            <div class="search-form mb-5 bg-light p-4 rounded shadow-sm">
                <h2 class="text-center text-uppercase mb-4">Забронировать отель</h2>
                <form action="<?php echo e(route('search.hotels')); ?>" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="countrySelect" class="form-label">Страна</label>
                            <select name="country_id" id="countrySelect" class="form-select" required>
                                <option value="">Выберите страну</option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>" <?php echo e(request('country_id') == $country->id ? 'selected' : ''); ?>>
                                        <?php echo e($country->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="citySelect" class="form-label">Город</label>
                            <select name="city_id" id="citySelect" class="form-select" required>
                                <option value="">Выберите город</option>
                                <?php if(isset($cities)): ?>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>" <?php echo e(request('city_id') == $city->id ? 'selected' : ''); ?>>
                                            <?php echo e($city->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="check_in" class="form-label">Дата заезда</label>
                            <input type="date" name="check_in" id="check_in" class="form-control"
                                   value="<?php echo e(request('check_in')); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="check_out" class="form-label">Дата выезда</label>
                            <input type="date" name="check_out" id="check_out" class="form-control"
                                   value="<?php echo e(request('check_out')); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label for="guests" class="form-label">Гостей</label>
                            <input type="number" name="guests" id="guests" class="form-control"
                                   min="1" value="<?php echo e(request('guests', 1)); ?>" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-warning w-100">Поиск</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <?php if(isset($hotels) && count($hotels)): ?>
                <div class="results-header mb-4">
                    <h3 class="mb-3">Отели в <?php echo e($selectedCity->name ?? ''); ?></h3>
                    <p class="text-muted">
                        Найдено <?php echo e($hotels->total()); ?> отелей по вашему запросу
                        (<?php echo e(\Carbon\Carbon::parse(request('check_in'))->format('d.m.Y')); ?> -
                        <?php echo e(\Carbon\Carbon::parse(request('check_out'))->format('d.m.Y')); ?>,
                        <?php echo e(request('guests')); ?> гостей)
                    </p>
                </div>

                <!-- Hotels List -->
                <div class="hotels-list">
                    <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="hotel-card card mb-4 shadow-sm">
                            <div class="row g-0">
                                <!-- Hotel Image -->
                                <div class="col-md-4">
                                    <img src="<?php echo e($hotel->image_url ?? asset('images/default-hotel.jpg')); ?>"
                                         class="img-fluid rounded-start h-100" alt="<?php echo e($hotel->name); ?>">
                                </div>

                                <!-- Hotel Info -->
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h4 class="card-title mb-1">
                                                    <?php echo e($hotel->name); ?>

                                                    <span class="badge bg-primary ms-2"><?php echo e(str_repeat('★', $hotel->stars)); ?></span>
                                                </h4>
                                                <p class="text-muted mb-2"><?php echo e($hotel->type); ?></p>
                                                <p class="text-muted mb-2">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <?php echo e($hotel->address); ?>, <?php echo e($hotel->distance_to_center); ?> км до центра
                                                </p>
                                                <?php if($hotel->cashback): ?>
                                                    <p class="text-success mb-2">
                                                        <i class="fas fa-coins"></i> Кэшбэк трипкоинами <?php echo e($hotel->cashback); ?>%
                                                        <?php echo e(number_format($hotel->cashback_amount, 0, ',', ' ')); ?> ₽
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="rating-badge bg-success text-white p-2 rounded">
                                                <strong><?php echo e($hotel->rating); ?></strong> <?php echo e($hotel->rating_text); ?>

                                            </div>
                                        </div>

                                        <!-- Hotel Facilities -->
                                        <div class="facilities mt-3">
                                            <?php $__currentLoopData = $hotel->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="badge bg-light text-dark me-1 mb-1">
                                                <i class="<?php echo e($facility->icon); ?>"></i> <?php echo e($facility->name); ?>

                                            </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price and Booking -->
                                <div class="col-md-3">
                                    <div class="card-body h-100 d-flex flex-column justify-content-between">
                                        <div class="text-end">
                                            <h4 class="text-primary mb-0">
                                                <?php echo e(number_format($hotel->min_price, 0, ',', ' ')); ?> ₽
                                            </h4>
                                            <small class="text-muted">Включая налоги и сборы</small>
                                            <p class="mb-2">За <?php echo e($hotel->nights); ?> ночи</p>
                                            <?php if($hotel->free_cancellation): ?>
                                                <span class="badge bg-success">Бесплатная отмена</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-block" data-bs-toggle="collapse"
                                                    data-bs-target="#rooms-<?php echo e($hotel->id); ?>">
                                                Показать номера
                                            </button>
                                            <a href="<?php echo e(route('hotels.show', $hotel->id)); ?>" class="btn btn-outline-primary">
                                                Подробнее об отеле
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rooms Collapse -->
                            <div id="rooms-<?php echo e($hotel->id); ?>" class="collapse">
                                <div class="card-footer bg-light">
                                    <h5 class="mb-3">Доступные номера</h5>
                                    <div class="rooms-list">
                                        <?php $__currentLoopData = $hotel->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="room-item border-bottom pb-3 mb-3">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img src="<?php echo e($room->image_url ?? asset('images/default-room.jpg')); ?>"
                                                             class="img-thumbnail" alt="<?php echo e($room->type); ?>">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <h6><?php echo e($room->type); ?></h6>
                                                        <p class="small"><?php echo e($room->description); ?></p>
                                                        <div class="room-facilities">
                                                            <?php $__currentLoopData = $room->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="badge bg-light text-dark me-1 mb-1 small">
                                                                <i class="<?php echo e($facility->icon); ?>"></i> <?php echo e($facility->name); ?>

                                                            </span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                        <p class="mt-2">
                                                            <span class="badge bg-info">Площадь: <?php echo e($room->area); ?> м²</span>
                                                            <span class="badge bg-info ms-1">Мест: <?php echo e($room->capacity); ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3 text-end">
                                                        <h5 class="text-primary"><?php echo e(number_format($room->price, 0, ',', ' ')); ?> ₽</h5>
                                                        <p class="small">за <?php echo e($hotel->nights); ?> ночи</p>
                                                        <?php if($room->breakfast_included): ?>
                                                            <span class="badge bg-warning text-dark">Завтрак включен</span>
                                                        <?php endif; ?>
                                                        <div class="mt-3">
                                                            <a href="<?php echo e(route('booking.create', ['hotel' => $hotel->id, 'room' => $room->id])); ?>"
                                                               class="btn btn-success btn-sm">
                                                                Забронировать
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($hotels->appends(request()->query())->links()); ?>

                </div>
            <?php elseif(request()->has('country_id')): ?>
                <div class="alert alert-info">
                    По вашему запросу отелей не найдено. Пожалуйста, измените параметры поиска.
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .hotel-card {
            transition: transform 0.2s;
        }
        .hotel-card:hover {
            transform: translateY(-5px);
        }
        .rating-badge {
            font-size: 0.9rem;
            min-width: 60px;
            text-align: center;
        }
        .facilities .badge {
            font-size: 0.8rem;
        }
        .room-item {
            transition: background-color 0.2s;
        }
        .room-item:hover {
            background-color: #f8f9fa;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dynamic city loading
            document.getElementById('countrySelect').addEventListener('change', function() {
                const countryId = this.value;
                const citySelect = document.getElementById('citySelect');

                if (countryId) {
                    fetch(`/api/cities/${countryId}`)
                        .then(res => res.json())
                        .then(data => {
                            citySelect.innerHTML = '<option value="">Выберите город</option>';
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id;
                                option.textContent = city.name;
                                citySelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            citySelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                            console.error('Ошибка при загрузке городов:', error);
                        });
                } else {
                    citySelect.innerHTML = '<option value="">Сначала выберите страну</option>';
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/layouts/search-results.blade.php ENDPATH**/ ?>
