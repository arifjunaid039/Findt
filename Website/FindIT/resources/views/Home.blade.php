    <!DOCTYPE html>
    <html lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FindIT | Home</title>
        <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
        <link rel="stylesheet" href="{{ asset('css/Hero.css') }}">
        <link rel="stylesheet" href="{{ asset('css/howitworks.css') }}">
        <link rel="stylesheet" href="{{ asset('css/Find.css') }}">

    </head>

    <body>

    @include('nav') 

    <section class="hero">
        <div class="hero-content">

            <h1>
                Lost Something?
                <span>Find It With FindIT</span>
            </h1>

            <p>
                Report lost items and help others recover their belongings.
            </p>

            <div class="hero-buttons">
            <a href="{{ url('/Report') }}" class="cta-secondary">Report Item</a>
            </div>

        </div>
    </section>

    @include('howitworks') 

    <br>

<section class="recent-items">

    <div class="section-header">
        <h2>Recent Lost & Found Items</h2>
    </div>

    <div class="items-grid">

        @forelse($items as $item)

        <div class="item-card">

            <!-- TYPE TAG -->
            <div class="item-tag {{ $item->item_type }}">
                {{ ucfirst($item->item_type) }}
            </div>

            <!-- IMAGE -->
            @if(!empty($item->photo))
                <img src="{{ asset('uploads/items/'.$item->photo) }}" class="item-img">
            @else
                <div class="item-placeholder">📦 No Image</div>
            @endif

            <!-- TITLE -->
            <h3>{{ $item->title }}</h3>

            <!-- LOCATION -->
            <p class="location">📍 {{ $item->location }}</p>

            <!-- TIME -->
            <span class="time">
                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
            </span>

        </div>

        @empty
            <p style="grid-column:1/-1;text-align:center;color:#777;">
                No items found yet.
            </p>
        @endforelse

    </div>

</section>  

    @include('categories') 

    @include('cta') 

    @include('footer') 

        <script>
    const toggle=document.getElementById('themeToggle');

    toggle.addEventListener('click',()=>{

        document.body.classList.toggle('dark');

        toggle.textContent=
        document.body.classList.contains('dark')
        ? '☀️'
        : '🌙';
    });
    </script>
    </body>
    </html>