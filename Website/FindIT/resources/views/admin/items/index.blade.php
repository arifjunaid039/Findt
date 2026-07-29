@extends('admin.layout')
@section('title', 'Items')
@section('content')

{{-- Bootstrap Icons, used for colored icon accents throughout this page.
     If admin.layout exposes a @stack('head') / @stack('styles'), move this
     link there instead — it works here too, just isn't head-optimal. --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  /* Same theme-variable pattern as the other admin tables. */

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
  .filter-form .input-icon-wrap .bi-search{ color:var(--blue); }
  .filter-form input[type="text"].with-icon{ padding-left:36px; }
  .filter-form .form-control,
  .filter-form .form-select{
    background:var(--bg-soft);
    border:1px solid var(--card-border);
    color:var(--text);
    font-size:.86rem;
  }
  .filter-form .form-control::placeholder{ color:var(--text-muted); opacity:.85; }
  .filter-form .form-control:focus,
  .filter-form .form-select:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 3px var(--blue-soft);
    background:var(--bg-soft);
    color:var(--text);
  }
  .filter-form .form-select{
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%2366738c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right .75rem center;
    background-size:14px;
  }
  html.dark .filter-form .form-select{
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%238ea0c4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
  }
  html.dark .filter-form .form-select{ color-scheme:dark; }
  html:not(.dark) .filter-form .form-select{ color-scheme:light; }

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

  .page-alert{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:.86rem;
    font-weight:500;
    padding:10px 14px;
    border-radius:.65rem;
    margin-bottom:14px;
  }
  .page-alert-success{ border:1px solid rgba(22,163,74,.3); background:rgba(22,163,74,.08); color:#16a34a; }
  .page-alert-danger{ border:1px solid rgba(220,38,38,.28); background:rgba(220,38,38,.06); color:#dc2626; }
  html.dark .page-alert-success{ border-color:rgba(74,222,128,.3); background:rgba(74,222,128,.1); color:#4ade80; }
  html.dark .page-alert-danger{ border-color:rgba(255,156,156,.3); background:rgba(255,156,156,.08); color:#ff9c9c; }

  /* ============ DESKTOP TABLE (md and up) ============ */
  .items-table{ --bs-table-color:var(--text); --bs-emphasis-color:var(--text); color:var(--text); }
  .items-table thead th{
    font-size:.72rem;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--text-muted) !important;
    font-weight:700;
    border-bottom:1px solid var(--card-border);
    padding-bottom:12px;
    background:transparent;
  }
  .items-table thead th i{ color:var(--text-muted); margin-right:4px; font-size:.8rem; }
  .items-table thead th:nth-child(1) i{ color:var(--blue); }
  .items-table thead th:nth-child(3) i{ color:#9333ea; }
  .items-table thead th:nth-child(4) i{ color:#0d9488; }
  .items-table thead th:nth-child(5) i{ color:#dc2626; }
  html.dark .items-table thead th:nth-child(3) i{ color:#c084fc; }
  html.dark .items-table thead th:nth-child(4) i{ color:#2dd4bf; }
  html.dark .items-table thead th:nth-child(5) i{ color:#f87171; }
  .items-table tbody td{
    border-bottom:1px solid var(--card-border);
    color:var(--text) !important;
    background:transparent;
    vertical-align:middle;
  }
  .items-table tbody td.text-muted{ color:var(--text-muted) !important; }
  .items-table tbody tr:last-child td{ border-bottom:none; }
  .items-table tbody tr:hover td{ background:var(--card); }

  .item-title{
    display:block;
    max-width:220px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    font-weight:600;
  }
  .item-location{
    display:flex;
    align-items:center;
    gap:5px;
    max-width:160px;
  }
  .item-location i{ color:#dc2626; font-size:.78rem; flex-shrink:0; }
  html.dark .item-location i{ color:#f87171; }
  .item-location span{
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
  }

  .category-cell{ display:flex; align-items:center; gap:6px; }
  .category-cell i{ color:#9333ea; font-size:.8rem; }
  html.dark .category-cell i{ color:#c084fc; }

  .owner-cell{ display:flex; align-items:center; gap:6px; }
  .owner-cell i{ color:#0d9488; font-size:.8rem; }
  html.dark .owner-cell i{ color:#2dd4bf; }

  .badge-status{
    font-size:.72rem;
    font-weight:600;
    padding:3px 10px;
    border-radius:999px;
    text-transform:capitalize;
    white-space:nowrap;
    display:inline-flex;
    align-items:center;
    gap:5px;
  }
  .badge-lost{ background:rgba(234,88,12,.14); color:#ea580c; }
  .badge-found{ background:rgba(22,163,74,.14); color:#16a34a; }
  html.dark .badge-lost{ background:rgba(251,146,60,.18); color:#fb923c; }
  html.dark .badge-found{ background:rgba(74,222,128,.18); color:#4ade80; }

  .btn-outline-glass{
    border:1px solid var(--card-border);
    background:transparent;
    color:var(--text);
    transition:.15s;
  }
  .btn-outline-glass:hover{
    background:var(--card);
    border-color:var(--blue);
    color:var(--blue);
  }
  .btn-outline-glass:focus-visible,
  .clear-link:focus-visible,
  .results-bar a:focus-visible{
    outline:2px solid var(--blue);
    outline-offset:2px;
  }

  .btn-delete-item{
    border:1px solid rgba(220,38,38,.28);
    background:rgba(220,38,38,.06);
    color:#dc2626;
  }
  .btn-delete-item:hover{
    background:rgba(220,38,38,.14);
    border-color:#dc2626;
    color:#dc2626;
  }
  html.dark .btn-delete-item{ border-color:rgba(255,156,156,.3); background:rgba(255,156,156,.08); color:#ff9c9c; }
  html.dark .btn-delete-item:hover{ background:rgba(255,156,156,.18); border-color:#ff9c9c; color:#ff9c9c; }

  .actions-cell{ display:flex; justify-content:flex-end; gap:6px; }

  .empty-state{ text-align:center; color:var(--text-muted); padding:28px 8px 10px; }
  .empty-state i{ font-size:1.5rem; opacity:.4; display:block; margin-bottom:8px; }
  .empty-state p{ font-size:.85rem; margin:0 0 8px; }
  .empty-state a{ font-size:.78rem; font-weight:600; color:var(--blue); text-decoration:none; }
  .empty-state a:hover{ text-decoration:underline; }

  .pagination-wrap{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    flex-wrap:wrap;
  }
  .page-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:36px;
    height:36px;
    padding:0 .8rem;
    border-radius:999px;
    border:1px solid var(--card-border);
    background:var(--bg-soft);
    color:var(--text);
    font-size:.85rem;
    font-weight:600;
    text-decoration:none;
    gap:6px;
    transition:transform .12s, background .15s, border-color .15s, color .15s;
  }
  .page-btn:hover{
    background:var(--card);
    border-color:var(--blue);
    color:var(--blue);
    transform:translateY(-1px);
  }
  .page-btn:focus-visible{
    outline:none;
    box-shadow:0 0 0 3px var(--blue-soft);
  }
  .page-btn.is-active{
    background:var(--blue);
    border-color:var(--blue);
    color:#fff;
    box-shadow:0 2px 8px var(--blue-soft);
  }
  .page-btn.is-disabled{
    opacity:.45;
    pointer-events:none;
    color:var(--text-muted);
  }
  .page-btn i{ font-size:.72rem; }
  .page-dots{ color:var(--text-muted); font-size:.85rem; padding:0 2px; }

  /* ============ MOBILE CARD LIST (below md) ============ */
  .item-card-list{ display:flex; flex-direction:column; gap:10px; }
  .item-card{
    border:1px solid var(--card-border);
    border-radius:.75rem;
    padding:14px;
    background:transparent;
  }
  html.dark .item-card{ background:rgba(255,255,255,.03); }
  .item-card .item-card-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:8px;
    margin-bottom:8px;
  }
  .item-card .item-card-title{
    font-weight:600;
    color:var(--text);
    font-size:.95rem;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    min-width:0;
  }
  .item-card dl{ margin:0; }
  .item-card dl div{
    display:flex;
    gap:8px;
    padding:5px 0;
    border-bottom:1px dashed var(--card-border);
    font-size:.86rem;
  }
  .item-card dl div:last-of-type{ border-bottom:none; }
  .item-card dt{
    flex:0 0 90px;
    color:var(--text-muted);
    font-weight:600;
    font-size:.72rem;
    text-transform:uppercase;
    letter-spacing:.04em;
    padding-top:2px;
  }
  .item-card dd{
    margin:0;
    color:var(--text);
    word-break:break-word;
    display:flex;
    align-items:center;
    gap:6px;
  }
  .item-card dd i{ font-size:.8rem; flex-shrink:0; }
  .item-card .card-actions{
    margin-top:10px;
  }
  .item-card .card-actions .btn{ width:100%; }
</style>

<h1 class="page-title">Items</h1>
<p class="page-sub">All lost & found items posted on the platform.</p>

@if(session('success'))
  <div class="page-alert page-alert-success" role="status">
    <i class="bi bi-check-circle-fill"></i>
    {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="page-alert page-alert-danger" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    {{ session('error') }}
  </div>
@endif
@if($errors->any())
  <div class="page-alert page-alert-danger" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    {{ $errors->first() }}
  </div>
@endif

<div class="glass-card mb-3">
  <form method="GET" class="row g-3 filter-form">
    <div class="col-12 col-md-8">
      <label class="field-label" for="itemSearch">Search</label>
      <div class="input-icon-wrap">
        <i class="bi bi-search"></i>
        <input id="itemSearch" type="text" name="search" value="{{ request('search') }}" class="form-control with-icon" placeholder="Title, location, or contact">
      </div>
    </div>
    <div class="col-12 col-md-4">
      <label class="field-label" for="itemType">Type</label>
      <select id="itemType" name="type" class="form-select">
        <option value="">All types</option>
        <option value="lost" @selected(request('type')==='lost')>Lost</option>
        <option value="found" @selected(request('type')==='found')>Found</option>
      </select>
    </div>
    <div class="col-12 d-flex flex-wrap gap-2">
      <button class="btn btn-blue"><i class="bi bi-funnel me-1"></i>Apply filters</button>
      @if(request('search') || request('type'))
        <a href="{{ route('admin.items.index') }}" class="clear-link"><i class="bi bi-x-lg"></i>Clear all</a>
      @endif
    </div>
  </form>
</div>

<div class="results-bar">
  <span>
    @if($items->total() > 0)
      Showing <strong>{{ $items->firstItem() }}–{{ $items->lastItem() }}</strong> of <strong>{{ $items->total() }}</strong> items
    @else
      No items to show
    @endif
  </span>
  @if(request('search') || request('type'))
    <a href="{{ route('admin.items.index') }}">Reset all</a>
  @endif
</div>

{{-- ============ DESKTOP / TABLET TABLE (md and up) ============ --}}
<div class="glass-card d-none d-md-block">
  <div class="table-responsive">
    <table class="table align-middle mb-0 items-table">
      <thead>
        <tr>
          <th><i class="bi bi-tag"></i>Title</th>
          <th><i class="bi bi-signpost"></i>Type</th>
          <th><i class="bi bi-bookmark"></i>Category</th>
          <th><i class="bi bi-person"></i>Owner</th>
          <th><i class="bi bi-geo-alt"></i>Location</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td><span class="item-title" title="{{ $item->title }}">{{ $item->title }}</span></td>
          <td>
            <span class="badge-status {{ $item->item_type === 'lost' ? 'badge-lost' : 'badge-found' }}">
              <i class="bi {{ $item->item_type === 'lost' ? 'bi-search' : 'bi-check-circle-fill' }}"></i>
              {{ ucfirst($item->item_type) }}
            </span>
          </td>
          <td>
            <div class="category-cell">
              <i class="bi bi-bookmark-fill"></i>
              {{ $item->category->name ?? '—' }}
            </div>
          </td>
          <td>
            <div class="owner-cell">
              <i class="bi bi-person-fill"></i>
              {{ $item->user->fullname ?? '—' }}
            </div>
          </td>
          <td class="text-muted small">
            <div class="item-location">
              <i class="bi bi-geo-alt-fill"></i>
              <span title="{{ $item->location }}">{{ $item->location }}</span>
            </div>
          </td>
          <td class="text-end">
            <div class="actions-cell">
              <form method="POST" action="{{ route('admin.items.destroy', $item) }}" onsubmit="return confirm('Delete this item? This cannot be undone.');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-glass btn-delete-item" title="Delete item" aria-label="Delete {{ $item->title }}">
                  <i class="bi bi-trash-fill" aria-hidden="true"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6">
            <div class="empty-state">
              <i class="bi bi-box-seam" aria-hidden="true"></i>
              @if(request('search') || request('type'))
                <p>No items match your filters.</p>
                <a href="{{ route('admin.items.index') }}">Clear filters</a>
              @else
                <p class="mb-0">No items found.</p>
              @endif
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ============ MOBILE CARD LIST (below md) ============ --}}
<div class="d-md-none item-card-list">
  @forelse($items as $item)
    <div class="glass-card item-card">
      <div class="item-card-head">
        <span class="item-card-title" title="{{ $item->title }}">{{ $item->title }}</span>
        <span class="badge-status {{ $item->item_type === 'lost' ? 'badge-lost' : 'badge-found' }}">
          <i class="bi {{ $item->item_type === 'lost' ? 'bi-search' : 'bi-check-circle-fill' }}"></i>
          {{ ucfirst($item->item_type) }}
        </span>
      </div>

      <dl>
        <div>
          <dt>Category</dt>
          <dd><i class="bi bi-bookmark-fill category-cell-icon"></i> {{ $item->category->name ?? '—' }}</dd>
        </div>
        <div>
          <dt>Owner</dt>
          <dd><i class="bi bi-person-fill"></i> {{ $item->user->fullname ?? '—' }}</dd>
        </div>
        <div>
          <dt>Location</dt>
          <dd><i class="bi bi-geo-alt-fill"></i> {{ $item->location ?? '—' }}</dd>
        </div>
      </dl>

      <div class="card-actions">
        <form method="POST" action="{{ route('admin.items.destroy', $item) }}" onsubmit="return confirm('Delete this item? This cannot be undone.');">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-glass btn-delete-item" title="Delete item" aria-label="Delete {{ $item->title }}">
            <i class="bi bi-trash-fill me-1" aria-hidden="true"></i> Delete
          </button>
        </form>
      </div>
    </div>
  @empty
    <div class="glass-card">
      <div class="empty-state">
        <i class="bi bi-box-seam" aria-hidden="true"></i>
        @if(request('search') || request('type'))
          <p>No items match your filters.</p>
          <a href="{{ route('admin.items.index') }}">Clear filters</a>
        @else
          <p class="mb-0">No items found.</p>
        @endif
      </div>
    </div>
  @endforelse
</div>

<div class="mt-3 pagination-wrap">
  @if($items->hasPages())
    @if($items->onFirstPage())
      <span class="page-btn is-disabled"><i class="bi bi-chevron-left" aria-hidden="true"></i> Prev</span>
    @else
      <a href="{{ $items->previousPageUrl() }}" class="page-btn" rel="prev"><i class="bi bi-chevron-left" aria-hidden="true"></i> Prev</a>
    @endif

    @foreach($items->getUrlRange(max(1, $items->currentPage() - 2), min($items->lastPage(), $items->currentPage() + 2)) as $page => $url)
      @if($page == $items->currentPage())
        <span class="page-btn is-active" aria-current="page">{{ $page }}</span>
      @else
        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
      @endif
    @endforeach

    @if($items->hasMorePages())
      <a href="{{ $items->nextPageUrl() }}" class="page-btn" rel="next">Next <i class="bi bi-chevron-right" aria-hidden="true"></i></a>
    @else
      <span class="page-btn is-disabled">Next <i class="bi bi-chevron-right" aria-hidden="true"></i></span>
    @endif
  @endif
</div>
@endsection