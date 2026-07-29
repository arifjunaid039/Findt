@extends('admin.layout')
@section('title', 'Messages')
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

  .messages-table{ --bs-table-color:var(--text); --bs-emphasis-color:var(--text); color:var(--text); }
  .messages-table thead th{
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
  .messages-table thead th a{
    color:inherit;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:5px;
  }
  .messages-table thead th a:hover{ color:var(--blue); }
  .messages-table thead th a i{ font-size:.65rem; opacity:.6; }
  .messages-table thead th a.active-sort{ color:var(--blue); }
  .messages-table thead th a.active-sort i{ opacity:1; }

  .messages-table tbody td{
    border-bottom:1px solid var(--card-border);
    color:var(--text) !important;
    background:transparent;
    vertical-align:top;
  }
  .messages-table tbody td.text-muted{ color:var(--text-muted) !important; }
  .messages-table tbody tr:last-child td{ border-bottom:none; }
  .messages-table tbody tr:hover td{
    background:var(--card);
  }

  .msg-sender{ font-weight:600; }
  .msg-email{
    font-size:.78rem;
    color:var(--text-muted) !important;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    max-width:220px;
  }
  .msg-subject{ font-weight:600; }
  .msg-body{
    font-size:.82rem;
    color:var(--text-muted);
    max-width:340px;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
  }

  /* Extra info shown stacked under the sender once Subject/Received
     columns collapse off screen on narrow viewports. */
  .msg-meta{
    display:none;
    flex-direction:column;
    gap:2px;
    font-size:.76rem;
    color:var(--text-muted);
    margin-top:6px;
  }
  .msg-meta .meta-piece{ display:flex; align-items:center; gap:5px; min-width:0; }
  .msg-meta .meta-piece span{ overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .msg-meta i{ font-size:.72rem; flex-shrink:0; }
  .msg-meta .meta-subject{ font-weight:600; color:var(--text); }

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
  .btn-outline-glass.copied{
    border-color:#16a34a;
    color:#16a34a;
  }
  html.dark .btn-outline-glass.copied{ border-color:#4ade80; color:#4ade80; }

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
     768–991px (md): Received column collapses into the msg-meta line.
     <768px (sm/xs): Subject also collapses into msg-meta, leaving only
                     Name / Message / Actions as real columns. */
  @media (max-width: 991.98px){
    .col-received{ display:none !important; }
    .msg-meta .meta-received{ display:flex; }
  }
  @media (max-width: 767.98px){
    .col-subject{ display:none !important; }
    .msg-meta .meta-subject{ display:flex; }
  }
  @media (max-width: 991.98px){
    .msg-meta{ display:flex; }
  }
  @media (min-width: 992px){
    .msg-meta{ display:none !important; }
  }
  @media (max-width: 575.98px){
    .msg-body{ max-width:150px; }
    .msg-email{ max-width:140px; }
    .messages-table tbody td, .messages-table thead th{ padding-left:.5rem; padding-right:.5rem; }
  }
</style>

@php
  // Sort helper: builds a link that toggles asc/desc for the given column
  // while preserving every other query param (search, page, etc).
  $currentSort = request('sort');
  $currentDir  = request('dir', 'asc');
  $sortLink = function (string $column, string $label) use ($currentSort, $currentDir) {
      $nextDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';
      $url = request()->fullUrlWithQuery(['sort' => $column, 'dir' => $nextDir, 'page' => 1]);
      $isActive = $currentSort === $column;
      $icon = $isActive ? ($currentDir === 'asc' ? 'fa-arrow-up-short-wide' : 'fa-arrow-down-wide-short') : 'fa-sort';
      return '<a href="' . $url . '" class="' . ($isActive ? 'active-sort' : '') . '">' . $label . ' <i class="fa-solid ' . $icon . '"></i></a>';
  };
@endphp

<h1 class="page-title">Messages</h1>
<p class="page-sub">Contact form submissions from your users.</p>

<div class="glass-card mb-3">
  <form method="GET" class="row g-3 filter-form">
    <div class="col-12 col-md-9">
      <label class="field-label" for="msgSearch">Search</label>
      <div class="input-icon-wrap">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input id="msgSearch" type="text" name="search" value="{{ request('search') }}" class="form-control with-icon" placeholder="Name, email, or subject">
      </div>
    </div>
    <div class="col-12 col-md-3 d-flex align-items-end gap-2">
      <button class="btn btn-blue flex-grow-1 w-100"><i class="fa-solid fa-filter me-1"></i>Apply</button>
    </div>
    @if(request('search'))
    <div class="col-12">
      <a href="{{ route('admin.messages.index') }}" class="clear-link"><i class="fa-solid fa-xmark"></i>Clear all filters</a>
    </div>
    @endif
  </form>
</div>

<div class="results-bar">
  <span>
    @if($messages->total() > 0)
      Showing <strong>{{ $messages->firstItem() }}–{{ $messages->lastItem() }}</strong> of <strong>{{ $messages->total() }}</strong> messages
    @else
      No messages to show
    @endif
  </span>
  @if(request('search') || request('sort'))
    <a href="{{ route('admin.messages.index') }}">Reset all</a>
  @endif
</div>

<div class="glass-card">
  <div class="table-responsive">
    <table class="table align-middle mb-0 messages-table">
      <thead>
        <tr>
          <th>{!! $sortLink('fullname', 'Name') !!}</th>
          <th class="col-subject">Subject</th>
          <th>Message</th>
          <th class="col-received">{!! $sortLink('created_at', 'Received') !!}</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($messages as $message)
        <tr>
          <td>
            <div class="msg-sender">{{ $message->name ?: 'Unnamed' }}</div>
            <div class="msg-email">{{ $message->email }}</div>

            {{-- Collapsed-column info: only the pieces hidden at the
                 current breakpoint actually render (see .msg-meta media
                 queries above). --}}
            <div class="msg-meta">
              <span class="meta-piece meta-subject">
                <i class="fa-solid fa-heading"></i>
                <span>{{ $message->subject ?: '—' }}</span>
              </span>
              <span class="meta-piece meta-received">
                <i class="fa-solid fa-clock"></i>
                <span>{{ \Illuminate\Support\Carbon::parse($message->created_at)->format('d M Y, h:i A') }}</span>
              </span>
            </div>
          </td>
          <td class="msg-subject col-subject">{{ $message->subject ?: '—' }}</td>
          <td>
            <div class="msg-body" id="msg-body-{{ $message->id }}">{{ $message->message }}</div>
          </td>
          <td class="text-muted small col-received">{{ \Illuminate\Support\Carbon::parse($message->created_at)->format('d M Y, h:i A') }}</td>
          <td class="text-end">
            <div class="d-flex gap-1 justify-content-end flex-wrap">
              <button
                type="button"
                class="btn btn-sm btn-outline-glass btn-copy"
                data-copy-target="msg-body-{{ $message->id }}"
                title="Copy message text">
                <i class="fa-solid fa-copy"></i>
              </button>
              <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('Delete this message?');">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-glass text-danger" title="Delete message">
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
              <i class="fa-solid fa-envelope"></i>
              @if(request('search'))
                <p>No messages match your search.</p>
                <a href="{{ route('admin.messages.index') }}">Clear filters</a>
              @else
                <p class="mb-0">No messages found.</p>
              @endif
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $messages->appends(request()->query())->links() }}</div>

@verbatim
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.btn-copy');
  if (!btn) return;
  const target = document.getElementById(btn.dataset.copyTarget);
  if (!target) return;
  navigator.clipboard.writeText(target.textContent.trim()).then(() => {
    const icon = btn.querySelector('i');
    btn.classList.add('copied');
    icon.classList.remove('fa-copy');
    icon.classList.add('fa-check');
    setTimeout(() => {
      btn.classList.remove('copied');
      icon.classList.remove('fa-check');
      icon.classList.add('fa-copy');
    }, 1500);
  });
});
</script>
@endverbatim
@endsection