<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BackToYou</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/adminlogin.css') }}">
</head>
<body>

    @include('nav')

    <button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle color theme">🌙</button>

    <div class="login-container">

        <div class="login-card">

            {{-- LEFT PANEL: brand / illustration --}}
            <div class="login-side">
                <div class="login-side-inner">
                    <img class="login-side-logo" src="{{ asset('img/Logo.jpeg') }}" alt="BackToYou Logo">
                    <h1>Behind every reunion,<br>there's an admin.</h1>
                    <p>Sign in to review claims, verify reports, and keep the BackToYou community running smoothly.</p>

                    <div class="tag-chip">
                        <span class="tag-hole"></span>
                        Verify &bull; Manage &bull; Protect
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: form --}}
            <div class="login-main">
                <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form" novalidate>
                    @csrf

                    <h2>Admin sign in</h2>
                    <p class="subtitle">Restricted access &mdash; authorized staff only.</p>

                    @if (session('error'))
                        <div class="alert-danger" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="field">
                        <label for="email">Email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@findit.com"
                            autocomplete="email"
                            required
                            autofocus
                        >
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="password-wrap">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                                required
                            >
                        </div>
                    </div>

                    <div class="field-row">
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="submit-btn">Login</button>

                    <div class="register-link">
                        <a href="{{ url('/') }}">&larr; Back to BackToYou</a>
                    </div>
                </form>
            </div>

        </div>

    </div>

    @include('footer')

    <script>
        const toggle = document.getElementById('themeToggle');
        if (toggle) {
            toggle.addEventListener('click', () => {
                document.body.classList.toggle('dark');
                toggle.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
            });
        }
    </script>

</body>
</html>