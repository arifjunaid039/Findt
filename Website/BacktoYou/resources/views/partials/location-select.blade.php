@php
    $fieldId = $fieldId ?? 'location';
    $fieldName = $fieldName ?? 'location';
    $selectedValue = $selectedValue ?? old($fieldName, $selectedValue ?? '');
    $areas = config('locations');
    $uid = uniqid('loc_');
@endphp

<style>
/* Scoped, self-contained styles for the .cr-dropdown component.
   Uses var(--accent, #2563eb) etc. so it inherits the page's theme
   automatically if those variables are already defined globally,
   and still looks right on its own if they aren't. */

.cr-dropdown{
    position:relative;
    width:100%;
    font-family:inherit;
}

.cr-dropdown-toggle{
    width:100%;
    display:flex;
    align-items:center;
    gap:10px;
    padding:11px 14px;
    background:#fff;
    border:1.5px solid var(--line, #e2e8f0);
    border-radius:12px;
    font-size:14px;
    color:var(--text-main, #0f172a);
    cursor:pointer;
    text-align:left;
    transition:.15s;
}

.cr-dropdown-toggle:hover{
    border-color:var(--accent-light, #3b82f6);
}

.cr-dropdown.open .cr-dropdown-toggle{
    border-color:var(--accent, #2563eb);
    box-shadow:0 0 0 3px var(--accent-soft, rgba(37,99,235,.12));
}

.icon-chip{
    width:28px;
    height:28px;
    border-radius:8px;
    background:var(--accent-soft, rgba(37,99,235,.10));
    color:var(--accent, #2563eb);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    flex-shrink:0;
}

.cr-dropdown-label{
    flex:1;
    min-width:0;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
    color:var(--text-sub, #64748b);
}

.cr-dropdown-label.has-value{
    color:var(--text-main, #0f172a);
    font-weight:600;
}

.cr-dropdown-arrow{
    font-size:12px;
    color:var(--text-sub, #64748b);
    flex-shrink:0;
    transition:transform .2s;
}

.cr-dropdown.open .cr-dropdown-arrow{
    transform:rotate(180deg);
}

/* ===== Menu (desktop: absolute panel under the toggle) ===== */

.cr-dropdown-menu{
    position:absolute;
    top:calc(100% + 8px);
    left:0;
    right:0;
    background:#fff;
    border:1px solid var(--line, #e2e8f0);
    border-radius:14px;
    box-shadow:0 16px 40px rgba(15,23,42,.14);
    z-index:60;
    overflow:hidden;
    display:none;
    flex-direction:column;
    max-height:320px;
}

.cr-dropdown.open .cr-dropdown-menu{
    display:flex;
}

/* opens upward when there isn't room below (JS adds .drop-up) */
.cr-dropdown.drop-up .cr-dropdown-menu{
    top:auto;
    bottom:calc(100% + 8px);
}

.cr-dropdown-mobile-head{
    display:none;
    align-items:center;
    justify-content:space-between;
    padding:14px 16px 6px;
    font-weight:700;
    font-size:15px;
    color:var(--text-main, #0f172a);
}

.cr-dropdown-close{
    width:30px;
    height:30px;
    border-radius:50%;
    border:none;
    background:var(--line-soft, rgba(37,99,235,.06));
    color:var(--text-sub, #64748b);
    font-size:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
}

.cr-dropdown-handle{
    display:none;
    width:36px;
    height:4px;
    border-radius:3px;
    background:var(--line, #e2e8f0);
    margin:10px auto 0;
    flex-shrink:0;
}

.cr-dropdown-search{
    position:relative;
    padding:10px 14px;
    flex-shrink:0;
}

.cr-dropdown-search i{
    position:absolute;
    left:26px;
    top:50%;
    transform:translateY(-50%);
    color:var(--text-sub, #64748b);
    font-size:12.5px;
}

.cr-dropdown-search input{
    width:100%;
    padding:9px 12px 9px 32px;
    border-radius:10px;
    border:1px solid var(--line, #e2e8f0);
    background:var(--line-soft, #f8fafc);
    font-size:13.5px;
    outline:none;
    color:var(--text-main, #0f172a);
}

.cr-dropdown-search input:focus{
    border-color:var(--accent, #2563eb);
    background:#fff;
}

.cr-dropdown-list{
    list-style:none;
    margin:0;
    padding:6px;
    overflow-y:auto;
    flex:1;
}

.cr-dropdown-list li{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    padding:10px 12px;
    border-radius:9px;
    font-size:13.5px;
    color:var(--text-main, #0f172a);
    cursor:pointer;
    transition:.12s;
}

.cr-dropdown-list li:hover,
.cr-dropdown-list li.active{
    background:var(--accent-soft, rgba(37,99,235,.10));
}

.cr-dropdown-list li.selected{
    color:var(--accent, #2563eb);
    font-weight:700;
}

.cr-option-text{
    display:flex;
    align-items:center;
    gap:8px;
    min-width:0;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.cr-option-icon{
    color:var(--text-sub, #64748b);
    font-size:12px;
    flex-shrink:0;
}

.cr-option-check{
    font-size:12px;
    opacity:0;
    color:var(--accent, #2563eb);
    flex-shrink:0;
}

.cr-dropdown-list li.selected .cr-option-check{
    opacity:1;
}

.cr-dropdown-empty{
    padding:24px 16px;
    text-align:center;
    color:var(--text-sub, #64748b);
    font-size:13px;
}

/* ===== Backdrop (mobile bottom-sheet only) ===== */

.cr-dropdown-backdrop{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(15,23,42,.45);
    z-index:55;
}

.cr-dropdown.open .cr-dropdown-backdrop{
    display:block;
}

/* ===== Responsive: mobile becomes a bottom sheet ===== */

@media(max-width:576px){

    .cr-dropdown-toggle{
        padding:12px 14px;
        font-size:15px;
    }

    /* Reset any desktop "flip up" positioning — mobile always docks to
       the bottom of the viewport regardless of where the toggle sits. */
    .cr-dropdown.drop-up .cr-dropdown-menu{
        top:auto;
    }

    .cr-dropdown-menu{
        position:fixed;
        left:0;
        right:0;
        bottom:0;
        top:auto;
        border-radius:20px 20px 0 0;
        max-height:75vh;
        max-height:75dvh;
        z-index:70;
        box-shadow:0 -12px 40px rgba(15,23,42,.25);
        transform:translateY(100%);
        transition:transform .25s ease;
    }

    .cr-dropdown.open .cr-dropdown-menu{
        transform:translateY(0);
    }

    .cr-dropdown-handle{ display:block; }
    .cr-dropdown-mobile-head{ display:flex; }

    .cr-dropdown-search{ padding:10px 16px 12px; }
    .cr-dropdown-search input{
        padding:12px 14px 12px 36px;
        font-size:15px;
    }
    .cr-dropdown-search i{ left:30px; }

    .cr-dropdown-list{ padding:6px 10px 14px; }

    /* Bigger, thumb-friendly tap targets */
    .cr-dropdown-list li{
        padding:13px 12px;
        font-size:15px;
    }
}

@media(max-width:340px){
    .cr-dropdown-toggle{ font-size:14px; padding:10px 12px; }
    .icon-chip{ width:24px; height:24px; font-size:12px; }
}
</style>

<div class="cr-dropdown" id="{{ $uid }}_dropdown">

    <input type="hidden" name="{{ $fieldName }}" id="{{ $uid }}_value" value="{{ $selectedValue }}" {{ $required ?? false ? 'required' : '' }}>

    <button type="button" class="cr-dropdown-toggle" id="{{ $uid }}_toggle" aria-haspopup="listbox" aria-expanded="false">
        <span class="icon-chip icon-location">
            <i class="fa-solid fa-location-dot"></i>
        </span>
        <span class="cr-dropdown-label {{ $selectedValue ? 'has-value' : '' }}" id="{{ $uid }}_label">
            {{ $selectedValue ?: 'Select area' }}
        </span>
        <i class="fa-solid fa-chevron-down cr-dropdown-arrow"></i>
    </button>

    <div class="cr-dropdown-backdrop" id="{{ $uid }}_backdrop"></div>

    <div class="cr-dropdown-menu" id="{{ $uid }}_menu">

        <div class="cr-dropdown-handle"></div>

        <div class="cr-dropdown-mobile-head">
            Select area
            <button type="button" class="cr-dropdown-close" id="{{ $uid }}_close" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="cr-dropdown-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="{{ $uid }}_search" placeholder="Search area..." autocomplete="off">
        </div>

        <ul class="cr-dropdown-list" role="listbox" id="{{ $uid }}_list">
            @foreach($areas as $area)
                <li role="option" data-value="{{ $area }}" class="{{ $selectedValue == $area ? 'selected' : '' }}">
                    <span class="cr-option-text"><i class="fa-solid fa-location-dot cr-option-icon"></i> {{ $area }}</span>
                    <i class="fa-solid fa-check cr-option-check"></i>
                </li>
            @endforeach
        </ul>

        <div class="cr-dropdown-empty" id="{{ $uid }}_empty" style="display:none;">
            No areas match your search.
        </div>

    </div>

</div>

<script>
(function(){
    const dropdown = document.getElementById('{{ $uid }}_dropdown');
    const toggle   = document.getElementById('{{ $uid }}_toggle');
    const label    = document.getElementById('{{ $uid }}_label');
    const value    = document.getElementById('{{ $uid }}_value');
    const search   = document.getElementById('{{ $uid }}_search');
    const list     = document.getElementById('{{ $uid }}_list');
    const empty    = document.getElementById('{{ $uid }}_empty');
    const menu     = document.getElementById('{{ $uid }}_menu');
    const backdrop = document.getElementById('{{ $uid }}_backdrop');
    const closeBtn = document.getElementById('{{ $uid }}_close');

    let activeIndex = -1;
    let scrollY = 0;

    const isMobile = () => window.matchMedia('(max-width:576px)').matches;

    function getVisibleItems(){
        return Array.from(list.querySelectorAll('li')).filter(li => li.style.display !== 'none');
    }

    function positionMenu(){
        // Desktop only: flip the panel above the toggle if there isn't
        // enough room below it in the viewport.
        dropdown.classList.remove('drop-up');
        if (isMobile()) return;

        const rect = toggle.getBoundingClientRect();
        const menuHeight = menu.offsetHeight || 320;
        const spaceBelow = window.innerHeight - rect.bottom;

        if (spaceBelow < menuHeight && rect.top > menuHeight) {
            dropdown.classList.add('drop-up');
        }
    }

    function lockBodyScroll(){
        if (!isMobile()) return;
        scrollY = window.scrollY;
        document.body.style.position = 'fixed';
        document.body.style.top = `-${scrollY}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
    }

    function unlockBodyScroll(){
        if (document.body.style.position !== 'fixed') return;
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        window.scrollTo(0, scrollY);
    }

    function openMenu(){
        dropdown.classList.add('open');
        toggle.setAttribute('aria-expanded', 'true');
        search.value = '';
        filterList('');
        positionMenu();
        lockBodyScroll();
        setTimeout(() => search.focus(), 50);
    }

    function closeMenu(){
        dropdown.classList.remove('open', 'drop-up');
        toggle.setAttribute('aria-expanded', 'false');
        activeIndex = -1;
        clearActiveHighlight();
        unlockBodyScroll();
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
        label.textContent = li.dataset.value;
        label.classList.add('has-value');

        closeMenu();
    }

    function filterList(query){
        const q = query.trim().toLowerCase();
        let anyVisible = false;

        list.querySelectorAll('li').forEach(li => {
            const text = li.textContent.trim().toLowerCase();
            const matches = text.includes(q);
            li.style.display = matches ? '' : 'none';
            if (matches) anyVisible = true;
        });

        empty.style.display = anyVisible ? 'none' : 'block';
        activeIndex = -1;
    }

    toggle.addEventListener('click', () => {
        dropdown.classList.contains('open') ? closeMenu() : openMenu();
    });

    closeBtn.addEventListener('click', closeMenu);
    backdrop.addEventListener('click', closeMenu);

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

    window.addEventListener('resize', () => {
        if (dropdown.classList.contains('open')) positionMenu();
    });
})();
</script>