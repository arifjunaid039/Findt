@extends('admin.layout')
@section('title', 'Users')
@section('content')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap');

  /* ---------- tokens (scoped, built on top of the layout's existing vars) ---------- */
  .ureg{
    --reg-teal:#2563eb; --reg-teal-soft:rgba(37,99,235,.09);
    --reg-active:#1a8f5c; --reg-active-soft:rgba(26,143,92,.12);
    --reg-blocked:#d1453b; --reg-blocked-soft:rgba(209,69,59,.12);
  }
  html.dark .ureg{
    --reg-teal:#60a5fa; --reg-teal-soft:rgba(96,165,250,.14);
    --reg-active:#34e0a1; --reg-active-soft:rgba(52,224,161,.14);
    --reg-blocked:#ff8a80; --reg-blocked-soft:rgba(255,138,128,.14);
  }

  /* ---------- header ---------- */
  .ureg-eyebrow{
    font-family:'Space Grotesk',sans-serif; font-size:.7rem; font-weight:600;
    letter-spacing:.16em; text-transform:uppercase; color:var(--reg-teal);
    display:flex; align-items:center; gap:7px; margin-bottom:8px;
  }
  .ureg-eyebrow .dot{ width:6px; height:6px; border-radius:50%; background:var(--reg-teal); flex-shrink:0; }
  .ureg-head{ display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:10px 16px; }
  .ureg-head h1{ margin-bottom:2px; }
  .ureg-count{
    font-family:'IBM Plex Mono',monospace; font-size:.72rem; font-weight:600; color:var(--reg-teal);
    background:var(--reg-teal-soft); border:1px solid var(--reg-teal-soft); padding:5px 11px;
    border-radius:999px; white-space:nowrap; margin-bottom:4px;
  }

  /* ---------- toolbar ---------- */
  .ureg-toolbar{ margin:16px 0; }
  .ureg-form{ margin:0; }
  .ureg-label{
    font-family:'Space Grotesk',sans-serif; font-size:.68rem; font-weight:600; letter-spacing:.08em;
    text-transform:uppercase; color:var(--text-muted); margin-bottom:7px; display:block;
  }
  .ureg-input-wrap{ position:relative; }
  .ureg-input-wrap i{
    position:absolute; left:14px; top:50%; transform:translateY(-50%);
    color:var(--text-muted); font-size:.8rem; pointer-events:none;
  }
  .ureg-input{
    width:100%; padding:10px 14px 10px 38px; border-radius:10px;
    background:var(--bg-soft, var(--surface)); border:1px solid var(--card-border);
    color:var(--text); font-size:.88rem;
  }
  .ureg-input::placeholder{ color:var(--text-muted); opacity:.8; }
  .ureg-input:focus{
    outline:none; border-color:var(--reg-teal);
    box-shadow:0 0 0 3px var(--reg-teal-soft);
  }

  .ureg-segmented{
    display:inline-flex; padding:3px; border-radius:10px;
    background:var(--bg-soft, var(--surface)); border:1px solid var(--card-border); width:100%;
  }
  .ureg-segmented input{ position:absolute; opacity:0; width:0; height:0; }
  .ureg-seg{
    flex:1; text-align:center; padding:7px 10px; border-radius:7px; cursor:pointer;
    font-size:.82rem; font-weight:600; color:var(--text-muted); transition:.15s;
    user-select:none;
  }
  .ureg-segmented input:checked + .ureg-seg{
    background:var(--card); color:var(--reg-teal); box-shadow:0 1px 3px rgba(0,0,0,.08);
  }
  .ureg-segmented input:focus-visible + .ureg-seg{ outline:2px solid var(--reg-teal); outline-offset:1px; }

  .ureg-apply{
    font-family:'Space Grotesk',sans-serif; font-weight:600; font-size:.86rem;
    background:var(--reg-teal); border:1px solid var(--reg-teal); color:#fff;
    border-radius:10px; padding:10px 16px; width:100%; transition:.15s; white-space:nowrap;
  }
  .ureg-apply:hover{ filter:brightness(1.08); color:#fff; }

  .ureg-clear{
    display:inline-flex; align-items:center; gap:6px; font-size:.8rem; font-weight:600;
    color:var(--text-muted); text-decoration:none; padding:4px; transition:color .15s;
  }
  .ureg-clear:hover{ color:var(--reg-blocked); }

  /* ---------- results bar ---------- */
  .ureg-resultsbar{
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;
    gap:8px; padding:0 2px 12px; font-size:.78rem; color:var(--text-muted);
  }
  .ureg-resultsbar strong{ color:var(--text); font-family:'IBM Plex Mono',monospace; }
  .ureg-resultsbar a{ color:var(--reg-teal); text-decoration:none; font-weight:600; }
  .ureg-resultsbar a:hover{ text-decoration:underline; }

  /* ---------- registry list ---------- */
  .ureg-registry{ padding:6px; }
  .ureg-row{
    display:grid; grid-template-columns:minmax(200px,1fr) 130px 110px 140px 220px;
    align-items:center; gap:14px; padding:14px 14px; border-radius:12px;
  }
  .ureg-row + .ureg-row{ border-top:1px solid var(--card-border); }
  .ureg-row.is-head{
    font-family:'Space Grotesk',sans-serif; font-size:.68rem; font-weight:700; letter-spacing:.07em;
    text-transform:uppercase; color:var(--text-muted); padding-bottom:12px; border-top:none;
  }
  .ureg-row.is-head a{ color:inherit; text-decoration:none; display:inline-flex; align-items:center; gap:5px; }
  .ureg-row.is-head a:hover{ color:var(--reg-teal); }
  .ureg-row.is-head a i{ font-size:.6rem; opacity:.55; }
  .ureg-row.is-head a.active-sort{ color:var(--reg-teal); }
  .ureg-row.is-head a.active-sort i{ opacity:1; }
  .ureg-row:not(.is-head):hover{ background:var(--bg-soft, var(--surface)); }

  .ureg-col-actions{ justify-self:end; }
  .ureg-col-mono{ font-family:'IBM Plex Mono',monospace; font-size:.8rem; color:var(--text-muted); }

  /* -- identity cell -- */
  .ureg-identity{ display:flex; align-items:center; gap:12px; min-width:0; }
  .ureg-avatar{
    width:42px; height:42px; border-radius:50%; display:flex; align-items:center; justify-content:center;
    font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:.86rem; flex-shrink:0;
    text-transform:uppercase; position:relative; overflow:hidden;
  }
  .ureg-avatar.is-active{ box-shadow:0 0 0 2px var(--card),0 0 0 4px var(--reg-active-soft); }
  .ureg-avatar.is-blocked{ box-shadow:0 0 0 2px var(--card),0 0 0 4px var(--reg-blocked-soft); }
  .ureg-avatar-img{ width:100%; height:100%; object-fit:cover; border-radius:50%; display:block; }
  .ureg-avatar-fallback{ width:100%; height:100%; display:flex; align-items:center; justify-content:center; }
  .ureg-tone-0{ background:rgba(37,99,235,.12); color:#2563eb; }
  .ureg-tone-1{ background:rgba(14,116,144,.12); color:#0e7490; }
  .ureg-tone-2{ background:rgba(79,70,229,.12); color:#4f46e5; }
  .ureg-tone-3{ background:rgba(3,105,161,.12); color:#0369a1; }
  .ureg-tone-4{ background:rgba(71,85,105,.12); color:#475569; }
  html.dark .ureg-tone-0{ background:rgba(96,165,250,.18); color:#93c5fd; }
  html.dark .ureg-tone-1{ background:rgba(34,211,238,.16); color:#67e8f9; }
  html.dark .ureg-tone-2{ background:rgba(129,140,248,.18); color:#a5b4fc; }
  html.dark .ureg-tone-3{ background:rgba(56,189,248,.18); color:#7dd3fc; }
  html.dark .ureg-tone-4{ background:rgba(148,163,184,.18); color:#cbd5e1; }

  .ureg-status-dot{
    position:absolute; width:11px; height:11px; border-radius:50%; right:-1px; bottom:-1px;
    border:2px solid var(--card); background:var(--reg-blocked);
  }
  .ureg-status-dot.is-active{ background:var(--reg-active); }
  .ureg-status-dot.is-active::after{
    content:''; position:absolute; inset:0; border-radius:50%; background:var(--reg-active);
    animation:ureg-pulse 2s ease-out infinite;
  }
  @keyframes ureg-pulse{
    0%{ box-shadow:0 0 0 0 rgba(26,143,92,.55); }
    100%{ box-shadow:0 0 0 7px rgba(26,143,92,0); }
  }
  @media (prefers-reduced-motion: reduce){ .ureg-status-dot.is-active::after{ animation:none; } }

  .ureg-name-line{ display:flex; align-items:center; flex-wrap:wrap; gap:6px; min-width:0; }
  .ureg-name-line span:first-child{ overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .ureg-you-tag{
    font-family:'Space Grotesk',sans-serif; font-size:.62rem; font-weight:700; color:var(--reg-teal);
    background:var(--reg-teal-soft); padding:1px 7px; border-radius:999px; flex-shrink:0;
  }
  .ureg-email{
    font-size:.78rem; color:var(--text-muted); overflow:hidden; text-overflow:ellipsis;
    white-space:nowrap; max-width:100%;
  }

  .ureg-meta{ display:none; flex-wrap:wrap; align-items:center; gap:5px 12px; font-size:.76rem; color:var(--text-muted); margin-top:6px; }
  .ureg-meta .piece{ display:inline-flex; align-items:center; gap:5px; font-family:'IBM Plex Mono',monospace; }
  .ureg-meta i{ font-size:.72rem; font-family:'Font Awesome 6 Free'; }

  /* -- badge -- */
  .ureg-badge{
    font-size:.72rem; font-weight:600; padding:3px 10px; border-radius:999px; text-transform:capitalize; white-space:nowrap;
  }
  .ureg-badge.is-active{ background:var(--reg-active-soft); color:var(--reg-active); }
  .ureg-badge.is-blocked{ background:var(--reg-blocked-soft); color:var(--reg-blocked); }

  /* -- action buttons -- */
  .ureg-actions{ display:flex; gap:6px; justify-content:flex-end; flex-wrap:wrap; }
  .ureg-btn{
    display:inline-flex; align-items:center; gap:6px; font-size:.78rem; font-weight:600;
    border-radius:8px; padding:7px 11px; border:1px solid var(--card-border); background:transparent;
    color:var(--text); transition:.15s; line-height:1;
  }
  .ureg-btn:hover{ background:var(--bg-soft, var(--surface)); border-color:var(--reg-teal); color:var(--reg-teal); }
  .ureg-btn:disabled{ opacity:.35; cursor:not-allowed; }
  .ureg-btn:disabled:hover{ background:transparent; border-color:var(--card-border); color:var(--text); }
  .ureg-btn.is-block{ border-color:var(--reg-blocked-soft); background:var(--reg-blocked-soft); color:var(--reg-blocked); }
  .ureg-btn.is-block:hover{ border-color:var(--reg-blocked); background:var(--reg-blocked-soft); color:var(--reg-blocked); }
  .ureg-btn.is-unblock{ border-color:var(--reg-active-soft); background:var(--reg-active-soft); color:var(--reg-active); }
  .ureg-btn.is-unblock:hover{ border-color:var(--reg-active); background:var(--reg-active-soft); color:var(--reg-active); }
  .ureg-btn.is-danger:hover{ border-color:var(--reg-blocked); color:var(--reg-blocked); background:var(--reg-blocked-soft); }

  /* ---------- empty state ---------- */
  .ureg-empty{ text-align:center; color:var(--text-muted); padding:40px 12px; }
  .ureg-empty i{ font-size:1.5rem; opacity:.35; display:block; margin-bottom:10px; color:var(--reg-teal); }
  .ureg-empty p{ font-size:.88rem; margin:0 0 8px; }
  .ureg-empty a{ font-size:.8rem; font-weight:600; color:var(--reg-teal); text-decoration:none; }
  .ureg-empty a:hover{ text-decoration:underline; }

  /* ---------- responsive ---------- */
  @media (max-width: 991.98px){
    .ureg-row{ grid-template-columns:minmax(180px,1fr) 110px 140px 200px; }
    .ureg-col-phone{ display:none; }
    .ureg-meta .meta-phone{ display:inline-flex; }
  }
  @media (max-width: 767.98px){
    .ureg-row.is-head{ display:none; }
    .ureg-row:not(.is-head){
      display:flex; flex-direction:column; align-items:stretch; gap:12px;
      background:var(--bg-soft, var(--surface)); margin-bottom:10px; padding:14px;
    }
    .ureg-row:not(.is-head):hover{ background:var(--bg-soft, var(--surface)); }
    .ureg-row + .ureg-row{ border-top:none; }
    .ureg-col-status, .ureg-col-joined{ display:none; }
    .ureg-meta{ display:flex; }
    .ureg-meta .meta-status, .ureg-meta .meta-joined{ display:inline-flex; }
    .ureg-col-actions{ justify-self:stretch; }
    .ureg-actions{ justify-content:flex-start; }
    .ureg-actions form, .ureg-actions .ureg-btn{ flex:1; justify-content:center; }
  }
  @media (min-width: 768px){ .ureg-meta{ display:none !important; } }
  @media (max-width: 420px){
    .ureg-avatar{ width:36px; height:36px; font-size:.76rem; }
    .ureg-row:not(.is-head){ padding:12px; }
    .ureg-email{ max-width:180px; }
    .ureg-actions .ureg-btn{ font-size:.74rem; padding:7px 9px; }
    .ureg-count{ font-size:.68rem; }
  }
</style>

@php
  $currentSort = request('sort');
  $currentDir  = request('dir', 'asc');
  $sortLink = function (string $column, string $label) use ($currentSort, $currentDir) {
      $nextDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';
      $url = request()->fullUrlWithQuery(['sort' => $column, 'dir' => $nextDir, 'page' => 1]);
      $isActive = $currentSort === $column;
      $icon = $isActive ? ($currentDir === 'asc' ? 'fa-arrow-up-short-wide' : 'fa-arrow-down-wide-short') : 'fa-sort';
      return '<a href="' . $url . '" class="' . ($isActive ? 'active-sort' : '') . '">' . $label . ' <i class="fa-solid ' . $icon . '"></i></a>';
  };

  $tonePalette = ['0', '1', '2', '3', '4'];
  $currentAdminId = auth('admin')->check() ? auth('admin')->id() : null;
  $status = request('status');
@endphp

<div class="ureg">

  <div class="ureg-eyebrow"><span class="dot"></span>User registry</div>
  <div class="ureg-head">
    <div>
      <h1 class="page-title">Users</h1>
      <p class="page-sub">View and manage all registered platform users.</p>
    </div>
    <span class="ureg-count">{{ $users->total() }} total</span>
  </div>

  <div class="glass-card ureg-toolbar">
    <form method="GET" class="row g-3 ureg-form">
      <div class="col-12 col-md-6">
        <label class="ureg-label" for="userSearch">Search</label>
        <div class="ureg-input-wrap">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input id="userSearch" type="text" name="search" value="{{ request('search') }}" class="ureg-input" placeholder="Name, email, phone, or CNIC">
        </div>
      </div>
      <div class="col-12 col-md-4">
        <label class="ureg-label">Status</label>
        <div class="ureg-segmented" role="radiogroup" aria-label="Filter by status">
          <input type="radio" name="status" id="statusAll" value="" onchange="this.form.submit()" {{ $status ? '' : 'checked' }}>
          <label for="statusAll" class="ureg-seg">All</label>
          <input type="radio" name="status" id="statusActive" value="active" onchange="this.form.submit()" {{ $status==='active' ? 'checked' : '' }}>
          <label for="statusActive" class="ureg-seg">Active</label>
          <input type="radio" name="status" id="statusBlocked" value="blocked" onchange="this.form.submit()" {{ $status==='blocked' ? 'checked' : '' }}>
          <label for="statusBlocked" class="ureg-seg">Blocked</label>
        </div>
      </div>
      <div class="col-12 col-md-2 d-flex align-items-end">
        <button class="ureg-apply"><i class="fa-solid fa-filter me-1"></i>Apply</button>
      </div>
      @if(request('search') || $status)
      <div class="col-12">
        <a href="{{ route('admin.users.index') }}" class="ureg-clear"><i class="fa-solid fa-xmark"></i>Clear all filters</a>
      </div>
      @endif
    </form>
  </div>

  <div class="ureg-resultsbar">
    <span>
      @if($users->total() > 0)
        Showing <strong>{{ $users->firstItem() }}–{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong> users
      @else
        No users to show
      @endif
    </span>
    @if(request('search') || $status || $currentSort)
      <a href="{{ route('admin.users.index') }}">Reset all</a>
    @endif
  </div>

  <div class="glass-card ureg-registry">

    <div class="ureg-row is-head">
      <div>{!! $sortLink('fullname', 'Name') !!}</div>
      <div class="ureg-col-phone">Phone</div>
      <div class="ureg-col-status">Status</div>
      <div class="ureg-col-joined">{!! $sortLink('created_at', 'Joined') !!}</div>
      <div class="ureg-col-actions">Actions</div>
    </div>

    @forelse($users as $user)
      @php
        $isActive = $user->status === 'active';
        // Adjust this to match your users table's actual column name for the stored photo.
        $photoPath = $user->photo ?? $user->avatar ?? $user->profile_photo ?? null;
        $photoUrl = $photoPath ? (Str::startsWith($photoPath, ['http://', 'https://']) ? $photoPath : asset('storage/'.$photoPath)) : null;
      @endphp
      <div class="ureg-row">
        <div class="ureg-identity">
          <div class="ureg-avatar ureg-tone-{{ $tonePalette[$user->id % count($tonePalette)] }} {{ $isActive ? 'is-active' : 'is-blocked' }}">
            @if($photoUrl)
              <img src="{{ $photoUrl }}" alt="{{ $user->fullname ?: 'User' }}" class="ureg-avatar-img"
                   onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
              <span class="ureg-avatar-fallback" style="display:none;">{{ Str::substr($user->fullname ?: '?', 0, 1) }}</span>
            @else
              <span class="ureg-avatar-fallback">{{ Str::substr($user->fullname ?: '?', 0, 1) }}</span>
            @endif
            <span class="ureg-status-dot {{ $isActive ? 'is-active' : '' }}"></span>
          </div>
          <div style="min-width:0;">
            <div class="ureg-name-line">
              <span>{{ $user->fullname ?: 'Unnamed user' }}</span>
              @if($currentAdminId && $user->id === $currentAdminId)
                <span class="ureg-you-tag">You</span>
              @endif
            </div>
            <div class="ureg-email">{{ $user->email }}</div>

            <div class="ureg-meta">
              <span class="piece meta-phone"><i class="fa-solid fa-phone"></i>{{ $user->phone ?: '—' }}</span>
              <span class="piece meta-status"><span class="ureg-badge {{ $isActive ? 'is-active' : 'is-blocked' }}">{{ ucfirst($user->status) }}</span></span>
              <span class="piece meta-joined"><i class="fa-solid fa-calendar"></i>{{ $user->created_at->format('d M Y') }}</span>
            </div>
          </div>
        </div>

        <div class="ureg-col-phone ureg-col-mono">{{ $user->phone ?: '—' }}</div>
        <div class="ureg-col-status"><span class="ureg-badge {{ $isActive ? 'is-active' : 'is-blocked' }}">{{ ucfirst($user->status) }}</span></div>
        <div class="ureg-col-joined ureg-col-mono">{{ $user->created_at->format('d M Y') }}</div>

        <div class="ureg-col-actions">
          <div class="ureg-actions">

            {{-- Block / Unblock toggle. Add these routes to web.php to activate:
                 Route::patch('users/{user}/block', [UserController::class,'block'])->name('admin.users.block');
                 Route::patch('users/{user}/unblock', [UserController::class,'unblock'])->name('admin.users.unblock'); --}}
            @if($currentAdminId && $user->id === $currentAdminId)
              <button class="ureg-btn" disabled title="You cannot block your own account">
                <i class="fa-solid fa-ban"></i>
              </button>
            @elseif(!$isActive)
              @if(Route::has('admin.users.unblock'))
                <form method="POST" action="{{ route('admin.users.unblock', $user) }}" onsubmit="return confirm('Unblock {{ $user->fullname ?: 'this user' }}? They will regain full access to the platform.');">
                  @csrf @method('PATCH')
                  <button class="ureg-btn is-unblock" title="Unblock user">
                    <i class="fa-solid fa-lock-open"></i>Unblock
                  </button>
                </form>
              @endif
            @else
              @if(Route::has('admin.users.block'))
                <form method="POST" action="{{ route('admin.users.block', $user) }}" onsubmit="return confirm('Block {{ $user->fullname ?: 'this user' }}? They will lose access to the platform immediately.');">
                  @csrf @method('PATCH')
                  <button class="ureg-btn is-block" title="Block user">
                    <i class="fa-solid fa-ban"></i>Block
                  </button>
                </form>
              @endif
            @endif

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user? This will also delete their items.');">
              @csrf @method('DELETE')
              <button
                class="ureg-btn is-danger"
                title="{{ $currentAdminId && $user->id === $currentAdminId ? 'You cannot delete your own account' : 'Delete user' }}"
                {{ $currentAdminId && $user->id === $currentAdminId ? 'disabled' : '' }}>
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <div class="ureg-empty">
        <i class="fa-solid fa-users"></i>
        @if(request('search') || $status)
          <p>No users match your filters.</p>
          <a href="{{ route('admin.users.index') }}">Clear filters</a>
        @else
          <p class="mb-0">No users found.</p>
        @endif
      </div>
    @endforelse

  </div>

  <div class="mt-3">{{ $users->appends(request()->query())->links() }}</div>
</div>
@endsection