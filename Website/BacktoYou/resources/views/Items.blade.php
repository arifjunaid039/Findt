<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | All Items</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Items.css') }}">
</head>
<style>

/* ---------- Tablet ---------- */
@media (max-width:992px){
    .search-filter-bar{
        flex-direction:column;
        align-items:stretch;
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

    .filter-dropdown{
        width:100%;
    }

    .filter-dropdown-toggle{
        width:100%;
        justify-content:space-between;
    }

    .filter-dropdown-menu{
        width:100%;
        left:0;
        right:0;
    }

    #itemsGrid.grid{
        grid-template-columns:repeat(2, 1fr);
    }

    .active-community-banner{
        flex-wrap:wrap;
        gap:8px;
    }
}

/* ---------- Phone ---------- */
@media (max-width:600px){
    .search-box input{
        font-size:16px; /* prevents iOS Safari auto-zoom on focus */
    }

    .filter-chip{
        padding:7px 13px;
        font-size:12.5px;
    }

    #itemsGrid.grid{
        grid-template-columns:1fr;
    }
}
</style>
<body>

@include('nav')

<div class="page">

    <div class="header">
        <h1>All Items</h1>
        <p>Browse lost and found items{{ $selectedCommunity ? ' from '.$selectedCommunity->name : ' in your community' }}</p>
    </div>

    @if($selectedCommunity)
        <div class="active-community-banner">
            <span>
                <i class="fa-solid fa-users"></i>
                Showing items from <strong>{{ $selectedCommunity->name }}</strong>
            </span>
            <a href="{{ route('items.all', array_filter(['type' => $type, 'location' => $location])) }}" class="clear-community-filter">
                <i class="fa-solid fa-xmark"></i> Clear
            </a>
        </div>
    @endif

    @if($location)
        <div class="active-community-banner">
            <span>
                <i class="fa-solid fa-location-dot"></i>
                Showing items from <strong>{{ $location }}</strong>
            </span>
            <a href="{{ route('items.all', array_filter(['type' => $type, 'community' => $selectedCommunity?->id])) }}" class="clear-community-filter">
                <i class="fa-solid fa-xmark"></i> Clear
            </a>
        </div>
    @endif

    {{-- ===== Search + Filter Bar ===== --}}
    <div class="search-filter-bar">

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Search by title, brand, location, color...">
        </div>

        <div class="filter-chips" id="typeChips">
            <a href="{{ route('items.all', array_filter(['community' => $selectedCommunity?->id, 'location' => $location])) }}"
               class="filter-chip {{ !$type ? 'active' : '' }}">All</a>
            <a href="{{ route('items.all', array_filter(['type' => 'lost', 'community' => $selectedCommunity?->id, 'location' => $location])) }}"
               class="filter-chip {{ $type === 'lost' ? 'active' : '' }}">Lost</a>
            <a href="{{ route('items.all', array_filter(['type' => 'found', 'community' => $selectedCommunity?->id, 'location' => $location])) }}"
               class="filter-chip {{ $type === 'found' ? 'active' : '' }}">Found</a>
        </div>

        {{-- CATEGORY — custom dropdown, filters client-side (cards already on the page) --}}
        <div class="filter-dropdown" id="categoryDropdown">
            <button type="button" class="filter-dropdown-toggle" id="categoryDropdownToggle" aria-haspopup="listbox" aria-expanded="false">
                <i class="fa-solid fa-tags"></i>
                <span id="categoryDropdownLabel">All Categories</span>
                <i class="fa-solid fa-chevron-down filter-dropdown-arrow"></i>
            </button>
            <ul class="filter-dropdown-menu" id="categoryMenu" role="listbox">
                <li role="option" data-filter="all" data-label="All Categories" class="selected">
                    <i class="fa-solid fa-layer-group"></i> All Categories
                    <i class="fa-solid fa-check filter-option-check"></i>
                </li>
                @foreach($categories as $category)
                    <li role="option" data-filter="{{ strtolower($category->name) }}" data-label="{{ $category->name }}">
                        <i class="fa-solid fa-tag"></i> {{ $category->name }}
                        <i class="fa-solid fa-check filter-option-check"></i>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- LOCATION — custom dropdown, navigates via real ?location= links (server-filtered) --}}
        <div class="filter-dropdown" id="locationDropdown">
            <button type="button" class="filter-dropdown-toggle" id="locationDropdownToggle" aria-haspopup="listbox" aria-expanded="false">
                <i class="fa-solid fa-location-dot"></i>
                <span id="locationDropdownLabel">{{ $location ?: 'All Locations' }}</span>
                <i class="fa-solid fa-chevron-down filter-dropdown-arrow"></i>
            </button>
            <ul class="filter-dropdown-menu" id="locationMenu" role="listbox">
                <li role="option" class="{{ !$location ? 'selected' : '' }}">
                    <a href="{{ route('items.all', array_filter(['type' => $type, 'community' => $selectedCommunity?->id])) }}">
                        <i class="fa-solid fa-globe"></i> All Locations
                        <i class="fa-solid fa-check filter-option-check"></i>
                    </a>
                </li>
                @foreach($locations as $loc)
                    <li role="option" class="{{ $location === $loc ? 'selected' : '' }}">
                        <a href="{{ route('items.all', array_filter(['type' => $type, 'community' => $selectedCommunity?->id, 'location' => $loc])) }}">
                            <i class="fa-solid fa-location-dot"></i> {{ $loc }}
                            <i class="fa-solid fa-check filter-option-check"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
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

                <span class="item-tag {{ $item->item_type }}">{{ ucfirst($item->item_type) }}</span>

                <div class="item-icon">
                    <i class="fa-solid {{ $item->item_type === 'lost' ? 'fa-magnifying-glass' : 'fa-circle-check' }}"></i>
                </div>
            </div>

            <div class="card-body">

                <h3>{{ $item->title }}</h3>
                <p class="desc">{{ $item->description }}</p>

                <div class="details">

                    <p>
                        <i class="fa-solid fa-location-dot text-primary"></i>
                        <strong>Location:</strong>
                        <a class="location-link" href="{{ route('items.all', array_filter(['type' => $type, 'community' => $selectedCommunity?->id, 'location' => $item->location])) }}">
                            {{ $item->location }}
                        </a>
                    </p>

                    <p>
                        <i class="fa-solid fa-calendar-days text-primary"></i>
                        <strong>Date:</strong> {{ $item->date_occurred }}
                    </p>

                    <p>
                        <i class="fa-solid fa-tag text-primary"></i>
                        <strong>Status:</strong> {{ ucfirst($item->item_type) }}
                    </p>

                    @if($item->brand)
                    <p>
                        <i class="fa-solid fa-industry text-primary"></i>
                        <strong>Brand:</strong> {{ $item->brand }}
                    </p>
                    @endif

                    @if($item->color)
                    <p>
                        <i class="fa-solid fa-palette text-primary"></i>
                        <strong>Color:</strong> {{ $item->color }}
                    </p>
                    @endif

                    @if($item->contact_number)
                    <p>
                        <i class="fa-solid fa-phone text-primary"></i>
                        <strong>Contact:</strong> {{ $item->contact_number }}
                    </p>
                    @endif

                    @if($item->sub_type)
                    <p>
                        <i class="fa-solid fa-layer-group text-primary"></i>
                        <strong>Category Detail:</strong> {{ $item->sub_type }}
                    </p>
                    @endif

                    @if($item->imei_number)
                    <p>
                        <i class="fa-solid fa-mobile-screen text-primary"></i>
                        <strong>IMEI:</strong> {{ $item->imei_number }}
                    </p>
                    @endif

                    @if($item->serial_number)
                    <p>
                        <i class="fa-solid fa-laptop text-primary"></i>
                        <strong>Serial No:</strong> {{ $item->serial_number }}
                    </p>
                    @endif

                    @if($item->verification_notes)
                    <p>
                        <i class="fa-solid fa-note-sticky text-primary"></i>
                        <strong>Extra Details:</strong> {{ $item->verification_notes }}
                    </p>
                    @endif

                </div>

                <div class="claim-btn-container">
                    <a href="{{ route('claim.create', $item->id) }}" class="btn btn-primary claim-btn">
                        Chat with Owner
                    </a>
                </div>

            </div>

        </div>

        @empty

        <div class="no-items">
            <i class="fa-solid fa-box-open"></i>
            <h3>No Items Found</h3>
            <p>Try changing your filters, or check back later.</p>
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
    if (toggle) {
        toggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            toggle.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
        });
    }
</script>

<script>
    (function(){
        const searchInput   = document.getElementById('searchInput');
        const cards         = document.querySelectorAll('#itemsGrid .card');
        const noResults     = document.getElementById('noResults');

        let activeCategoryFilter = 'all';

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

                const matchesCategory =
                    activeCategoryFilter === 'all' ||
                    card.dataset.category === activeCategoryFilter;

                const show = matchesSearch && matchesCategory;
                card.style.display = show ? '' : 'none';
                if(show) visibleCount++;
            });

            noResults.style.display = (visibleCount === 0 && cards.length > 0) ? 'block' : 'none';
        }

        searchInput.addEventListener('input', applyFilters);

        /* ===========================
           Generic dropdown behavior
        =========================== */
        function setupDropdown(wrapId, toggleId, menuId, labelId){
            const wrap   = document.getElementById(wrapId);
            const toggle = document.getElementById(toggleId);
            const menu   = document.getElementById(menuId);
            const label  = document.getElementById(labelId);

            if (!wrap || !toggle || !menu) return { wrap, toggle, menu, label };

            toggle.addEventListener('click', () => {
                const isOpen = wrap.classList.toggle('open');
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });

            document.addEventListener('click', (e) => {
                if (!wrap.contains(e.target)) {
                    wrap.classList.remove('open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });

            return { wrap, toggle, menu, label };
        }

        // Category dropdown — client-side filter, no navigation
        const categoryDD = setupDropdown('categoryDropdown', 'categoryDropdownToggle', 'categoryMenu', 'categoryDropdownLabel');
        if (categoryDD.menu) {
            categoryDD.menu.querySelectorAll('li[role="option"]').forEach(option => {
                option.addEventListener('click', () => {
                    categoryDD.menu.querySelectorAll('li').forEach(o => o.classList.remove('selected'));
                    option.classList.add('selected');

                    activeCategoryFilter = option.dataset.filter;
                    categoryDD.label.textContent = option.dataset.label;

                    categoryDD.wrap.classList.remove('open');
                    categoryDD.toggle.setAttribute('aria-expanded', 'false');

                    applyFilters();
                });
            });
        }

        setupDropdown('locationDropdown', 'locationDropdownToggle', 'locationMenu', 'locationDropdownLabel');

        applyFilters();
    })();
</script>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>

</body>
</html>