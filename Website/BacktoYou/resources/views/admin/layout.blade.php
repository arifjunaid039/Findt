<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
<title>@yield('title')</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
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
    --bg:#f4f6f9;
    --surface:#ffffff;
    --card:#ffffff;
    --card-border:#e3e8ef;
    --text:#0f172a;
    --text-muted:#64748b;
    --blue:#2563eb;
    --blue-soft:#eaf1ff;
    --blue-strong:#1d4ed8;
    --danger:#dc2626;
    --danger-soft:#fef2f2;
    --success:#16a34a;
    --success-soft:#f0fdf4;
    --radius:10px;
  }
  html.dark{
    --bg:#0b0f19;
    --surface:#121724;
    --card:#121724;
    --card-border:#232b3a;
    --text:#eef1f6;
    --text-muted:#8a94a6;
    --blue:#3b82f6;
    --blue-soft:#17233d;
    --blue-strong:#60a5fa;
    --danger:#f87171;
    --danger-soft:#2a1414;
    --success:#4ade80;
    --success-soft:#122a17;
  }
  *, *::before, *::after{ box-sizing:border-box; }

  /* ============ global overflow / image safety net ============ */
  html, body{
    max-width:100%;
    overflow-x:hidden;
  }
  html{
    -webkit-text-size-adjust:100%;
    text-size-adjust:100%;
  }
  img, svg, video, canvas{
    max-width:100%;
    height:auto;
    display:block;
  }
  table{ max-width:100%; }
  input, textarea, select, button, a{
    -webkit-tap-highlight-color:transparent;
  }

  body{
    background:var(--bg);
    color:var(--text);
    font-family:'Plus Jakarta Sans', sans-serif;
    min-height:100vh;
    transition:background-color .2s ease, color .2s ease;
  }
  h1,h2,h3,h4,.brand{ font-family:'Syne', sans-serif; }

  /* themed scrollbar */
  ::-webkit-scrollbar{ width:8px; height:8px; }
  ::-webkit-scrollbar-track{ background:transparent; }
  ::-webkit-scrollbar-thumb{ background:var(--card-border); border-radius:999px; }
  ::-webkit-scrollbar-thumb:hover{ background:var(--text-muted); }
  *{ scrollbar-width:thin; scrollbar-color:var(--card-border) transparent; }

  @media (prefers-reduced-motion: reduce){
    *, *::before, *::after{ transition-duration:0.01ms !important; animation-duration:0.01ms !important; }
  }

  .admin-shell{ display:block; min-height:100vh; max-width:100%; }

  /* ============ sidebar ============ */
  .sidebar{
    width:264px;
    background:var(--surface);
    border-right:1px solid var(--card-border);
    padding:20px 14px calc(20px + env(safe-area-inset-bottom, 0px));
    position:fixed; top:0; left:0; bottom:0;
    height:100vh; height:100dvh;
    z-index:1050;
    display:flex;
    flex-direction:column;
    overflow-y:auto;
    transition:background-color .2s ease, border-color .2s ease;
  }
  .brand{
    font-weight:800;
    font-size:1.12rem;
    color:var(--text);
    margin-bottom:6px;
    padding:6px 8px 20px;
    display:flex;
    align-items:center;
    gap:10px;
    border-bottom:1px solid var(--card-border);
    margin-bottom:18px;
    min-width:0;
  }
  .brand img{ border:1px solid var(--card-border); flex-shrink:0; }
  .brand span{ min-width:0; }
  .nav-section-label{
    font-size:.68rem;
    font-weight:700;
    letter-spacing:.07em;
    text-transform:uppercase;
    color:var(--text-muted);
    padding:0 12px;
    margin:14px 0 8px;
  }
  nav:first-of-type .nav-section-label,
  .nav-section-label:first-child{ margin-top:0; }
  .nav-link{
    color:var(--text-muted);
    border-radius:8px;
    padding:9px 12px;
    margin-bottom:2px;
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:600;
    font-size:.86rem;
    border-left:2px solid transparent;
    transition:background .15s ease, color .15s ease, border-color .15s ease, transform .15s ease;
  }
  .nav-link i{ width:16px; text-align:center; font-size:.82rem; flex-shrink:0; transition:transform .15s ease; }
  .nav-link:hover{ background:var(--bg); color:var(--text); transform:translateX(2px); }
  .nav-link:hover i{ transform:scale(1.08); }
  .nav-link:focus-visible{ outline:2px solid var(--blue); outline-offset:2px; }
  .nav-link.active{
    background:var(--blue-soft);
    color:var(--blue);
    border-left-color:var(--blue);
    font-weight:700;
    box-shadow:inset 0 0 0 1px rgba(37,99,235,.08);
  }
  .nav-link.back-to-site:hover i{ transform:translateX(-3px) scale(1); }

  .main{ margin-left:264px; padding:26px 30px; min-width:0; max-width:100%; overflow-x:hidden; min-height:100vh; min-height:100dvh; display:flex; flex-direction:column; transition:margin-left .2s ease; }

  /* ============ generic card ============ */
  .glass-card{
    background:var(--card);
    border:1px solid var(--card-border);
    border-radius:var(--radius);
    padding:20px;
    max-width:100%;
    box-shadow:0 1px 2px rgba(15,23,42,.04);
    transition:background-color .2s ease, border-color .2s ease;
  }

  .stat-card .num{ font-family:'Syne',sans-serif; font-size:1.7rem; font-weight:700; color:var(--text); }
  .stat-card .label{ color:var(--text-muted); font-size:.82rem; }
  .stat-card i{ font-size:1.1rem; color:var(--blue); }

  /* ============ global overlap guard for card headers / list rows ============ */
  /* Fixes "text sitting on top of text" bugs on any page that uses .glass-card
     with a Bootstrap d-flex row (heading + "View all" link, or title + badge + time),
     the same way the sidebar/topbar were made to wrap instead of overlap. */
  .glass-card{ overflow:hidden; }
  .glass-card h1, .glass-card h2, .glass-card h3,
  .glass-card h4, .glass-card h5, .glass-card h6,
  .glass-card .card-title{
    min-width:0;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    margin-top:0;
    margin-bottom:0;
  }
  /* neutralize negative-margin "compact spacing" tricks that cause stacking on narrow screens */
  .glass-card [class*="mt-n"],
  .glass-card [class*="mb-n"]{ margin-top:0 !important; margin-bottom:0 !important; }
  .glass-card .position-absolute{ position:static !important; }

  .glass-card .d-flex{
    flex-wrap:wrap;
    row-gap:6px;
    column-gap:10px;
    align-items:center;
  }
  .glass-card .d-flex > *{ min-width:0; }
  .glass-card .d-flex > a,
  .glass-card .d-flex > .badge-status,
  .glass-card .d-flex > small,
  .glass-card .d-flex > .text-muted,
  .glass-card .d-flex > .text-nowrap{
    flex-shrink:0;
    white-space:nowrap;
  }
  .glass-card .d-flex > span:not(.badge-status):not(.text-nowrap),
  .glass-card .d-flex > p{
    flex:1 1 auto;
    min-width:0;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
  }
  /* list rows inside cards (title / status / time) stack cleanly instead of overlapping */
  .list-row, .recent-row, .activity-row{
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    row-gap:4px;
    column-gap:10px;
    padding:10px 0;
    border-bottom:1px solid var(--card-border);
  }
  .list-row:last-child, .recent-row:last-child, .activity-row:last-child{ border-bottom:none; }

  /* ============ tables ============ */
  .table{ color:var(--text); }
  .table thead th{ color:var(--text-muted); font-weight:700; font-size:.72rem; text-transform:uppercase; letter-spacing:.04em; border-bottom:1px solid var(--card-border); white-space:nowrap; }
  .table td, .table th{ border-color:var(--card-border); vertical-align:middle; }
  .table>:not(caption)>*>*{ background:transparent; }
  .table-responsive{
    -webkit-overflow-scrolling:touch;
    scrollbar-width:thin;
  }

  .badge-status{ padding:4px 11px; border-radius:6px; font-size:.72rem; font-weight:700; }
  .badge-active, .badge-approved{ background:var(--success-soft); color:var(--success); }
  .badge-blocked, .badge-rejected{ background:var(--danger-soft); color:var(--danger); }
  .badge-pending{ background:var(--blue-soft); color:var(--blue); }

  /* ============ buttons ============ */
  .btn-blue{
    background:var(--blue);
    border:1px solid var(--blue);
    color:#fff;
    font-weight:700;
    transition:background-color .15s ease, border-color .15s ease, transform .1s ease, box-shadow .15s ease;
  }
  .btn-blue:hover{ background:var(--blue-strong); border-color:var(--blue-strong); color:#fff; box-shadow:0 4px 10px rgba(37,99,235,.22); transform:translateY(-1px); }
  .btn-blue:active{ transform:translateY(0); box-shadow:none; }
  .btn-blue:focus-visible{ outline:2px solid var(--blue-strong); outline-offset:2px; }
  .btn-outline-glass{ border:1px solid var(--card-border); color:var(--text); background:transparent; transition:background-color .15s ease, border-color .15s ease, transform .1s ease; }
  .btn-outline-glass:hover{ background:var(--bg); color:var(--text); border-color:var(--blue); transform:translateY(-1px); }
  .btn-outline-glass:active{ transform:translateY(0); }

  .form-control, .form-select{
    background:var(--surface); border:1px solid var(--card-border); color:var(--text);
  }
  .form-control:focus, .form-select:focus{
    background:var(--surface); color:var(--text); border-color:var(--blue);
    box-shadow:0 0 0 .18rem var(--blue-soft);
  }
  .page-title{ font-weight:700; margin-bottom:4px; color:var(--text); }
  .page-sub{ color:var(--text-muted); margin-bottom:22px; }

  ::placeholder{ color:var(--text-muted); opacity:.7; }
  a{ text-decoration:none; }

  .alert-success{ border:1px solid var(--card-border)!important; border-left:3px solid var(--success)!important; color:var(--text); background:var(--success-soft); border-radius:8px; }
  .alert-danger{ border:1px solid var(--card-border)!important; border-left:3px solid var(--danger)!important; color:var(--text); background:var(--danger-soft); border-radius:8px; }

  /* ============ sidebar theme toggle ============ */
  .sidebar-theme-toggle{
    display:flex; align-items:center; justify-content:center; gap:10px;
    padding:14px 10px 4px; margin-top:auto; border-top:1px solid var(--card-border);
    flex-wrap:wrap;
  }
  .theme-label{
    font-size:.72rem; font-weight:600; color:var(--text-muted);
    display:flex; align-items:center; gap:5px;
    white-space:nowrap;
  }
  .theme-label i{ font-size:.68rem; }
  .theme-switch{
    position:relative; width:40px; height:22px; border-radius:999px;
    border:1px solid var(--card-border); background:var(--bg);
    cursor:pointer; padding:0; flex-shrink:0;
    transition:background .15s ease, border-color .15s ease;
  }
  .theme-switch-thumb{
    position:absolute; top:2px; left:2px; width:16px; height:16px; border-radius:50%;
    background:var(--blue); transition:transform .15s ease;
  }
  .theme-switch[aria-checked="true"]{ border-color:var(--blue); }
  .theme-switch[aria-checked="true"] .theme-switch-thumb{ transform:translateX(18px); }
  .theme-switch:focus-visible{ outline:2px solid var(--blue); outline-offset:2px; }
  .sidebar-theme-toggle .theme-label:first-of-type{ opacity:.55; }
  .sidebar-theme-toggle .theme-label:last-of-type{ opacity:.55; }
  html.dark .sidebar-theme-toggle .theme-label:first-of-type{ opacity:.55; }
  html.dark .sidebar-theme-toggle .theme-label:last-of-type{ opacity:1; }
  html:not(.dark) .sidebar-theme-toggle .theme-label:first-of-type{ opacity:1; }

  /* ============ mobile topbar + off-canvas sidebar ============ */
  .mobile-topbar{
    display:none;
    width:100%;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    padding:calc(12px + env(safe-area-inset-top, 0px)) 14px 12px;
    background:var(--surface);
    border-bottom:1px solid var(--card-border);
    position:sticky;
    top:0;
    z-index:1040;
    max-width:100%;
    transition:background-color .2s ease, border-color .2s ease;
  }
  .mobile-topbar .brand{
    margin-bottom:0; padding:0; border:none; font-size:.98rem;
    flex:1 1 auto;
    min-width:0;
  }
  .mobile-topbar .brand img{ width:30px; height:30px; flex-shrink:0; }
  .mobile-topbar .brand span{
    white-space:nowrap;
    flex-shrink:0;
  }
  .sidebar-toggle-btn{
    width:36px; height:36px;
    display:flex; align-items:center; justify-content:center;
    border-radius:8px;
    border:1px solid var(--card-border);
    background:transparent;
    color:var(--text);
    font-size:1rem;
    flex-shrink:0;
    transition:background-color .15s ease, border-color .15s ease, color .15s ease, transform .1s ease;
  }
  .sidebar-toggle-btn:hover{ border-color:var(--blue); color:var(--blue); }
  .sidebar-toggle-btn:active{ transform:scale(.92); }
  .sidebar-toggle-btn:focus-visible{ outline:2px solid var(--blue); outline-offset:2px; }

  .sidebar-backdrop{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(10,14,23,.5);
    z-index:1045;
  }

  /* ============ clickable logo + lightbox ============ */
  .brand-logo-clickable{
    cursor:zoom-in;
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .brand-logo-clickable:hover{ transform:scale(1.08); box-shadow:0 0 0 3px var(--blue-soft); }
  .brand-logo-clickable:focus-visible{ outline:2px solid var(--blue); outline-offset:2px; }

  .logo-lightbox{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(6,9,16,.8);
    z-index:2000;
    align-items:center;
    justify-content:center;
    padding:24px;
    cursor:zoom-out;
    animation:logoFadeIn .15s ease;
  }
  .logo-lightbox.show{ display:flex; }
  .logo-lightbox img{
    max-width:min(85vw, 420px);
    max-height:80vh;
    border-radius:20px;
    box-shadow:0 24px 64px rgba(0,0,0,.5);
    object-fit:cover;
    cursor:default;
    animation:logoZoomIn .18s ease;
  }
  .logo-lightbox-close{
    position:absolute;
    top:18px; right:18px;
    width:38px; height:38px;
    border-radius:50%;
    border:1px solid rgba(255,255,255,.25);
    background:rgba(255,255,255,.08);
    color:#fff;
    display:flex; align-items:center; justify-content:center;
    font-size:1rem;
    cursor:pointer;
    transition:background-color .15s ease, transform .1s ease;
  }
  .logo-lightbox-close:hover{ background:rgba(255,255,255,.18); }
  .logo-lightbox-close:active{ transform:scale(.92); }
  @keyframes logoFadeIn{ from{opacity:0;} to{opacity:1;} }
  @keyframes logoZoomIn{ from{opacity:0; transform:scale(.9);} to{opacity:1; transform:scale(1);} }

  @media (max-width: 991.98px){
    .mobile-topbar{ display:flex; }

    .sidebar{
      transform:translateX(-100%);
      transition:transform .2s ease, background-color .2s ease, border-color .2s ease;
      max-width:85vw;
    }
    .sidebar.sidebar-open{
      transform:translateX(0);
      box-shadow:8px 0 24px rgba(0,0,0,.18);
    }
    .sidebar-backdrop.show{ display:block; }

    .main{ margin-left:0; padding:18px 16px; }

    /* bigger tap targets once the sidebar becomes an off-canvas menu */
    .nav-link{
      padding:12px 12px;
      font-size:.92rem;
      min-height:44px;
    }
    .sidebar-toggle-btn{ width:40px; height:40px; }
    .theme-switch{ width:44px; height:26px; }
    .theme-switch-thumb{ width:20px; height:20px; }
    .theme-switch[aria-checked="true"] .theme-switch-thumb{ transform:translateX(18px); }

    /* stack action buttons/rows full-width so they don't crowd on narrow screens */
    .glass-card .d-flex.gap-2,
    .glass-card .d-flex.gap-3{ flex-wrap:wrap; }

    .btn-blue, .btn-outline-glass{ min-height:40px; }

    /* keep page headers readable */
    .page-title{ font-size:1.15rem; }
    .page-sub{ font-size:.85rem; }
  }

  @media (max-width: 575.98px){
    .main{ padding:14px 12px; }
    .sidebar{ width:236px; max-width:85vw; }
    .sidebar .brand{ font-size:.98rem; }
    .sidebar .brand img{ width:32px; height:32px; margin-right:8px !important; }
    .mobile-topbar .brand span{ font-size:.85rem; }

    .glass-card{ padding:16px; border-radius:8px; }

    .stat-card .num{ font-size:1.4rem; }
    .stat-card .label{ font-size:.76rem; }

    /* full-width, stacked action buttons on very narrow screens */
    .glass-card .d-flex.justify-content-between{ flex-wrap:wrap; gap:10px; }
    .btn-blue, .btn-outline-glass{ width:100%; justify-content:center; }
    .btn-blue.btn-sm, .btn-outline-glass.btn-sm,
    .btn-blue.w-auto, .btn-outline-glass.w-auto{ width:auto; }

    /* keep modals from overflowing the viewport */
    .modal-dialog{ margin:10px; }

    .table thead th, .table td{ font-size:.82rem; padding:.5rem .6rem; }

    .badge-status{ padding:3px 9px; font-size:.68rem; }

    .list-row, .recent-row, .activity-row{ font-size:.85rem; padding:8px 0; }
    .list-row .badge-status, .recent-row .badge-status, .activity-row .badge-status{ order:2; }
    .list-row small, .recent-row small, .activity-row small,
    .list-row .text-muted, .recent-row .text-muted, .activity-row .text-muted{ order:3; width:100%; }
  }

  @media (max-width: 360px){
    .mobile-topbar{ padding:10px 10px; }
    .mobile-topbar .brand img{ width:28px; height:28px; margin-right:6px !important; }
    .table thead th, .table td{ font-size:.78rem; padding:.45rem .5rem; }
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
      <img src="{{ asset('img/Logo.jpeg') }}"
           alt="BackToYou Logo"
           class="brand-logo-clickable"
           tabindex="0"
           role="button"
           aria-label="View logo full size"
           style="width:30px;height:30px;object-fit:cover;border-radius:50%;margin-right:8px;">
      <span style="font-size:0.88rem;font-weight:700;">BackToYou Admin</span>
    </div>
  </div>

  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

  <aside class="sidebar" id="adminSidebar">
    <div class="brand d-flex align-items-center">
      <img src="{{ asset('img/Logo.jpeg') }}"
           alt="BackToYou Logo"
           class="brand-logo-clickable"
           tabindex="0"
           role="button"
           aria-label="View logo full size"
           style="width:36px;height:36px;border-radius:50%;object-fit:cover;margin-right:10px;">
      <span>BackToYou Admin</span>
    </div>

    <div class="nav-section-label">Main</div>
    <nav>
      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
      <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Users</a>
      <a href="{{ route('admin.items.index') }}" class="nav-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}"><i class="fa-solid fa-box-open"></i> Items</a>
      <a href="{{ route('admin.claims.index') }}" class="nav-link {{ request()->routeIs('admin.claims.*') ? 'active' : '' }}"><i class="fa-solid fa-hand-holding"></i> Claims</a>
    </nav>

    <div class="nav-section-label">Moderation</div>
    <nav>
      <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"><i class="fa-solid fa-flag"></i> Reports</a>
      <a href="{{ route('admin.communities.index') }}" class="nav-link {{ request()->routeIs('admin.communities.*') ? 'active' : '' }}"><i class="fa-solid fa-people-group"></i> Communities</a>
      <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="fa-solid fa-tags"></i> Categories</a>
      <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="fa-solid fa-envelope"></i> Messages</a>
    </nav>

    <div class="nav-section-label">General</div>
    <nav>
      <a href="{{ url('/') }}" class="nav-link back-to-site"><i class="fa-solid fa-arrow-left"></i> Back to site</a>
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

<div class="logo-lightbox" id="logoLightbox" aria-hidden="true">
  <button type="button" class="logo-lightbox-close" id="logoLightboxClose" aria-label="Close">
    <i class="fa-solid fa-xmark"></i>
  </button>
  <img src="{{ asset('img/Logo.jpeg') }}" alt="BackToYou Logo">
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

  applyTheme(initial);

  switchEl.addEventListener('click', () => {
    const next = root.classList.contains('dark') ? 'light' : 'dark';
    applyTheme(next);
    try { localStorage.setItem('findit-theme', next); } catch (e) {}
  });
})();
</script>
<script>
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

  sidebar.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', closeSidebar);
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 991.98) closeSidebar();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSidebar();
  });
})();
</script>
<script>
(function () {
  const lightbox = document.getElementById('logoLightbox');
  const closeBtn = document.getElementById('logoLightboxClose');
  const logos = document.querySelectorAll('.brand-logo-clickable');
  if (!lightbox || !logos.length) return;

  function openLightbox() {
    lightbox.classList.add('show');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    lightbox.classList.remove('show');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  logos.forEach(logo => {
    logo.addEventListener('click', openLightbox);
    logo.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openLightbox();
      }
    });
  });

  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
  });
  closeBtn.addEventListener('click', closeLightbox);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && lightbox.classList.contains('show')) closeLightbox();
  });
})();
</script>
@stack('scripts')
</body>
</html>