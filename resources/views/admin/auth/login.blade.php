@extends('admin.layouts.guest')

@section('title', 'Admin Login')

@section('content')
    <div class="admin-guest">
        <section class="admin-guest-brand">
            <div class="admin-guest-logo">
                <img src="{{ media_asset('images/logo-new-2.png') }}" alt="FA Solutions">
            </div>

            <div class="admin-guest-copy">
                <h1>Admin Control Center</h1>
                <p>Secure access to manage FA Solutions website content, submissions, and operational tools from one
                    professional dashboard.</p>
            </div>

            <div class="admin-guest-footer">
            Restricted Area — Access Limited to Authorized Personnel Only | Truepid Technologies
            </div>
        </section>

        <section class="admin-guest-panel">
            <div class="admin-login-card">
                <h2>Welcome back</h2>
                <p class="subtitle">Sign in to your admin account</p>

                @if ($errors->any())
                    <div class="admin-alert admin-alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="admin-alert admin-alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="admin-form-group">
                        <label for="email">Email address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="admin-form-control @error('email') is-invalid @enderror" placeholder="admin@getfasolutions.com"
                            autocomplete="username" required autofocus>
                        @error('email')
                            <div class="admin-invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password"
                            class="admin-form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password" autocomplete="current-password" required>
                        @error('password')
                            <div class="admin-invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-row">
                        <label class="admin-checkbox">
                            <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="admin-btn admin-btn-primary">Sign In</button>
                </form>

                <a href="{{ route('home') }}" class="admin-back-link">&larr; Back to website</a>
            </div>
        </section>
    </div>
@endsection
