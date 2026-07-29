    <!DOCTYPE html>
    <html lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FindIT | Home</title>
        <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
        <link rel="stylesheet" href="{{ asset('css/About.css') }}">
        <link rel="stylesheet" href="{{ asset('css/howitworks.css') }}">
    </head>

    <body>

    @include('nav') 

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

    @include('howitworks') 

    <br>
    
    @include('Find', ['items' => $lostItems, 'sectionTitle' => 'Recently Lost', 'gridId' => 'lostItemsGrid'])

    @include('Find', ['items' => $foundItems, 'sectionTitle' => 'Recently Found', 'gridId' => 'foundItemsGrid'])

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

    <script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
    </body>
    </html>