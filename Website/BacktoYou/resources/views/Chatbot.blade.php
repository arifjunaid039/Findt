<!-- ===========================
        FINDIT CHATBOT
=========================== -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Chat Button -->
<div id="chatbot-toggle">
    <img src="{{ asset('img/chatbot-icon.png') }}" alt="Chatbot">
    <span class="chat-notification">1</span>
</div>

<!-- Chatbot -->
<div id="chatbot">

    <!-- Header -->
    <div class="chat-header">

        <div class="chat-user">

            <div class="bot-image">
    <img src="{{ asset('img/chatbot-icon2(1).png') }}" alt="Bot">
</div>

            <div>
                <h3>FindIT Assistant</h3>
                <small>🟢 Online</small>
            </div>

        </div>

        <span id="close-chat">
            <i class="fas fa-times"></i>
        </span>

    </div>

    <!-- Chat Body -->
    <div class="chat-body" id="chat-body">

        <div class="bot-msg">
            <div class="msg">
                👋 <b>Assalam-o-Alaikum!</b><br><br>

                Welcome to <b>FindIT</b>.

                <br><br>

                Main aapki kis tarah madad kar sakta hoon?

                <br><br>

                Aap niche diye gaye buttons par click kar sakte hain ya apna sawal type kar sakte hain.
            </div>
        </div>

    </div>

    <!-- Quick Reply Buttons -->
    <div class="quick-replies">

        <button class="quick-btn">Lost Item</button>

        <button class="quick-btn">Found Item</button>

        <button class="quick-btn">Commonities</button>

        <button class="quick-btn">Report Lost Item</button>

        <button class="quick-btn">Login</button>

        <button class="quick-btn">Register</button>

        <button class="quick-btn">About</button>

        <button class="quick-btn">Contact</button>

        



    </div>

    <!-- Footer -->
    <div class="chat-footer">

        <input
            type="text"
            id="user-input"
            placeholder="Type your message..."
            autocomplete="off">

        <button id="send-btn">
            <i class="fas fa-paper-plane"></i>
        </button>

    </div>

</div>

<!-- Chatbot CSS -->
<link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">

<!-- Chatbot JavaScript -->
<script src="{{ asset('js/chatbot.js') }}"></script>