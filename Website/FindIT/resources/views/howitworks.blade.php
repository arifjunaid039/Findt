<link rel="stylesheet" href="{{ asset('css/howitworks.css') }}">

<section class="how-it-works">

    <span class="section-badge">
        <i class="fa-solid fa-bolt"></i>
        Quick Access
    </span>

    <h2>Everything You Need in One Place</h2>

    <p class="section-text">
        Easily report lost items, browse found belongings, or search for missing items—all in just a few clicks.
    </p>

    <div class="steps">

        <!-- Report -->
        <div class="step">

            <div class="step-number">01</div>

            <div class="step-image-box">
                <img src="https://images.unsplash.com/photo-1517842645767-c639042777db?w=900&h=600&fit=crop&auto=format&q=80"
                     alt="Report Item"
                     loading="lazy">

                <div class="image-overlay"></div>
            </div>

            <div class="step-content">

                <div class="step-icon">
                    <i class="fa-solid fa-file-pen"></i>
                </div>

                <h3>Report Item</h3>

                <p>
                    Submit details about a lost or found item in minutes and help reunite people with their belongings.
                </p>

                <a href="{{ url('/Report') }}">
                    Report Now
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

        <!-- Found -->
        <div class="step">

            <div class="step-number">02</div>

            <div class="step-image-box">

                <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=900&h=600&fit=crop&auto=format&q=80"
                     alt="Found Items"
                     loading="lazy">

                <div class="image-overlay"></div>

            </div>

            <div class="step-content">

                <div class="step-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <h3>Found Items</h3>

                <p>
                    Browse recently reported found items and check whether your missing belongings have already been discovered.
                </p>

                <a href="{{ url('/Founditems') }}">
                    View Found
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

        <!-- Lost -->
        <div class="step">

            <div class="step-number">03</div>

            <div class="step-image-box">

                <img src="https://images.unsplash.com/photo-1509281373149-e957c6296406?w=900&h=600&fit=crop&auto=format&q=80"
                     alt="Lost Items"
                     loading="lazy">

                <div class="image-overlay"></div>

            </div>

            <div class="step-content">

                <div class="step-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <h3>Lost Items</h3>

                <p>
                    Explore reported lost items and help connect owners with the belongings they are searching for.
                </p>

                <a href="{{ url('/Lostitems') }}">
                    View Lost
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>