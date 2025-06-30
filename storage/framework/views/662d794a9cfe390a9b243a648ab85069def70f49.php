<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <a href="<?php echo e(route('hotel')); ?>" class="btn btn-outline-secondary mb-3">← Назад</a>
        <h2 class="text-center mb-4">Оплата бронирования: <?php echo e($hotel->name); ?></h2>

        <form method="POST" action="<?php echo e(route('booking.pay', $hotel->id)); ?>" class="row" style="gap: 30px;">
            <?php echo csrf_field(); ?>

            <!-- Платёжные данные -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment options</h4>
                        <p class="text-muted mb-0">Выберите подходящий способ</p>
                    </div>
                    <div class="card-body">
                        <h6 class="my-2">Имя на карте: <strong><?php echo e(auth()->user()->name ?? 'Имя пользователя'); ?></strong></h6>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="method1" value="card" checked>
                            <label class="form-check-label" for="method1">Карта 12XX XXXX XXXX 0000</label>
                        </div>
                        <div class="form-inline my-3">
                            <label class="form-label me-2" for="cvv">Введите CVV</label>
                            <input type="password" name="cvv" id="cvv" class="form-control w-auto" maxlength="3" required>
                            <button type="submit" class="btn btn-primary ms-2">Продолжить</button>
                        </div>

                        <hr>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="method2" value="credit">
                            <label class="form-check-label" for="method2">Кредитная / Дебетовая карта</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="method3" value="netbanking">
                            <label class="form-check-label" for="method3">Интернет-банкинг</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="method4" value="emi">
                            <label class="form-check-label" for="method4">Рассрочка</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="method5" value="cod">
                            <label class="form-check-label" for="method5">Оплата при заселении</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Детали заказа -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Price Details</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Цена за 1 ночь</span>
                                <strong><?php echo e(number_format($hotel->price_per_night, 0, ',', ' ')); ?> $</strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <span><strong>Итого к оплате</strong></span>
                                <strong><?php echo e(number_format($hotel->price_per_night, 0, ',', ' ')); ?> $</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/booking/
 * create.blade.php ENDPATH**/ ?>
