<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Иконки Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #f2f4f8, #dfe9f3);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #003366 !important;
        }

        .navbar-brand, .nav-link, .navbar-toggler-icon {
            color: #fff !important;
        }

        .card {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background-color: #006699;
            border-color: #006699;
        }

        .btn-primary:hover {
            background-color: #004d80;
            border-color: #004d80;
        }

        footer {
            background: #003366;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo e(route('hotel')); ?>">
            <i class="bi bi-building"></i> LuxHotel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-light"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item"><a class="nav-link" href="#"><?php echo e(Auth::user()->name); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
                    <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Войти</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<footer>
    <div class="container">
        &copy; <?php echo e(date('Y')); ?> LuxHotel — Все права защищены
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\xampp4\htdocs\hotel-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>