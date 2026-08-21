<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Contact</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Contact.css') }}">
</head>
<body>

    @include('nav')

    <div class="contact-wrap">
        <div class="contact-form">

            <div class="form-header">
                <div class="form-icon"><i class="fa-solid fa-headset"></i></div>
                <h1>Contact Us</h1>
                <p class="lede">
                    Have questions, feedback, or need assistance? We're always here to help.
                    At <strong>BackToYou</strong>, we believe in providing fast, reliable, and
                    professional support for every visitor.
                </p>
            </div>

            @if (session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="contact-body">

                <!-- Message form -->
                <div>
                    <h2 class="section-title"><i class="fa-solid fa-paper-plane"></i> Send Us a Message</h2>

                    <form action="{{ route('contact') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i> Full Name</label>
                            <input
                                type="text"
                                id="name"
                                class="@error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required>
                            @error('name')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                            <input
                                type="email"
                                id="email"
                                class="@error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required>
                            @error('email')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject"><i class="fa-solid fa-tag"></i> Subject</label>
                            <input
                                type="text"
                                id="subject"
                                class="@error('subject') is-invalid @enderror"
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="Enter subject"
                                required>
                            @error('subject')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message"><i class="fa-solid fa-pen-to-square"></i> Message</label>
                            <textarea
                                id="message"
                                class="@error('message') is-invalid @enderror"
                                name="message"
                                placeholder="Write your message here"
                                required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit">
                            <i class="fa-solid fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact information -->
                <div>
                    <h2 class="section-title"><i class="fa-solid fa-address-book"></i> Contact Information</h2>

                    <ul class="info-list">

                        <li class="info-item">
                            <span class="icon"><i class="fa-solid fa-phone"></i></span>
                            <div>
                                <h5>Phone</h5>
                                <a href="tel:+923001234567">+92 300 1234567</a>
                            </div>
                        </li>

                        <li class="info-item">
                            <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                            <div>
                                <h5>Email</h5>
                                <a href="mailto:support@findit.com">support@findit.com</a>
                                <small>We reply within 24 hours</small>
                            </div>
                        </li>

                        <li class="info-item address">
                            <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                            <div>
                                <h5>Office Address</h5>
                                <p>Karachi, Pakistan</p>
                            </div>
                        </li>

                        <li class="info-item whatsapp">
                            <span class="icon"><i class="fa-brands fa-whatsapp"></i></span>
                            <div>
                                <h5>WhatsApp</h5>
                                <a href="https://wa.me/923001234567" target="_blank" rel="noopener">+92 300 1234567</a>
                                <small>Chat with us anytime</small>
                            </div>
                        </li>

                        <li class="info-item">
                            <span class="icon"><i class="fa-solid fa-headset"></i></span>
                            <div>
                                <h5>Customer Support</h5>
                                <p>Available 24/7</p>
                                <small>Friendly &amp; professional assistance whenever you need it.</small>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>

        </div>
    </div>

    @include('footer')

</body>
</html>