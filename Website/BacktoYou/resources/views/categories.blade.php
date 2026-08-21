<link rel="stylesheet" href="{{ asset('css/Categories.css') }}">

<style>
    .categories-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(160px,1fr));
        gap:18px;
    }

    a.category-card{
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align:center;
        gap:10px;
        text-decoration:none;
        color:inherit;
        cursor:pointer;
        padding:26px 18px;
        border-radius:18px;
        background:#fff;
        border:1px solid rgba(0,0,0,.06);
        box-shadow:0 2px 10px rgba(0,0,0,.04);
        transition:transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    a.category-card:hover{
        transform:translateY(-4px);
        box-shadow:0 12px 28px rgba(0,0,0,.09);
        border-color:#22c55e;
    }

    a.category-card .category-icon{
        width:56px;
        height:56px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:26px;
        border-radius:50%;
        background:rgba(34,197,94,.12);
        transition:transform .2s ease;
    }

    a.category-card:hover .category-icon{
        transform:scale(1.08);
    }

    a.category-card h3{
        margin:0;
        font-size:15px;
        font-weight:700;
        color:#1e293b;
    }

    body.dark a.category-card{
        background:#1e293b;
        border-color:rgba(255,255,255,.08);
        box-shadow:0 2px 10px rgba(0,0,0,.25);
    }

    body.dark a.category-card:hover{
        border-color:#22c55e;
        box-shadow:0 12px 28px rgba(0,0,0,.4);
    }

    body.dark a.category-card .category-icon{
        background:rgba(34,197,94,.18);
    }

    body.dark a.category-card h3{
        color:#f1f5f9;
    }
    
</style>

<section class="categories">

    <div class="section-header">
        <h2>Browse Categories</h2>
    </div>

    <div class="categories-grid">

        @php
            $categoryIcons = [
                'documents'      => '📄',
                'id card'        => '🪪',
                'jewelry'        => '💍',
                'keys'           => '🔑',
                'laptop'         => '💻',
                'mobile phone'   => '📱',
                'other'          => '📦',
                'wallet'         => '👛',
            ];
        @endphp

        @forelse($categories as $category)

            @php
                $icon = $categoryIcons[strtolower($category->name)] ?? '📦';
            @endphp

            <a href="{{ url('/Founditems') }}?category={{ urlencode(strtolower($category->name)) }}" class="category-card">
                <div class="category-icon">{{ $icon }}</div>
                <h3>{{ $category->name }}</h3>
            </a>

        @empty

            <p>No categories yet.</p>

        @endforelse

    </div>

</section>