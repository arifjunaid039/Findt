<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Community Manage Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/community.css') }}">
</head>

<body>

@include('nav')

<div class="container">

    <div class="page-title">
        <h2>Community Manage Profile</h2>
        <p>Update your community's details, media, and settings.</p>
    </div>

    <form method="POST" action="/community/profile/update" enctype="multipart/form-data">
        @csrf

        <div class="banner-wrap">
            @if($community->banner)
                <img src="{{ asset('uploads/communities/'.$community->banner) }}" class="banner-img" id="bannerPreview" alt="{{ $community->name }} banner">
            @else
                <img src="{{ asset('img/community-placeholder.jpg') }}" class="banner-img" id="bannerPreview" alt="Default community banner">
            @endif

            <label class="banner-edit">
                <i class="fa-solid fa-image"></i> Change Banner
                <input type="file" name="banner" id="bannerInput" accept="image/*">
            </label>
        </div>

        <div class="logo-wrap">
            @if($community->image)
                <img src="{{ asset('uploads/communities/'.$community->image) }}" class="logo-img" id="logoPreview" alt="{{ $community->name }} logo">
            @else
                <img src="{{ asset('img/community-placeholder.jpg') }}" class="logo-img" id="logoPreview" alt="Default community logo">
            @endif

            <label class="logo-edit">
                <i class="fa-solid fa-camera"></i>
                <input type="file" name="image" id="logoInput" accept="image/*">
            </label>
        </div>

        <div class="form-area">

            @if(session('success'))
            <div class="success-box">
                <i class="fa-solid fa-check"></i> {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="panel">
                <div class="section-label"><i class="fa-solid fa-circle-info"></i> Basic Info</div>

                <div class="form-group">
                    <label for="name">Community Name</label>
                    <div class="input-wrap">
                        <span class="icon-chip icon-name"><i class="fa-solid fa-users"></i></span>
                        <input type="text" id="name" name="name" value="{{ old('name', $community->name) }}" placeholder="Community name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <span class="icon-chip icon-email"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" id="email" name="email" value="{{ old('email', $community->email) }}" placeholder="community@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="input-wrap">
                        <span class="icon-chip icon-description top-align"><i class="fa-solid fa-align-left"></i></span>
                        <textarea id="description" name="description" placeholder="What is this community about?">{{ old('description', $community->description) }}</textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <div class="input-wrap">
                            <span class="icon-chip icon-category"><i class="fa-solid fa-tags"></i></span>
                            <input type="text" id="category" name="category" value="{{ old('category', $community->category) }}" placeholder="e.g. Technology">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location">Location / Area</label>
                        @include('partials.location-select', ['fieldName' => 'location', 'selectedValue' => $community->location])
                    </div>
                </div>

                <div class="form-group">
                    <label for="rules">Community Rules</label>
                    <div class="input-wrap">
                        <span class="icon-chip icon-rules top-align"><i class="fa-solid fa-scroll"></i></span>
                        <textarea id="rules" name="rules" placeholder="List the ground rules">{{ old('rules', $community->rules) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="section-label"><i class="fa-solid fa-user-shield"></i> Leader Details</div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="leader_phone">Leader Phone</label>
                        <div class="input-wrap">
                            <span class="icon-chip icon-phone"><i class="fa-solid fa-phone"></i></span>
                            <input type="tel" id="leader_phone" name="leader_phone" value="{{ old('leader_phone', $community->leader_phone) }}" placeholder="03XX XXXXXXX">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="leader_cnic">Leader CNIC</label>
                        <div class="input-wrap">
                            <span class="icon-chip icon-cnic"><i class="fa-solid fa-id-card"></i></span>
                            <input type="text" id="leader_cnic" name="leader_cnic" value="{{ old('leader_cnic', $community->leader_cnic) }}" placeholder="XXXXX-XXXXXXX-X">
                        </div>
                    </div>
                </div>

                <p class="privacy-hint"><i class="fa-solid fa-lock" style="color:var(--primary); margin-right:4px;"></i>Only visible to BackToYou admins for verification purposes.</p>
            </div>

            <button type="submit" class="update-btn">
                <i class="fa-solid fa-floppy-disk"></i> Update Community
            </button>

        </div> <!-- form-area -->
    </form> <!-- Update Form Ends -->

    <form action="{{ route('community.logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </button>
    </form>

    {{-- Danger Zone: kept as its own section/forms, separate from the update form above --}}
    <div class="danger-section">
        <div class="danger-zone-label">
            <i class="fa-solid fa-triangle-exclamation"></i> Danger Zone
        </div>

        <p class="danger-zone-desc">
            Deleting <strong>{{ $community->name }}</strong> removes it permanently, along with its members and history. This can't be undone.
        </p>

        <form method="POST" action="/community/profile/delete" id="deleteForm">
            @csrf

            <div class="form-group">
                <label for="delete_confirm">
                    Type <strong>{{ $community->name }}</strong> to confirm
                </label>

                <input
                    type="text"
                    id="delete_confirm"
                    name="confirm_name"
                    placeholder="{{ $community->name }}"
                    autocomplete="off">
            </div>

            <button type="submit" class="delete-btn" id="deleteBtn" disabled>
                <i class="fa-solid fa-trash"></i> Delete Community
            </button>
        </form>
    </div>

</div>

@include('footer')

<script>
// Live preview for banner
const bannerInput = document.getElementById('bannerInput');
const bannerPreview = document.getElementById('bannerPreview');
if (bannerInput) {
    bannerInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (file) bannerPreview.src = URL.createObjectURL(file);
    });
}

// Live preview for logo
const logoInput = document.getElementById('logoInput');
const logoPreview = document.getElementById('logoPreview');
if (logoInput) {
    logoInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (file) logoPreview.src = URL.createObjectURL(file);
    });
}

// Require typing the exact community name before the delete button is enabled
const communityName = @json($community->name);
const deleteInput = document.getElementById('delete_confirm');
const deleteBtn = document.getElementById('deleteBtn');
if (deleteInput && deleteBtn) {
    deleteInput.addEventListener('input', () => {
        deleteBtn.disabled = deleteInput.value.trim() !== communityName;
    });
}
</script>

</body>
</html>