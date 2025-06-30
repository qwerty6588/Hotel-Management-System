@extends('layouts.login')

@section('content')

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static">
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper d-flex align-items-center justify-content-center vh-100">
        <div class="card shadow-lg border-0 p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body text-center">
                <p class="text-muted">Please sign in to your account</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="email" class="form-label text-white">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label text-white">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="remember">Remember Me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="text-white text-decoration-none" href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </form>
                <p class="mt-3 text-white">New here? <a href="{{ route('register') }}" class="fw-bold text-primary">Create an account</a></p>
            </div>
        </div>
    </div>
</div>
<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
<script src="../../../app-assets/js/core/app-menu.js"></script>
<script src="../../../app-assets/js/core/app.js"></script>
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    });
</script>
</body>
@endsection
