<link rel="stylesheet" href="{{ asset('css/Footer.css') }}">

<footer class="footer">

    <div class="footer-container">

        <div class="footer-brand">
            <h2>Find<span>IT</span></h2>
            <p>Reconnecting people with their lost belongings.</p>
        </div>

        <div class="footer-links">
            <div>
                <h3>Platform</h3>
                <a href="{{ url('/Lostitems') }}">Lost Items</a>
                <a href="{{ url('/Founditems') }}">Found Items</a>
                <a href="{{ url('/Report') }}">Report Item</a>
            </div>

            <div>
                <h3>Company</h3>
                <a href="{{ url('/About') }}">About</a>
                <a href="#">Contact</a>
                <a href="#">Privacy</a>
            </div>

            <div>
                <h3>Support</h3>
                <a href="#">Help Center</a>
                <a href="#">Terms</a>
                <a href="#">FAQ</a>
            </div>
        </div>

        <div class="footer-bottom">
        <p>© 2026 FindIT. All rights reserved.</p>

        <div class="footer-bottom-links">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
        </div>
    </div>
    
    </div>

</footer>