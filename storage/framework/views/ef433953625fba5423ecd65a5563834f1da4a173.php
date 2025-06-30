<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Иконки (Feather или FontAwesome) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Стили -->
    <style>
        body {
            background-color: #1e1e2d;
            color: #fff;
        }
        .card {
            background-color: #2c2c3d;
        }
        .form-label, .form-check-label {
            color: #ccc;
        }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Навигация -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('hotel')); ?>">HotelBooking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php if(auth()->guard()->check()): ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('hotel')); ?>">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
                </ul>
            </div>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
        <?php endif; ?>

        <?php if(auth()->guard()->guest()): ?>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Вход</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Регистрация</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>

<!-- Контент -->
<main class="flex-fill">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- Подвал -->
<footer class="bg-dark text-center text-white py-3 mt-auto">
    &copy; <?php echo e(date('Y')); ?> Hotel Management System
</footer>

<!-- Скрипты -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/layouts/login.blade.php ENDPATH**/ ?>