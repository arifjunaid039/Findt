<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Community Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    @include('nav')

    <div class="login-container">

        <div class="login-card">

            {{-- LEFT PANEL: brand / community framing --}}
            <div class="login-side">
                <div class="login-side-inner">
                    <img class="login-side-logo" src="{{ asset('img/Logo.jpeg') }}" alt="FindIT Logo">
                    <h1>Run your community.<br>Reunite more people.</h1>
                    <p>Manage members, verify claims, and keep your community's lost &amp; found moving &mdash; all in one place.</p>

                    <div class="tag-chip">
                        <span class="tag-hole"></span>
                        Verify &bull; Coordinate &bull; Support
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: form --}}
            <div class="login-main">
                <form action="/communitylogin" method="POST" class="login-form" novalidate>
                    @csrf

                    <h2>Community login</h2>
                    <p class="subtitle">Sign in to manage your community and its members.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="field">
                        <label for="email">Community email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="community@example.com"
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

                    <button type="submit" class="submit-btn">Login as community</button>

                    <div class="register-link">
                        Don't have a community account?
                        <a href="{{ url('/communityregister') }}">Register your community</a>
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

        const pwdInput = document.getElementById('password');
        const pwdToggle = document.getElementById('togglePassword');
        if (pwdInput && pwdToggle) {
            pwdToggle.addEventListener('click', () => {
                const isHidden = pwdInput.type === 'password';
                pwdInput.type = isHidden ? 'text' : 'password';
                pwdToggle.setAttribute('aria-pressed', String(isHidden));
                pwdToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        }
    </script>

    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>

</body>
</html>