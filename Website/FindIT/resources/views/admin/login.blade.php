<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | FindIT</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- Responsive overrides for the two-panel login card.
         login.css isn't visible to this edit, so these rules are scoped to
         .login-* classes and use safe fallbacks (flex-wrap / width resets)
         that hold regardless of whatever fixed widths login.css sets. If
         login.css already had its own @media rules for this, prefer folding
         these into that file instead of stacking two responsive layers. --}}
    <style>
        @media (max-width: 991.98px){
            .login-container{
                padding:16px !important;
                min-height:auto !important;
            }
            .login-card{
                flex-direction:column !important;
                width:100% !important;
                max-width:520px !important;
                margin:0 auto !important;
            }
            .login-side{
                width:100% !important;
                min-height:0 !important;
                padding:28px 24px !important;
            }
            .login-side h1{ font-size:1.4rem !important; }
            .login-side p{ font-size:.9rem !important; }
            .login-main{
                width:100% !important;
                padding:28px 24px !important;
            }
        }

        @media (max-width: 575.98px){
            .login-container{ padding:10px !important; }
            .login-card{ border-radius:14px !important; }
            .login-side{ padding:22px 18px !important; }
            .login-side-logo{ width:44px !important; height:44px !important; }
            .login-side h1{ font-size:1.2rem !important; }
            .tag-chip{ font-size:.72rem !important; flex-wrap:wrap !important; }
            .login-main{ padding:22px 18px !important; }
            .login-form h2{ font-size:1.25rem !important; }
            .field input{ width:100% !important; box-sizing:border-box !important; }
            .submit-btn{ width:100% !important; }
        }

        /* Keep the floating theme toggle from overlapping the nav or
           running off-screen on narrow viewports. */
        @media (max-width: 575.98px){
            .theme-toggle{
                top:auto !important;
                bottom:16px !important;
                right:16px !important;
            }
        }
    </style>
</head>
<body>

    @include('nav')

    <button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle color theme">🌙</button>

    <div class="login-container">

        <div class="login-card">

            {{-- LEFT PANEL: brand / illustration --}}
            <div class="login-side">
                <div class="login-side-inner">
                    <img class="login-side-logo" src="{{ asset('img/Logo.jpeg') }}" alt="FindIT Logo">
                    <h1>Behind every reunion,<br>there's an admin.</h1>
                    <p>Sign in to review claims, verify reports, and keep the FindIT community running smoothly.</p>

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
                        <div class="alert alert-danger" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
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
                        <a href="{{ url('/') }}">&larr; Back to FindIT</a>
                    </div>
                </form>
            </div>

        </div>

    </div>

    @include('footer')

        <script>
        // Theme toggle: guard against the button not existing on this page
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