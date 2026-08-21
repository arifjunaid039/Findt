@extends('admin.layout')
@section('title', 'Claims')
@section('content')

<style>
  .filter-form .form-select{
    background:var(--bg-soft);
    border:1px solid var(--card-border);
    color:var(--text);
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%2366738c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right .75rem center;
    background-size:14px;
  }
  .filter-form .form-select:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 3px var(--blue-soft);
    background-color:var(--bg-soft);
    color:var(--text);
  }
  html.dark .filter-form .form-select{
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%238ea0c4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
  }

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
  .claims-table{ --bs-table-color:var(--text); --bs-emphasis-color:var(--text); color:var(--text); }
  .claims-table thead th{
    font-size:.72rem;
    letter-spacing:.06em;
    text-transform:uppercase;
    font-weight:700;
    border-bottom:1px solid var(--card-border);
    padding-bottom:12px;
    background:transparent;
  }
  .claims-table thead th i{ margin-right:4px; font-size:.8rem; }
  .claims-table thead th:nth-child(1){ color:var(--text-muted) !important; }
  .claims-table thead th:nth-child(2){ color:var(--blue) !important; }
  .claims-table thead th:nth-child(2) i{ color:var(--blue); }
  .claims-table thead th:nth-child(3){ color:#0d9488 !important; }
  .claims-table thead th:nth-child(3) i{ color:#0d9488; }
  .claims-table thead th:nth-child(4){ color:#9333ea !important; }
  .claims-table thead th:nth-child(4) i{ color:#9333ea; }
  .claims-table thead th:nth-child(5){ color:#d97706 !important; }
  .claims-table thead th:nth-child(5) i{ color:#d97706; }
  .claims-table thead th:nth-child(6){ color:var(--text-muted) !important; }
  .claims-table thead th:nth-child(6) i{ color:var(--text-muted); }
  .claims-table thead th:nth-child(7){ color:var(--text-muted) !important; }
  html.dark .claims-table thead th:nth-child(3){ color:#2dd4bf !important; }
  html.dark .claims-table thead th:nth-child(3) i{ color:#2dd4bf; }
  html.dark .claims-table thead th:nth-child(4){ color:#c084fc !important; }
  html.dark .claims-table thead th:nth-child(4) i{ color:#c084fc; }
  html.dark .claims-table thead th:nth-child(5){ color:#fbbf24 !important; }
  html.dark .claims-table thead th:nth-child(5) i{ color:#fbbf24; }
  .claims-table tbody td{
    border-bottom:1px solid var(--card-border);
    color:var(--text) !important;
    background:transparent;
    vertical-align:middle;
  }
  .claims-table tbody td.text-muted{ color:var(--text-muted) !important; }
  .claims-table tbody tr:last-child td{ border-bottom:none; }
  .claims-table tbody tr:hover td{ background:var(--card); }

  .claim-message{
    display:block;
    max-width:220px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
  }

  .badge-status{
    font-size:.72rem;
    font-weight:600;
    padding:3px 10px;
    border-radius:999px;
    text-transform:capitalize;
    white-space:nowrap;
  }
  .badge-pending{ background:rgba(217,119,6,.14); color:#b45309; }
  .badge-approved{ background:rgba(22,163,74,.14); color:#15803d; }
  .badge-rejected{ background:rgba(220,38,38,.14); color:#b91c1c; }
  html.dark .badge-pending{ background:rgba(251,191,36,.18); color:#fbbf24; }
  html.dark .badge-approved{ background:rgba(74,222,128,.18); color:#4ade80; }
  html.dark .badge-rejected{ background:rgba(255,156,156,.18); color:#ff9c9c; }

  .btn-outline-glass{
    border:1px solid var(--card-border);
    background:transparent;
    color:var(--text);
    transition:.15s;
  }
  .btn-outline-glass:hover{
    background:var(--card);
    border-color:var(--blue);
  }
  .btn-outline-glass:focus-visible,
  .btn-blue:focus-visible{
    outline:2px solid var(--blue);
    outline-offset:2px;
  }

  .empty-state{ text-align:center; color:var(--text-muted); padding:8px; }
  .empty-state i{ font-size:1.3rem; opacity:.4; display:block; margin-bottom:8px; }

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

  .claims-page, .claims-page p, .claims-page span, .claims-page small, .claims-page label{ color:var(--text); }
  .claims-page .text-muted{ color:var(--text-muted) !important; }

  /* ============ MOBILE CARD LIST (below md) ============ */
  .claim-card-list{ display:flex; flex-direction:column; gap:10px; }
  .claim-card{
    border:1px solid var(--card-border);
    border-radius:.75rem;
    padding:14px;
    background:transparent;
  }
  html.dark .claim-card{ background:rgba(255,255,255,.03); }
  .claim-card .claim-card-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:8px;
    margin-bottom:8px;
  }
  .claim-card .claim-card-id{ font-size:.78rem; color:var(--text-muted); }
  .claim-card dl{ margin:0; }
  .claim-card dl div{
    display:flex;
    gap:8px;
    padding:5px 0;
    border-bottom:1px dashed var(--card-border);
    font-size:.86rem;
  }
  .claim-card dl div:last-of-type{ border-bottom:none; }
  .claim-card dt{
    flex:0 0 90px;
    color:var(--text-muted);
    font-weight:600;
    font-size:.72rem;
    text-transform:uppercase;
    letter-spacing:.04em;
    padding-top:2px;
  }
  .claim-card dd{
    margin:0;
    color:var(--text);
    word-break:break-word;
  }
  .claim-card .card-actions{
    margin-top:10px;
    display:flex;
    gap:8px;
  }
  .claim-card .card-actions form{ flex:1; }
  .claim-card .card-actions .btn{ width:100%; }
</style>

<div class="claims-page">
<h1 class="page-title">Claims</h1>
<p class="page-sub">Every claim made on lost/found items.</p>

@if(session('success'))
  <div class="page-alert page-alert-success" role="status">
    <i class="fa-solid fa-circle-check"></i>
    {{ session('success') }}
  </div>
@endif
@if(session('error'))
  <div class="page-alert page-alert-danger" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i>
    {{ session('error') }}
  </div>
@endif
@if($errors->any())
  <div class="page-alert page-alert-danger" role="alert">
    <i class="fa-solid fa-triangle-exclamation"></i>
    {{ $errors->first() }}
  </div>
@endif

<div class="glass-card mb-3">
  <form method="GET" class="row g-2 filter-form">
    <div class="col-md-3">
      <label for="claimStatus" class="visually-hidden">Filter by status</label>
      <select id="claimStatus" name="status" class="form-select">
        <option value="">All Status</option>
        <option value="pending" @selected(request('status')==='pending')>Pending</option>
        <option value="approved" @selected(request('status')==='approved')>Approved</option>
        <option value="rejected" @selected(request('status')==='rejected')>Rejected</option>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-blue w-100">Filter</button>
    </div>
  </form>
</div>

{{-- ============ DESKTOP / TABLET TABLE (md and up) ============ --}}
<div class="glass-card d-none d-md-block">
  <div class="table-responsive">
    <table class="table align-middle mb-0 claims-table">
      <thead>
        <tr>
          <th>#</th>
          <th><i class="fa-solid fa-box" aria-hidden="true"></i>Item</th>
          <th><i class="fa-solid fa-user" aria-hidden="true"></i>Claimant</th>
          <th><i class="fa-solid fa-message" aria-hidden="true"></i>Message</th>
          <th><i class="fa-solid fa-flag" aria-hidden="true"></i>Status</th>
          <th><i class="fa-regular fa-calendar" aria-hidden="true"></i>Date</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($claims as $claim)
        <tr>
          <td class="text-muted small">#{{ $claim->id }}</td>
          <td>{{ $claim->item->title ?? '—' }}</td>
          <td>{{ $claim->claimant->fullname ?? '—' }}</td>
          <td class="text-muted small">
            <span class="claim-message" title="{{ $claim->message }}">{{ $claim->message }}</span>
          </td>
          <td><span class="badge-status badge-{{ $claim->status }}">{{ ucfirst($claim->status) }}</span></td>
          <td class="text-muted small">{{ optional($claim->created_at)->format('d M Y') }}</td>
          <td class="text-end">
            <div class="d-flex gap-1 justify-content-end flex-wrap">
              <form method="POST" action="{{ route('admin.claims.destroy', $claim) }}" onsubmit="return confirm('Delete this claim?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-glass text-danger" title="Delete claim" aria-label="Delete claim #{{ $claim->id }}">
                  <i class="fa-solid fa-trash" aria-hidden="true"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">
            <div class="empty-state">
              <i class="fa-solid fa-hourglass-half" aria-hidden="true"></i>
              <p class="mb-0">No claims found.</p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ============ MOBILE CARD LIST (below md) ============ --}}
<div class="d-md-none claim-card-list">
  @forelse($claims as $claim)
    <div class="glass-card claim-card">
      <div class="claim-card-head">
        <span class="claim-card-id">#{{ $claim->id }}</span>
        <span class="badge-status badge-{{ $claim->status }}">{{ ucfirst($claim->status) }}</span>
      </div>

      <dl>
        <div>
          <dt>Item</dt>
          <dd>{{ $claim->item->title ?? '—' }}</dd>
        </div>
        <div>
          <dt>Claimant</dt>
          <dd>{{ $claim->claimant->fullname ?? '—' }}</dd>
        </div>
        <div>
          <dt>Message</dt>
          <dd>{{ $claim->message ?? '—' }}</dd>
        </div>
        <div>
          <dt>Date</dt>
          <dd>{{ optional($claim->created_at)->format('d M Y') }}</dd>
        </div>
      </dl>

      <div class="card-actions">
        <form method="POST" action="{{ route('admin.claims.destroy', $claim) }}" onsubmit="return confirm('Delete this claim?');">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-glass text-danger" title="Delete claim" aria-label="Delete claim #{{ $claim->id }}">
            <i class="fa-solid fa-trash me-1" aria-hidden="true"></i> Delete
          </button>
        </form>
      </div>
    </div>
  @empty
    <div class="glass-card">
      <div class="empty-state">
        <i class="fa-solid fa-hourglass-half" aria-hidden="true"></i>
        <p class="mb-0">No claims found.</p>
      </div>
    </div>
  @endforelse
</div>

<div class="mt-3 pagination-wrap">
  {{-- Custom pagination using Font Awesome icons instead of the default
       Laravel/Bootstrap "Previous"/"Next" text view. --}}
  @if($claims->hasPages())
    @if($claims->onFirstPage())
      <span class="page-btn is-disabled"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Prev</span>
    @else
      <a href="{{ $claims->previousPageUrl() }}" class="page-btn" rel="prev"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i> Prev</a>
    @endif

    @foreach($claims->getUrlRange(max(1, $claims->currentPage() - 2), min($claims->lastPage(), $claims->currentPage() + 2)) as $page => $url)
      @if($page == $claims->currentPage())
        <span class="page-btn is-active" aria-current="page">{{ $page }}</span>
      @else
        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
      @endif
    @endforeach

    @if($claims->hasMorePages())
      <a href="{{ $claims->nextPageUrl() }}" class="page-btn" rel="next">Next <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
    @else
      <span class="page-btn is-disabled">Next <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></span>
    @endif
  @endif
</div>
</div>
@endsection