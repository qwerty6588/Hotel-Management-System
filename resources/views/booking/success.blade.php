@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="display-1 text-success mb-3">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h2 class="fw-bold">Спасибо за бронирование!</h2>
            <p class="text-muted">Ваше бронирование <strong>{{ $booking->id }}</strong> прошло успешно.</p>
            <p>Мы отправим подтверждение на вашу почту: <strong>{{ $booking->email ?? auth()->user()->email }}</strong></p>
        </div>

        <div class="row g-4">

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Детали бронирования</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Отель:</strong> {{ $booking->hotel->name }}</p>
                        <p><strong>Номер брони:</strong> {{ $booking->id }}</p>
                        <p><strong>Даты:</strong> {{ $booking->check_in }} → {{ $booking->check_out }}</p>
                        <p><strong>Гостей:</strong> {{ $booking->guests }}</p>
                        <p><strong>Итого:</strong> {{ number_format($booking->total_price, 0, ',', ' ') }} $</p>
                        <p><strong>Статус:</strong> <span class="badge bg-success">Оплачено</span></p>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Контактная информация</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Имя:</strong> {{ $booking->full_name ?? auth()->user()->name }}</p>
                        <p><strong>Email:</strong> {{ $booking->email ?? auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('hotel') }}" class="btn btn-outline-primary me-2">
                <i class="bi bi-arrow-left-circle me-1"></i> На главную
            </a>
            <a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-download me-1"></i> Скачать
            </a>
        </div>
    </div>
@endsection
