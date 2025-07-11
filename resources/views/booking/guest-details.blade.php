@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">
            Информация о госте для: <span class="text-primary">{{ $hotel->name }}</span>
        </h2>

        <form method="POST" action="{{ route('booking.details.submit', $hotel->id) }}"
              class="bg-white border rounded-3 shadow p-4 needs-validation" novalidate>
            @csrf

            <hr class="mb-4">

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-person-badge me-1 text-secondary"></i>ФИО
                    </label>
                    <input name="full_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-envelope-at me-1 text-secondary"></i>Email
                    </label>
                    <input name="email" type="email" class="form-control" required placeholder="example@mail.com">
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-telephone-fill me-1 text-secondary"></i>Телефон
                    </label>
                    <input name="phone" class="form-control" required placeholder="+998 90 123 45 67">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-people-fill me-1 text-secondary"></i>Гостей
                    </label>
                    <input name="guests" type="number" class="form-control" min="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-person-hearts me-1 text-secondary"></i>Детей
                    </label>
                    <input name="children" type="number" class="form-control">
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-passport me-1 text-secondary"></i>Паспортные данные
                    </label>
                    <input name="passport" id="passport" class="form-control" required
                           placeholder="AA1234567" pattern="[A-Z]{2}[0-9]{7}" maxlength="9">

                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-chat-left-dots me-1 text-secondary"></i>Пожелания
                    </label>
                    <textarea name="special_requests" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <hr class="mb-4">


            <div class="text-end">
                <a href="{{ route('booking.create', $hotel->id) }}" class="btn btn-success btn-lg">
                    <i class="bi bi-credit-card-2-front-fill me-1"></i>Перейти к оплате
                </a>
            </div>

        </form>
    </div>

    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Автоматическое форматирование паспорта
        const passportInput = document.getElementById('passport');
        passportInput.addEventListener('input', function () {
            let value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');

            let letters = value.slice(0, 2).replace(/[^A-Z]/g, '');
            let numbers = value.slice(2).replace(/[^0-9]/g, '').slice(0, 7); // максимум 7 цифр

            this.value = (letters + numbers).slice(0, 9);
        });
    </script>
@endsection
