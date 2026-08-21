<!DOCTYPE html>
<html>
<head>
    <title>BackToYou | Communities</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/Communities.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
@include('nav')

@if(session('success') || session('info'))
    <div class="ft-toast {{ session('success') ? 'ft-toast-success' : 'ft-toast-info' }}" id="ftToast">
        <span class="ft-toast-icon">
            <i class="fa-solid {{ session('success') ? 'fa-circle-check' : 'fa-circle-info' }}"></i>
        </span>
        <span class="ft-toast-msg">{{ session('success') ?? session('info') }}</span>
        <span class="ft-toast-close" id="ftToastClose">
            <i class="fa-solid fa-xmark"></i>
        </span>
    </div>
@endif

<div class="container">

    <div class="page-header">
        <span class="section-badge">
            <i class="fa-solid fa-users"></i>
            Communities
        </span>

        <h1>Find Your Community</h1>

        <p>
            Join trusted communities to receive updates about lost and found items,
            connect with members, and help recover belongings faster.
        </p>
    </div>

    <form method="GET" action="{{ route('communities') }}" class="location-filter-bar">

        <div class="cr-dropdown" id="locationDropdown">

            <input type="hidden" name="location" id="locationValue" value="{{ request('location') }}">

            <button type="button" class="cr-dropdown-toggle" id="locationToggle" aria-haspopup="listbox" aria-expanded="false">
                <span class="icon-chip icon-location">
                    <i class="fa-solid fa-location-dot"></i>
                </span>
                <span class="cr-dropdown-label {{ request('location') ? 'has-value' : '' }}" id="locationLabel">
                    {{ request('location') ?: 'All Locations' }}
                </span>

                @if(request('location'))
                    <span class="cr-dropdown-clear" id="locationClear" title="Clear filter">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                @endif

                <i class="fa-solid fa-chevron-down cr-dropdown-arrow"></i>
            </button>

            <div class="cr-dropdown-menu" id="locationMenu">

                <div class="cr-dropdown-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="locationSearch" placeholder="Search location..." autocomplete="off">
                </div>

                <ul class="cr-dropdown-list" role="listbox" id="locationList">
                    <li role="option" data-value="" class="{{ request('location') == '' ? 'selected' : '' }}">
                        <span class="cr-option-text"><i class="fa-solid fa-globe cr-option-icon"></i> All Locations</span>
                        <i class="fa-solid fa-check cr-option-check"></i>
                    </li>
                    @foreach($locations as $loc)
                        <li role="option" data-value="{{ $loc }}" class="{{ request('location') == $loc ? 'selected' : '' }}">
                            <span class="cr-option-text"><i class="fa-solid fa-location-dot cr-option-icon"></i> {{ $loc }}</span>
                            <i class="fa-solid fa-check cr-option-check"></i>
                        </li>
                    @endforeach
                </ul>

                <div class="cr-dropdown-empty" id="locationEmpty" style="display:none;">
                    No locations match your search.
                </div>

            </div>

        </div>

    </form>

    <div class="community-grid">

        @forelse($communities as $community)

            <div class="community-card">

                <div class="card-image">
                    <img
                        src="{{ $community->image ? asset('uploads/communities/'.$community->image) : asset('img/community-placeholder.jpg') }}"
                        alt="{{ $community->name }}"
                        loading="lazy"
                    >

                    @if($community->category)
                        <span class="category-badge">
                            <i class="fa-solid fa-tags"></i> {{ $community->category }}
                        </span>
                    @endif

                    @if(!empty($community->is_verified))
                        <div class="verified-badge" title="Verified community">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    @endif

                    <div class="member-badge">
                        <i class="fa-solid fa-users"></i> {{ $community->members->count() }}
                    </div>
                </div>

                <div class="card-content">

                    <h2>{{ $community->name }}</h2>

                    <p>{{ Str::limit($community->description, 100) }}</p>

                    <div class="stats-strip">
                        <div class="stat-item">
                            <i class="fa-solid fa-users"></i>
                            <span class="stat-num">{{ $community->members->count() }}</span>
                            <span class="stat-label">Members</span>
                        </div>

                        <div class="stat-item">
                            <i class="fa-solid fa-clock"></i>
                            <span class="stat-num">{{ $community->created_at ? (int) round($community->created_at->diffInMonths(now())) : '—' }}</span>
                            <span class="stat-label">Months</span>
                        </div>
                    </div>

                    <div class="card-divider"></div>

                    <div class="community-info">

                        @if($community->leader)
                            <div class="leader-row">
                                <span class="leader-avatar">{{ strtoupper(substr($community->leader->fullname, 0, 1)) }}</span>
                                <span><strong>{{ $community->leader->fullname }}</strong> · Community Leader</span>
                            </div>
                        @endif

                        <p>
                            <span class="icon-circle icon-location"><i class="fa-solid fa-location-dot"></i></span>
                            <span><strong>Location:</strong> {{ $community->location }}</span>
                        </p>

                        @if(!empty($community->contact))
                            <p>
                                <span class="icon-circle icon-contact"><i class="fa-solid fa-phone"></i></span>
                                <span><strong>Contact:</strong> {{ $community->contact }}</span>
                            </p>
                        @endif

                        @if($community->created_at)
                            <p>
                                <span class="icon-circle icon-date"><i class="fa-solid fa-calendar-days"></i></span>
                                <span><strong>Created:</strong> {{ $community->created_at->format('M Y') }}</span>
                            </p>
                        @endif

                        @if($community->rules)
                            <p>
                                <span class="icon-circle icon-rules"><i class="fa-solid fa-scroll"></i></span>
                                <span><strong>Rules:</strong> {{ Str::limit($community->rules, 70) }}</span>
                            </p>
                        @endif

                    </div>

                    @auth
@if($community->members->contains('user_id', auth()->id()))        
<div class="joined-actions">
<a href="{{ route('items.all', ['community' => $community->id]) }}" class="view-items-btn">
                    <i class="fa-solid fa-box-open"></i>
                View Items
            </a>

            <form action="{{ route('communities.leave', $community->id) }}" method="POST" class="leave-form">
                @csrf
                <button class="join-btn joined-btn" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Leave
                </button>
            </form>
        </div>
    @else
        <form action="{{ route('communities.join', $community->id) }}" method="POST">
            @csrf
            <button class="join-btn" type="submit">
                <i class="fa-solid fa-user-plus"></i>
                Join Community
            </button>
        </form>
    @endif
@else
    <a href="{{ route('login') }}" class="join-btn">
        <i class="fa-solid fa-right-to-bracket"></i>
        Log In to Join
    </a>
@endauth
                </div>

            </div>

        @empty

            <div class="empty-community">

                <div class="empty-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h2>No Communities Available</h2>

                <p>
                    No communities have been created yet.
                    Once communities become available, they will appear here.
                </p>

            </div>

        @endforelse

    </div>

    @if(method_exists($communities, 'links'))
        <div class="pagination-wrapper">
            {{ $communities->links() }}
        </div>
    @endif

</div>

@include('footer')

<script>
(function(){
    const dropdown = document.getElementById('locationDropdown');
    const toggle   = document.getElementById('locationToggle');
    const menu     = document.getElementById('locationMenu');
    const label    = document.getElementById('locationLabel');
    const value    = document.getElementById('locationValue');
    const search   = document.getElementById('locationSearch');
    const list     = document.getElementById('locationList');
    const empty    = document.getElementById('locationEmpty');
    const clearBtn = document.getElementById('locationClear');
    const form     = dropdown.closest('form');

    let activeIndex = -1;

    function getVisibleItems(){
        return Array.from(list.querySelectorAll('li')).filter(li => li.style.display !== 'none');
    }

    function openMenu(){
        dropdown.classList.add('open');
        toggle.setAttribute('aria-expanded', 'true');
        search.value = '';
        filterList('');
        setTimeout(() => search.focus(), 50);
    }

    function closeMenu(){
        dropdown.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        activeIndex = -1;
        clearActiveHighlight();
    }

    function clearActiveHighlight(){
        list.querySelectorAll('li').forEach(li => li.classList.remove('active'));
    }

    function setActive(index){
        const items = getVisibleItems();
        clearActiveHighlight();
        if (items[index]) {
            items[index].classList.add('active');
            items[index].scrollIntoView({ block:'nearest' });
        }
    }

    function selectOption(li){
        value.value = li.dataset.value;
        label.textContent = li.dataset.value || 'All Locations';
        label.classList.toggle('has-value', li.dataset.value !== '');

        dropdown.classList.add('loading');
        closeMenu();
        form.submit();
    }

    function filterList(query){
        const q = query.trim().toLowerCase();
        let anyVisible = false;

        list.querySelectorAll('li').forEach(li => {
            const text = li.textContent.trim().toLowerCase();
            const isAll = li.dataset.value === '';
            const matches = isAll || text.includes(q);
            li.style.display = matches ? '' : 'none';
            if (matches) anyVisible = true;
        });

        empty.style.display = anyVisible ? 'none' : 'block';
        activeIndex = -1;
    }

    toggle.addEventListener('click', () => {
        dropdown.classList.contains('open') ? closeMenu() : openMenu();
    });

    if (clearBtn) {
        clearBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            value.value = '';
            dropdown.classList.add('loading');
            form.submit();
        });
    }

    search.addEventListener('input', (e) => filterList(e.target.value));

    search.addEventListener('keydown', (e) => {
        const items = getVisibleItems();

        if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = Math.min(activeIndex + 1, items.length - 1);
            setActive(activeIndex);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIndex = Math.max(activeIndex - 1, 0);
            setActive(activeIndex);
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (items[activeIndex]) selectOption(items[activeIndex]);
        } else if (e.key === 'Escape') {
            closeMenu();
        }
    });

    list.querySelectorAll('li').forEach(li => {
        li.addEventListener('click', () => selectOption(li));
        li.addEventListener('mouseenter', () => {
            clearActiveHighlight();
            li.classList.add('active');
        });
    });

    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) closeMenu();
    });
})();

(function(){
    const toast = document.getElementById('ftToast');
    if (!toast) return;

    const closeBtn = document.getElementById('ftToastClose');

    setTimeout(() => toast.classList.add('show'), 50);

    function hideToast(){
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }

    const autoHide = setTimeout(hideToast, 4000);

    closeBtn.addEventListener('click', () => {
        clearTimeout(autoHide);
        hideToast();
    });
})();
</script>

</body>
</html>