<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <a href="<?php echo e(route('search-results')); ?>" class="btn btn-outline-secondary mb-4">← Назад</a>
        <h1 class="text-center mb-4"><?php echo e($hotel->name); ?></h1>
        
        <form method="POST" action="<?php echo e(route('booking.pay', $hotel->id)); ?>" class="row g-4">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="pricePerNight" value="<?php echo e($hotel->price_per_night); ?>">


            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-3 fw-semibold">Даты проживания</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Дата заезда</label>
                                <input type="date" class="form-control" id="checkIn" name="check_in" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Дата выезда</label>
                                <input type="date" class="form-control" id="checkOut" name="check_out" required>
                            </div>
                        </div>

                        <h5 class="mb-3 fw-semibold">Способ оплаты</h5>
                        <p class="text-muted">Выберите удобный способ</p>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="method1" value="card" checked>
                            <label class="form-check-label" for="method1">Карта 12XX XXXX XXXX 0000</label>
                        </div>

                        <div class="row align-items-center mb-4">
                            <div class="col-md-4">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="password" name="cvv" id="cvv" class="form-control" maxlength="3" required>
                            </div>
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary w-100 mt-2">Оплатить</button>
                            </div>
                        </div>

                        <hr>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="method2" value="credit">
                            <label class="form-check-label" for="method2">Кредитная / Дебетовая карта</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="method3" value="netbanking">
                            <label class="form-check-label" for="method3">Интернет-банкинг</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="method4" value="emi">
                            <label class="form-check-label" for="method4">Рассрочка</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="method5" value="cod">
                            <label class="form-check-label" for="method5">Оплата при заселении</label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Детали оплаты</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Цена за 1 ночь</span>
                                <strong><?php echo e(number_format($hotel->price_per_night, 0, ',', ' ')); ?> $</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Количество ночей</span>
                                <strong id="nightCount">0</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Итого к оплате</span>
                                <strong id="totalPrice"><?php echo e(number_format($hotel->price_per_night, 0, ',', ' ')); ?> $</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkIn = document.getElementById('checkIn');
            const checkOut = document.getElementById('checkOut');
            const pricePerNight = parseInt(document.getElementById('pricePerNight').value);
            const totalPrice = document.getElementById('totalPrice');
            const nightCount = document.getElementById('nightCount');

            function updateTotalPrice() {
                const inDate = new Date(checkIn.value);
                const outDate = new Date(checkOut.value);
                if (!isNaN(inDate.getTime()) && !isNaN(outDate.getTime()) && outDate > inDate) {
                    const diffTime = outDate - inDate;
                    const nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const total = nights * pricePerNight;
                    totalPrice.textContent = `${total.toLocaleString()} ₽`;
                    nightCount.textContent = nights;
                } else {
                    totalPrice.textContent = `${pricePerNight.toLocaleString()} ₽`;
                    nightCount.textContent = 1;
                }
            }

            checkIn.addEventListener('change', updateTotalPrice);
            checkOut.addEventListener('change', updateTotalPrice);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/booking/create.blade.php ENDPATH**/ ?>