@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

<style>
  /* ============ base ============ */
  .db-wrap{ font-size:.9rem; overflow-x:hidden; max-width:100%; }
  .db-wrap *{ box-sizing:border-box; min-width:0; }
  .db-wrap img{ max-width:100%; }
  .db-wrap .row{ margin-left:0; margin-right:0; }
  .db-wrap .row > [class^="col"],
  .db-wrap .row > [class*=" col"]{ padding-left:8px; padding-right:8px; }

  /* ============ header ============ */
  .db-header{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:14px;
    margin-bottom:20px;
    padding-bottom:18px;
    border-bottom:1px solid var(--card-border);
  }
  .db-crumb{
    font-size:.72rem;
    font-weight:600;
    color:var(--text-muted);
    text-transform:uppercase;
    letter-spacing:.06em;
    margin-bottom:6px;
  }
  .db-crumb span{ color:var(--blue); }
  .db-header h1{ font-size:1.4rem; font-weight:700; margin:0; color:var(--text); }
  .db-header .db-sub{ font-size:.83rem; color:var(--text-muted); margin-top:2px; }
  .db-header-right{ display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
  .db-date-chip{
    font-size:.76rem;
    font-weight:600;
    color:var(--text);
    display:flex;
    align-items:center;
    gap:7px;
    padding:8px 13px;
    border-radius:8px;
    border:1px solid var(--card-border);
    white-space:nowrap;
  }
  .db-date-chip i{ color:var(--blue); font-size:.72rem; }

  /* ============ alert bar ============ */
  .db-alert{
    display:flex;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
    padding:12px 16px;
    border-radius:8px;
    border:1px solid var(--card-border);
    border-left:3px solid #d97706;
    background:transparent;
    margin-bottom:20px;
  }
  .db-alert .db-alert-icon{ color:#d97706; font-size:.9rem; flex-shrink:0; }
  .db-alert p{ margin:0; font-size:.82rem; color:var(--text); flex:1; min-width:200px; }
  .db-alert p strong{ font-weight:700; }
  .db-alert-actions{ display:flex; gap:8px; flex-wrap:wrap; width:100%; }
  .db-alert-link{
    font-size:.75rem;
    font-weight:700;
    color:var(--text);
    background:transparent;
    border:1px solid var(--card-border);
    padding:6px 12px;
    border-radius:6px;
    text-decoration:none;
    white-space:nowrap;
    transition:.15s;
    text-align:center;
  }
  .db-alert-link:hover{ border-color:#d97706; color:#d97706; }

  /* ============ section label ============ */
  .db-section-label{
    font-size:.72rem;
    font-weight:700;
    letter-spacing:.07em;
    text-transform:uppercase;
    color:var(--text-muted);
    margin:0 0 12px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
  }
  .db-section-label a{ font-size:.72rem; font-weight:700; text-transform:none; letter-spacing:0; color:var(--blue); text-decoration:none; flex-shrink:0; }
  .db-section-label a:hover{ text-decoration:underline; }

  /* ============ KPI row ============ */
  .kpi-card{
    background:var(--card, var(--blue-soft));
    border:1px solid var(--card-border);
    border-radius:10px;
    padding:16px 18px;
    display:flex;
    flex-direction:column;
    gap:10px;
    text-decoration:none;
    transition:border-color .15s, transform .15s;
    height:100%;
  }
  a.kpi-card:hover{ border-color:var(--blue); transform:translateY(-1px); }
  .kpi-top{ display:flex; align-items:center; justify-content:space-between; gap:8px; }
  .kpi-chip{
    width:32px; height:32px;
    border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    font-size:.85rem;
    flex-shrink:0;
  }
  .kpi-chip.blue{ background:var(--blue-soft); color:var(--blue); }
  .kpi-chip.indigo{ background:rgba(99,102,241,.12); color:#6366f1; }
  .kpi-chip.amber{ background:rgba(217,119,6,.12); color:#d97706; }
  .kpi-chip.red{ background:rgba(220,38,38,.12); color:#dc2626; }
  .kpi-chip.orange{ background:rgba(234,88,12,.12); color:#ea580c; }
  .kpi-chip.green{ background:rgba(22,163,74,.12); color:#16a34a; }
  .kpi-chip.purple{ background:rgba(147,51,234,.12); color:#9333ea; }
  .kpi-chip.teal{ background:rgba(13,148,136,.12); color:#0d9488; }
  html.dark .kpi-chip.indigo{ background:rgba(129,140,248,.18); color:#a5b4fc; }
  html.dark .kpi-chip.amber{ background:rgba(251,191,36,.18); color:#fbbf24; }
  html.dark .kpi-chip.red{ background:rgba(255,156,156,.16); color:#ff9c9c; }
  html.dark .kpi-chip.orange{ background:rgba(251,146,60,.18); color:#fb923c; }
  html.dark .kpi-chip.green{ background:rgba(74,222,128,.16); color:#4ade80; }
  html.dark .kpi-chip.purple{ background:rgba(192,132,252,.18); color:#c084fc; }
  html.dark .kpi-chip.teal{ background:rgba(45,212,191,.18); color:#2dd4bf; }
  .kpi-label{ font-size:.75rem; color:var(--text-muted); font-weight:600; }
  .kpi-num{ font-size:1.55rem; font-weight:700; color:var(--text); line-height:1; word-break:break-all; }

  /* ============ panel (card container) ============ */
  .db-panel{
    background:var(--card, var(--blue-soft));
    border:1px solid var(--card-border);
    border-radius:10px;
    overflow:hidden;
  }
  .db-panel-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    padding:14px 18px;
    border-bottom:1px solid var(--card-border);
  }
  .db-panel-head h2{ font-size:.92rem; font-weight:700; margin:0; color:var(--text); display:flex; align-items:center; gap:8px; }
  .db-panel-head h2 i{ font-size:.78rem; color:var(--text-muted); }
  .db-panel-head a{ font-size:.75rem; font-weight:700; color:var(--blue); text-decoration:none; flex-shrink:0; white-space:nowrap; }
  .db-panel-head a:hover{ text-decoration:underline; }
  .db-panel-body{ padding:6px 18px 14px; }
  .db-panel-body.pad-0{ padding:0; }

  /* ============ data table (desktop) ============ */
  .db-table-scroll{ width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch; }
  .db-table{ width:100%; border-collapse:collapse; min-width:480px; }
  .db-table thead th{
    text-align:left;
    font-size:.68rem;
    font-weight:700;
    letter-spacing:.05em;
    text-transform:uppercase;
    color:var(--text-muted);
    padding:8px 18px;
    border-bottom:1px solid var(--card-border);
    white-space:nowrap;
  }
  .db-table tbody td{
    padding:11px 18px;
    font-size:.83rem;
    color:var(--text);
    border-bottom:1px solid var(--card-border);
    vertical-align:middle;
  }
  .db-table tbody tr:last-child td{ border-bottom:none; }
  .db-table tbody tr{ transition:background .12s; }
  a.db-table-row:hover, .db-table tbody tr:hover{ background:var(--blue-soft); }
  .db-table a.cell-link{ color:var(--text); text-decoration:none; display:block; }
  .db-table a.cell-link:hover{ color:var(--blue); }
  .db-cell-title{ font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:220px; }
  .db-cell-meta{ font-size:.72rem; color:var(--text-muted); margin-top:1px; white-space:nowrap; }

  .type-chip{
    font-size:.68rem;
    font-weight:700;
    padding:3px 9px;
    border-radius:5px;
    text-transform:uppercase;
    letter-spacing:.03em;
    display:inline-flex;
    align-items:center;
    gap:5px;
    white-space:nowrap;
  }
  .type-chip.lost{ background:rgba(234,88,12,.12); color:#ea580c; }
  .type-chip.found{ background:rgba(22,163,74,.12); color:#16a34a; }
  html.dark .type-chip.lost{ background:rgba(251,146,60,.18); color:#fb923c; }
  html.dark .type-chip.found{ background:rgba(74,222,128,.16); color:#4ade80; }

  .badge-status{
    font-size:.7rem;
    font-weight:700;
    padding:3px 10px;
    border-radius:999px;
    text-transform:capitalize;
    white-space:nowrap;
    display:inline-block;
  }
  .badge-pending{ background:rgba(217,119,6,.12); color:#b45309; }
  .badge-approved{ background:rgba(22,163,74,.12); color:#15803d; }
  .badge-rejected{ background:rgba(220,38,38,.12); color:#b91c1c; }
  html.dark .badge-pending{ background:rgba(251,191,36,.16); color:#fbbf24; }
  html.dark .badge-approved{ background:rgba(74,222,128,.16); color:#4ade80; }
  html.dark .badge-rejected{ background:rgba(255,156,156,.16); color:#ff9c9c; }

  .db-empty{ text-align:center; padding:32px 16px; color:var(--text-muted); }
  .db-empty i{ font-size:1.3rem; opacity:.35; margin-bottom:8px; display:block; }
  .db-empty p{ font-size:.82rem; margin:0; }

  /* ============ mobile card list (replaces table below md) ============ */
  .db-mobile-list{ display:flex; flex-direction:column; }
  .db-mobile-item{
    display:block;
    padding:12px 18px;
    border-bottom:1px solid var(--card-border);
    text-decoration:none;
    color:var(--text);
    transition:background .12s;
  }
  .db-mobile-item:last-child{ border-bottom:none; }
  a.db-mobile-item:hover{ background:var(--blue-soft); color:var(--text); }
  .db-mobile-item-top{ display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:5px; }
  .db-mobile-item-title{
    font-weight:600;
    font-size:.85rem;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    flex:1;
    min-width:0;
  }
  .db-mobile-item-reason{
    font-weight:600;
    font-size:.85rem;
    line-height:1.35;
    margin-bottom:5px;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }
  .db-mobile-item-meta{ font-size:.72rem; color:var(--text-muted); }

  /* ============ sidebar widgets ============ */
  .side-stack{ display:flex; flex-direction:column; gap:16px; }

  .ratio-widget-body{ padding:16px 18px 18px; }
  .ratio-row{ display:flex; justify-content:space-between; font-size:.78rem; margin-bottom:8px; flex-wrap:wrap; gap:4px; }
  .ratio-row .rl{ display:flex; align-items:center; gap:6px; color:var(--text-muted); font-weight:600; }
  .ratio-row .rv{ color:var(--text); font-weight:700; }
  .dot{ width:7px; height:7px; border-radius:50%; display:inline-block; flex-shrink:0; }
  .dot.lost{ background:#ea580c; }
  .dot.found{ background:#16a34a; }
  .ratio-track{ width:100%; height:8px; border-radius:999px; overflow:hidden; background:var(--card-border); display:flex; margin-top:2px; }
  .ratio-seg-lost{ background:#ea580c; height:100%; }
  .ratio-seg-found{ background:#16a34a; height:100%; }

  .qa-list{ display:flex; flex-direction:column; }
  .qa-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:11px 18px;
    font-size:.82rem;
    font-weight:600;
    color:var(--text);
    text-decoration:none;
    border-bottom:1px solid var(--card-border);
    transition:.15s;
  }
  .qa-item:last-child{ border-bottom:none; }
  .qa-item i:first-child{ color:var(--text-muted); font-size:.8rem; width:16px; text-align:center; flex-shrink:0; transition:.15s; }
  .qa-item:hover{ color:var(--blue); background:var(--blue-soft); }
  .qa-item:hover i{ color:var(--blue); }
  .qa-item .qa-arrow{ margin-left:auto; font-size:.7rem; color:var(--text-muted); opacity:0; transition:.15s; flex-shrink:0; }
  .qa-item:hover .qa-arrow{ opacity:1; transform:translateX(2px); }

  .mini-stat-row{ display:flex; align-items:center; justify-content:space-between; gap:8px; padding:10px 18px; font-size:.82rem; border-bottom:1px solid var(--card-border); text-decoration:none; color:var(--text); }
  .mini-stat-row:last-child{ border-bottom:none; }
  .mini-stat-row:hover{ background:var(--blue-soft); color:var(--blue); }
  .mini-stat-row .msr-label{ display:flex; align-items:center; gap:8px; color:var(--text-muted); font-weight:600; min-width:0; }
  .mini-stat-row .msr-label span{ overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .mini-stat-row .msr-label i{ width:14px; text-align:center; font-size:.75rem; flex-shrink:0; }
  .mini-stat-row .msr-val{ font-weight:700; color:var(--text); flex-shrink:0; }

  /* ============ responsive tweaks ============ */
  @media (max-width: 575.98px){
    .db-header{ align-items:flex-start; }
    .db-header-right{ width:100%; }
    .db-date-chip{ width:100%; justify-content:center; }
    .kpi-num{ font-size:1.3rem; }
    .kpi-card{ padding:14px; }
    .db-cell-title{ max-width:130px; }
    .db-alert-actions{ flex-direction:column; }
    .db-alert-link{ width:100%; }
  }

  @media (max-width: 767.98px){
    .db-panel-head{ padding:12px 14px; }
    .db-panel-head h2{ font-size:.86rem; }
    .db-mobile-item{ padding:11px 14px; }
    .mini-stat-row, .qa-item{ padding:10px 14px; }
    .ratio-widget-body{ padding:14px; }
  }
</style>

@php
  $adminName = null;
  if (auth('admin')->check()) {
      $adminName = explode(' ', auth('admin')->user()->name)[0];
  } elseif (auth()->check() && auth()->user()->name) {
      $adminName = explode(' ', auth()->user()->name)[0];
  }

  $lost = (int) ($stats['lost_items'] ?? 0);
  $found = (int) ($stats['found_items'] ?? 0);
  $lostFoundTotal = max($lost + $found, 1);
  $lostPct = round(($lost / $lostFoundTotal) * 100);
  $foundPct = 100 - $lostPct;
@endphp

<div class="db-wrap">

  <div class="db-header">
    <div>
      <div class="db-crumb">Admin <i class="fa-solid fa-chevron-right" style="font-size:.6rem; margin:0 4px;"></i> <span>Dashboard</span></div>
      <h1>Dashboard</h1>
      <div class="db-sub">Welcome back{{ $adminName ? ', ' . $adminName : '' }} — here's today's overview.</div>
    </div>
    <div class="db-header-right">
      <div class="db-date-chip"><i class="fa-regular fa-calendar"></i> {{ now()->format('l, d M Y') }}</div>
    </div>
  </div>

  @if(($stats['pending_claims'] ?? 0) > 0 || ($stats['pending_communities'] ?? 0) > 0)
    <div class="db-alert">
      <i class="fa-solid fa-triangle-exclamation db-alert-icon"></i>
      <p>
        @if(($stats['pending_claims'] ?? 0) > 0)
          <strong>{{ $stats['pending_claims'] }}</strong> claim{{ $stats['pending_claims'] == 1 ? '' : 's' }} waiting for review
        @endif
        @if(($stats['pending_claims'] ?? 0) > 0 && ($stats['pending_communities'] ?? 0) > 0) &middot; @endif
        @if(($stats['pending_communities'] ?? 0) > 0)
          <strong>{{ $stats['pending_communities'] }}</strong> communit{{ $stats['pending_communities'] == 1 ? 'y' : 'ies' }} awaiting approval
        @endif
      </p>
      <div class="db-alert-actions">
        @if(($stats['pending_claims'] ?? 0) > 0 && Route::has('admin.claims.index'))
          <a class="db-alert-link" href="{{ route('admin.claims.index') }}">Review claims</a>
        @endif
        @if(($stats['pending_communities'] ?? 0) > 0 && Route::has('admin.communities.index'))
          <a class="db-alert-link" href="{{ route('admin.communities.index') }}">Review communities</a>
        @endif
      </div>
    </div>
  @endif

  <div class="db-section-label">Key metrics</div>
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      @if(Route::has('admin.users.index'))
        <a href="{{ route('admin.users.index') }}" class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Total Users</span><span class="kpi-chip blue"><i class="fa-solid fa-users"></i></span></div>
          <div class="kpi-num">{{ $stats['total_users'] }}</div>
        </a>
      @else
        <div class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Total Users</span><span class="kpi-chip blue"><i class="fa-solid fa-users"></i></span></div>
          <div class="kpi-num">{{ $stats['total_users'] }}</div>
        </div>
      @endif
    </div>
    <div class="col-6 col-md-3">
      @if(Route::has('admin.items.index'))
        <a href="{{ route('admin.items.index') }}" class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Total Items</span><span class="kpi-chip indigo"><i class="fa-solid fa-box-open"></i></span></div>
          <div class="kpi-num">{{ $stats['total_items'] }}</div>
        </a>
      @else
        <div class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Total Items</span><span class="kpi-chip indigo"><i class="fa-solid fa-box-open"></i></span></div>
          <div class="kpi-num">{{ $stats['total_items'] }}</div>
        </div>
      @endif
    </div>
    <div class="col-6 col-md-3">
      @if(Route::has('admin.claims.index'))
        <a href="{{ route('admin.claims.index') }}" class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Pending Claims</span><span class="kpi-chip amber"><i class="fa-solid fa-hourglass-half"></i></span></div>
          <div class="kpi-num">{{ $stats['pending_claims'] }}</div>
        </a>
      @else
        <div class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Pending Claims</span><span class="kpi-chip amber"><i class="fa-solid fa-hourglass-half"></i></span></div>
          <div class="kpi-num">{{ $stats['pending_claims'] }}</div>
        </div>
      @endif
    </div>
    <div class="col-6 col-md-3">
      @if(Route::has('admin.reports.index'))
        <a href="{{ route('admin.reports.index') }}" class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Reports</span><span class="kpi-chip red"><i class="fa-solid fa-flag"></i></span></div>
          <div class="kpi-num">{{ $stats['total_reports'] }}</div>
        </a>
      @else
        <div class="kpi-card">
          <div class="kpi-top"><span class="kpi-label">Reports</span><span class="kpi-chip red"><i class="fa-solid fa-flag"></i></span></div>
          <div class="kpi-num">{{ $stats['total_reports'] }}</div>
        </div>
      @endif
    </div>
  </div>

  <div class="row g-3">
    <!-- ================= main column ================= -->
    <div class="col-12 col-lg-8">

      <div class="db-section-label">Recent items</div>
      <div class="db-panel mb-4">
        <div class="db-panel-head">
          <h2><i class="fa-solid fa-box-open"></i> Latest reported items</h2>
          @if(Route::has('admin.items.index'))<a href="{{ route('admin.items.index') }}">View all</a>@endif
        </div>
        <div class="db-panel-body pad-0">
          @if(count($recentItems ?? []))
            <!-- desktop table -->
            <div class="db-table-scroll d-none d-md-block">
              <table class="db-table">
                <thead><tr><th>Item</th><th>Type</th><th>Reported</th></tr></thead>
                <tbody>
                  @foreach($recentItems as $item)
                    @php $itemHref = Route::has('admin.items.show') ? route('admin.items.show', $item->id) : null; @endphp
                    <tr>
                      <td>
                        @if($itemHref)<a class="cell-link" href="{{ $itemHref }}">@endif
                        <div class="db-cell-title" title="{{ $item->title }}">{{ $item->title }}</div>
                        @if($itemHref)</a>@endif
                      </td>
                      <td>
                        <span class="type-chip {{ $item->item_type === 'lost' ? 'lost' : 'found' }}">
                          <i class="fa-solid {{ $item->item_type === 'lost' ? 'fa-magnifying-glass' : 'fa-circle-check' }}"></i>
                          {{ $item->item_type }}
                        </span>
                      </td>
                      <td class="db-cell-meta">{{ $item->created_at ? $item->created_at->diffForHumans() : '—' }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- mobile card list -->
            <div class="db-mobile-list d-md-none">
              @foreach($recentItems as $item)
                @php $itemHref = Route::has('admin.items.show') ? route('admin.items.show', $item->id) : null; @endphp
                @if($itemHref)
                  <a class="db-mobile-item" href="{{ $itemHref }}">
                @else
                  <div class="db-mobile-item">
                @endif
                  <div class="db-mobile-item-top">
                    <span class="db-mobile-item-title" title="{{ $item->title }}">{{ $item->title }}</span>
                    <span class="type-chip {{ $item->item_type === 'lost' ? 'lost' : 'found' }}">
                      <i class="fa-solid {{ $item->item_type === 'lost' ? 'fa-magnifying-glass' : 'fa-circle-check' }}"></i>
                      {{ $item->item_type }}
                    </span>
                  </div>
                  <div class="db-mobile-item-meta">{{ $item->created_at ? $item->created_at->diffForHumans() : '—' }}</div>
                @if($itemHref)
                  </a>
                @else
                  </div>
                @endif
              @endforeach
            </div>
          @else
            <div class="db-empty"><i class="fa-solid fa-box-open"></i><p>No items reported yet.</p></div>
          @endif
        </div>
      </div>

      <div class="db-section-label">Recent claims</div>
      <div class="db-panel mb-4">
        <div class="db-panel-head">
          <h2><i class="fa-solid fa-hourglass-half"></i> Latest claim submissions</h2>
          @if(Route::has('admin.claims.index'))<a href="{{ route('admin.claims.index') }}">View all</a>@endif
        </div>
        <div class="db-panel-body pad-0">
          @if(count($recentClaims ?? []))
            <!-- desktop table -->
            <div class="db-table-scroll d-none d-md-block">
              <table class="db-table">
                <thead><tr><th>Claim</th><th>Status</th><th>Submitted</th></tr></thead>
                <tbody>
                  @foreach($recentClaims as $claim)
                    @php $claimHref = Route::has('admin.claims.show') ? route('admin.claims.show', $claim->id) : null; @endphp
                    <tr>
                      <td>
                        @if($claimHref)<a class="cell-link" href="{{ $claimHref }}">@endif
                        <div class="db-cell-title">{{ optional($claim->item ?? null)->title ?? 'Claim #' . $claim->id }}</div>
                        @if($claimHref)</a>@endif
                      </td>
                      <td><span class="badge-status badge-{{ $claim->status }}">{{ ucfirst($claim->status) }}</span></td>
                      <td class="db-cell-meta">{{ $claim->created_at ? $claim->created_at->diffForHumans() : '—' }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- mobile card list -->
            <div class="db-mobile-list d-md-none">
              @foreach($recentClaims as $claim)
                @php $claimHref = Route::has('admin.claims.show') ? route('admin.claims.show', $claim->id) : null; @endphp
                @if($claimHref)
                  <a class="db-mobile-item" href="{{ $claimHref }}">
                @else
                  <div class="db-mobile-item">
                @endif
                  <div class="db-mobile-item-top">
                    <span class="db-mobile-item-title">{{ optional($claim->item ?? null)->title ?? 'Claim #' . $claim->id }}</span>
                    <span class="badge-status badge-{{ $claim->status }}">{{ ucfirst($claim->status) }}</span>
                  </div>
                  <div class="db-mobile-item-meta">{{ $claim->created_at ? $claim->created_at->diffForHumans() : '—' }}</div>
                @if($claimHref)
                  </a>
                @else
                  </div>
                @endif
              @endforeach
            </div>
          @else
            <div class="db-empty"><i class="fa-solid fa-hourglass-half"></i><p>No claims submitted yet.</p></div>
          @endif
        </div>
      </div>

      <div class="db-section-label">Recent reports</div>
      <div class="db-panel">
        <div class="db-panel-head">
          <h2><i class="fa-solid fa-flag"></i> Latest user reports</h2>
          @if(Route::has('admin.reports.index'))<a href="{{ route('admin.reports.index') }}">View all</a>@endif
        </div>
        <div class="db-panel-body pad-0">
          @if(count($recentReports ?? []))
            <!-- desktop table -->
            <div class="db-table-scroll d-none d-md-block">
              <table class="db-table">
                <thead><tr><th>Reason</th><th>Filed</th></tr></thead>
                <tbody>
                  @foreach($recentReports as $report)
                    @php $reportHref = Route::has('admin.reports.show') ? route('admin.reports.show', $report->id) : null; @endphp
                    <tr>
                      <td>
                        @if($reportHref)<a class="cell-link" href="{{ $reportHref }}">@endif
                        <div class="db-cell-title" style="max-width:340px;" title="{{ $report->reason }}">{{ $report->reason }}</div>
                        @if($reportHref)</a>@endif
                      </td>
                      <td class="db-cell-meta">{{ $report->created_at ? $report->created_at->diffForHumans() : '—' }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- mobile card list -->
            <div class="db-mobile-list d-md-none">
              @foreach($recentReports as $report)
                @php $reportHref = Route::has('admin.reports.show') ? route('admin.reports.show', $report->id) : null; @endphp
                @if($reportHref)
                  <a class="db-mobile-item" href="{{ $reportHref }}">
                @else
                  <div class="db-mobile-item">
                @endif
                  <div class="db-mobile-item-reason" title="{{ $report->reason }}">{{ $report->reason }}</div>
                  <div class="db-mobile-item-meta">{{ $report->created_at ? $report->created_at->diffForHumans() : '—' }}</div>
                @if($reportHref)
                  </a>
                @else
                  </div>
                @endif
              @endforeach
            </div>
          @else
            <div class="db-empty"><i class="fa-solid fa-flag"></i><p>No reports filed yet.</p></div>
          @endif
        </div>
      </div>

    </div>

    <!-- ================= sidebar column ================= -->
    <div class="col-12 col-lg-4">
      <div class="side-stack">

        <div class="db-panel">
          <div class="db-panel-head"><h2><i class="fa-solid fa-scale-balanced"></i> Lost vs found</h2></div>
          <div class="ratio-widget-body">
            <div class="ratio-row"><span class="rl"><i class="dot lost"></i> Lost</span><span class="rv">{{ $lost }} &middot; {{ $lostPct }}%</span></div>
            <div class="ratio-row"><span class="rl"><i class="dot found"></i> Found</span><span class="rv">{{ $found }} &middot; {{ $foundPct }}%</span></div>
            <div class="ratio-track">
              <div class="ratio-seg-lost" style="width:{{ $lostPct }}%"></div>
              <div class="ratio-seg-found" style="width:{{ $foundPct }}%"></div>
            </div>
          </div>
        </div>

        <div class="db-panel">
          <div class="db-panel-head"><h2><i class="fa-solid fa-chart-simple"></i> More stats</h2></div>
          <div>
            <div class="mini-stat-row">
              <span class="msr-label"><i class="fa-solid fa-user-slash"></i> <span>Blocked users</span></span>
              <span class="msr-val">{{ $stats['blocked_users'] }}</span>
            </div>
            @if(Route::has('admin.messages.index'))
              <a href="{{ route('admin.messages.index') }}" class="mini-stat-row">
                <span class="msr-label"><i class="fa-solid fa-envelope"></i> <span>Contact messages</span></span>
                <span class="msr-val">{{ $stats['total_messages'] ?? 0 }}</span>
              </a>
            @else
              <div class="mini-stat-row">
                <span class="msr-label"><i class="fa-solid fa-envelope"></i> <span>Contact messages</span></span>
                <span class="msr-val">{{ $stats['total_messages'] ?? 0 }}</span>
              </div>
            @endif
            <div class="mini-stat-row">
              <span class="msr-label"><i class="fa-solid fa-people-group"></i> <span>Communities pending</span></span>
              <span class="msr-val">{{ $stats['pending_communities'] }}</span>
            </div>
          </div>
        </div>

        <div class="db-panel">
          <div class="db-panel-head"><h2><i class="fa-solid fa-bolt"></i> Quick actions</h2></div>
          <div class="qa-list">
            @if(Route::has('admin.items.index'))
              <a class="qa-item" href="{{ route('admin.items.index') }}"><i class="fa-solid fa-box-open"></i> Manage items <i class="fa-solid fa-arrow-right qa-arrow"></i></a>
            @endif
            @if(Route::has('admin.claims.index'))
              <a class="qa-item" href="{{ route('admin.claims.index') }}"><i class="fa-solid fa-hourglass-half"></i> Review claims <i class="fa-solid fa-arrow-right qa-arrow"></i></a>
            @endif
            @if(Route::has('admin.reports.index'))
              <a class="qa-item" href="{{ route('admin.reports.index') }}"><i class="fa-solid fa-flag"></i> View reports <i class="fa-solid fa-arrow-right qa-arrow"></i></a>
            @endif
            @if(Route::has('admin.users.index'))
              <a class="qa-item" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users"></i> Manage users <i class="fa-solid fa-arrow-right qa-arrow"></i></a>
            @endif
            @if(Route::has('admin.communities.index'))
              <a class="qa-item" href="{{ route('admin.communities.index') }}"><i class="fa-solid fa-people-group"></i> Communities <i class="fa-solid fa-arrow-right qa-arrow"></i></a>
            @endif
            @if(Route::has('admin.messages.index'))
              <a class="qa-item" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope"></i> View messages <i class="fa-solid fa-arrow-right qa-arrow"></i></a>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
@endsection