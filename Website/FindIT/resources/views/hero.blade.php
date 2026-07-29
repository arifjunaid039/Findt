<link rel="stylesheet" href="{{ asset('css/Hero.css') }}">

<section class="hero">

    <div class="hero-glow hero-glow-1"></div>
    <div class="hero-glow hero-glow-2"></div>

    <div class="hero-content">

        <span class="hero-badge">
            <i class="fa-solid fa-shield-heart"></i>
            Community-powered lost &amp; found
        </span>

        <h1>
            Lost Something?
            <span>Find It With FindIT</span>
        </h1>

        <p>
            Report lost items and help others recover their belongings.
        </p>

        <div class="hero-buttons">
            <a href="{{ url('/Report') }}" class="cta-secondary">
                <i class="fa-solid fa-flag"></i>
                Report Item
            </a>
        </div>

    </div>

</section>