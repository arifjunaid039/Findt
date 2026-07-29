@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

<style>
  /* ---------- header ---------- */
  .dash-header{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:12px;
    margin-bottom:22px;
  }
  .dash-header .page-title{ margin-bottom:2px; }
  .dash-header .page-sub{ margin-bottom:0; }
  .dash-header .page-sub strong{ color:var(--blue); font-weight:700; }
  .dash-date{
    font-size:.78rem;
    font-weight:600;
    color:var(--text-muted);
    display:flex;
    align-items:center;
    gap:7px;
    padding:8px 14px;
    border-radius:10px;
    border:1px solid var(--card-border);
    background:var(--blue-soft);
    white-space:nowrap;
  }
  .dash-date i{ color:var(--blue); }

  /* ---------- attention banner ---------- */
  .attn-banner{
    display:flex;
    align-items:center;
    gap:14px;
    flex-wrap:wrap;
    padding:14px 18px;
    border-radius:14px;
    background:rgba(217,119,6,.1);
    border:1px solid rgba(217,119,6,.25);
    margin-bottom:22px;
  }
  html.dark .attn-banner{ background:rgba(251,191,36,.08); border-color:rgba(251,191,36,.2); }
  .attn-banner .attn-icon{
    width:36px; height:36px;
    border-radius:10px;
    background:rgba(217,119,6,.16);
    color:#d97706;
    display:flex; align-items:center; justify-content:center;
    flex-shrink:0;
  }
  html.dark .attn-banner .attn-icon{ background:rgba(251,191,36,.2); color:#fbbf24; }
  .attn-banner p{
    margin:0;
    font-size:.85rem;
    color:var(--text);
    flex:1;
    min-width:200px;
  }
  .attn-banner .attn-actions{ display:flex; gap:8px; flex-wrap:wrap; }
  .attn-link{
    font-size:.78rem;
    font-weight:700;
    color:#d97706;
    background:rgba(217,119,6,.12);
    padding:7px 13px;
    border-radius:8px;
    text-decoration:none;
    white-space:nowrap;
    transition:.2s;
  }
  .attn-link:hover{ background:rgba(217,119,6,.2); color:#b45309; }
  html.dark .attn-link{ color:#fbbf24; background:rgba(251,191,36,.14); }
  html.dark .attn-link:hover{ background:rgba(251,191,36,.22); }

  /* ---------- stat cards ---------- */
  .stat-card{
    position:relative;
    overflow:hidden;
    text-decoration:none;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
    transition:transform .2s ease, box-shadow .2s ease;
    animation:dashFadeIn .4s ease backwards;
  }
  a.stat-card:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 28px rgba(0,0,0,.12);
  }
  html.dark a.stat-card:hover{ box-shadow:0 12px 28px rgba(0,0,0,.4); }

  .stat-icon{
    width:42px; height:42px;
    border-radius:11px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.05rem;
    flex-shrink:0;
  }
  .stat-icon.blue{ background:var(--blue-soft); color:var(--blue); }
  .stat-icon.indigo{ background:rgba(99,102,241,.14); color:#6366f1; }
  .stat-icon.amber{ background:rgba(217,119,6,.14); color:#d97706; }
  .stat-icon.red{ background:rgba(220,38,38,.14); color:#dc2626; }
  .stat-icon.orange{ background:rgba(234,88,12,.14); color:#ea580c; }
  .stat-icon.green{ background:rgba(22,163,74,.14); color:#16a34a; }
  .stat-icon.purple{ background:rgba(147,51,234,.14); color:#9333ea; }
  .stat-icon.teal{ background:rgba(13,148,136,.14); color:#0d9488; }
  html.dark .stat-icon.indigo{ background:rgba(129,140,248,.2); color:#a5b4fc; }
  html.dark .stat-icon.amber{ background:rgba(251,191,36,.2); color:#fbbf24; }
  html.dark .stat-icon.red{ background:rgba(255,156,156,.18); color:#ff9c9c; }
  html.dark .stat-icon.orange{ background:rgba(251,146,60,.2); color:#fb923c; }
  html.dark .stat-icon.green{ background:rgba(74,222,128,.18); color:#4ade80; }
  html.dark .stat-icon.purple{ background:rgba(192,132,252,.2); color:#c084fc; }
  html.dark .stat-icon.teal{ background:rgba(45,212,191,.2); color:#2dd4bf; }

  .stat-card .num{ font-size:1.6rem; font-weight:700; line-height:1.15; color:var(--text) !important; }
  .stat-card .label{
    font-size:.78rem;
    color:var(--text-muted) !important;
    margin-top:2px;
  }

  .section-label{
    font-size:.72rem;
    font-weight:700;
    letter-spacing:.08em;
    text-transform:uppercase;
    color:var(--text-muted);
    margin:4px 0 10px;
  }

  /* ---------- quick actions ---------- */
  .quick-actions{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(150px, 1fr));
    gap:12px;
  }
  .qa-btn{
    display:flex;
    align-items:center;
    gap:10px;
    padding:13px 14px;
    border-radius:12px;
    background:transparent;
    border:1px solid var(--card-border);
    color:var(--text);
    text-decoration:none;
    font-size:.83rem;
    font-weight:600;
    transition:.2s;
  }
  .qa-btn:hover{
    border-color:var(--blue);
    color:var(--blue);
    transform:translateY(-2px);
  }
  .qa-btn i{ color:var(--blue); font-size:.95rem; flex-shrink:0; }

  /* ---------- panels ---------- */
  .panel-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:14px;
  }
  .panel-head h5{ margin-bottom:0; color:var(--text); }
  .panel-head a{
    font-size:.78rem;
    font-weight:600;
    color:var(--blue);
    text-decoration:none;
  }
  .panel-head a:hover{ text-decoration:underline; }

  .list-row{
    display:flex;
    align-items:center;
    gap:10px;
    justify-content:space-between;
    padding:10px 0;
    border-bottom:1px solid var(--card-border);
    color:var(--text);
    text-decoration:none;
  }
  .list-row:last-child{ border-bottom:none; padding-bottom:0; }
  .list-row:first-child{ padding-top:0; }
  a.list-row:hover .row-title{ color:var(--blue); }

  .row-icon{
    width:30px; height:30px;
    border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    font-size:.75rem;
    flex-shrink:0;
  }
  .row-icon.lost{ background:rgba(234,88,12,.14); color:#ea580c; }
  .row-icon.found{ background:rgba(22,163,74,.14); color:#16a34a; }
  html.dark .row-icon.lost{ background:rgba(251,146,60,.2); color:#fb923c; }
  html.dark .row-icon.found{ background:rgba(74,222,128,.18); color:#4ade80; }

  .row-main{
    display:flex; align-items:center; gap:10px;
    min-width:0;
    flex:1;
  }
  .row-text{
    min-width:0;
    flex:1;
  }
  .row-title{
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    width:100%;
    font-size:.88rem;
    color:var(--text);
    transition:color .15s;
  }
  .row-meta{
    font-size:.72rem;
    color:var(--text-muted);
    margin-top:1px;
  }

  .badge-status{
    font-size:.72rem;
    font-weight:600;
    padding:3px 10px;
    border-radius:999px;
    text-transform:capitalize;
    white-space:nowrap;
    flex-shrink:0;
  }
  .badge-pending{ background:rgba(217,119,6,.14); color:#b45309; }
  .badge-approved{ background:rgba(22,163,74,.14); color:#15803d; }
  .badge-rejected{ background:rgba(220,38,38,.14); color:#b91c1c; }
  html.dark .badge-pending{ background:rgba(251,191,36,.18); color:#fbbf24; }
  html.dark .badge-approved{ background:rgba(74,222,128,.18); color:#4ade80; }
  html.dark .badge-rejected{ background:rgba(255,156,156,.18); color:#ff9c9c; }

  .empty-state{
    text-align:center;
    padding:24px 8px 6px;
    color:var(--text-muted);
  }
  .empty-state i{
    font-size:1.4rem;
    opacity:.4;
    margin-bottom:8px;
    display:block;
  }
  .empty-state p{ font-size:.83rem; margin:0; }

  /* ---------- motion ---------- */
  @keyframes dashFadeIn{
    from{ opacity:0; transform:translateY(6px); }
    to{ opacity:1; transform:translateY(0); }
  }
  .row.g-3 > [class^="col-"]:nth-child(1) .stat-card{ animation-delay:.02s; }
  .row.g-3 > [class^="col-"]:nth-child(2) .stat-card{ animation-delay:.06s; }
  .row.g-3 > [class^="col-"]:nth-child(3) .stat-card{ animation-delay:.1s; }
  .row.g-3 > [class^="col-"]:nth-child(4) .stat-card{ animation-delay:.14s; }

  @media (prefers-reduced-motion: reduce){
    .stat-card{ animation:none !important; }
    a.stat-card:hover, .qa-btn:hover{ transition:none !important; transform:none !important; }
  }

  /* ---------- small-screen tweaks ---------- */
  @media (max-width: 575.98px){
    .stat-card{ padding:14px; }
    .stat-icon{ width:36px; height:36px; font-size:.95rem; }
    .stat-card .num{ font-size:1.3rem; }
    .stat-card .label{ font-size:.72rem; }
    .dash-header{ align-items:flex-start; }
    .dash-date{ font-size:.72rem; padding:6px 11px; }
  }
</style>

@php
  $adminName = null;
  if (auth('admin')->check()) {
      $adminName = explode(' ', auth('admin')->user()->name)[0];
  } elseif (auth()->check() && auth()->user()->name) {
      $adminName = explode(' ', auth()->user()->name)[0];
  }
@endphp

<div class="dash-header">
  <div>
    <h1 class="page-title">Dashboard</h1>
    <p class="page-sub">
      Welcome back{{ $adminName ? ', ' . $adminName : '' }}. Here's what's happening on <strong>FindIT</strong> today.
    </p>
  </div>
  <div class="dash-date">
    <i class="fa-regular fa-calendar"></i>
    {{ now()->format('l, d M Y') }}
  </div>
</div>

@if(($stats['pending_claims'] ?? 0) > 0 || ($stats['pending_communities'] ?? 0) > 0)
  <div class="attn-banner">
    <div class="attn-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
    <p>
      @if(($stats['pending_claims'] ?? 0) > 0)
        <strong>{{ $stats['pending_claims'] }}</strong> claim{{ $stats['pending_claims'] == 1 ? '' : 's' }} waiting for review
      @endif
      @if(($stats['pending_claims'] ?? 0) > 0 && ($stats['pending_communities'] ?? 0) > 0) &middot; @endif
      @if(($stats['pending_communities'] ?? 0) > 0)
        <strong>{{ $stats['pending_communities'] }}</strong> communit{{ $stats['pending_communities'] == 1 ? 'y' : 'ies' }} awaiting approval
      @endif
    </p>
    <div class="attn-actions">
      @if(($stats['pending_claims'] ?? 0) > 0 && Route::has('admin.claims.index'))
        <a class="attn-link" href="{{ route('admin.claims.index') }}">Review claims</a>
      @endif
      @if(($stats['pending_communities'] ?? 0) > 0 && Route::has('admin.communities.index'))
        <a class="attn-link" href="{{ route('admin.communities.index') }}">Review communities</a>
      @endif
    </div>
  </div>
@endif

<div class="section-label">Overview</div>
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    @if(Route::has('admin.users.index'))
      <a href="{{ route('admin.users.index') }}" class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_users'] }}</div><div class="label">Total Users</div></div>
        <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
      </a>
    @else
      <div class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_users'] }}</div><div class="label">Total Users</div></div>
        <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
      </div>
    @endif
  </div>
  <div class="col-6 col-md-3">
    @if(Route::has('admin.items.index'))
      <a href="{{ route('admin.items.index') }}" class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_items'] }}</div><div class="label">Total Items</div></div>
        <div class="stat-icon indigo"><i class="fa-solid fa-box-open"></i></div>
      </a>
    @else
      <div class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_items'] }}</div><div class="label">Total Items</div></div>
        <div class="stat-icon indigo"><i class="fa-solid fa-box-open"></i></div>
      </div>
    @endif
  </div>
  <div class="col-6 col-md-3">
    @if(Route::has('admin.claims.index'))
      <a href="{{ route('admin.claims.index') }}" class="glass-card stat-card">
        <div><div class="num">{{ $stats['pending_claims'] }}</div><div class="label">Pending Claims</div></div>
        <div class="stat-icon amber"><i class="fa-solid fa-hourglass-half"></i></div>
      </a>
    @else
      <div class="glass-card stat-card">
        <div><div class="num">{{ $stats['pending_claims'] }}</div><div class="label">Pending Claims</div></div>
        <div class="stat-icon amber"><i class="fa-solid fa-hourglass-half"></i></div>
      </div>
    @endif
  </div>
  <div class="col-6 col-md-3">
    @if(Route::has('admin.reports.index'))
      <a href="{{ route('admin.reports.index') }}" class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_reports'] }}</div><div class="label">Reports</div></div>
        <div class="stat-icon red"><i class="fa-solid fa-flag"></i></div>
      </a>
    @else
      <div class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_reports'] }}</div><div class="label">Reports</div></div>
        <div class="stat-icon red"><i class="fa-solid fa-flag"></i></div>
      </div>
    @endif
  </div>
</div>

<div class="section-label">Breakdown</div>
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="glass-card stat-card">
      <div><div class="num">{{ $stats['lost_items'] }}</div><div class="label">Lost Items</div></div>
      <div class="stat-icon orange"><i class="fa-solid fa-magnifying-glass"></i></div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="glass-card stat-card">
      <div><div class="num">{{ $stats['found_items'] }}</div><div class="label">Found Items</div></div>
      <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="glass-card stat-card">
      <div><div class="num">{{ $stats['blocked_users'] }}</div><div class="label">Blocked Users</div></div>
      <div class="stat-icon red"><i class="fa-solid fa-user-slash"></i></div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    @if(Route::has('admin.messages.index'))
      <a href="{{ route('admin.messages.index') }}" class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_messages'] ?? 0 }}</div><div class="label">Contact Messages</div></div>
        <div class="stat-icon teal"><i class="fa-solid fa-envelope"></i></div>
      </a>
    @else
      <div class="glass-card stat-card">
        <div><div class="num">{{ $stats['total_messages'] ?? 0 }}</div><div class="label">Contact Messages</div></div>
        <div class="stat-icon teal"><i class="fa-solid fa-envelope"></i></div>
      </div>
    @endif
  </div>
</div>

<div class="section-label">More</div>
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="glass-card stat-card">
      <div><div class="num">{{ $stats['pending_communities'] }}</div><div class="label">Communities Awaiting Approval</div></div>
      <div class="stat-icon purple"><i class="fa-solid fa-people-group"></i></div>
    </div>
  </div>
</div>

<div class="section-label">Quick Actions</div>
<div class="quick-actions mb-4">
  @if(Route::has('admin.items.index'))
    <a class="qa-btn" href="{{ route('admin.items.index') }}"><i class="fa-solid fa-box-open"></i> Manage Items</a>
  @endif
  @if(Route::has('admin.claims.index'))
    <a class="qa-btn" href="{{ route('admin.claims.index') }}"><i class="fa-solid fa-hourglass-half"></i> Review Claims</a>
  @endif
  @if(Route::has('admin.reports.index'))
    <a class="qa-btn" href="{{ route('admin.reports.index') }}"><i class="fa-solid fa-flag"></i> View Reports</a>
  @endif
  @if(Route::has('admin.users.index'))
    <a class="qa-btn" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users"></i> Manage Users</a>
  @endif
  @if(Route::has('admin.communities.index'))
    <a class="qa-btn" href="{{ route('admin.communities.index') }}"><i class="fa-solid fa-people-group"></i> Communities</a>
  @endif
  @if(Route::has('admin.messages.index'))
    <a class="qa-btn" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope"></i> View Messages</a>
  @endif
</div>

<div class="row g-3">
  <div class="col-12 col-lg-4">
    <div class="glass-card">
      <div class="panel-head">
        <h5>Recent Items</h5>
        @if(Route::has('admin.items.index'))
          <a href="{{ route('admin.items.index') }}">View all</a>
        @endif
      </div>
      @forelse($recentItems as $item)
        @php $itemHref = Route::has('admin.items.show') ? route('admin.items.show', $item->id) : null; @endphp
        @if($itemHref)
          <a href="{{ $itemHref }}" class="list-row">
            <div class="row-main">
              <div class="row-icon {{ $item->item_type === 'lost' ? 'lost' : 'found' }}">
                <i class="fa-solid {{ $item->item_type === 'lost' ? 'fa-magnifying-glass' : 'fa-circle-check' }}"></i>
              </div>
              <div class="row-text">
                <div class="row-title" title="{{ $item->title }}">{{ $item->title }}</div>
                @if($item->created_at)
                  <div class="row-meta">{{ $item->created_at->diffForHumans() }}</div>
                @endif
              </div>
            </div>
            <span class="text-muted small text-nowrap">{{ ucfirst($item->item_type) }}</span>
          </a>
        @else
          <div class="list-row">
            <div class="row-main">
              <div class="row-icon {{ $item->item_type === 'lost' ? 'lost' : 'found' }}">
                <i class="fa-solid {{ $item->item_type === 'lost' ? 'fa-magnifying-glass' : 'fa-circle-check' }}"></i>
              </div>
              <div class="row-text">
                <div class="row-title" title="{{ $item->title }}">{{ $item->title }}</div>
                @if($item->created_at)
                  <div class="row-meta">{{ $item->created_at->diffForHumans() }}</div>
                @endif
              </div>
            </div>
            <span class="text-muted small text-nowrap">{{ ucfirst($item->item_type) }}</span>
          </div>
        @endif
      @empty
        <div class="empty-state">
          <i class="fa-solid fa-box-open"></i>
          <p>No items yet.</p>
        </div>
      @endforelse
    </div>
  </div>

  <div class="col-12 col-lg-4">
    <div class="glass-card">
      <div class="panel-head">
        <h5>Recent Claims</h5>
        @if(Route::has('admin.claims.index'))
          <a href="{{ route('admin.claims.index') }}">View all</a>
        @endif
      </div>
      @forelse($recentClaims as $claim)
        @php $claimHref = Route::has('admin.claims.show') ? route('admin.claims.show', $claim->id) : null; @endphp
        @if($claimHref)
          <a href="{{ $claimHref }}" class="list-row">
            <div class="row-text">
              <div class="row-title">
                {{ optional($claim->item ?? null)->title ?? 'Claim #' . $claim->id }}
              </div>
              @if($claim->created_at)
                <div class="row-meta">{{ $claim->created_at->diffForHumans() }}</div>
              @endif
            </div>
            <span class="badge-status badge-{{ $claim->status }}">{{ ucfirst($claim->status) }}</span>
          </a>
        @else
          <div class="list-row">
            <div class="row-text">
              <div class="row-title">
                {{ optional($claim->item ?? null)->title ?? 'Claim #' . $claim->id }}
              </div>
              @if($claim->created_at)
                <div class="row-meta">{{ $claim->created_at->diffForHumans() }}</div>
              @endif
            </div>
            <span class="badge-status badge-{{ $claim->status }}">{{ ucfirst($claim->status) }}</span>
          </div>
        @endif
      @empty
        <div class="empty-state">
          <i class="fa-solid fa-hourglass-half"></i>
          <p>No claims yet.</p>
        </div>
      @endforelse
    </div>
  </div>

  <div class="col-12 col-lg-4">
    <div class="glass-card">
      <div class="panel-head">
        <h5>Recent Reports</h5>
        @if(Route::has('admin.reports.index'))
          <a href="{{ route('admin.reports.index') }}">View all</a>
        @endif
      </div>
      @forelse($recentReports as $report)
        @php $reportHref = Route::has('admin.reports.show') ? route('admin.reports.show', $report->id) : null; @endphp
        @if($reportHref)
          <a href="{{ $reportHref }}" class="list-row">
            <div class="row-text">
              <div class="row-title" title="{{ $report->reason }}">{{ $report->reason }}</div>
              @if($report->created_at)
                <div class="row-meta">{{ $report->created_at->diffForHumans() }}</div>
              @endif
            </div>
          </a>
        @else
          <div class="list-row">
            <div class="row-text">
              <div class="row-title" title="{{ $report->reason }}">{{ $report->reason }}</div>
              @if($report->created_at)
                <div class="row-meta">{{ $report->created_at->diffForHumans() }}</div>
              @endif
            </div>
          </div>
        @endif
      @empty
        <div class="empty-state">
          <i class="fa-solid fa-flag"></i>
          <p>No reports yet.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>
@endsection