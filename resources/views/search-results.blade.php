@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">Search Results</h2>

        @if($filteredHotels->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No hotels found.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($filteredHotels as $hotel)
                    <div class="col">
                        <div class="card h-100 shadow border-0 rounded-4">
                            <img src="{{ $hotel->image ? asset('images/hotels/' . $hotel->image) : asset('images/hotels/') }}"
                                 class="card-img-top rounded-top-4" alt="{{ $hotel->name }}" style="height: 200px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>

                                <ul class="list-unstyled small mb-3">
                                    <li><strong>Country:</strong> {{ $hotel->country->name ?? '—' }}</li>
                                    <li><strong>City:</strong> {{ $hotel->city->name ?? '—' }}</li>
                                    <li><strong>Price:</strong> {{ number_format($hotel->price_per_night, 0, ',', ' ') }} $SS / night</li>
                                    <li><strong>Rating:</strong> {{ number_format($hotel->rating, 1) }}/10</li>
                                </ul>

                                <p class="card-text flex-grow-1">{{ Str::limit($hotel->description, 100) }}</p>

                                <a href="{{ route('hotel.show', $hotel->id) }}" class="btn btn-outline-primary mt-auto">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
