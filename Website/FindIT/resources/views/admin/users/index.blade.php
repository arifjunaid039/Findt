@extends('admin.layout')
@section('title', 'Users')
@section('content')
<style>
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
    font-size:.8rem;
    pointer-events:none;
  }
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
  /* Chrome/Firefox render native <select> option lists with the OS theme,
     ignoring our CSS vars. color-scheme tells the browser which palette
     to draw them in, so options stay legible instead of white-on-white
     or barely-readable in dark mode. */
  html.dark .filter-form .form-select{ color-scheme:dark; }
  html:not(.dark) .filter-form .form-select{ color-scheme:light; }

  .filter-form .btn-blue{
    font-weight:600;
    font-size:.86rem;
  }
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

  .users-table{ --bs-table-color:var(--text); --bs-emphasis-color:var(--text); color:var(--text); }
  .users-table thead th{
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
  .users-table thead th a{
    color:inherit;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:5px;
  }
  .users-table thead th a:hover{ color:var(--blue); }
  .users-table thead th a i{ font-size:.65rem; opacity:.6; }
  .users-table thead th a.active-sort{ color:var(--blue); }
  .users-table thead th a.active-sort i{ opacity:1; }

  .users-table tbody td{
    border-bottom:1px solid var(--card-border);
    color:var(--text) !important;
    background:transparent;
    vertical-align:middle;
  }
  .users-table tbody td.text-muted{ color:var(--text-muted) !important; }
  .users-table tbody tr:last-child td{ border-bottom:none; }
  .users-table tbody tr:hover td{
    background:var(--card);
  }

  .user-cell{ display:flex; align-items:center; gap:10px; min-width:0; }
  .user-cell > div:last-child{ min-width:0; }
  .user-avatar{
    width:34px; height:34px;
    border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:.78rem;
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

  .user-name-line{ display:flex; align-items:center; flex-wrap:wrap; gap:4px; }
  .user-email{
    font-size:.78rem;
    color:var(--text-muted) !important;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    max-width:100%;
  }
  .you-tag{
    font-size:.65rem;
    font-weight:700;
    color:var(--blue);
    background:var(--blue-soft);
    padding:1px 7px;
    border-radius:999px;
    vertical-align:middle;
  }

  .badge-status{
    font-size:.72rem;
    font-weight:600;
    padding:3px 10px;
    border-radius:999px;
    text-transform:capitalize;
    white-space:nowrap;
  }
  .badge-active{ background:rgba(22,163,74,.14); color:#16a34a; }
  .badge-blocked{ background:rgba(220,38,38,.14); color:#dc2626; }
  html.dark .badge-active{ background:rgba(74,222,128,.18); color:#4ade80; }
  html.dark .badge-blocked{ background:rgba(255,156,156,.18); color:#ff9c9c; }

  /* Extra info shown stacked under the name once Phone/Status/Joined
     columns collapse off screen on narrow viewports. */
  .user-meta{
    display:none;
    flex-wrap:wrap;
    align-items:center;
    gap:4px 10px;
    font-size:.72rem;
    color:var(--text-muted);
    margin-top:4px;
  }
  .user-meta .meta-piece{ display:inline-flex; align-items:center; gap:4px; }
  .user-meta i{ font-size:.75rem; }

  .btn-outline-glass{
    border:1px solid var(--card-border);
    background:transparent;
    color:var(--text);
    font-weight:600;
    font-size:.78rem;
    transition:.15s;
  }
  .btn-outline-glass:hover{
    background:var(--card);
    border-color:var(--blue);
    color:var(--blue);
  }
  .btn-outline-glass:disabled{
    opacity:.4;
    cursor:not-allowed;
  }

  .btn-block-user{
    border:1px solid rgba(220,38,38,.28);
    background:rgba(220,38,38,.06);
    color:#dc2626;
  }
  .btn-block-user:hover{
    background:rgba(220,38,38,.14);
    border-color:#dc2626;
    color:#dc2626;
  }
  html.dark .btn-block-user{ border-color:rgba(255,156,156,.3); background:rgba(255,156,156,.08); color:#ff9c9c; }
  html.dark .btn-block-user:hover{ background:rgba(255,156,156,.18); border-color:#ff9c9c; color:#ff9c9c; }

  .btn-unblock-user{
    border:1px solid rgba(22,163,74,.3);
    background:rgba(22,163,74,.08);
    color:#16a34a;
  }
  .btn-unblock-user:hover{
    background:rgba(22,163,74,.16);
    border-color:#16a34a;
    color:#16a34a;
  }
  html.dark .btn-unblock-user{ border-color:rgba(74,222,128,.3); background:rgba(74,222,128,.1); color:#4ade80; }
  html.dark .btn-unblock-user:hover{ background:rgba(74,222,128,.2); border-color:#4ade80; color:#4ade80; }

  .btn-outline-glass.text-danger:hover{
    border-color:var(--danger) !important;
    color:var(--danger) !important;
    background:rgba(220,38,38,.08);
  }
  html.dark .btn-outline-glass.text-danger:hover{
    background:rgba(248,113,113,.12);
  }

  .empty-state{ text-align:center; color:var(--text-muted); padding:28px 8px 10px; }
  .empty-state i{ font-size:1.4rem; opacity:.4; display:block; margin-bottom:8px; }
  .empty-state p{ font-size:.85rem; margin:0 0 8px; }
  .empty-state a{ font-size:.78rem; font-weight:600; color:var(--blue); text-decoration:none; }
  .empty-state a:hover{ text-decoration:underline; }

  /* ---- Responsive breakpoints ----
     >=992px (lg): full table, every column visible.
     768–991px (md): Phone column collapses into the user-meta line.
     <768px (xs/sm): Phone and Joined both collapse into user-meta;
                     Status stays visible as it's compact and useful
                     at a glance, but also mirrored into user-meta below
                     576px where the badge column itself gets tight. */
  @media (max-width: 991.98px){
    .col-phone{ display:none !important; }
    .user-meta .meta-phone{ display:inline-flex; }
  }
  @media (max-width: 767.98px){
    .col-joined{ display:none !important; }
    .user-meta .meta-joined{ display:inline-flex; }
  }
  @media (max-width: 575.98px){
    .col-status{ display:none !important; }
    .user-meta .meta-status{ display:inline-flex; }
    .users-table tbody td, .users-table thead th{ padding-left:.5rem; padding-right:.5rem; }
  }
  @media (min-width: 992px){
    .user-meta{ display:none !important; }
  }
  @media (max-width: 991.98px){
    .user-meta{ display:flex; }
  }
</style>

@php
  // Sort helper: builds a link that toggles asc/desc for the given column
  // while preserving every other query param (search, status, page, etc).
  // Safe to keep even if the controller doesn't read `sort`/`dir` yet —
  // it just won't change the order until that's wired up.
  $currentSort = request('sort');
  $currentDir  = request('dir', 'asc');
  $sortLink = function (string $column, string $label) use ($currentSort, $currentDir) {
      $nextDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';
      $url = request()->fullUrlWithQuery(['sort' => $column, 'dir' => $nextDir, 'page' => 1]);
      $isActive = $currentSort === $column;
      $icon = $isActive ? ($currentDir === 'asc' ? 'fa-arrow-up-short-wide' : 'fa-arrow-down-wide-short') : 'fa-sort';
      return '<a href="' . $url . '" class="' . ($isActive ? 'active-sort' : '') . '">' . $label . ' <i class="fa-solid ' . $icon . '"></i></a>';
  };

  $avatarPalette = ['0', '1', '2', '3', '4'];
  $currentAdminId = auth('admin')->check() ? auth('admin')->id() : null;
@endphp

<h1 class="page-title">Users</h1>
<p class="page-sub">View and manage all registered platform users.</p>

<div class="glass-card mb-3">
  <form method="GET" class="row g-3 filter-form">
    <div class="col-12 col-md-6">
      <label class="field-label" for="userSearch">Search</label>
      <div class="input-icon-wrap">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input id="userSearch" type="text" name="search" value="{{ request('search') }}" class="form-control with-icon" placeholder="Name, email, phone, or CNIC">
      </div>
    </div>
    <div class="col-6 col-md-3">
      <label class="field-label" for="userStatus">Status</label>
      <select id="userStatus" name="status" class="form-select">
        <option value="">All statuses</option>
        <option value="active" @selected(request('status')==='active')>Active</option>
        <option value="blocked" @selected(request('status')==='blocked')>Blocked</option>
      </select>
    </div>
    <div class="col-6 col-md-3 d-flex align-items-end gap-2">
      <button class="btn btn-blue flex-grow-1 w-100"><i class="fa-solid fa-filter me-1"></i>Apply</button>
    </div>
    @if(request('search') || request('status'))
    <div class="col-12">
      <a href="{{ route('admin.users.index') }}" class="clear-link"><i class="fa-solid fa-xmark"></i>Clear all filters</a>
    </div>
    @endif
  </form>
</div>

<div class="results-bar">
  <span>
    @if($users->total() > 0)
      Showing <strong>{{ $users->firstItem() }}–{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong> users
    @else
      No users to show
    @endif
  </span>
  @if(request('search') || request('status') || request('sort'))
    <a href="{{ route('admin.users.index') }}">Reset all</a>
  @endif
</div>

<div class="glass-card">
  <div class="table-responsive">
    <table class="table align-middle mb-0 users-table">
      <thead>
        <tr>
          <th>{!! $sortLink('fullname', 'Name') !!}</th>
          <th class="col-phone">Phone</th>
          <th class="col-status">Status</th>
          <th class="col-joined">{!! $sortLink('created_at', 'Joined') !!}</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td>
            <div class="user-cell">
              <div class="user-avatar avatar-{{ $avatarPalette[$user->id % count($avatarPalette)] }}">
                {{ Str::substr($user->fullname ?: '?', 0, 1) }}
              </div>
              <div>
                <div class="user-name-line">
                  <span>{{ $user->fullname ?: 'Unnamed user' }}</span>
                  @if($currentAdminId && $user->id === $currentAdminId)
                    <span class="you-tag">You</span>
                  @endif
                </div>
                <div class="user-email">{{ $user->email }}</div>

                {{-- Collapsed-column info: only the pieces hidden at the
                     current breakpoint actually render (see .user-meta
                     media queries above). --}}
                <div class="user-meta">
                  <span class="meta-piece meta-phone">
                    <i class="fa-solid fa-phone"></i>
                    <span>{{ $user->phone ?: '—' }}</span>
                  </span>
                  <span class="meta-piece meta-status">
                    <span class="badge-status badge-{{ $user->status }}">{{ ucfirst($user->status) }}</span>
                  </span>
                  <span class="meta-piece meta-joined">
                    <i class="fa-solid fa-calendar"></i>
                    <span>{{ $user->created_at->format('d M Y') }}</span>
                  </span>
                </div>
              </div>
            </div>
          </td>
          <td class="col-phone">{{ $user->phone ?: '—' }}</td>
          <td class="col-status"><span class="badge-status badge-{{ $user->status }}">{{ ucfirst($user->status) }}</span></td>
          <td class="text-muted small col-joined">{{ $user->created_at->format('d M Y') }}</td>
          <td class="text-end">
            <div class="d-flex gap-1 justify-content-end flex-wrap">
              <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user? This will also delete their items.');">
                @csrf @method('DELETE')
                <button
                  class="btn btn-sm btn-outline-glass text-danger"
                  title="{{ $currentAdminId && $user->id === $currentAdminId ? 'You cannot delete your own account' : 'Delete user' }}"
                  {{ $currentAdminId && $user->id === $currentAdminId ? 'disabled' : '' }}>
                  <i class="fa-solid fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5">
            <div class="empty-state">
              <i class="fa-solid fa-users"></i>
              @if(request('search') || request('status'))
                <p>No users match your filters.</p>
                <a href="{{ route('admin.users.index') }}">Clear filters</a>
              @else
                <p class="mb-0">No users found.</p>
              @endif
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $users->appends(request()->query())->links() }}</div>
@endsection