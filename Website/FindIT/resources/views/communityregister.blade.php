<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Create Community</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/communityregister.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="community-register-page">

@include('nav')

<div class="community-register-container">

    <form action="{{ url('/communityregister') }}"
          method="POST"
          enctype="multipart/form-data"
          class="register-form wide">

        @csrf

        @if ($errors->any())
            <div class="alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-logo">
            <img src="{{ asset('img/Logo.jpeg') }}" alt="">
        </div>

        <h2>Create Your Community</h2>
        <p class="form-subtitle">Set up a space for people to connect and stay updated on lost & found items.</p>

        <div class="intro-banner">
            <i class="fa-solid fa-star"></i>
            <span>Become a Community Leader and build your own group.</span>
        </div>

        <!-- COMMUNITY DETAILS -->
        <div class="section-label"><i class="fa-solid fa-users"></i> Community Details</div>

        <div class="input-group">
            <label>Community Name</label>
            <div class="input-wrap">
                <span class="icon-chip icon-community"><i class="fa-solid fa-users"></i></span>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter community name" required>
            </div>
        </div>

<div class="input-group">
    <label>Community Category</label>

    <div class="cr-dropdown" id="categoryDropdown">

        <input type="hidden" name="category" id="categoryValue" required>

        <button type="button" class="cr-dropdown-toggle" id="categoryToggle" aria-haspopup="listbox" aria-expanded="false">
            <span class="icon-chip icon-category">
                <i class="fa-solid fa-layer-group"></i>
            </span>
            <span class="cr-dropdown-label" id="categoryLabel">Select a Community Category</span>
            <i class="fa-solid fa-chevron-down cr-dropdown-arrow"></i>
        </button>

        <ul class="cr-dropdown-menu" id="categoryMenu" role="listbox">
            <li role="option" data-value="Technology">
                <span class="cr-option-emoji">💻</span> Technology
            </li>
            <li role="option" data-value="Education">
                <span class="cr-option-emoji">📚</span> Education
            </li>
            <li role="option" data-value="Sports">
                <span class="cr-option-emoji">⚽</span> Sports
            </li>
            <li role="option" data-value="Gaming">
                <span class="cr-option-emoji">🎮</span> Gaming
            </li>
            <li role="option" data-value="Lost & Found">
                <span class="cr-option-emoji">🔍</span> Lost &amp; Found
            </li>
            <li role="option" data-value="Social">
                <span class="cr-option-emoji">🤝</span> Social
            </li>
            <li role="option" data-value="Other">
                <span class="cr-option-emoji">✨</span> Other
            </li>
        </ul>

    </div>
</div>
        <div class="input-group">
            <label>Community Description</label>
            <div class="input-wrap">
                <span class="icon-chip icon-description top-align"><i class="fa-solid fa-align-left"></i></span>
                <textarea name="description" rows="4" placeholder="Describe your community..." required>{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="input-group">
            <label>Community Rules <span class="hint" style="display:inline;margin:0;">(optional)</span></label>
            <div class="input-wrap">
                <span class="icon-chip icon-rules top-align"><i class="fa-solid fa-scroll"></i></span>
                <textarea name="rules" rows="3" placeholder="Example: Be respectful, No spam, etc.">{{ old('rules') }}</textarea>
            </div>
        </div>

        <div class="input-group">
            <label>Community Email Address</label>
            <div class="input-wrap">
                <span class="icon-chip icon-email"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="community@example.com" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-group">
                <label>Password</label>
                <div class="input-wrap password-wrap">
                    <span class="icon-chip icon-lock"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" placeholder="Create a password" required>
                    <button type="button" class="toggle-pass" data-target="password">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <div class="input-wrap password-wrap">
                    <span class="icon-chip icon-lock2"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm password" required>
                    <button type="button" class="toggle-pass" data-target="confirmPassword">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- LEADER DETAILS -->
        <div class="section-label"><i class="fa-solid fa-user-shield"></i> Community Leader Information</div>

        <div class="input-group">
            <label>Leader Full Name</label>
            <div class="input-wrap">
                <span class="icon-chip icon-leader"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="leader_name" value="{{ old('leader_name') }}" placeholder="Enter leader full name" required>
            </div>
        </div>

        <div class="form-row">
            <div class="input-group">
                <label>Leader Contact Number</label>
                <div class="input-wrap">
                    <span class="icon-chip icon-phone"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" name="leader_phone" value="{{ old('leader_phone') }}" pattern="[0-9]{11}" placeholder="03XXXXXXXXX" required>
                </div>
            </div>

            <div class="input-group">
                <label>Leader CNIC Number</label>
                <div class="input-wrap">
                    <span class="icon-chip icon-cnic"><i class="fa-solid fa-id-card"></i></span>
                    <input type="text" name="leader_cnic" value="{{ old('leader_cnic') }}" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" placeholder="42101-1234567-1" required>
                </div>
            </div>
        </div>

        <div class="input-group">
            <label>Location</label>
            <div class="input-wrap">
                <span class="icon-chip icon-location"><i class="fa-solid fa-location-dot"></i></span>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="Karachi, Pakistan" required>
            </div>
        </div>

        <!-- PRIVACY -->
        <div class="section-label"><i class="fa-solid fa-lock"></i> Privacy</div>

        <div class="input-group">
            <label>Community Type</label>
            <div class="privacy-pills">
                <div class="privacy-pill">
                    <input type="radio" name="privacy" id="privacyPublic" value="public" checked>
                    <label for="privacyPublic"><i class="fa-solid fa-globe"></i> Public</label>
                </div>
                <div class="privacy-pill">
                    <input type="radio" name="privacy" id="privacyPrivate" value="private">
                    <label for="privacyPrivate"><i class="fa-solid fa-lock"></i> Private</label>
                </div>
            </div>
        </div>

        <!-- IMAGES -->
        <div class="section-label"><i class="fa-solid fa-image"></i> Community Images</div>

        <div class="input-group">
            <div class="media-row">
                <div class="media-upload">
                    <img src="{{ asset('img/community-placeholder.jpg') }}" class="media-preview-circle" id="logoPreview">
                    <div class="media-upload-text">
                        <strong>Logo</strong>
                        <span>Required</span>
                    </div>
                    <label class="media-browse-btn">
                        Browse
                        <input type="file" name="image" id="logoInput" accept="image/*" required>
                    </label>
                </div>

                <div class="media-upload">
                    <img src="{{ asset('img/community-placeholder.jpg') }}" class="media-preview-rect" id="bannerPreview">
                    <div class="media-upload-text">
                        <strong>Banner</strong>
                        <span>Optional</span>
                    </div>
                    <label class="media-browse-btn">
                        Browse
                        <input type="file" name="banner" id="bannerInput" accept="image/*">
                    </label>
                </div>
            </div>
        </div>

        <button type="submit">
            <i class="fa-solid fa-circle-plus"></i> Create Community
        </button>

    </form>

</div>

@include('footer')

<script>
// Password show/hide toggle
document.querySelectorAll('.toggle-pass').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector('i');
        if (target.type === 'password') {
            target.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            target.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

// Live preview: logo
const logoInput = document.getElementById('logoInput');
const logoPreview = document.getElementById('logoPreview');
if (logoInput) {
    logoInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (file) logoPreview.src = URL.createObjectURL(file);
    });
}

// Live preview: banner
const bannerInput = document.getElementById('bannerInput');
const bannerPreview = document.getElementById('bannerPreview');
if (bannerInput) {
    bannerInput.addEventListener('change', function(e){
        const file = e.target.files[0];
        if (file) bannerPreview.src = URL.createObjectURL(file);
    });
}
// Custom category dropdown
const catDropdown = document.getElementById('categoryDropdown');
const catToggle   = document.getElementById('categoryToggle');
const catMenu     = document.getElementById('categoryMenu');
const catLabel    = document.getElementById('categoryLabel');
const catValue    = document.getElementById('categoryValue');

catToggle.addEventListener('click', () => {
    const isOpen = catDropdown.classList.toggle('open');
    catToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
});

catMenu.querySelectorAll('li').forEach(option => {
    option.addEventListener('click', () => {
        catMenu.querySelectorAll('li').forEach(o => o.classList.remove('selected'));
        option.classList.add('selected');

        catValue.value = option.dataset.value;
        catLabel.textContent = option.textContent.trim();
        catLabel.classList.add('has-value');

        catDropdown.classList.remove('open');
        catToggle.setAttribute('aria-expanded', 'false');
    });
});

// Close on outside click
document.addEventListener('click', (e) => {
    if (!catDropdown.contains(e.target)) {
        catDropdown.classList.remove('open');
        catToggle.setAttribute('aria-expanded', 'false');
    }
});
</script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>