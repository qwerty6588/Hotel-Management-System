@extends('layouts.login')

@section('content')

    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper d-flex align-items-center justify-content-center vh-100">
            <div class="card shadow-lg border-0 p-4" style="max-width: 500px; width: 100%;">
                <div class="card-body text-center">
                    <h4 class="text-white">Create your account </h4>
                    <p class="text-muted">Please fill in your details</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3 text-start">
                            <label for="name" class="form-label text-white">Full Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="email" class="form-label text-white">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label text-white">Password</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password-confirm" class="form-label text-white">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Sign up</button>
                    </form>

                    <p class="mt-3 text-white">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-bold text-primary">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        });
    </script>

    </body>
@endsection
