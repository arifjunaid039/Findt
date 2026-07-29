<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FindIT helps people report, search and recover lost & found items securely.">
    <title>FindIT | About Us</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/About.css') }}">
</head>

<body>

@include('nav')

<div class="about-container">

    <!-- HERO -->

    <section class="about-hero">

        <div class="hero-content">

            <span class="about-eyebrow">
                <i class="fa-solid fa-location-dot"></i>
                Pakistan's Smart Lost & Found Platform
            </span>

            <h1>
                Reconnecting People With
                <span>The Things They Value.</span>
            </h1>

            <p>
                FindIT provides a secure and intelligent platform where people
                can report lost belongings, upload found items, search listings,
                communicate safely, and recover valuable possessions faster than
                ever before.
            </p>

            <div class="hero-buttons">

                <a href="{{ url('/Report') }}" class="hero-btn primary-btn rep">
                    <i class="fa-solid fa-circle-plus"></i>
                    Report Item
                </a>

                <a href="{{ url('/Founditems') }}" class="hero-btn secondary-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Browse Items
                </a>

            </div>

        </div>

    </section>

    <!-- SECTION 1 -->

    <section class="about-section">

        <div class="about-image">

            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3"
                 alt="FindIT">

        </div>

        <div class="about-text">

            <span class="section-tag">
                ABOUT FINDIT
            </span>

            <h2>
                A Better Way To Recover Lost Items
            </h2>

            <p>

                Losing an important belonging can be frustrating and stressful.
                FindIT simplifies the entire recovery process by bringing together
                people who lost something and those who found it.

            </p>

            <p>

                Instead of relying on social media posts or word of mouth,
                everything is organized in one trusted platform where users can
                quickly report, search and communicate.

            </p>

        </div>

    </section>

    <!-- SECTION 2 -->

    <section class="about-section reverse">

        <div class="about-image">

            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                 alt="Community">

        </div>

        <div class="about-text">

            <span class="section-tag">
                OUR COMMUNITY
            </span>

            <h2>
                Powered By Honest People
            </h2>

            <p>

                Communities are at the heart of FindIT.
                Schools, universities, companies and organizations can create
                verified communities where members work together to return
                misplaced belongings.

            </p>

            <p>

                Every recovered item strengthens trust and encourages people to
                help each other.

            </p>

        </div>

    </section>

    <!-- SECTION 3 -->

    <section class="about-section">

        <div class="about-image">

            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85"
                 alt="Mission">

        </div>

        <div class="about-text">

            <span class="section-tag">
                OUR MISSION
            </span>

            <h2>
                Making Recovery Faster & Simpler
            </h2>

            <p>

                Our mission is to create Pakistan's most trusted Lost & Found
                platform by combining smart technology with community support.

            </p>

            <ul>

                <li>Smart item matching</li>

                <li>Secure messaging</li>

                <li>Verified communities</li>

                <li>Simple reporting process</li>

                <li>Fast recovery experience</li>

            </ul>

        </div>

    </section>

    <!-- SECTION 4 -->

    <section class="about-section reverse">

        <div class="about-image">

            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f"
                 alt="Technology">

        </div>

        <div class="about-text">

            <span class="section-tag">
                TECHNOLOGY
            </span>

            <h2>
                Smart Features Built For Everyone
            </h2>

            <p>

                FindIT uses modern web technologies to provide secure searching,
                organized categories, protected communication and an easy-to-use
                interface for every user.

            </p>

            <p>

                Whether you're reporting a wallet, phone, ID card or laptop,
                FindIT makes the process quick and reliable.

            </p>

        </div>

    </section>

    <!-- SECTION 5 -->

    <section class="about-section">

        <div class="about-image">

            <img src="https://images.unsplash.com/photo-1484101403633-562f891dc89a"
                 alt="Future">

        </div>

        <div class="about-text">

            <span class="section-tag">
                FUTURE VISION
            </span>

            <h2>
                Building The Future Of Lost & Found
            </h2>

            <p>

                We continue improving FindIT with AI-powered matching,
                mobile applications, live notifications, GPS-based search
                and stronger verification systems.

            </p>

            <p>

                Our goal is simple:
                help every lost item find its rightful owner.

            </p>

        </div>

    </section>

    <!-- CTA -->

    <section class="about-cta">

        <h2>
            Ready To Recover Your Lost Item?
        </h2>

        <p>

            Join thousands of users who trust FindIT every day.

        </p>

        <div class="about-cta-buttons">

            <a href="{{ url('/Report') }}" class="cta-primary">
                <i class="fa-solid fa-circle-plus"></i>
                Report Item
            </a>

            <a href="{{ url('/Founditems') }}" class="cta-secondary">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search Items
            </a>

        </div>

    </section>

</div>

@include('footer')

<script>

document.addEventListener("DOMContentLoaded", function () {

const toggle = document.getElementById('themeToggle');

// Page load hone par saved theme apply karo
if(localStorage.getItem('theme') === 'dark'){
    document.body.classList.add('dark');
    toggle.textContent = '☀️';
}else{
    document.body.classList.remove('dark');
    toggle.textContent = '🌙';
}

// Theme change
toggle.addEventListener('click', () => {

    document.body.classList.toggle('dark');

    if(document.body.classList.contains('dark')){
        localStorage.setItem('theme','dark');
        toggle.textContent = '☀️';
    }else{
        localStorage.setItem('theme','light');
        toggle.textContent = '🌙';
    }

});


// Page load theme

if(localStorage.getItem("theme") === "dark"){

    document.body.classList.add("dark");

    toggle.textContent = "☀️";

}
else{

    document.body.classList.remove("dark");

    toggle.textContent = "🌙";

}



// Theme change

toggle.addEventListener("click", function(){


    document.body.classList.toggle("dark");


    if(document.body.classList.contains("dark")){


        localStorage.setItem("theme","dark");

        toggle.textContent="☀️";


    }
    else{


        localStorage.setItem("theme","light");

        toggle.textContent="🌙";


    }


});



// SCROLL ANIMATION

const sections = document.querySelectorAll(".about-section");


const observer = new IntersectionObserver((entries)=>{


    entries.forEach(entry=>{


        if(entry.isIntersecting){

            entry.target.classList.add("in-view");

        }


    });


},{threshold:0.1});



sections.forEach(section=>{

    observer.observe(section);

});


});

</script>

</body>
</html>