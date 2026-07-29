@extends('admin.layout')
@section('title', 'Communities')
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

  .community-card{ display:flex; flex-direction:column; transition:border-color .15s, box-shadow .15s; overflow:hidden; padding:0 !important; }
  .community-card:hover{ border-color:var(--blue); box-shadow:0 0 0 3px var(--blue-soft); }
  .community-cover{
    width:100%;
    aspect-ratio:16/9;
    object-fit:cover;
    background:var(--bg-soft);
    display:block;
  }
  .community-body{ padding:22px; display:flex; flex-direction:column; flex:1; }
  .card-image{ position:relative; }
  .member-badge{
    position:absolute;
    bottom:10px;
    left:10px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:.72rem;
    font-weight:600;
    padding:4px 10px;
    border-radius:999px;
    background:rgba(15,23,42,.65);
    color:#fff;
    backdrop-filter:blur(3px);
  }
  .member-badge i{ font-size:.7rem; }
  .community-name{
    font-size:1.15rem;
    font-weight:700;
    color:var(--text) !important;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    min-width:0;
  }
  .community-desc{
    color:var(--text-muted) !important;
    font-size:.88rem;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
    min-height:2.6em;
  }
  .community-meta{
    color:var(--text-muted) !important;
    border-top:1px solid var(--card-border);
    padding-top:10px;
    margin-top:2px;
  }
  .community-meta > div{
    display:flex;
    align-items:center;
    gap:7px;
    margin-bottom:4px;
  }
  .community-meta i{ width:14px; text-align:center; font-size:.8rem; }
  .community-meta .bi-loc,
  .community-meta .fa-location-dot{ color:#dc2626; opacity:.9; }
  .community-meta .fa-tag{ color:#9333ea; opacity:.9; }
  .community-meta .fa-lock{ color:#d97706; opacity:.9; }
  html.dark .community-meta .fa-location-dot{ color:#f87171; }
  html.dark .community-meta .fa-tag{ color:#c084fc; }
  html.dark .community-meta .fa-lock{ color:#fbbf24; }
  .community-actions{ margin-top:auto; padding-top:14px; }
  .community-actions form{ flex:1 1 auto; }
  .community-actions .btn{ width:100%; white-space:nowrap; }

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
  .btn-outline-glass.text-danger:hover{
    border-color:var(--danger) !important;
    color:var(--danger) !important;
    background:rgba(220,38,38,.08);
  }
  html.dark .btn-outline-glass.text-danger:hover{
    background:rgba(248,113,113,.12);
  }
  .btn-outline-glass:focus-visible,
  .btn-blue:focus-visible{
    outline:2px solid var(--blue);
    outline-offset:2px;
  }

  .empty-state{
    text-align:center;
    color:var(--text-muted);
    padding:40px 8px;
    width:100%;
  }
  .empty-state i{ font-size:1.6rem; opacity:.4; display:block; margin-bottom:10px; }
</style>

<h1 class="page-title">Communities</h1>
<p class="page-sub">Approve, reject, or remove user-created communities.</p>

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
    <div class="col-12 col-md-3">
      <label for="communityStatus" class="visually-hidden">Filter by status</label>
      <select id="communityStatus" name="status" class="form-select">
        <option value="">All Status</option>
        <option value="pending" @selected(request('status')==='pending')>Pending</option>
        <option value="approved" @selected(request('status')==='approved')>Approved</option>
        <option value="rejected" @selected(request('status')==='rejected')>Rejected</option>
      </select>
    </div>
    <div class="col-12 col-md-2">
      <button class="btn btn-blue w-100">Filter</button>
    </div>
  </form>
</div>

<div class="row g-3">
  @forelse($communities as $c)
  <div class="col-12 col-md-6">
    <div class="glass-card h-100 community-card">
      <div class="card-image">
        @if($c->image)
          <img src="{{ asset('uploads/communities/' . $c->image) }}" alt="{{ $c->name }} cover image" class="community-cover" loading="lazy">
        @else
          <img src="{{ asset('img/community-placeholder.jpg') }}" alt="{{ $c->name }} cover image" class="community-cover" loading="lazy">
        @endif
        <div class="member-badge">
          <i class="fa-solid fa-users" aria-hidden="true"></i> {{ $c->members->count() }} Members
        </div>
      </div>
      <div class="community-body">
      <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
        <h5 class="mb-0 community-name" title="{{ $c->name }}">{{ $c->name }}</h5>
        <span class="badge-status badge-{{ $c->status }}">{{ ucfirst($c->status) }}</span>
      </div>
      <p class="small community-desc mb-3">{{ $c->description }}</p>
      <div class="small community-meta mb-3">
        <div><i class="fa-solid fa-location-dot" aria-hidden="true"></i> {{ $c->location ?? '—' }}</div>
        <div><i class="fa-solid fa-tag" aria-hidden="true"></i> {{ $c->category ?? '—' }}</div>
        <div><i class="fa-solid fa-lock" aria-hidden="true"></i> {{ ucfirst($c->privacy) }}</div>
      </div>
      <div class="d-flex gap-1 flex-wrap community-actions">
        @if($c->status !== 'approved')
        <form method="POST" action="{{ route('admin.communities.approve', $c) }}">
          @csrf @method('PATCH')
          <button type="submit" class="btn btn-sm btn-blue"><i class="fa-solid fa-check" aria-hidden="true"></i> Approve</button>
        </form>
        @endif
        @if($c->status !== 'rejected')
        <form method="POST" action="{{ route('admin.communities.reject', $c) }}">
          @csrf @method('PATCH')
          <button type="submit" class="btn btn-sm btn-outline-glass"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Reject</button>
        </form>
        @endif
        <form method="POST" action="{{ route('admin.communities.destroy', $c) }}" onsubmit="return confirm('Delete this community?');">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-glass text-danger" title="Delete community" aria-label="Delete {{ $c->name }}">
            <i class="fa-solid fa-trash" aria-hidden="true"></i>
          </button>
        </form>
      </div>
      </div>
    </div>
  </div>
  @empty
  <div class="empty-state">
    <i class="fa-solid fa-people-group" aria-hidden="true"></i>
    <p class="mb-0">No communities found.</p>
  </div>
  @endforelse
</div>

<div class="mt-3">{{ $communities->links() }}</div>
@endsection