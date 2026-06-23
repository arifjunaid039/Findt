<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | About</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    
@include('nav')
<div class="about-container">
    <div class="about-heading">
    <h1>About FindIT</h1>
    <p>Helping People Reconnect With Their Lost Belongings</p>
</div>
<section class="about-section">

    <div class="about-text">
        <h2>About FindIT</h2>

        <p>
            FindIT is a modern Lost & Found platform created to help people
            reconnect with their lost belongings quickly and securely.
            Whether you have lost an important item or found something that
            belongs to someone else, FindIT provides a trusted space where
            users can report, search, and recover items with ease.
        </p>
    </div>

    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3" alt="About FindIT">
    </div>

</section>

<section class="about-section reverse">

    <div class="about-text">
        <h2>Who We Are</h2>

        <p>
            FindIT was developed by a passionate team of students 
            who wanted to solve a common problem faced by thousands of people every day. Our goal is to create a reliable
            digital community where honesty, technology, and collaboration
            help people recover their valuable belongings.
        </p>
    </div>

    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Our Team">
    </div>

</section>

<section class="about-section">

    <div class="about-text">
        <h2>Our Mission</h2>

        <p>
            Our mission is to simplify the lost-and-found process by
            connecting people through a secure and user-friendly platform.
            We aim to increase the chances of successful item recovery while
            promoting trust, responsibility, and community support among users.
        </p>
    </div>

    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85" alt="Mission">
    </div>

</section>

<section class="about-section reverse">

    <div class="about-text">
        <h2>How FindIT Works</h2>

        <p>
            Users can easily report lost or found items, browse available
            listings, and search for potential matches. Through a simple and
            intuitive interface, FindIT helps users connect with one another,
            making the process of recovering lost belongings faster and more
            efficient than traditional methods.
        </p>
    </div>

    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f" alt="How FindIT Works">
    </div>

</section>

<section class="about-section">

    <div class="about-text">
        <h2>Future Vision</h2>

        <p>
            We envision FindIT becoming the leading lost-and-found platform
            worldwide. Future enhancements include AI-powered item matching,
            mobile applications, real-time notifications, location-based
            searches, and advanced security features that make recovering
            lost belongings faster, smarter, and safer.
        </p>
    </div>

    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1484101403633-562f891dc89a" alt="Future Vision">
    </div>

</section>

</div>

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