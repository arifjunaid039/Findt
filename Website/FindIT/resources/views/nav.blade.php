<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$claimCount = 0;

if (Auth::check()) {
    $claimCount = DB::table('claims')
        ->join('items', 'claims.item_id', '=', 'items.id')
        ->where('items.user_id', Auth::id())
        ->where('claims.status', 'pending')
        ->count();
}
?>

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<nav class="navbar">

    <div class="nav-left">

        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('img/Logo.jpeg') }}" alt="FindIT Logo" class="logo-img">
            <span class="logo-text">Find<span class="accent">IT</span></span>
        </a>

        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/Lostitems">Lost Items</a></li>
            <li><a href="/Founditems">Found Items</a></li>
            <li><a href="/communities">Communities</a></li>
            <li><a href="/About">About</a></li>
            <li><a href="/Report">Report Item</a></li>
        </ul>

    </div>

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
                    <button class="login-btn">
                        Login <span class="chevron"></span>
                    </button>

                    <div class="auth-dropdown-content">
                        <a href="/login">User Login</a>
                        <a href="/communitylogin">Community Login</a>
                    </div>
                </div>

                <div class="auth-dropdown">
                    <button class="register-btn">
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

</nav>

<script>
const toggle = document.getElementById('themeToggle');

function applyTheme(isDark){
    document.body.classList.toggle('dark', isDark);
    toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
}

// Page load hone par saved theme apply karo
applyTheme(localStorage.getItem('theme') === 'dark');

// Theme change
toggle.addEventListener('click', () => {
    const isDark = !document.body.classList.contains('dark');
    applyTheme(isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
});
</script>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>