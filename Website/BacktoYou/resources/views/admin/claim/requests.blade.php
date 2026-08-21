<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>BackToYou | Claim Requests</title>

<link rel="icon" href="{{ asset('img/Logo.jpeg') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>

:root{
    --accent:#f59e0b;
    --accent-dark:#d97706;
    --accent-soft:rgba(245,158,11,.12);
    --glass-bg:rgba(255,255,255,.65);
    --glass-border:rgba(255,255,255,.5);
    --text-main:#1e293b;
    --text-sub:#64748b;
    --page-bg-1:#fdf6ec;
    --page-bg-2:#eef2f9;

    --pending-bg:#fef3c7;
    --pending-text:#92400e;
    --approved-bg:#dcfce7;
    --approved-text:#166534;
    --rejected-bg:#fee2e2;
    --rejected-text:#991b1b;
}

*{
    font-family:'Plus Jakarta Sans',sans-serif;
}

html{
    /* Guards against a long unbroken word (title/message) ever
       pushing a horizontal scrollbar onto the whole page. */
    overflow-x:hidden;
}

body{
    background:linear-gradient(135deg,var(--page-bg-1) 0%,var(--page-bg-2) 100%);
    min-height:100vh;
    color:var(--text-main);
    transition:background .3s ease,color .3s ease;
}

.wrap{
    width:95%;
    max-width:1000px;
    margin:50px auto;
}

.heading{
    font-family:'Syne',sans-serif;
    font-size:32px;
    font-weight:800;
    margin-bottom:0;
    display:flex;
    align-items:center;
    gap:12px;
}

.heading i{
    color:var(--accent);
}

.subtitle{
    color:var(--text-sub);
    font-size:14px;
    margin-top:4px;
    margin-bottom:24px;
}

.filters{
    display:inline-flex;
    gap:8px;
    background:var(--glass-bg);
    backdrop-filter:blur(20px);
    -webkit-backdrop-filter:blur(20px);
    border:1px solid var(--glass-border);
    padding:5px;
    border-radius:14px;
    box-shadow:0 8px 24px rgba(0,0,0,.05);
    margin-bottom:26px;
    flex-wrap:wrap;
}

.filter-btn{
    border:none;
    background:transparent;
    padding:8px 16px;
    border-radius:10px;
    font-size:13.5px;
    font-weight:600;
    color:var(--text-sub);
    cursor:pointer;
    transition:.2s;
    white-space:nowrap;
}

.filter-btn:hover{
    color:var(--text-main);
}

.filter-btn.active{
    background:var(--accent);
    color:#fff;
}

.alert-glass{
    background:var(--glass-bg);
    backdrop-filter:blur(20px);
    border:1px solid var(--glass-border);
    border-radius:16px;
    padding:16px 20px;
    margin-bottom:22px;
    color:var(--approved-text);
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:600;
}

.claim-card{
    background:var(--glass-bg);
    backdrop-filter:blur(24px);
    -webkit-backdrop-filter:blur(24px);
    border:1px solid var(--glass-border);
    border-radius:20px;
    padding:24px;
    margin-bottom:18px;
    box-shadow:0 12px 35px rgba(0,0,0,.06);
    transition:.3s ease;
    display:flex;
    gap:20px;
}

.claim-card:hover{
    transform:translateY(-4px);
    box-shadow:0 18px 45px rgba(0,0,0,.09);
}

.item-photo{
    width:80px;
    height:80px;
    border-radius:16px;
    object-fit:cover;
    flex-shrink:0;
    border:1px solid rgba(0,0,0,.06);
}

.item-placeholder{
    width:80px;
    height:80px;
    border-radius:16px;
    background:var(--accent-soft);
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--accent);
    font-size:28px;
    flex-shrink:0;
}

.card-body{
    flex:1;
    min-width:0;
}

.top-row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:12px;
    flex-wrap:wrap;
}

.item-title{
    font-size:19px;
    font-weight:700;
    color:var(--text-main);
    overflow-wrap:break-word;
}

.claim-date{
    color:var(--text-sub);
    font-size:12.5px;
    white-space:nowrap;
}

.user{
    color:var(--text-sub);
    margin-top:6px;
    font-size:14px;
    display:flex;
    align-items:center;
    gap:6px;
}

.user i{
    color:var(--accent);
}

.user b{
    color:var(--text-main);
}

.message{
    background:rgba(0,0,0,.03);
    padding:14px 16px;
    border-radius:12px;
    margin:14px 0;
    color:var(--text-main);
    font-size:14.5px;
    line-height:1.5;
    border-left:3px solid var(--accent);
    overflow-wrap:break-word;
}

.status{
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:6px;
}

.status.pending{ background:var(--pending-bg); color:var(--pending-text); }
.status.approved{ background:var(--approved-bg); color:var(--approved-text); }
.status.rejected{ background:var(--rejected-bg); color:var(--rejected-text); }

.actions{
    margin-top:16px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn-approve{
    background:var(--found, #22c55e);
    border:none;
    color:#fff;
    border-radius:12px;
    padding:10px 22px;
    font-weight:600;
    font-size:14px;
    transition:.2s;
}

.btn-approve:hover{
    background:#16a34a;
    color:#fff;
}

.btn-reject{
    background:transparent;
    border:1.5px solid var(--rejected-text);
    color:var(--rejected-text);
    border-radius:12px;
    padding:9px 22px;
    font-weight:600;
    font-size:14px;
    transition:.2s;
}

.btn-reject:hover{
    background:var(--rejected-bg);
    color:var(--rejected-text);
}

.empty{
    text-align:center;
    padding:80px 20px;
    background:var(--glass-bg);
    backdrop-filter:blur(20px);
    border:1px solid var(--glass-border);
    border-radius:20px;
}

.empty i{
    font-size:56px;
    color:var(--accent);
    opacity:.5;
    margin-bottom:16px;
}

.empty h3{
    font-weight:700;
}

.empty p{
    color:var(--text-sub);
}

.no-results{
    text-align:center;
    padding:50px 20px;
    color:var(--text-sub);
    display:none;
}

/* Dark mode */
body.dark{
    --glass-bg:rgba(30,41,59,.65);
    --glass-border:rgba(255,255,255,.08);
    --text-main:#f1f5f9;
    --text-sub:#94a3b8;
    --page-bg-1:#0f172a;
    --page-bg-2:#111c33;
    --pending-bg:rgba(254,243,199,.15);
    --pending-text:#fbbf24;
    --approved-bg:rgba(220,252,231,.12);
    --approved-text:#4ade80;
    --rejected-bg:rgba(254,226,226,.12);
    --rejected-text:#f87171;
}

body.dark .message{
    background:rgba(255,255,255,.04);
}

body.dark .item-placeholder{
    background:rgba(245,158,11,.15);
}

/* ---- Responsive ----
   >=577px: row layout throughout — flex-wrap on top-row/actions/filters
            already absorbs the squeeze down to tablet widths.
   <=576px: card stacks to a column, thumbnail goes full-width. */
@media(max-width:576px){
    .wrap{margin:28px auto;}
    .heading{font-size:26px;}
    .claim-card{flex-direction:column;}
    .item-photo, .item-placeholder{width:100%; height:140px;}
}

/* <=400px: phones narrow enough that the base padding/sizing above
   starts crowding the card contents — trim it down a notch further. */
@media(max-width:400px){
    .claim-card{padding:16px;}
    .item-photo, .item-placeholder{height:110px;}
    .item-title{font-size:17px;}
    .btn-approve, .btn-reject{
        padding:9px 16px;
        font-size:13px;
        flex:1 1 auto;
        text-align:center;
    }
    .filters{padding:4px; gap:5px;}
    .filter-btn{padding:7px 11px; font-size:12.5px;}
}

</style>

</head>

<body>

@include('nav')

<div class="wrap" x-data="claims()">

    <h1 class="heading">
        <i class="fa-solid fa-file-circle-check"></i>
        Claim Requests
    </h1>
    <div class="subtitle">{{ $claims->count() }} {{ Str::plural('request', $claims->count()) }} total</div>

    @if(session('success'))
    <div class="alert-glass">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
    @endif

    @if($claims->count() > 0)
    <div class="filters">
        <button class="filter-btn" :class="{active: filter === 'all'}" @click="setFilter('all')">All</button>
        <button class="filter-btn" :class="{active: filter === 'pending'}" @click="setFilter('pending')">Pending</button>
        <button class="filter-btn" :class="{active: filter === 'approved'}" @click="setFilter('approved')">Approved</button>
        <button class="filter-btn" :class="{active: filter === 'rejected'}" @click="setFilter('rejected')">Rejected</button>
    </div>
    @endif

    <div id="claimList">

    @forelse($claims as $claim)

        <div class="claim-card" data-status="{{ $claim->status }}">

            @if(optional($claim->item)->photo)
                <img src="{{ asset('uploads/items/'.$claim->item->photo) }}" class="item-photo" alt="{{ $claim->item->title }}">
            @else
                <div class="item-placeholder">
                    <i class="fa-solid fa-box-open"></i>
                </div>
            @endif

            <div class="card-body">

                <div class="top-row">
                    <div class="item-title">{{ optional($claim->item)->title ?? 'Untitled item' }}</div>
                    @if(isset($claim->created_at))
                        <div class="claim-date">{{ \Carbon\Carbon::parse($claim->created_at)->diffForHumans() }}</div>
                    @endif
                </div>

                <div class="user">
                    <i class="fa-solid fa-user-circle"></i>
                    Claimed by <b>{{ optional($claim->claimant)->fullname ?? 'Unknown user' }}</b>
                </div>

                @if($claim->message)
                <div class="message">
                    {{ $claim->message }}
                </div>
                @endif

                <span class="status {{ $claim->status }}">
                    @if($claim->status == 'pending') <i class="fa-solid fa-clock"></i>
                    @elseif($claim->status == 'approved') <i class="fa-solid fa-check"></i>
                    @else <i class="fa-solid fa-xmark"></i>
                    @endif
                    {{ ucfirst($claim->status) }}
                </span>

                @if($claim->status == 'pending')
                <div class="actions">

                    <form action="{{ route('claim.approve', $claim->id) }}" method="POST"
                          onsubmit="return confirm('Approve this claim? This usually can\'t be undone.')">
                        @csrf
                        <button class="btn-approve">
                            <i class="fa-solid fa-check me-1"></i> Approve
                        </button>
                    </form>

                    <form action="{{ route('claim.reject', $claim->id) }}" method="POST"
                          onsubmit="return confirm('Reject this claim?')">
                        @csrf
                        <button class="btn-reject">
                            <i class="fa-solid fa-xmark me-1"></i> Reject
                        </button>
                    </form>

                </div>
                @endif

            </div>

        </div>

    @empty

        <div class="empty">
            <i class="fa-solid fa-file-circle-check"></i>
            <h3>No Claim Requests</h3>
            <p>When someone submits a claim on your listed items, it'll show up here.</p>
        </div>

    @endforelse

    </div>

    <div class="no-results" id="noResults">
        <i class="fa-solid fa-filter fa-2x mb-3"></i>
        <p>No claims match this filter.</p>
    </div>

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
function claims(){
    return {
        filter: 'all',
        setFilter(f){
            this.filter = f;
            const cards = document.querySelectorAll('#claimList .claim-card');
            let visible = 0;

            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                const show = f === 'all' || status === f;
                card.style.display = show ? 'flex' : 'none';
                if(show) visible++;
            });

            document.getElementById('noResults').style.display = (visible === 0 && cards.length > 0) ? 'block' : 'none';
        }
    }
}
</script>

</body>
</html>