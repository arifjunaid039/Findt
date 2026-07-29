<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Lost Items</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/Lostitems.css') }}">

    <style>

    .search-filter-bar{
        max-width:1200px;
        margin:0 auto 24px;
        padding:0 16px;
        display:flex;
        flex-wrap:wrap;
        gap:12px;
        align-items:center;
        justify-content:space-between;
    }

    .search-box{
        position:relative;
        flex:1;
        min-width:220px;
    }

    .search-box i{
        position:absolute;
        left:14px;
        top:50%;
        transform:translateY(-50%);
        color:#94a3b8;
        font-size:14px;
    }

    .search-box input{
        width:100%;
        padding:11px 14px 11px 38px;
        border-radius:10px;
        border:1px solid #e2e8f0;
        font-size:14px;
        outline:none;
        transition:.2s;
    }

    .search-box input:focus{
        border-color:#2563eb;
        box-shadow:0 0 0 3px rgba(37,99,235,.12);
    }

    .filter-chips{
        display:flex;
        flex-wrap:wrap;
        gap:8px;
    }

    .filter-chip{
        border:1px solid #e2e8f0;
        background:#fff;
        padding:8px 16px;
        border-radius:20px;
        font-size:13px;
        font-weight:600;
        color:#475569;
        cursor:pointer;
        white-space:nowrap;
        transition:.2s;
    }

    .filter-chip:hover{
        border-color:#2563eb;
        color:#2563eb;
    }

    .filter-chip.active{
        background:#2563eb;
        border-color:#2563eb;
        color:#fff;
    }

    .no-results{
        text-align:center;
        padding:60px 20px;
        color:#94a3b8;
        display:none;
    }

    .no-results i{
        font-size:44px;
        color:#2563eb;
        opacity:.4;
        margin-bottom:12px;
        display:block;
    }

    /* Dark mode */
    body.dark .search-box input{
        background:rgba(255,255,255,.05);
        border-color:rgba(255,255,255,.1);
        color:#f1f5f9;
    }

    body.dark .filter-chip{
        background:#1e293b;
        border-color:rgba(255,255,255,.1);
        color:#94a3b8;
    }

    body.dark .filter-chip.active{
        background:#2563eb;
        border-color:#2563eb;
        color:#fff;
    }

    .claim-btn-container{
        padding:0 20px 20px;
    }

    .claim-btn{
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:8px;
        padding:12px;
        border-radius:10px;
        font-weight:600;
        font-size:14.5px;
        text-decoration:none;
    }
</style>
</head>
<body>

@include('nav')

<div class="page">

    <div class="header">
        <h1>Lost Items</h1>
        <p>Browse items reported lost in your community</p>
    </div>

    {{-- ===== Search + Filter Bar ===== --}}
    <div class="search-filter-bar">

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Search by title, brand, location, color...">
        </div>

        <div class="filter-chips" id="filterChips">
            <button class="filter-chip active" data-filter="all">All</button>
            @foreach($categories as $category)
                <button class="filter-chip" data-filter="{{ strtolower($category->name) }}">{{ $category->name }}</button>
            @endforeach
        </div>

    </div>

    <div class="grid" id="itemsGrid">

        @forelse($items as $item)

        <div class="card"
             data-title="{{ strtolower($item->title) }}"
             data-desc="{{ strtolower($item->description) }}"
             data-location="{{ strtolower($item->location) }}"
             data-brand="{{ strtolower($item->brand ?? '') }}"
             data-color="{{ strtolower($item->color ?? '') }}"
             data-category="{{ strtolower($item->category_name ?? '') }}">

            <div class="image-box">

                @if($item->photo)
                    <img src="{{ asset('uploads/items/'.$item->photo) }}" class="item-img" alt="{{ $item->title }}">
                @else
                    <div class="item-placeholder">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                @endif

                <span class="item-tag {{ $item->item_type }}">{{ ucfirst($item->item_type) }}</span>

                <div class="item-icon {{ $item->item_type }}">
                    <i class="fa-solid {{ $item->item_type === 'lost' ? 'fa-circle-exclamation' : 'fa-circle-check' }}"></i>
                </div>

            </div>

            <div class="card-body">

                <h3>{{ $item->title }}</h3>

                <p class="desc">{{ $item->description }}</p>

                <div class="details">

                    <p>
                        <i class="fa-solid fa-location-dot"></i>
                        <strong>Location:</strong>
                        {{ $item->location }}
                    </p>

                    <p>
                        <i class="fa-solid fa-calendar-days"></i>
                        <strong>Date:</strong>
                        {{ $item->date_occurred }}
                    </p>

                    <p>
                        <i class="fa-solid fa-tag"></i>
                        <strong>Type:</strong>
                        {{ ucfirst($item->item_type) }}
                    </p>

                    @if(!empty($item->brand))
                    <p>
                        <i class="fa-solid fa-industry"></i>
                        <strong>Brand:</strong>
                        {{ $item->brand }}
                    </p>
                    @endif

                    @if(!empty($item->color))
                    <p>
                        <i class="fa-solid fa-palette"></i>
                        <strong>Color:</strong>
                        {{ $item->color }}
                    </p>
                    @endif

                    @if(!empty($item->contact_number))
                    <p>
                        <i class="fa-solid fa-phone"></i>
                        <strong>Contact:</strong>
                        {{ $item->contact_number }}
                    </p>
                    @endif

                    @if(!empty($item->sub_type))
                    <p>
                        <i class="fa-solid fa-layer-group"></i>
                        <strong>Category Detail:</strong>
                        {{ $item->sub_type }}
                    </p>
                    @endif

                    @if(!empty($item->imei_number))
                    <p>
                        <i class="fa-solid fa-mobile-screen"></i>
                        <strong>IMEI:</strong>
                        {{ $item->imei_number }}
                    </p>
                    @endif

                    @if(!empty($item->serial_number))
                    <p>
                        <i class="fa-solid fa-laptop"></i>
                        <strong>Serial Number:</strong>
                        {{ $item->serial_number }}
                    </p>
                    @endif

                    @if(!empty($item->verification_notes))
                    <p>
                        <i class="fa-solid fa-note-sticky"></i>
                        <strong>Extra Details:</strong>
                        {{ $item->verification_notes }}
                    </p>
                    @endif

                </div>

            </div>

                <div class="claim-btn-container">
                    <a href="{{ route('claim.create', $item->id) }}" class="view-btn claim-btn">
                        <i class="fa-solid fa-comments" aria-hidden="true"></i>
                        Chat with Owner
                    </a>
                </div>
        </div>

        @empty

        <div class="no-items">
            <i class="fa-solid fa-magnifying-glass"></i>
            <h3>No Lost Items Reported</h3>
            <p>When someone reports a lost item, it'll show up here.</p>
        </div>

        @endforelse

    </div>

    <div class="no-results" id="noResults">
        <i class="fa-solid fa-magnifying-glass"></i>
        <h3>No matching items</h3>
        <p>Try a different search term or filter.</p>
    </div>

</div>

@include('footer')

<script>
const toggle = document.getElementById('themeToggle');

if(toggle){
    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        toggle.textContent =
            document.body.classList.contains('dark') ? '☀️' : '🌙';
    });
}
</script>

<script>
    (function(){
        const searchInput = document.getElementById('searchInput');
        const filterChips = document.getElementById('filterChips');
        const cards = document.querySelectorAll('#itemsGrid .card');
        const noResults = document.getElementById('noResults');

        let activeFilter = 'all';

        function applyFilters(){
            const term = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            cards.forEach(card => {
                const matchesSearch =
                    card.dataset.title.includes(term) ||
                    card.dataset.desc.includes(term) ||
                    card.dataset.location.includes(term) ||
                    card.dataset.brand.includes(term) ||
                    card.dataset.color.includes(term);

                const matchesFilter =
                    activeFilter === 'all' ||
                    card.dataset.category === activeFilter;

                const show = matchesSearch && matchesFilter;
                card.style.display = show ? '' : 'none';
                if(show) visibleCount++;
            });

            noResults.style.display = (visibleCount === 0 && cards.length > 0) ? 'block' : 'none';
        }

        searchInput.addEventListener('input', applyFilters);

        filterChips.addEventListener('click', function(e){
            const chip = e.target.closest('.filter-chip');
            if(!chip) return;

            filterChips.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            chip.classList.add('active');

            activeFilter = chip.dataset.filter;
            applyFilters();
        });

        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');

        if(categoryParam){
            const matchingChip = filterChips.querySelector(`.filter-chip[data-filter="${CSS.escape(categoryParam.toLowerCase())}"]`);
            if(matchingChip){
                filterChips.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                matchingChip.classList.add('active');
                activeFilter = matchingChip.dataset.filter;
            }
        }

        applyFilters();
    })();
</script>

</body>
</html>