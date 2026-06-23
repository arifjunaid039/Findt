<!DOCTYPE html>
<html>
<head>
    <title>FindIT | Communities</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/communities.css') }}">
</head>
<body>
@include('nav')
<div class="container">

    <div class="page-header">
        <h1>Communities</h1>
        <p>Join communities to connect with people and stay updated about lost and found items.</p>
    </div>

    <div class="community-grid">

        @forelse($communities as $community)

            <div class="community-card">

    <div class="card-image">
        @if($community->image)
            <img src="{{ asset('uploads/'.$community->image) }}" alt="">
        @else
            <img src="{{ asset('img/community-placeholder.jpg') }}" alt="">
        @endif

        <div class="member-badge">
            👥 {{ $community->members->count() }} Members
        </div>
    </div>

    <div class="card-content">
        <h2>{{ $community->name }}</h2>

        <p>
            {{ Str::limit($community->description, 120) }}
        </p>

        <form action="{{ url('/communities/join/'.$community->id) }}" method="POST">
            @csrf
            <button type="submit">
                Join Community
            </button>
        </form>
    </div>

</div>

        @empty

            <div class="empty-community">
                <img src="{{ asset('img/Logo.jpeg') }}" alt="">
                <h2>No Communities Yet</h2>
                <p>
                    There are currently no communities available.
                    Check back later or create your first community.
                </p>
            </div>

        @endforelse

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