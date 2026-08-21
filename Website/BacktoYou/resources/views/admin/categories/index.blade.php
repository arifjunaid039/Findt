@extends('admin.layout')
@section('title', 'Categories')
@section('content')

<style>
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
  .categories-table{ color:var(--text); }
  .categories-table thead th{
    font-size:.72rem;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:var(--text-muted);
    font-weight:700;
    border-bottom:1px solid var(--card-border);
    padding-bottom:12px;
    background:transparent;
  }
  .categories-table thead th i{ margin-right:4px; font-size:.8rem; }
  .categories-table thead th:nth-child(1){ color:var(--blue) !important; }
  .categories-table thead th:nth-child(1) i{ color:var(--blue); }
  .categories-table thead th:nth-child(2){ color:#9333ea !important; }
  .categories-table thead th:nth-child(2) i{ color:#9333ea; }
  html.dark .categories-table thead th:nth-child(2){ color:#c084fc !important; }
  html.dark .categories-table thead th:nth-child(2) i{ color:#c084fc; }
  .categories-table tbody td{
    border-bottom:1px solid var(--card-border);
    color:var(--text);
    background:transparent;
    vertical-align:middle;
  }
  .categories-table tbody tr:last-child td{ border-bottom:none; }
  .categories-table tbody tr:hover td{ background:var(--card); }
  html.dark .categories-table tbody tr:hover td{ background:rgba(255,255,255,.04); }

  .rename-form .form-control{
    background:var(--bg-soft);
    border:1px solid var(--card-border);
    color:var(--text);
  }
  .rename-form .form-control:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 3px var(--blue-soft);
  }
  html.dark .rename-form .form-control{ color-scheme:dark; }

  .items-count-pill{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:.78rem;
    font-weight:600;
    color:var(--text-muted);
    background:var(--card);
    border:1px solid var(--card-border);
    padding:3px 10px;
    border-radius:999px;
  }
  .items-count-pill i{ color:#9333ea; }
  html.dark .items-count-pill{ background:rgba(255,255,255,.05); }
  html.dark .items-count-pill i{ color:#c084fc; }

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
  .btn-outline-glass:focus-visible{
    outline:2px solid var(--blue);
    outline-offset:2px;
  }

  .empty-state{ text-align:center; color:var(--text-muted); padding:8px; }
  .empty-state i{ font-size:1.3rem; opacity:.4; display:block; margin-bottom:8px; }
  html.dark .empty-state i{ opacity:.55; }

  html.dark .glass-card{ box-shadow:0 1px 0 rgba(255,255,255,.03) inset, 0 8px 24px rgba(0,0,0,.28); }

  /* ============ MOBILE CARD LIST (below md) ============ */
  .category-card-list{ display:flex; flex-direction:column; gap:10px; }
  .category-card{
    border:1px solid var(--card-border);
    border-radius:.75rem;
    padding:14px;
    background:transparent;
  }
  html.dark .category-card{ background:rgba(255,255,255,.03); }
  .category-card .rename-form .form-control{ min-width:0; }
  .category-card .card-actions{
    display:flex;
    gap:8px;
    margin-top:10px;
  }
  .category-card .card-actions form{ flex:1; }
  .category-card .card-actions .btn{ width:100%; }
</style>

<h1 class="page-title">Categories</h1>
<p class="page-sub">Item categories used across the platform.</p>

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

{{-- ============ DESKTOP / TABLET TABLE (md and up) ============ --}}
<div class="glass-card d-none d-md-block">
  <div class="table-responsive">
    <table class="table align-middle mb-0 categories-table">
      <thead>
        <tr>
          <th><i class="fa-solid fa-tag" aria-hidden="true"></i>Name</th>
          <th><i class="fa-solid fa-box-open" aria-hidden="true"></i>Items Using</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $cat)
        <tr>
          <td>
            <form method="POST" action="{{ route('admin.categories.update', $cat) }}" class="d-flex flex-wrap gap-2 rename-form">
              @csrf @method('PATCH')
              <label for="cat-name-{{ $cat->id }}" class="visually-hidden">Category name</label>
              <input id="cat-name-{{ $cat->id }}" type="text" name="name" value="{{ $cat->name }}" class="form-control form-control-sm" style="max-width:220px;">
              <button type="submit" class="btn btn-sm btn-outline-glass" title="Save name" aria-label="Save name for {{ $cat->name }}">
                <i class="fa-solid fa-check" aria-hidden="true"></i> Save
              </button>
            </form>
          </td>
          <td>
            <span class="items-count-pill"><i class="fa-solid fa-box-open" aria-hidden="true"></i> {{ $cat->items_count }}</span>
          </td>
          <td class="text-end">
            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category? Items using it will have no category.');">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-glass text-danger" title="Delete category" aria-label="Delete category {{ $cat->name }}">
                <i class="fa-solid fa-trash" aria-hidden="true"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3">
            <div class="empty-state">
              <i class="fa-solid fa-tags" aria-hidden="true"></i>
              <p class="mb-0">No categories yet.</p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- ============ MOBILE CARD LIST (below md) ============ --}}
<div class="d-md-none">
  @forelse($categories as $cat)
    <div class="glass-card category-card mb-2">
      <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
        <span class="items-count-pill">
          <i class="fa-solid fa-box-open" aria-hidden="true"></i> {{ $cat->items_count }} item{{ $cat->items_count == 1 ? '' : 's' }}
        </span>
      </div>

      <form method="POST" action="{{ route('admin.categories.update', $cat) }}" class="d-flex gap-2 rename-form">
        @csrf @method('PATCH')
        <label for="cat-name-m-{{ $cat->id }}" class="visually-hidden">Category name</label>
        <input id="cat-name-m-{{ $cat->id }}" type="text" name="name" value="{{ $cat->name }}" class="form-control form-control-sm flex-grow-1">
        <button type="submit" class="btn btn-sm btn-outline-glass flex-shrink-0" title="Save name" aria-label="Save name for {{ $cat->name }}">
          <i class="fa-solid fa-check" aria-hidden="true"></i>
        </button>
      </form>

      <div class="card-actions">
        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category? Items using it will have no category.');">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-glass text-danger" title="Delete category" aria-label="Delete category {{ $cat->name }}">
            <i class="fa-solid fa-trash me-1" aria-hidden="true"></i> Delete
          </button>
        </form>
      </div>
    </div>
  @empty
    <div class="glass-card">
      <div class="empty-state">
        <i class="fa-solid fa-tags" aria-hidden="true"></i>
        <p class="mb-0">No categories yet.</p>
      </div>
    </div>
  @endforelse
</div>
@endsection