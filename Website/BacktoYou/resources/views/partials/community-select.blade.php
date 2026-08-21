@php
    $fieldName = $fieldName ?? 'community_id';
    $selectedValue = old($fieldName, $selectedValue ?? '');
    $uid = uniqid('comm_');
    $selectedCommunity = $myCommunities->firstWhere('id', (int) $selectedValue);
@endphp

<div class="cr-dropdown" id="{{ $uid }}_dropdown">

    <input type="hidden" name="{{ $fieldName }}" id="{{ $uid }}_value" value="{{ $selectedValue }}">

    <button type="button" class="cr-dropdown-toggle" id="{{ $uid }}_toggle" aria-haspopup="listbox" aria-expanded="false">
        <span class="icon-chip icon-community-chip" id="{{ $uid }}_icon">
            @if($selectedCommunity && $selectedCommunity->image)
                <img src="{{ asset('uploads/communities/'.$selectedCommunity->image) }}" alt="">
            @else
                <i class="fa-solid fa-users"></i>
            @endif
        </span>
        <span class="cr-dropdown-label {{ $selectedCommunity ? 'has-value' : '' }}" id="{{ $uid }}_label">
            {{ $selectedCommunity->name ?? 'No community (post publicly)' }}
        </span>
        <i class="fa-solid fa-chevron-down cr-dropdown-arrow"></i>
    </button>

    <div class="cr-dropdown-menu" id="{{ $uid }}_menu">

        @if($myCommunities->count() > 5)
            <div class="cr-dropdown-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="{{ $uid }}_search" placeholder="Search community..." autocomplete="off">
            </div>
        @endif

        <ul class="cr-dropdown-list" role="listbox" id="{{ $uid }}_list">

            <li role="option" data-value="" data-icon="none" class="{{ $selectedValue === '' ? 'selected' : '' }}">
                <span class="cr-option-text">
                    <span class="cr-option-avatar cr-option-avatar-none"><i class="fa-solid fa-globe"></i></span>
                    No community (post publicly)
                </span>
                <i class="fa-solid fa-check cr-option-check"></i>
            </li>

            @forelse($myCommunities as $comm)
                <li role="option" data-value="{{ $comm->id }}" data-image="{{ $comm->image ? asset('uploads/communities/'.$comm->image) : '' }}" class="{{ (string) $selectedValue === (string) $comm->id ? 'selected' : '' }}">
                    <span class="cr-option-text">
                        <span class="cr-option-avatar">
                            @if($comm->image)
                                <img src="{{ asset('uploads/communities/'.$comm->image) }}" alt="">
                            @else
                                <i class="fa-solid fa-users"></i>
                            @endif
                        </span>
                        {{ $comm->name }}
                    </span>
                    <i class="fa-solid fa-check cr-option-check"></i>
                </li>
            @empty
                <li class="cr-dropdown-empty-inline">You haven't joined any communities yet.</li>
            @endforelse

        </ul>

        <div class="cr-dropdown-empty" id="{{ $uid }}_empty" style="display:none;">
            No communities match your search.
        </div>

    </div>

</div>

<script>
(function(){
    const dropdown = document.getElementById('{{ $uid }}_dropdown');
    const toggle   = document.getElementById('{{ $uid }}_toggle');
    const label    = document.getElementById('{{ $uid }}_label');
    const iconWrap = document.getElementById('{{ $uid }}_icon');
    const value    = document.getElementById('{{ $uid }}_value');
    const search   = document.getElementById('{{ $uid }}_search');
    const list     = document.getElementById('{{ $uid }}_list');
    const empty    = document.getElementById('{{ $uid }}_empty');

    let activeIndex = -1;

    function getVisibleItems(){
        return Array.from(list.querySelectorAll('li[role="option"]')).filter(li => li.style.display !== 'none');
    }

    function openMenu(){
        dropdown.classList.add('open');
        toggle.setAttribute('aria-expanded', 'true');
        if (search) {
            search.value = '';
            filterList('');
            setTimeout(() => search.focus(), 50);
        }
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
        list.querySelectorAll('li').forEach(o => o.classList.remove('selected'));
        li.classList.add('selected');

        value.value = li.dataset.value;

        const textEl = li.querySelector('.cr-option-text');
        label.textContent = textEl ? textEl.textContent.trim() : li.textContent.trim();
        label.classList.add('has-value');

        const img = li.dataset.image;
        if (img) {
            iconWrap.innerHTML = `<img src="${img}" alt="">`;
        } else {
            iconWrap.innerHTML = li.dataset.value === '' ? '<i class="fa-solid fa-globe"></i>' : '<i class="fa-solid fa-users"></i>';
        }

        closeMenu();
    }

    function filterList(query){
        const q = query.trim().toLowerCase();
        let anyVisible = false;

        list.querySelectorAll('li[role="option"]').forEach(li => {
            const text = li.textContent.trim().toLowerCase();
            const matches = text.includes(q);
            li.style.display = matches ? '' : 'none';
            if (matches) anyVisible = true;
        });

        if (empty) empty.style.display = anyVisible ? 'none' : 'block';
        activeIndex = -1;
    }

    toggle.addEventListener('click', () => {
        dropdown.classList.contains('open') ? closeMenu() : openMenu();
    });

    if (search) {
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
    }

    list.querySelectorAll('li[role="option"]').forEach(li => {
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
</script>