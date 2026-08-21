<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$claimCount = 0;
$isPhoneVerified = false;

if (Auth::check()) {
    $isPhoneVerified = (bool) Auth::user()->phone_verified_at;

    if ($isPhoneVerified) {
        $claimCount = DB::table('claims')
            ->join('items', 'claims.item_id', '=', 'items.id')
            ->where('items.user_id', Auth::id())
            ->where('claims.status', 'pending')
            ->count();
    }
}
?>

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<nav class="navbar" id="siteNavbar">

    <div class="nav-left">

        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/Logo.jpeg') }}" alt="BackToYou Logo" class="logo-img">
            <span class="logo-text">Back<span class="accent">ToYou</span></span>
        </a>

    </div>

    <button type="button" id="navToggle" class="nav-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="navCollapse">
        <i class="fa-solid fa-bars" id="navToggleIcon"></i>
    </button>

    <div class="nav-collapse" id="navCollapse">

        @if(Auth::check() && !$isPhoneVerified)

            {{-- UNVERIFIED USER: only public pages, no access to logged-in features --}}
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/communities">Communities</a></li>
                <li><a href="/About">About</a></li>
            </ul>

            <div class="nav-right">

                <button id="themeToggle" class="theme-btn" type="button" aria-label="Toggle dark mode" aria-pressed="false">
                    <i class="fa-solid fa-sun theme-icon sun" aria-hidden="true"></i>
                    <i class="fa-solid fa-moon theme-icon moon" aria-hidden="true"></i>
                    <span class="theme-thumb"></span>
                </button>

                <a href="{{ route('verify-phone.show') }}" class="profile-btn" style="background:#DC2626;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Verify Phone
                </a>

                <form action="{{ route('logout') }}" method="POST" style="display:inline;margin:0;">
                    @csrf
                    <button type="submit" class="profile-btn" style="border:none;cursor:pointer;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>

            </div>

        @else

            {{-- VERIFIED USER OR GUEST: normal full navbar --}}
            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/Lostitems">Lost Items</a></li>
                <li><a href="/Founditems">Found Items</a></li>
                <li><a href="/communities">Communities</a></li>
                <li><a href="/About">About</a></li>
                <li><a href="/Report">Report Item</a></li>
            </ul>

            <div class="nav-right">

                <button id="themeToggle" class="theme-btn" type="button" aria-label="Toggle dark mode" aria-pressed="false">
                    <i class="fa-solid fa-sun theme-icon sun" aria-hidden="true"></i>
                    <i class="fa-solid fa-moon theme-icon moon" aria-hidden="true"></i>
                    <span class="theme-thumb"></span>
                </button>

                @if(Auth::check())

                    <a href="{{ route('messages.index') }}" class="profile-btn">
                        <i class="fa-solid fa-comments"></i>
                        Messages
                    </a>

                    <a href="/profile" class="profile-btn">
                        <i class="fa-solid fa-user"></i>
                        Manage Profile
                    </a>

                @elseif(session()->has('community_id'))

                    <a href="/community/profile" class="profile-btn">
                        <i class="fa-solid fa-user-group"></i>
                        Community Profile
                    </a>

                @else

                    <div class="auth-buttons">

                        <div class="auth-dropdown">
                            <button type="button" class="login-btn">
                                Login <span class="chevron"></span>
                            </button>

                            <div class="auth-dropdown-content">
                                <a href="/login">User Login</a>
                                <a href="/communitylogin">Community Login</a>
                            </div>
                        </div>

                        <div class="auth-dropdown">
                            <button type="button" class="register-btn">
                                Register <span class="chevron"></span>
                            </button>

                            <div class="auth-dropdown-content">
                                <a href="/register">User Register</a>
                                <a href="/communityregister">Community Register</a>
                            </div>
                        </div>

                    </div>

                @endif

            </div>

        @endif

    </div>

</nav>

<div class="nav-backdrop" id="navBackdrop"></div>

<script>
const toggle = document.getElementById('themeToggle');

function applyTheme(isDark){
    document.body.classList.toggle('dark', isDark);
    toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
}

applyTheme(localStorage.getItem('theme') === 'dark');

// Theme change
toggle.addEventListener('click', () => {
    const isDark = !document.body.classList.contains('dark');
    applyTheme(isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
});
</script>

<script>
(function () {
    const navbar   = document.getElementById('siteNavbar');
    const navToggle = document.getElementById('navToggle');
    const navIcon  = document.getElementById('navToggleIcon');
    const navCollapse = document.getElementById('navCollapse');
    const navBackdrop = document.getElementById('navBackdrop');
    if (!navbar || !navToggle || !navCollapse) return;

    function openMenu() {
        navbar.classList.add('nav-open');
        navToggle.setAttribute('aria-expanded', 'true');
        navIcon.classList.remove('fa-bars');
        navIcon.classList.add('fa-xmark');
        navBackdrop.classList.add('show');
    }
    function closeMenu() {
        navbar.classList.remove('nav-open');
        navToggle.setAttribute('aria-expanded', 'false');
        navIcon.classList.remove('fa-xmark');
        navIcon.classList.add('fa-bars');
        navBackdrop.classList.remove('show');
        document.querySelectorAll('.auth-dropdown.open').forEach(d => d.classList.remove('open'));
    }

    navToggle.addEventListener('click', () => {
        navbar.classList.contains('nav-open') ? closeMenu() : openMenu();
    });
    navBackdrop.addEventListener('click', closeMenu);

    navCollapse.querySelectorAll('.nav-links a, .profile-btn').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 900) closeMenu();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });

    document.querySelectorAll('.auth-dropdown > button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const dropdown = btn.closest('.auth-dropdown');
            const isOpen = dropdown.classList.contains('open');
            document.querySelectorAll('.auth-dropdown.open').forEach(d => d.classList.remove('open'));
            if (!isOpen) dropdown.classList.add('open');
        });
    });
    document.addEventListener('click', () => {
        document.querySelectorAll('.auth-dropdown.open').forEach(d => d.classList.remove('open'));
    });
})();
</script>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>