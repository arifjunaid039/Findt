@extends('admin.layout')
@section('title', 'Reports')
@section('content')

{{-- Bootstrap Icons, used for colored icon accents throughout this page.
     If admin.layout exposes a @stack('head') / @stack('styles'), move this
     link there instead — it works here too, just isn't head-optimal. --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  /* Same theme-variable pattern as the Users table, so this follows
     light/dark mode instead of Bootstrap's hardcoded table colors. */

  .filter-form{ margin:0; }
  .filter-form .field-label{
    font-size:.68rem;
    font-weight:700;
    letter-spacing:.05em;
    text-transform:uppercase;
    color:var(--text-muted);
    margin-bottom:6px;
    display:block;
  }
  .filter-form .input-icon-wrap{ position:relative; }
  .filter-form .input-icon-wrap i{
    position:absolute;
    left:13px;
    top:50%;
    transform:translateY(-50%);
    color:var(--text-muted);
    font-size:.85rem;
    pointer-events:none;
  }
  .filter-form input[type="text"].with-icon{ padding-left:36px; }
  .filter-form .form-control{
    background:var(--bg-soft);
    border:1px solid var(--card-border);
    color:var(--text);
    font-size:.86rem;
  }
  .filter-form .form-control::placeholder{ color:var(--text-muted); opacity:.85; }
  .filter-form .form-control:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 3px var(--blue-soft);
    background:var(--bg-soft);
    color:var(--text);
  }
  .filter-form .btn-blue{ font-weight:600; font-size:.86rem; }
  .filter-form .clear-link{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:.8rem;
    font-weight:600;
    color:var(--text-muted);
    text-decoration:none;
    padding:9px 4px;
    transition:color .15s;
  }
  .filter-form .clear-link:hover{ color:var(--danger); }

  .results-bar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:8px;
    padding:0 2px 12px;
    font-size:.78rem;
    color:var(--text-muted);
  }
  .results-bar strong{ color:var(--text); }
  .results-bar a{ color:var(--blue); text-decoration:none; font-weight:600; }
  .results-bar a:hover{ text-decoration:underline; }

  .reports-table{ --bs-table-color:var(--text); --bs-emphasis-color:var(--text); color:var(--text); }
  .reports-table thead th{
    font-size:.72rem;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--text-muted) !important;
    font-weight:700;
    border-bottom:1px solid var(--card-border);
    padding-bottom:12px;
    background:transparent;
    white-space:nowrap;
  }
  .reports-table thead th i{ color:var(--text-muted); margin-right:4px; font-size:.8rem; }
  .reports-table tbody td{
    border-bottom:1px solid var(--card-border);
    color:var(--text) !important;
    background:transparent;
    vertical-align:middle;
  }
  .reports-table tbody td.text-muted{ color:var(--text-muted) !important; }
  .reports-table tbody tr:last-child td{ border-bottom:none; }
  .reports-table tbody tr:hover td{ background:var(--card); }

  .report-id{
    display:inline-flex;
    align-items:center;
    gap:5px;
    font-size:.78rem;
    font-weight:600;
    color:var(--text-muted);
    white-space:nowrap;
  }
  .report-id i{ color:#9333ea; font-size:.75rem; }
  html.dark .report-id i{ color:#c084fc; }

  .item-cell{ display:flex; align-items:center; gap:8px; min-width:0; }
  .item-cell i{ color:var(--blue); font-size:.9rem; flex-shrink:0; }
  .item-cell span{ overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

  /* Extra info shown stacked under the item name once Reporter/Reason/Date
     columns collapse off screen on narrow viewports. */
  .item-meta{
    display:none;
    flex-wrap:wrap;
    align-items:center;
    gap:4px 10px;
    font-size:.72rem;
    color:var(--text-muted);
    margin-top:4px;
  }
  .item-meta .meta-piece{ display:inline-flex; align-items:center; gap:4px; max-width:100%; }
  .item-meta .meta-piece span{ overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .item-meta i{ font-size:.75rem; }

  .item-deleted{
    display:flex;
    align-items:center;
    gap:6px;
    font-size:.78rem;
    font-style:italic;
    color:var(--text-muted) !important;
  }
  .item-deleted i{ color:#d97706; font-size:.85rem; }
  html.dark .item-deleted i{ color:#fbbf24; }

  .report-reason{
    display:block;
    max-width:260px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
  }

  .reporter-cell{ display:flex; align-items:center; gap:8px; min-width:0; }
  .reporter-cell span{ overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .reporter-avatar{
    width:26px; height:26px;
    border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:.68rem;
    font-weight:700;
    flex-shrink:0;
    text-transform:uppercase;
  }
  .avatar-0{ background:var(--blue-soft); color:var(--blue); }
  .avatar-1{ background:rgba(147,51,234,.14); color:#9333ea; }
  .avatar-2{ background:rgba(22,163,74,.14); color:#16a34a; }
  .avatar-3{ background:rgba(234,88,12,.14); color:#ea580c; }
  .avatar-4{ background:rgba(219,39,119,.14); color:#db2777; }
  html.dark .avatar-1{ background:rgba(192,132,252,.2); color:#c084fc; }
  html.dark .avatar-2{ background:rgba(74,222,128,.18); color:#4ade80; }
  html.dark .avatar-3{ background:rgba(251,146,60,.2); color:#fb923c; }
  html.dark .avatar-4{ background:rgba(244,114,182,.2); color:#f9a8d4; }

  .date-cell{ display:flex; align-items:center; gap:6px; white-space:nowrap; }
  .date-cell i{ color:var(--text-muted); font-size:.78rem; }

  .btn-outline-glass{
    border:1px solid var(--card-border);
    background:transparent;
    color:var(--text);
    font-weight:600;
    font-size:.78rem;
    transition:.15s;
    white-space:nowrap;
  }
  .btn-outline-glass:hover{
    background:var(--card);
    border-color:var(--blue);
    color:var(--blue);
  }

  .btn-remove-item{
    border:1px solid rgba(220,38,38,.28);
    background:rgba(220,38,38,.06);
    color:#dc2626;
  }
  .btn-remove-item:hover{
    background:rgba(220,38,38,.14);
    border-color:#dc2626;
    color:#dc2626;
  }
  html.dark .btn-remove-item{ border-color:rgba(255,156,156,.3); background:rgba(255,156,156,.08); color:#ff9c9c; }
  html.dark .btn-remove-item:hover{ background:rgba(255,156,156,.18); border-color:#ff9c9c; color:#ff9c9c; }

  .btn-dismiss{
    border:1px solid rgba(22,163,74,.3);
    background:rgba(22,163,74,.08);
    color:#16a34a;
  }
  .btn-dismiss:hover{
    background:rgba(22,163,74,.16);
    border-color:#16a34a;
    color:#16a34a;
  }
  html.dark .btn-dismiss{ border-color:rgba(74,222,128,.3); background:rgba(74,222,128,.1); color:#4ade80; }
  html.dark .btn-dismiss:hover{ background:rgba(74,222,128,.2); border-color:#4ade80; color:#4ade80; }

  .empty-state{ text-align:center; color:var(--text-muted); padding:28px 8px 10px; }
  .empty-state i{ font-size:1.5rem; opacity:.4; display:block; margin-bottom:8px; }
  .empty-state p{ font-size:.85rem; margin:0 0 8px; }
  .empty-state a{ font-size:.78rem; font-weight:600; color:var(--blue); text-decoration:none; }
  .empty-state a:hover{ text-decoration:underline; }

  /* ---- Responsive breakpoints ----
     >=992px (lg): full table, every column visible.
     768–991px (md): Reason column collapses into the item-meta line.
     576–767px (sm): Date also collapses into item-meta.
     <576px (xs):   Reporter also collapses into item-meta; only
                    ID / Reported Item / Actions stay as real columns. */
  @media (max-width: 991.98px){
    .col-reason{ display:none !important; }
    .item-meta .meta-reason{ display:inline-flex; }
  }
  @media (max-width: 767.98px){
    .col-date{ display:none !important; }
    .item-meta .meta-date{ display:inline-flex; }
  }
  @media (max-width: 575.98px){
    .col-reporter{ display:none !important; }
    .item-meta .meta-reporter{ display:inline-flex; }
    .report-reason{ max-width:180px; }
    .reports-table tbody td, .reports-table thead th{ padding-left:.5rem; padding-right:.5rem; }
  }
  @media (min-width: 992px){
    .item-meta{ display:none !important; }
  }
  @media (max-width: 991.98px){
    .item-meta{ display:flex; }
  }
</style>

@php
  $avatarPalette = ['0', '1', '2', '3', '4'];
@endphp

<h1 class="page-title">Reports</h1>
<p class="page-sub">Items or issues reported by users.</p>

<div class="glass-card mb-3">
  <form method="GET" class="row g-3 filter-form">
    <div class="col-12 col-md-8">
      <label class="field-label" for="reportSearch">Search</label>
      <div class="input-icon-wrap">
        <i class="bi bi-search"></i>
        <input id="reportSearch" type="text" name="search" value="{{ request('search') }}" class="form-control with-icon" placeholder="Reported item, reporter name, or reason">
      </div>
    </div>
    <div class="col-12 col-md-4 d-flex align-items-end gap-2">
      <button class="btn btn-blue flex-grow-1 w-100"><i class="bi bi-funnel me-1"></i>Apply</button>
    </div>
    @if(request('search'))
    <div class="col-12">
      <a href="{{ route('admin.reports.index') }}" class="clear-link"><i class="bi bi-x-lg"></i>Clear search</a>
    </div>
    @endif
  </form>
</div>

<div class="results-bar">
  <span>
    @if($reports->total() > 0)
      Showing <strong>{{ $reports->firstItem() }}–{{ $reports->lastItem() }}</strong> of <strong>{{ $reports->total() }}</strong> reports
    @else
      No reports to show
    @endif
  </span>
  @if(request('search'))
    <a href="{{ route('admin.reports.index') }}">Reset</a>
  @endif
</div>

<div class="glass-card">
  <div class="table-responsive">
    <table class="table align-middle mb-0 reports-table">
      <thead>
        <tr>
          <th><i class="bi bi-hash"></i>ID</th>
          <th><i class="bi bi-box-seam"></i>Reported Item</th>
          <th class="col-reporter"><i class="bi bi-person"></i>Reporter</th>
          <th class="col-reason"><i class="bi bi-chat-left-text"></i>Reason</th>
          <th class="col-date"><i class="bi bi-calendar3"></i>Date</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reports as $report)
<tr>
  <td>
    <span class="report-id"><i class="bi bi-flag-fill"></i>#{{ $report->id }}</span>
  </td>
  <td>
    @if($report->claim && $report->claim->item)
      <div class="item-cell">
        <i class="bi bi-box-seam-fill"></i>
        <span>{{ $report->claim->item->title }}</span>
      </div>
    @else
      <span class="item-deleted"><i class="bi bi-exclamation-triangle-fill"></i>Item deleted</span>
    @endif

    {{-- Collapsed-column info: only the pieces hidden at the current
         breakpoint actually render (see .item-meta media queries). --}}
    <div class="item-meta">
      <span class="meta-piece meta-reporter">
        <i class="bi bi-person"></i>
        @if($report->reporter)
          <span>{{ $report->reporter->fullname ?: 'Unnamed user' }}</span>
        @else
          <span>—</span>
        @endif
      </span>
      <span class="meta-piece meta-reason">
        <i class="bi bi-chat-left-text"></i>
        <span title="{{ $report->reason }}">{{ $report->reason }}</span>
      </span>
      <span class="meta-piece meta-date">
        <i class="bi bi-calendar3"></i>
        <span>{{ optional($report->created_at)->format('d M Y') }}</span>
      </span>
    </div>
  </td>
  <td class="col-reporter">
    @if($report->reporter)
      <div class="reporter-cell">
        <div class="reporter-avatar avatar-{{ $avatarPalette[$report->reporter->id % count($avatarPalette)] }}">
          {{ Str::substr($report->reporter->fullname ?: '?', 0, 1) }}
        </div>
        <span>{{ $report->reporter->fullname ?: 'Unnamed user' }}</span>
      </div>
    @else
      <span class="text-muted">—</span>
    @endif
  </td>
  <td class="text-muted small col-reason">
    <span class="report-reason" title="{{ $report->reason }}">{{ $report->reason }}</span>
  </td>
  <td class="text-muted small col-date">
    <div class="date-cell">
      <i class="bi bi-calendar3"></i>
      {{ optional($report->created_at)->format('d M Y') }}
    </div>
  </td>
  <td class="text-end">
    <div class="d-flex gap-1 justify-content-end flex-wrap">
      @if($report->claim && $report->claim->item)
      <form method="POST" action="{{ route('admin.reports.deleteItem', $report) }}" onsubmit="return confirm('Delete the reported item and resolve this report? This cannot be undone.');">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-glass btn-remove-item" title="Remove the reported item"><i class="bi bi-archive-fill"></i> <span class="d-none d-sm-inline">Remove Item</span></button>
      </form>
      @endif
      <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" onsubmit="return confirm('Dismiss this report?');">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-glass btn-dismiss" title="Dismiss report"><i class="bi bi-check-circle-fill"></i> <span class="d-none d-sm-inline">Dismiss</span></button>
      </form>
    </div>
  </td>
</tr>
@empty
<tr>
  <td colspan="6">
    <div class="empty-state">
      <i class="bi bi-flag"></i>
      @if(request('search'))
        <p>No reports match your search.</p>
        <a href="{{ route('admin.reports.index') }}">Clear search</a>
      @else
        <p class="mb-0">No reports found.</p>
      @endif
    </div>
  </td>
</tr>
@endforelse
      </tbody>
    </table>
  </div>  
</div>

<div class="mt-3">{{ $reports->appends(request()->query())->links() }}</div>
@endsection