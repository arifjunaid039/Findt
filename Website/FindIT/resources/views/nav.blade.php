   <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

   <nav class="navbar">

    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">
            <span class="logo-icon">🔍</span>
            <span>Find<span class="accent">IT</span></span>
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/Lostitems') }}">Lost Items</a></li>
        <li><a href="{{ url('/Founditems') }}">Found Items</a></li>
        <li><a href="{{ url('/communities') }}">Communities</a></li>
        <li><a href="{{ url('/About') }}">About</a></li>
    </ul>

<div class="nav-right">

<button id="openSearch" class="search-trigger">
    <span>Search lost & found items...</span>
</button>

<button class="icon-btn">
    🔔
    <span class="badge">3</span>
</button>

<button id="themeToggle" class="theme-btn">
    🌙
</button>

@auth
    <a href="{{ url('/profile') }}" class="profile-btn">
        Manage Profile
    </a>
@else
    <div class="auth-buttons">
        <a href="{{ url('/login') }}" class="login-btn">Login</a>
        <a href="{{ url('/register') }}" class="register-btn">Register</a>
    </div>
@endauth

</div>

</nav>