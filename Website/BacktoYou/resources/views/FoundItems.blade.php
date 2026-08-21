<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Found Items</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Founditems.css') }}">

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
    border-color:#16a34a;
    box-shadow:0 0 0 3px rgba(22,163,74,.12);
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
    border-color:#16a34a;
    color:#16a34a;
}

.filter-chip.active{
    background:#16a34a;
    border-color:#16a34a;
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
    color:#16a34a;
    opacity:.4;
    margin-bottom:12px;
    display:block;
}

#itemsGrid.grid{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:24px;
    max-width:1200px;
    margin:0 auto;
    padding:0 16px;
}

#itemsGrid.grid .card{
    display:flex;
    flex-direction:column;
    min-width:0;
}

#itemsGrid.grid .image-box{
    width:100%;
    height:220px;
    overflow:hidden;
    background:#f1f5f9;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
}

#itemsGrid.grid .item-img{
    width:100%;
    height:100%;
    object-fit:contain;
    display:block;
}

#itemsGrid.grid .item-placeholder{
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
}

@media (max-width:992px){
    .search-filter-bar{
        flex-direction:column;
        align-items:stretch;
        padding:0 12px;
    }

    .search-box{
        min-width:0;
        width:100%;
    }

    .filter-chips{
        width:100%;
        overflow-x:auto;
        flex-wrap:nowrap;
        -webkit-overflow-scrolling:touch;
        padding-bottom:4px;
    }

    .filter-chip{
        flex:0 0 auto;
    }

    #itemsGrid.grid{
        grid-template-columns:repeat(2, 1fr);
        gap:18px;
    }
}

@media (max-width:600px){
    .search-box input{
        font-size:16px;
    }

    .filter-chip{
        padding:7px 13px;
        font-size:12.5px;
    }

    #itemsGrid.grid{
        grid-template-columns:1fr;
        gap:16px;
        padding:0 12px;
    }
}
</style>
</head>
<body>

@include('nav')

<div class="page">

    <div class="header">
        <h1>Found Items</h1>
        <p>Browse items reported found in your community</p>
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
                    <img src="{{ asset('uploads/items/' . $item->photo) }}" class="item-img">
                @else
                    <div class="item-placeholder">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                @endif

                <span class="item-tag found">Found</span>

                <div class="item-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>

            <div class="card-body">

    <h3>{{ $item->title }}</h3>

    <p class="desc">{{ $item->description }}</p>

    <div class="details">

        <p>
            <i class="fa-solid fa-location-dot text-primary"></i>
            <strong>Location:</strong>
            {{ $item->location }}
        </p>

        <p>
            <i class="fa-solid fa-calendar-days text-primary"></i>
            <strong>Date:</strong>
            {{ $item->date_occurred }}
        </p>

        <p>
            <i class="fa-solid fa-tag text-primary"></i>
            <strong>Status:</strong>
            {{ ucfirst($item->item_type) }}
        </p>

        @if($item->brand)
        <p>
            <i class="fa-solid fa-industry text-primary"></i>
            <strong>Brand:</strong>
            {{ $item->brand }}
        </p>
        @endif

        @if($item->color)
        <p>
            <i class="fa-solid fa-palette text-primary"></i>
            <strong>Color:</strong>
            {{ $item->color }}
        </p>
        @endif

        @if($item->contact_number)
        <p>
            <i class="fa-solid fa-phone text-primary"></i>
            <strong>Contact:</strong>
            {{ $item->contact_number }}
        </p>
        @endif

        @if($item->sub_type)
        <p>
            <i class="fa-solid fa-layer-group text-primary"></i>
            <strong>Category Detail:</strong>
            {{ $item->sub_type }}
        </p>
        @endif

        @if($item->imei_number)
        <p>
            <i class="fa-solid fa-mobile-screen text-primary"></i>
            <strong>IMEI:</strong>
            {{ $item->imei_number }}
        </p>
        @endif

        @if($item->serial_number)
        <p>
            <i class="fa-solid fa-laptop text-primary"></i>
            <strong>Serial No:</strong>
            {{ $item->serial_number }}
        </p>
        @endif

        @if($item->verification_notes)
        <p>
            <i class="fa-solid fa-note-sticky text-primary"></i>
            <strong>Extra Details:</strong>
            {{ $item->verification_notes }}
        </p>
        @endif

    </div>

    <div class="claim-btn-container">
                    <a href="{{ route('claim.create', $item->id) }}" class="view-btn claim-btn">
                        <i class="fa-solid fa-comments" aria-hidden="true"></i>
                        Chat with Owner
                    </a>
                </div>

</div>

        </div>

        @empty

        <div class="no-items">
            <i class="fa-solid fa-box-open"></i>
            <h3>No Found Items Yet</h3>
            <p>Be the first to help someone by reporting a found item.</p>
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

    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        toggle.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
    });
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
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>