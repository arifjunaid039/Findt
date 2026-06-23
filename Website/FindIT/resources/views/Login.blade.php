<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    @include('nav')

    <div class="login-container">

    <form action="/login" method="POST" class="login-form">
    @csrf

    <div class="login-logo">
        <img src="{{ asset('img/Logo.jpeg') }}" alt="FindIT Logo">
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
    <h2>Login to FindIT</h2>
    <p>Access your account and manage lost & found items.</p>

    <input type="email" name="email" placeholder="Email Address" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Login</button>

    <div class="register-link">
        Don't have an account?
        <a href="{{ route('register') }}">Register Here</a>
    </div>
</form>

    </div>

@include('footer')

</body>
</html>