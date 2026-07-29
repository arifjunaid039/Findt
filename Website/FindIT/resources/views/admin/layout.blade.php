<!DOCTYPE html>
  <html lang="en" data-theme="dark">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
<title>@yield('title')</title>  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-theme.css') }}">
  <script>
  (function(){
    try{
      var stored = localStorage.getItem('findit-theme');
      var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      var theme = stored || (prefersDark ? 'dark' : 'light');
      if (theme === 'dark') document.documentElement.classList.add('dark');
    }catch(e){}
  })();
  </script>
  <style>
    :root{
      --bg:#f4f7fb;
      --bg-soft:#ffffff;
      --card:rgba(15,23,42,0.03);
      --card-border:rgba(15,23,42,0.10);
      --text:#0f172a;
      --text-muted:#66738c;
      --blue:#0284c7;
      --blue-soft:rgba(2,132,199,0.10);
      --blue-glow:rgba(2,132,199,0.25);
      --white:#0f172a;
      --danger:#dc2626;
      --success:#16a34a;
      --radius:16px;
    }
    html.dark{
      --bg:#0a0e17;
      --bg-soft:#111827;
      --card:rgba(255,255,255,0.04);
      --card-border:rgba(255,255,255,0.09);
      --text:#f4f7fb;
      --text-muted:#8b96a8;
      --blue:#38bdf8;
      --blue-soft:rgba(56,189,248,0.12);
      --blue-glow:rgba(56,189,248,0.35);
      --white:#ffffff;
      --danger:#f87171;
      --success:#4ade80;
    }
    *{box-sizing:border-box}
    body{
      background:radial-gradient(1200px 600px at 10% -10%, var(--blue-soft), transparent),
                var(--bg);
      color:var(--text);
      font-family:'Plus Jakarta Sans', sans-serif;
      min-height:100vh;
      transition:background-color .2s ease, color .2s ease;
    }
    h1,h2,h3,h4,.brand{ font-family:'Syne', sans-serif; }

    .admin-shell{ display:flex; min-height:100vh; }

    .sidebar{
      width:250px; flex-shrink:0;
      background:var(--bg-soft);
      border-right:1px solid var(--card-border);
      padding:24px 16px;
      position:sticky; top:0; height:100vh;
      display:flex;
      flex-direction:column;
    }
    .brand{ font-weight:800; font-size:1.3rem; color:var(--white); margin-bottom:28px; display:flex; align-items:center; gap:8px;}
    .brand i{ color:var(--blue); text-shadow:0 0 16px var(--blue-glow); }
    .nav-link{
      color:var(--text-muted); border-radius:10px; padding:10px 14px; margin-bottom:4px;
      display:flex; align-items:center; gap:10px; font-weight:500; font-size:.92rem;
      transition:.15s;
    }
    .nav-link i{ width:18px; text-align:center; }
    .nav-link:hover{ background:var(--card); color:var(--white); }
    .nav-link.active{ background:var(--blue-soft); color:var(--blue); font-weight:600; border:1px solid rgba(56,189,248,0.2); }

    .main{ flex:1; padding:28px 32px; min-width:0; }

    .glass-card{
      background:var(--card);
      border:1px solid var(--card-border);
      border-radius:var(--radius);
      backdrop-filter:blur(14px);
      padding:22px;
    }
    .stat-card .num{ font-family:'Syne',sans-serif; font-size:1.9rem; font-weight:700; color:var(--white); }
    .stat-card .label{ color:var(--text-muted); font-size:.85rem; }
    .stat-card i{ font-size:1.4rem; color:var(--blue); text-shadow:0 0 16px var(--blue-glow); }

    .table{ color:var(--text); }
    .table thead th{ color:var(--text-muted); font-weight:600; font-size:.8rem; text-transform:uppercase; letter-spacing:.03em; border-bottom:1px solid var(--card-border); }
    .table td, .table th{ border-color:var(--card-border); vertical-align:middle; }
    .table>:not(caption)>*>*{ background:transparent; }

    .badge-status{ padding:5px 12px; border-radius:999px; font-size:.75rem; font-weight:600; }
    .badge-active, .badge-approved{ background:rgba(74,222,128,.15); color:var(--success); }
    .badge-blocked, .badge-rejected{ background:rgba(248,113,113,.15); color:var(--danger); }
    .badge-pending{ background:var(--blue-soft); color:var(--blue); }

    .btn-blue{
      background:linear-gradient(135deg, var(--blue), #0ea5e9);
      border:none; color:#052033; font-weight:700;
      box-shadow:0 6px 18px rgba(56,189,248,0.22);
    }
    .btn-blue:hover{ filter:brightness(1.08); color:#052033; }
    .btn-outline-glass{ border:1px solid var(--card-border); color:var(--text); background:transparent; }
    .btn-outline-glass:hover{ background:var(--card); color:var(--white); border-color:var(--blue); }

    .form-control, .form-select{
      background:var(--bg-soft); border:1px solid var(--card-border); color:var(--white);
    }
    .form-control:focus, .form-select:focus{
      background:var(--bg-soft); color:var(--white); border-color:var(--blue);
      box-shadow:0 0 0 .2rem rgba(56,189,248,.15);
    }
    .page-title{ font-weight:700; margin-bottom:4px; color:var(--white); }
    .page-sub{ color:var(--text-muted); margin-bottom:22px; }

    ::placeholder{ color:var(--text-muted); opacity:.7; }
    a{ text-decoration:none; }

    .alert-success{ border-color:var(--success)!important; color:var(--success); background:rgba(74,222,128,.08); }
    .alert-danger{ border-color:var(--danger)!important; color:var(--danger); background:rgba(248,113,113,.08); }

    /* ---------- Sidebar theme toggle ---------- */
    .sidebar-theme-toggle{
      display:flex; align-items:center; justify-content:center; gap:10px;
      padding:14px 12px; margin-top:auto; border-top:1px solid var(--card-border);
    }
    .theme-label{
      font-size:.74rem; font-weight:600; color:var(--text-muted);
      display:flex; align-items:center; gap:5px;
    }
    .theme-label i{ font-size:.7rem; }
    .theme-switch{
      position:relative; width:42px; height:23px; border-radius:999px;
      border:1px solid var(--card-border); background:var(--bg-soft);
      cursor:pointer; padding:0; flex-shrink:0;
      transition:background .2s ease, border-color .2s ease;
    }
    .theme-switch-thumb{
      position:absolute; top:2px; left:2px; width:17px; height:17px; border-radius:50%;
      background:var(--blue); transition:transform .2s ease, background .2s ease;
    }
    .theme-switch[aria-checked="true"]{ background:var(--bg); border-color:var(--blue); }
    .theme-switch[aria-checked="true"] .theme-switch-thumb{ transform:translateX(19px); background:var(--blue); }
    .theme-switch:focus-visible{ outline:2px solid var(--blue); outline-offset:2px; }
    html.dark .theme-label:first-of-type{ opacity:.55; }
    .sidebar-theme-toggle .theme-label:last-of-type{ opacity:.55; }
    html.dark .sidebar-theme-toggle .theme-label:last-of-type{ opacity:1; }
    html.dark .sidebar-theme-toggle .theme-label:first-of-type{ opacity:.55; }

    /* ---------- Mobile topbar + off-canvas sidebar ---------- */
    .mobile-topbar{
      display:none;
      align-items:center;
      justify-content:space-between;
      gap:12px;
      padding:12px 16px;
      background:var(--bg-soft);
      border-bottom:1px solid var(--card-border);
      position:sticky;
      top:0;
      z-index:1040;
    }
    .mobile-topbar .brand{ margin-bottom:0; font-size:1.05rem; }
    .mobile-topbar .brand img{ width:32px; height:32px; }
    .sidebar-toggle-btn{
      width:38px; height:38px;
      display:flex; align-items:center; justify-content:center;
      border-radius:10px;
      border:1px solid var(--card-border);
      background:transparent;
      color:var(--text);
      font-size:1.05rem;
      flex-shrink:0;
    }
    .sidebar-toggle-btn:hover{ border-color:var(--blue); color:var(--blue); }

    .sidebar-backdrop{
      display:none;
      position:fixed;
      inset:0;
      background:rgba(0,0,0,.45);
      z-index:1045;
    }

    @media (max-width: 991.98px){
      .admin-shell{ flex-direction:column; }
      .mobile-topbar{ display:flex; }

      .sidebar{
        position:fixed;
        top:0; left:0;
        height:100vh;
        z-index:1050;
        transform:translateX(-100%);
        transition:transform .25s ease;
        box-shadow:0 0 0 rgba(0,0,0,0);
      }
      .sidebar.sidebar-open{
        transform:translateX(0);
        box-shadow:12px 0 32px rgba(0,0,0,.25);
      }
      .sidebar-backdrop.show{ display:block; }

      .main{ padding:20px 16px; }
    }

    @media (max-width: 575.98px){
      .main{ padding:16px 12px; }
      .sidebar{ width:230px; }
    }
  </style>
  @stack('styles')
  </head>
  <body>
  <div class="admin-shell">

    <div class="mobile-topbar">
      <button type="button" id="sidebarToggleBtn" class="sidebar-toggle-btn" aria-label="Open menu" aria-expanded="false" aria-controls="adminSidebar">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="brand d-flex align-items-center">
        <img src="{{ asset('img/Logo.jpeg') }}" alt="FindIT Logo" style="width:32px;height:32px;border-radius:50%;object-fit:cover;margin-right:8px;">
        <span>FindIT Admin</span>
      </div>
      <span style="width:38px;"></span>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <aside class="sidebar" id="adminSidebar">
      <div class="brand d-flex align-items-center">
    <img src="{{ asset('img/Logo.jpeg') }}"
         alt="FindIT Logo"
         style="width:40px;height:40px;border-radius:50%;object-fit:cover;margin-right:10px;">
    <span>FindIT Admin</span>
</div>
      <nav>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Users</a>
        <a href="{{ route('admin.items.index') }}" class="nav-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}"><i class="fa-solid fa-box-open"></i> Items</a>
        <a href="{{ route('admin.claims.index') }}" class="nav-link {{ request()->routeIs('admin.claims.*') ? 'active' : '' }}"><i class="fa-solid fa-hand-holding"></i> Claims</a>
        <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"><i class="fa-solid fa-flag"></i> Reports</a>
        <a href="{{ route('admin.communities.index') }}" class="nav-link {{ request()->routeIs('admin.communities.*') ? 'active' : '' }}"><i class="fa-solid fa-people-group"></i> Communities</a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="fa-solid fa-tags"></i> Categories</a>
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="fa-solid fa-envelope"></i> Messages</a>
        <hr style="border-color:var(--card-border); margin:16px 0;">
        <a href="{{ url('/') }}" class="nav-link"><i class="fa-solid fa-arrow-left"></i> Back to Site</a>
      </nav>

      <div class="sidebar-theme-toggle">
        <span class="theme-label"><i class="fa-solid fa-sun"></i> Light</span>
        <button type="button" id="sidebarThemeSwitch" class="theme-switch" role="switch" aria-checked="false" aria-label="Toggle dark mode">
          <span class="theme-switch-thumb"></span>
        </button>
        <span class="theme-label"><i class="fa-solid fa-moon"></i> Dark</span>
      </div>
    </aside>

    <main class="main">
      @if(session('success'))
        <div class="alert alert-success bg-transparent border">
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger bg-transparent border">
          {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </main>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  (function () {
    const root = document.documentElement;
    const switchEl = document.getElementById('sidebarThemeSwitch');
    if (!switchEl) return;

    let stored = null;
    try { stored = localStorage.getItem('findit-theme'); } catch (e) {}
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initial = stored || (prefersDark ? 'dark' : 'light');

    function applyTheme(theme) {
      root.classList.toggle('dark', theme === 'dark');
      switchEl.setAttribute('aria-checked', theme === 'dark' ? 'true' : 'false');
    }

    // Head script already set the class pre-paint; this just syncs the switch UI.
    applyTheme(initial);

    switchEl.addEventListener('click', () => {
      const next = root.classList.contains('dark') ? 'light' : 'dark';
      applyTheme(next);
      try { localStorage.setItem('findit-theme', next); } catch (e) {}
    });
  })();
  </script>
  <script>
  // Off-canvas sidebar for mobile/tablet (<992px). Desktop keeps the
  // always-visible sticky sidebar untouched.
  (function () {
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebar = document.getElementById('adminSidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    if (!toggleBtn || !sidebar || !backdrop) return;

    function openSidebar() {
      sidebar.classList.add('sidebar-open');
      backdrop.classList.add('show');
      toggleBtn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
      sidebar.classList.remove('sidebar-open');
      backdrop.classList.remove('show');
      toggleBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
    });
    backdrop.addEventListener('click', closeSidebar);

    // Close after tapping a nav link (mobile nav should navigate away anyway,
    // but this avoids a flash of the open drawer during the page transition).
    sidebar.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', closeSidebar);
    });

    // If the viewport grows back to desktop size, reset drawer state so it
    // doesn't get stuck "open" (translated in) when the media query flips.
    window.addEventListener('resize', () => {
      if (window.innerWidth > 991.98) closeSidebar();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeSidebar();
    });
  })();
  </script>
  @stack('scripts')
  </body>
  </html>