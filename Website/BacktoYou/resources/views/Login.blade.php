<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<style>
    .login-side-logo-wrap {
        width: 72px;
        height: 72px;
        background: #fff;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        box-shadow: 0 8px 20px rgba(0,0,0,.25);
        padding: 10px;
    }

    .login-side-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }
</style>
<body>

    @include('nav')

    <div class="login-container">

        <div class="login-card">

            {{-- LEFT PANEL: brand / illustration --}}
            <div class="login-side">
                <div class="login-side-inner">
                    <div class="login-side-logo-wrap">
                        <img class="login-side-logo" src="{{ asset('img/Logo.jpeg') }}" alt="BackToYou Logo">
                    </div>
                    <h1>Lost something?<br>Let's get it back.</h1>
                    <p>BackToYou connects people who've lost items with people who've found them &mdash; fast, simple, and free.</p>

                    <div class="tag-chip">
                        <span class="tag-hole"></span>
                        Claim &bull; Reunite &bull; Repeat
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: form --}}
            <div class="login-main">
                <form action="/login" method="POST" class="login-form" novalidate>
                    @csrf

                    <h2>Welcome back</h2>
                    <p class="subtitle">Log in to manage your lost &amp; found items.</p>

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
                            placeholder="you@example.com"
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
                        Don't have an account?
                        <a href="{{ route('register') }}">Register here</a>
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
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>