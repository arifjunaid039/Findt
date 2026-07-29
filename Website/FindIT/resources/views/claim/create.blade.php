<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Claim Item</title>

    <link rel="icon" href="{{ asset('img/Logo.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>

        :root{
            --accent:#f59e0b;
            --accent-dark:#d97706;
            --accent-soft:rgba(245,158,11,.12);
            --lost:#ef4444;
            --lost-soft:rgba(239,68,68,.12);
            --found:#22c55e;
            --found-soft:rgba(34,197,94,.12);
            --text-main:#1e293b;
            --text-sub:#64748b;

            --page-bg-1:#fdf6ec;
            --page-bg-2:#eef2f9;
            --card-bg:rgba(255,255,255,.75);
            --card-border:rgba(255,255,255,.5);
            --card-shadow:0 15px 45px rgba(0,0,0,.08);
            --hairline:rgba(0,0,0,.06);
            --avatar-border:rgba(255,255,255,.6);
            --cancel-border:rgba(0,0,0,.12);
            --cancel-border-hover:rgba(0,0,0,.25);
            --cancel-bg-hover:rgba(0,0,0,.03);
        }

        /* Dark mode: same near-black/glass approach as Messages, so the
           two pages feel like one app when a person switches themes. */
        body.dark{
            --text-main:#f1f5f9;
            --text-sub:#94a3b8;

            --page-bg-1:#0f172a;
            --page-bg-2:#111c33;
            --card-bg:rgba(30,41,59,.65);
            --card-border:rgba(255,255,255,.14);
            --card-shadow:0 20px 55px rgba(0,0,0,.55);
            --hairline:rgba(255,255,255,.06);
            --avatar-border:rgba(255,255,255,.14);
            --cancel-border:rgba(255,255,255,.14);
            --cancel-border-hover:rgba(255,255,255,.28);
            --cancel-bg-hover:rgba(255,255,255,.06);

            --accent-soft:rgba(245,158,11,.18);
            --lost-soft:rgba(239,68,68,.18);
            --found-soft:rgba(34,197,94,.18);
        }

        *{
            font-family:'Plus Jakarta Sans',sans-serif;
            box-sizing:border-box;
        }

        body{
            margin:0;
            background:linear-gradient(135deg,var(--page-bg-1) 0%,var(--page-bg-2) 100%);
            min-height:100vh;
            color:var(--text-main);
            transition:background .3s ease,color .3s ease;
        }

        .claim-page{
            width:94%;
            max-width:720px;
            margin:48px auto;
        }

        .back-link{
            display:inline-flex;
            align-items:center;
            gap:8px;
            color:var(--text-sub);
            text-decoration:none;
            font-size:13.5px;
            font-weight:600;
            margin-bottom:16px;
            transition:.2s;
        }

        .back-link:hover{ color:var(--accent-dark); }

        .claim-card{
            background:var(--card-bg);
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(20px);
            border:1px solid var(--card-border);
            border-radius:22px;
            overflow:hidden;
            box-shadow:var(--card-shadow);
            transition:background .3s ease, border-color .3s ease, box-shadow .3s ease;
        }

        /* ===== Header ===== */

        .claim-header{
            display:flex;
            gap:18px;
            align-items:center;
            padding:26px;
            border-bottom:1px solid var(--hairline);
        }

        .claim-photo{
            width:84px;
            height:84px;
            border-radius:16px;
            object-fit:cover;
            border:2px solid var(--avatar-border);
            flex-shrink:0;
        }

        .claim-photo.lost{ border-color:var(--lost); }
        .claim-photo.found{ border-color:var(--found); }

        .claim-placeholder{
            width:84px;
            height:84px;
            border-radius:16px;
            background:var(--accent-soft);
            color:var(--accent);
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:30px;
            flex-shrink:0;
        }

        .claim-placeholder.lost{ background:var(--lost-soft); color:var(--lost); }
        .claim-placeholder.found{ background:var(--found-soft); color:var(--found); }

        .claim-title{
            font-family:'Syne',sans-serif;
            font-size:22px;
            font-weight:800;
            line-height:1.25;
        }

        .status-pill{
            display:inline-flex;
            align-items:center;
            gap:6px;
            margin-top:8px;
            padding:5px 13px;
            border-radius:20px;
            font-size:12px;
            font-weight:700;
        }

        .status-pill.lost{ background:var(--lost-soft); color:var(--lost); }
        .status-pill.found{ background:var(--found-soft); color:var(--found); }

        /* ===== Item details ===== */

        .claim-details{
            padding:22px 26px;
            border-bottom:1px solid var(--hairline);
        }

        .claim-details .detail-row{
            display:flex;
            align-items:flex-start;
            gap:12px;
            font-size:14px;
            color:var(--text-main);
            padding:8px 0;
        }

        .claim-details .detail-row i{
            width:18px;
            color:var(--accent);
            margin-top:2px;
        }

        .claim-details .detail-row strong{
            font-weight:700;
            margin-right:5px;
        }

        .claim-details .desc-text{
            color:var(--text-sub);
            font-size:14px;
            line-height:1.55;
            margin:0 0 6px;
        }

        /* ===== Body / empty state ===== */

        .claim-body{
            padding:44px 30px;
            text-align:center;
        }

        .claim-body .icon-wrap{
            width:72px;
            height:72px;
            margin:0 auto 18px;
            border-radius:50%;
            background:var(--accent-soft);
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .claim-body .icon-wrap i{
            font-size:30px;
            color:var(--accent);
        }

        .claim-body h4{
            font-family:'Syne',sans-serif;
            font-weight:700;
            font-size:18px;
            margin-bottom:8px;
        }

        .claim-body p{
            color:var(--text-sub);
            font-size:14px;
            max-width:380px;
            margin:0 auto;
        }

        /* ===== Footer / actions ===== */

        .claim-footer{
            padding:22px 26px 28px;
            display:flex;
            justify-content:center;
            gap:12px;
            flex-wrap:wrap;
        }

        .btn-start{
            background:var(--accent);
            border:none;
            color:#fff;
            padding:13px 28px;
            border-radius:12px;
            font-weight:700;
            font-size:14.5px;
            display:inline-flex;
            align-items:center;
            gap:9px;
            text-decoration:none;
            transition:.2s;
        }

        .btn-start:hover{
            background:var(--accent-dark);
            color:#fff;
            transform:translateY(-1px);
        }

        .btn-cancel{
            background:transparent;
            border:1.5px solid var(--cancel-border);
            color:var(--text-sub);
            padding:13px 26px;
            border-radius:12px;
            font-weight:600;
            font-size:14.5px;
            text-decoration:none;
            transition:.2s;
        }

        .btn-cancel:hover{
            border-color:var(--cancel-border-hover);
            color:var(--text-main);
            background:var(--cancel-bg-hover);
        }

        /* keyboard-only focus states */
        .back-link:focus-visible,
        .btn-start:focus-visible,
        .btn-cancel:focus-visible{
            outline:2px solid var(--accent);
            outline-offset:2px;
        }

    </style>

</head>
<body>

@include('nav')

<div class="claim-page">

    <a href="{{ url()->previous() }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>

    <div class="claim-card">

        @php
            $itemType = strtolower($item->item_type ?? $item->status ?? '');
        @endphp

        <div class="claim-header">

            @if($item->photo)
                <img src="{{ asset('uploads/items/'.$item->photo) }}" class="claim-photo {{ $itemType }}" alt="{{ $item->title }}">
            @else
                <div class="claim-placeholder {{ $itemType }}">
                    <i class="fa-solid fa-box-open"></i>
                </div>
            @endif

            <div>
                <div class="claim-title">{{ $item->title }}</div>

                <span class="status-pill {{ $itemType }}">
                    <i class="fa-solid {{ $itemType === 'lost' ? 'fa-circle-exclamation' : 'fa-circle-check' }}"></i>
                    {{ ucfirst($item->status ?? '') }}
                </span>
            </div>

        </div>

        @if(!empty($item->description) || !empty($item->location) || !empty($item->date_occurred) || !empty($item->brand) || !empty($item->color))
        <div class="claim-details">

            @if(!empty($item->description))
                <p class="desc-text">{{ $item->description }}</p>
            @endif

            @if(!empty($item->location))
            <div class="detail-row">
                <i class="fa-solid fa-location-dot"></i>
                <span><strong>Location:</strong> {{ $item->location }}</span>
            </div>
            @endif

            @if(!empty($item->date_occurred))
            <div class="detail-row">
                <i class="fa-solid fa-calendar-days"></i>
                <span><strong>Date:</strong> {{ $item->date_occurred }}</span>
            </div>
            @endif

            @if(!empty($item->brand))
            <div class="detail-row">
                <i class="fa-solid fa-industry"></i>
                <span><strong>Brand:</strong> {{ $item->brand }}</span>
            </div>
            @endif

            @if(!empty($item->color))
            <div class="detail-row">
                <i class="fa-solid fa-palette"></i>
                <span><strong>Color:</strong> {{ $item->color }}</span>
            </div>
            @endif

        </div>
        @endif

        <div class="claim-body">
            <div class="icon-wrap">
                <i class="fa-solid fa-comments"></i>
            </div>

            <h4>No Conversation Yet</h4>

            <p>Click the button below to start chatting with the item owner.</p>
        </div>

        <div class="claim-footer">

            <a href="{{ route('messages.start',$item->id) }}" class="btn-start">
                <i class="fa-solid fa-comments"></i>
                Start Conversation
            </a>

            <a href="{{ url()->previous() }}" class="btn-cancel">
                Cancel
            </a>

        </div>

    </div>

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>