<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FindIT | FoundItems</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/Founditems.css') }}">
</head>
<body>

@include('nav')

<div class="page">

    <div class="header">
        <h1>Found Items</h1>
        <br>
        <p>Find reported lost items in your community</p>
    </div>

    <div class="grid">

@foreach($items as $item)

<div class="card">

    @if($item->photo)
        <img src="{{ asset('uploads/items/' . $item->photo) }}" class="item-img">
    @endif

    <div class="card-body">

        <h3>{{ $item->title }}</h3>

        <p class="desc">{{ $item->description }}</p>

        <div class="details">
            <p><strong>📍 Location:</strong> {{ $item->location }}</p>
            <p><strong>📅 Date:</strong> {{ $item->date_occurred }}</p>
            <p><strong>🆔 Type:</strong> {{ ucfirst($item->item_type) }}</p>
        </div>

    </div>

</div>

@endforeach

</div>

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