<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/Footer.css') }}">

<footer class="footer">

    <div class="footer-container">

        <!-- Brand -->
        <div class="footer-brand">
            <a href="{{ url('/') }}" class="footer-logo">
                <img src="{{ asset('img/Logo.jpeg') }}" alt="BackToYou Logo" class="footer-logo-img">
                <span class="footer-logo-text">Back<span class="footer-accent">ToYou</span></span>
            </a>

            <p class="footer-tagline">
                Helping people reconnect with their lost belongings through a secure,
                trusted, and community-driven platform.
            </p>

            <div class="footer-social-icons">
                <a href="https://www.facebook.com/" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.youtube.com/" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://www.whatsapp.com/" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <!-- Links -->
        <div class="footer-links">

            <div>
                <h3>Platform</h3>
                <a href="{{ url('/Lostitems') }}">Lost Items</a>
                <a href="{{ url('/Founditems') }}">Found Items</a>
                <a href="{{ url('/Report') }}">Report Item</a>
                <a href="{{ url('/communities') }}">Communities</a>
            </div>

            <div>
                <h3>Company</h3>
                <a href="{{ url('/About') }}">About Us</a>
                <a href="{{ url('/contact') }}">Contact Us</a>
                <a href="{{ url('/privacy') }}">Privacy</a>
                <a href="{{ url('/terms') }}">Terms</a>
            </div>

            <div>
                <h3>Quick Links</h3>
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
                <a href="{{ url('/faq') }}">FAQ</a>
            </div>

        </div>

    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} BackToYou. All rights reserved.</p>

        <div class="footer-bottom-links">
            <a href="{{ url('/privacy') }}">Privacy Policy</a>
            <a href="{{ url('/terms') }}">Terms</a>
        </div>
    </div>

</footer>