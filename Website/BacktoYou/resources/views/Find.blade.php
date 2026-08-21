@if(!isset($skipCss))
<link rel="stylesheet" href="{{ asset('css/Find.css') }}">
@endif

<section class="recent-items">

    <div class="section-header">
    <span class="eyebrow">
        <i class="fa-solid fa-magnifying-glass-location" aria-hidden="true"></i>
        Community Board
    </span>
    <h2>{{ $sectionTitle ?? 'Recent Lost & Found Items' }}</h2>
</div>

    <div class="items-grid" id="{{ $gridId ?? 'itemsGrid' }}">

        @forelse($items as $item)

        <div class="item-card"
            data-title="{{ strtolower($item->title) }}"
            data-desc="{{ strtolower($item->description) }}"
            data-location="{{ strtolower($item->location) }}"
            data-brand="{{ strtolower($item->brand ?? '') }}"
            data-color="{{ strtolower($item->color ?? '') }}"
            data-category="{{ strtolower($item->category_name ?? '') }}">

            <div class="image-box">

                @if($item->photo)
                    <img src="{{ asset('uploads/items/' . $item->photo) }}" class="item-img" alt="{{ $item->title }}">
                @else
                    <div class="item-placeholder">
                        <i class="fa-solid fa-box-open" aria-hidden="true"></i>
                    </div>
                @endif

                <span class="item-tag {{ strtolower($item->item_type) }}">
                    {{ ucfirst($item->item_type) }}
                </span>

                <div class="item-icon {{ strtolower($item->item_type) }}">
                    <i class="fa-solid {{ strtolower($item->item_type) === 'lost' ? 'fa-circle-exclamation' : 'fa-circle-check' }}" aria-hidden="true"></i>
                </div>

            </div>

            <div class="item-content">

                <h3>{{ $item->title }}</h3>

                <p class="desc" title="{{ $item->description }}">{{ $item->description }}</p>

                <div class="details">

                    <p title="{{ $item->location }}">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <strong>Location:</strong>
                        <span class="value">{{ $item->location }}</span>
                    </p>

                    <p title="{{ $item->date_occurred }}">
                        <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                        <strong>Date:</strong>
                        <span class="value">{{ $item->date_occurred }}</span>
                    </p>

                    <p>
                        <i class="fa-solid fa-tag" aria-hidden="true"></i>
                        <strong>Status:</strong>
                        <span class="value">{{ ucfirst($item->item_type) }}</span>
                    </p>

                    @if($item->brand)
                    <p title="{{ $item->brand }}">
                        <i class="fa-solid fa-industry" aria-hidden="true"></i>
                        <strong>Brand:</strong>
                        <span class="value">{{ $item->brand }}</span>
                    </p>
                    @endif

                    @if($item->color)
                    <p title="{{ $item->color }}">
                        <i class="fa-solid fa-palette" aria-hidden="true"></i>
                        <strong>Color:</strong>
                        <span class="value">{{ $item->color }}</span>
                    </p>
                    @endif

                    @if($item->contact_number)
                    <p title="{{ $item->contact_number }}">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <strong>Contact:</strong>
                        <span class="value">{{ $item->contact_number }}</span>
                    </p>
                    @endif

                    @if($item->sub_type)
                    <p title="{{ $item->sub_type }}">
                        <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                        <strong>Category Detail:</strong>
                        <span class="value">{{ $item->sub_type }}</span>
                    </p>
                    @endif

                    @if($item->imei_number)
                    <p title="{{ $item->imei_number }}">
                        <i class="fa-solid fa-mobile-screen" aria-hidden="true"></i>
                        <strong>IMEI:</strong>
                        <span class="value">{{ $item->imei_number }}</span>
                    </p>
                    @endif

                    @if($item->serial_number)
                    <p title="{{ $item->serial_number }}">
                        <i class="fa-solid fa-laptop" aria-hidden="true"></i>
                        <strong>Serial No:</strong>
                        <span class="value">{{ $item->serial_number }}</span>
                    </p>
                    @endif

                    @if($item->verification_notes)
                    <p title="{{ $item->verification_notes }}">
                        <i class="fa-solid fa-note-sticky" aria-hidden="true"></i>
                        <strong>Extra Details:</strong>
                        <span class="value">{{ $item->verification_notes }}</span>
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
            <i class="fa-solid fa-box-open" aria-hidden="true"></i>
            <h4>No Items Found</h4>
            <p>There are no lost or found items available right now.</p>

            @if(Route::has('items.create'))
                <a href="{{ route('items.create') }}" class="report-btn">
                    <i class="fa-solid fa-plus me-1" aria-hidden="true"></i>
                    Report an Item
                </a>
            @endif
        </div>

        @endforelse

    </div>

</section>