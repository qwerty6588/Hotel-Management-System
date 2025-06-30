@extends('layouts.master')

@section('content')
    <div class="container py-5">
        <a href="{{ route('hotel') }}" class="btn btn-outline-secondary mb-3">← Назад на главную</a>
        <h2 class="mb-4 text-center">Избранные отели</h2>

        <div class="row">

            <div class="col-md-3 mb-4">
                <div class="bg-light p-3 rounded shadow-sm">
                    <h5 class="mb-3">Фильтр</h5>
                    <form method="GET" action="{{ route('search-results') }}">

                        <div class="mb-3">
                            <label for="country_id" class="form-label">Страна</label>
                            <select class="form-select" id="country_id" name="country_id">
                                <option value="">Все страны</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="sort_by" class="form-label">Сортировать</label>
                            <select class="form-select" name="sort_by" id="sort_by">
                                <option value="rating" {{ request('sort_by') == 'rating' ? 'selected' : '' }}>По оценке</option>
                                <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>По цене</option>
                            </select>
                        </div>


                        <label class="form-label">Звёзды отеля</label>
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="stars[]" value="{{ $i }}"
                                       id="stars{{ $i }}"
                                    {{ is_array(request('stars')) && in_array($i, request('stars')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="stars{{ $i }}">
                                    {{ str_repeat('★', $i) }}
                                </label>
                            </div>
                        @endfor

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="no_stars" value="1"
                                   id="no_stars" {{ request('no_stars') ? 'checked' : '' }}>
                            <label class="form-check-label" for="no_stars">Отели без звёзд</label>
                        </div>


                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Применить фильтры</button>
                            <a href="{{ route('search-results') }}" class="btn btn-link w-100 text-decoration-none">Сбросить фильтры</a>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-9">
                @if($filteredHotels->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
                        Отели не найдены.
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($filteredHotels as $hotel)


                            <div class="col-12">
                                <div class="card h-100 shadow-sm rounded-4 d-flex flex-row overflow-hidden">
                                    <img src="{{ $hotel->image ? asset('storage/images/hotels/' . $hotel->image) : asset('storage/images/hotels/default.jpg') }}"
                                         class="rounded-start-4" style="width: 250px; object-fit: cover;" alt="{{ $hotel->name }}">

                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="mb-2">
                                                <span class="badge bg-warning text-dark fw-bold">
                                                    {{ number_format($hotel->rating, 1) }}
                                                </span>
                                                <span class="ms-2 text-muted">
                                                    {{ $hotel->stars ? str_repeat('★', $hotel->stars) : 'Без звёзд' }}
                                                </span>
                                            </div>
                                            <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>
                                            <p class="text-muted small">{{ $hotel->city->name ?? '' }}, {{ $hotel->country->name ?? '' }}</p>
                                            <p class="mb-2 small">{{ Str::limit($hotel->description, 100) }}</p>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-primary fs-5">Цена за ночь {{ number_format($hotel->price_per_night, 0, ',', ' ') }} $</span>
                                            <a href="{{ route('booking.create', $hotel->id) }}" class="btn btn-outline-primary btn-sm">Забронировать</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
