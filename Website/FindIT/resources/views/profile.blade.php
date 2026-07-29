<!DOCTYPE html>
<html>
<head>
    <title> FindIT | Manage Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
:root{
    --primary:#2563eb;
    --primary-dark:#1d4ed8;
    --danger:#ef4444;
    --danger-dark:#dc2626;
    --dark:#111827;
    --text:#374151;
    --muted:#6b7280;
    --border:#e5e7eb;
}

*{ box-sizing:border-box; }

body{
    margin:0;
    font-family:'Segoe UI', system-ui, sans-serif;
    background:
        radial-gradient(circle at top left,#eef2ff,transparent 50%),
        radial-gradient(circle at bottom right,#eff6ff,transparent 50%),
        #f8fafc;
    min-height:100vh;
    transition:background .3s ease,color .3s ease;
}

/* MAIN CARD */
.container{
    max-width:520px;
    margin:70px auto;
    background:rgba(255,255,255,0.92);
    backdrop-filter: blur(10px);
    padding:40px 35px;
    border-radius:24px;
    box-shadow:
        0 10px 25px rgba(0,0,0,.04),
        0 25px 60px rgba(37,99,235,.08);
    border:1px solid rgba(0,0,0,0.05);
    transition:background .3s ease,border-color .3s ease,box-shadow .3s ease;
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:6px;
    font-size:26px;
    font-weight:700;
    color:var(--dark);
}

.subtitle{
    text-align:center;
    color:var(--muted);
    font-size:14px;
    margin-bottom:28px;
    line-height:1.6;
}

/* PROFILE IMAGE */
.profile-img-wrap{
    position:relative;
    width:104px;
    height:104px;
    margin:0 auto 10px;
    cursor:pointer;
}

.profile-img{
    display:block;
    width:100px;
    height:100px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #fff;
    box-shadow:
        0 0 0 3px var(--primary),
        0 10px 20px rgba(37,99,235,0.25);
    transition:opacity .22s ease, transform .22s ease, filter .22s ease;
}

.profile-img.img-fading{
    opacity:0;
    transform:scale(.96);
}

/* Hover veil + hint over the avatar itself — hints that the whole
   circle (not just the small badge) is clickable to change the photo */
.profile-img-veil{
    position:absolute;
    top:0; left:0;
    width:100px; height:100px;
    border-radius:50%;
    background:rgba(15,23,42,0);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:11px;
    font-weight:700;
    text-align:center;
    line-height:1.3;
    opacity:0;
    transition:.22s ease;
    pointer-events:none;
}

.profile-img-wrap:hover .profile-img-veil{
    background:rgba(15,23,42,.42);
    opacity:1;
}

.profile-img-wrap:hover .profile-img{
    filter:brightness(.92);
}

/* Uploading spinner shown while the file is being read */
.profile-img-spinner{
    position:absolute;
    top:0; left:0;
    width:100px; height:100px;
    border-radius:50%;
    display:none;
    align-items:center;
    justify-content:center;
    background:rgba(15,23,42,.45);
    color:#fff;
    font-size:18px;
}

.profile-img-spinner.active{
    display:flex;
}

.profile-img-spinner i{
    animation:spin .7s linear infinite;
}

@keyframes spin{
    from{ transform:rotate(0deg); }
    to{ transform:rotate(360deg); }
}

.profile-img-edit{
    position:absolute;
    bottom:0;
    right:0;
    width:32px;
    height:32px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    border:3px solid #fff;
    cursor:pointer;
    box-shadow:0 4px 10px rgba(37,99,235,.4);
    transition:.25s;
    z-index:2;
}

.profile-img-edit:hover{
    transform:scale(1.12) rotate(-8deg);
    box-shadow:0 6px 16px rgba(37,99,235,.5);
}

.profile-img-edit input[type="file"]{
    display:none;
}

/* Feedback line under the avatar: filename on success, message on error */
.photo-feedback{
    text-align:center;
    font-size:12.5px;
    margin:0 0 22px;
    min-height:16px;
    transition:color .2s ease;
}

.photo-feedback.is-success{
    color:#059669;
}

.photo-feedback.is-error{
    color:var(--danger);
    font-weight:600;
}

/* FORM GROUP + LABEL */
.form-group{
    margin-bottom:16px;
}

label{
    font-size:13px;
    font-weight:600;
    color:var(--text);
    display:block;
    margin-bottom:6px;
}

/* INPUT WRAP — only wraps the input/textarea, keeps icon aligned to it, not the label */
.input-wrap{
    position:relative;
}

.input-wrap .icon-chip{
    position:absolute;
    left:8px;
    top:8px;
    width:28px;
    height:28px;
    border-radius:9px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    pointer-events:none;
    transition:.2s;
}

.input-wrap .icon-chip.top-align{
    top:10px;
}

.input-wrap input,
.input-wrap textarea{
    padding-left:46px;
}

/* per-field icon colors */
.icon-name    { background:#e0e7ff; color:#4f46e5; }
.icon-email   { background:#fce7f3; color:#db2777; }
.icon-phone   { background:#dcfce7; color:#16a34a; }
.icon-address { background:#fef3c7; color:#d97706; }

.form-group:focus-within .icon-chip{
    transform:scale(1.08);
    box-shadow:0 2px 8px rgba(0,0,0,.12);
}

input, textarea{
    width:100%;
    padding:12px 14px;
    border:1.5px solid var(--border);
    border-radius:12px;
    outline:none;
    font-size:14px;
    color:var(--dark);
    transition:.25s;
    background:#fff;
    font-family:inherit;
}

textarea{
    resize:vertical;
    min-height:80px;
}

input::placeholder, textarea::placeholder{
    color:#b0b5bd;
}

input:hover, textarea:hover{
    border-color:#d1d5db;
}

input:focus, textarea:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 4px rgba(37,99,235,0.12);
}

button{
    font-family:inherit;
}

/* SAVE BUTTON */
.update-btn{
    width:100%;
    padding:13px;
    border:none;
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));
    color:white;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    font-size:15px;
    margin-top:6px;
    box-shadow:0 8px 18px rgba(37,99,235,0.25);
    transition:.25s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}

.update-btn i{
    font-size:14px;
}

.update-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(37,99,235,0.3);
}

.update-btn:active{
    transform:translateY(0);
}

/* DANGER ZONE */
.danger-zone{
    margin-top:32px;
    padding-top:22px;
    border-top:1px dashed var(--border);
}

.danger-zone-label{
    font-size:12px;
    font-weight:700;
    letter-spacing:.06em;
    text-transform:uppercase;
    color:#b91c1c;
    margin-bottom:12px;
    display:flex;
    align-items:center;
    gap:8px;
}

.danger-zone-label i{
    background:#fef3c7;
    color:#d97706;
    width:20px;
    height:20px;
    border-radius:6px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:11px;
}

/* LOGOUT BUTTON */
.logout-btn{
    width:100%;
    padding:12px;
    border:1.5px solid var(--border);
    border-radius:12px;
    text-align:center;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    background:#fff;
    color:var(--text);
    font-size:14.5px;
    font-weight:600;
    cursor:pointer;
    transition:.25s;
    margin-top:22px;
}

.logout-btn i{
    color:#6b7280;
    font-size:14px;
}

.logout-btn:hover{
    background:#f9fafb;
    border-color:#d1d5db;
    transform:translateY(-1px);
}

.logout-btn:active{
    transform:scale(0.98);
}

/* DELETE BUTTON */
.delete-btn{
    width:100%;
    padding:12px;
    border:1.5px solid #fecaca;
    border-radius:12px;
    background:#fff;
    color:var(--danger);
    font-weight:600;
    font-size:14.5px;
    cursor:pointer;
    transition:.25s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}

.delete-btn i{
    color:var(--danger);
    font-size:14px;
}

.delete-btn:hover{
    background:#fef2f2;
    border-color:var(--danger);
    color:var(--danger-dark);
}

.delete-btn:active{
    transform:scale(0.98);
}

/* SUCCESS MESSAGE */
.success-box{
    background:#ecfdf5;
    color:#059669;
    border:1px solid #a7f3d0;
    padding:12px 15px;
    border-radius:12px;
    margin-bottom:18px;
    font-size:14px;
    text-align:center;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    animation:fadeIn 0.4s ease;
}

.success-box i{
    background:#059669;
    color:#fff;
    width:20px;
    height:20px;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:11px;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(-10px);}
    to{opacity:1; transform:translateY(0);}
}

/* RESPONSIVE */
@media(max-width:600px){
    .container{
        margin:30px 16px;
        padding:28px 22px;
    }
}

/*==================================================
            DARK MODE
==================================================*/

body.dark{
    background:
        radial-gradient(circle at top left,#1e2545,transparent 50%),
        radial-gradient(circle at bottom right,#152238,transparent 50%),
        #0f172a;
    color:#f1f5f9;
}

body.dark .container{
    background:rgba(30,41,59,.9);
    border-color:#334155;
    box-shadow:
        0 10px 25px rgba(0,0,0,.35),
        0 25px 60px rgba(0,0,0,.25);
}

body.dark h2{
    color:#f8fafc;
}

body.dark .subtitle{
    color:#94a3b8;
}

body.dark label{
    color:#e2e8f0;
}

/* Inputs */
body.dark input,
body.dark textarea{
    background:#0f172a;
    border-color:#334155;
    color:#f1f5f9;
}

body.dark input::placeholder,
body.dark textarea::placeholder{
    color:#64748b;
}

body.dark input:hover,
body.dark textarea:hover{
    border-color:#475569;
}

body.dark input:focus,
body.dark textarea:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 4px rgba(37,99,235,0.25);
}

/* Icon chips */
body.dark .icon-name    { background:rgba(79,70,229,.22); color:#a5b4fc; }
body.dark .icon-email   { background:rgba(219,39,119,.2); color:#f9a8d4; }
body.dark .icon-phone   { background:rgba(22,163,74,.2);  color:#86efac; }
body.dark .icon-address { background:rgba(217,119,6,.2);  color:#fcd34d; }

/* Profile image */
body.dark .profile-img{
    border-color:#1e293b;
    box-shadow:
        0 0 0 3px var(--primary),
        0 10px 20px rgba(0,0,0,.4);
}

body.dark .profile-img-edit{
    border-color:#1e293b;
}

body.dark .photo-feedback.is-success{
    color:#6ee7b7;
}

body.dark .photo-feedback.is-error{
    color:#fca5a5;
}

/* Danger zone */
body.dark .danger-zone{
    border-top-color:#334155;
}

body.dark .danger-zone-label{
    color:#fca5a5;
}

body.dark .danger-zone-label i{
    background:rgba(217,119,6,.2);
    color:#fcd34d;
}

/* Logout button */
body.dark .logout-btn{
    background:#0f172a;
    border-color:#334155;
    color:#e2e8f0;
}

body.dark .logout-btn i{
    color:#94a3b8;
}

body.dark .logout-btn:hover{
    background:#1e293b;
    border-color:#475569;
}

/* Delete button */
body.dark .delete-btn{
    background:#0f172a;
    border-color:rgba(239,68,68,.4);
    color:#fca5a5;
}

body.dark .delete-btn i{
    color:#fca5a5;
}

body.dark .delete-btn:hover{
    background:rgba(239,68,68,.12);
    border-color:var(--danger);
    color:#fecaca;
}

/* Success box */
body.dark .success-box{
    background:rgba(5,150,105,.15);
    color:#6ee7b7;
    border-color:rgba(5,150,105,.35);
}

body.dark .success-box i{
    background:#059669;
    color:#fff;
}

/* MY COMMUNITIES */
.communities-section{
    margin-top:26px;
    padding-top:22px;
    border-top:1px dashed var(--border);
}

.section-title{
    font-size:15px;
    font-weight:700;
    color:var(--dark);
    display:flex;
    align-items:center;
    gap:8px;
    margin:0 0 14px;
}

.section-title i{
    color:var(--primary);
    font-size:13px;
}

.community-list{
    display:flex;
    flex-direction:column;
    gap:10px;
}

.community-chip{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 14px;
    background:#f8fafc;
    border:1.5px solid var(--border);
    border-radius:12px;
    transition:.2s;
}

.community-chip:hover{
    border-color:#d1d5db;
    background:#f1f5f9;
}

.community-chip-info{
    display:flex;
    flex-direction:column;
    gap:2px;
}

.community-chip-name{
    font-size:14px;
    font-weight:600;
    color:var(--dark);
}

.community-chip-location{
    font-size:12px;
    color:var(--muted);
    display:flex;
    align-items:center;
    gap:5px;
}

.leave-chip-btn{
    width:28px;
    height:28px;
    border-radius:50%;
    border:1.5px solid #fecaca;
    background:#fff;
    color:var(--danger);
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    font-size:12px;
    transition:.2s;
}

.leave-chip-btn:hover{
    background:#fef2f2;
    border-color:var(--danger);
    color:var(--danger-dark);
}

.no-community-text{
    font-size:13.5px;
    color:var(--muted);
    text-align:center;
    margin:0;
}

.no-community-text a{
    color:var(--primary);
    font-weight:600;
    text-decoration:none;
}

.no-community-text a:hover{
    text-decoration:underline;
}

/* Dark mode */
body.dark .communities-section{
    border-top-color:#334155;
}

body.dark .section-title{
    color:#f8fafc;
}

body.dark .community-chip{
    background:#0f172a;
    border-color:#334155;
}

body.dark .community-chip:hover{
    background:#1e293b;
    border-color:#475569;
}

body.dark .community-chip-name{
    color:#f1f5f9;
}

body.dark .community-chip-location{
    color:#94a3b8;
}

body.dark .leave-chip-btn{
    background:#0f172a;
    border-color:rgba(239,68,68,.4);
    color:#fca5a5;
}

body.dark .leave-chip-btn:hover{
    background:rgba(239,68,68,.12);
    border-color:var(--danger);
    color:#fecaca;
}

body.dark .no-community-text{
    color:#94a3b8;
}

body.dark .no-community-text a{
    color:#93c5fd;
}

.community-chip-link{
    flex:1;
    text-decoration:none;
    color:inherit;
    display:block;
}

.community-chip-name{
    font-size:14px;
    font-weight:600;
    color:var(--dark);
    display:flex;
    align-items:center;
    gap:6px;
}

.community-chip-arrow{
    font-size:10px;
    color:var(--primary);
    opacity:0;
    transform:translateX(-4px);
    transition:.2s;
}

.community-chip:hover .community-chip-arrow{
    opacity:1;
    transform:translateX(0);
}

.community-chip:hover .community-chip-name{
    color:var(--primary);
}

/* Dark mode */
body.dark .community-chip:hover .community-chip-name{
    color:#93c5fd;
}
</style>
</head>
<body>

@include('nav')

<div class="container">

    <h2>Manage Profile</h2>
    <p class="subtitle">Update your personal details and account settings.</p>

    @if(session('success'))
    <div class="success-box">
        <i class="fa-solid fa-check"></i> {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="/profile/update" enctype="multipart/form-data">
        @csrf

        <div class="profile-img-wrap" id="photoDropZone">
            <img src="{{ asset('uploads/'.$user->photo) }}" class="profile-img" id="photoPreview">
            <div class="profile-img-veil">Click to<br>change</div>
            <div class="profile-img-spinner" id="photoSpinner"><i class="fa-solid fa-spinner"></i></div>
            <label class="profile-img-edit">
                <i class="fa-solid fa-camera"></i>
                <input type="file" name="photo" id="photoInput" accept="image/png,image/jpeg,image/jpg,image/webp">
            </label>
        </div>
        <p class="photo-feedback" id="photoFeedback"></p>

        <div class="form-group">
            <label>Name</label>
            <div class="input-wrap">
                <span class="icon-chip icon-name"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="fullname" value="{{ $user->fullname }}" placeholder="Your full name">
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <div class="input-wrap">
                <span class="icon-chip icon-email"><i class="fa-solid fa-envelope"></i></span>
                <input type="email" name="email" value="{{ $user->email }}" placeholder="you@example.com">
            </div>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <div class="input-wrap">
                <span class="icon-chip icon-phone"><i class="fa-solid fa-phone"></i></span>
                <input type="text" name="phone" value="{{ $user->phone }}" placeholder="03XX XXXXXXX">
            </div>
        </div>

        <div class="form-group">
            <label>Address</label>
            <div class="input-wrap">
                <span class="icon-chip icon-address top-align"><i class="fa-solid fa-location-dot"></i></span>
                <textarea name="address" placeholder="Your address">{{ $user->address }}</textarea>
            </div>
        </div>

        <button type="submit" class="update-btn">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    </form>

    <div class="communities-section">
        <h3 class="section-title">
            <i class="fa-solid fa-users"></i> My Communities
        </h3>

        @if($myCommunities->count())
    <div class="community-list">
        @foreach($myCommunities as $community)
            <div class="community-chip">
                <a href="{{ route('items.all', ['community' => $community->id]) }}" class="community-chip-link">
                    <div class="community-chip-info">
                        <span class="community-chip-name">
                            {{ $community->name }}
                            <i class="fa-solid fa-arrow-right community-chip-arrow"></i>
                        </span>
                        <span class="community-chip-location">
                            <i class="fa-solid fa-location-dot"></i> {{ $community->location }}
                        </span>
                    </div>
                </a>
                <form method="POST" action="{{ route('communities.leave', $community->id) }}"
                      onsubmit="return confirm('Leave {{ $community->name }}?');">
                    @csrf
                    <button type="submit" class="leave-chip-btn" title="Leave community">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@else
    <p class="no-community-text">
        You haven't joined any communities yet.
        <a href="{{ route('communities') }}">Browse communities</a>
    </p>
@endif
    </div>

    <br>
    <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </button>
    </form>
    <div class="danger-zone">
        <div class="danger-zone-label">
            <i class="fa-solid fa-triangle-exclamation"></i> Danger Zone
        </div>

        <form method="POST" action="/profile/delete" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            @csrf
            <button type="submit" class="delete-btn">
                <i class="fa-solid fa-trash"></i> Delete Account
            </button>
        </form>
    </div>

</div>

@include("footer")
<script>
setTimeout(() => {
    const box = document.querySelector('.success-box');
    if(box) box.style.display = 'none';
}, 3000);

/* ===========================
   LIVE PHOTO PREVIEW
   - validates type & size before previewing
   - shows a brief spinner while the file is read
   - fades the old image out / new image in instead of an instant swap
   - clicking anywhere on the avatar (not just the small badge) opens the picker
   - drag & drop a file onto the avatar works too
   - shows the chosen filename, or a clear error, under the avatar
=========================== */
(function(){
    const photoInput    = document.getElementById('photoInput');
    const photoPreview   = document.getElementById('photoPreview');
    const photoSpinner   = document.getElementById('photoSpinner');
    const photoFeedback  = document.getElementById('photoFeedback');
    const photoDropZone  = document.getElementById('photoDropZone');

    if (!photoInput || !photoPreview) return;

    const MAX_PHOTO_BYTES = 5 * 1024 * 1024; // 5MB
    const ALLOWED_TYPES = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
    let currentObjectUrl = null;

    function setFeedback(message, type){
        photoFeedback.textContent = message || '';
        photoFeedback.classList.remove('is-success', 'is-error');
        if (type) photoFeedback.classList.add(type);
    }

    function handleFile(file){
        if (!file) return;

        if (!ALLOWED_TYPES.includes(file.type)) {
            setFeedback('Please choose a PNG, JPG, or WEBP image.', 'is-error');
            photoInput.value = '';
            return;
        }

        if (file.size > MAX_PHOTO_BYTES) {
            setFeedback('Image must be 5MB or smaller.', 'is-error');
            photoInput.value = '';
            return;
        }

        photoSpinner.classList.add('active');

        if (currentObjectUrl) URL.revokeObjectURL(currentObjectUrl);
        currentObjectUrl = URL.createObjectURL(file);

        const nextImg = new Image();
        nextImg.onload = function(){
            photoPreview.classList.add('img-fading');
            setTimeout(() => {
                photoPreview.src = currentObjectUrl;
                photoPreview.classList.remove('img-fading');
                photoSpinner.classList.remove('active');
                setFeedback(file.name, 'is-success');
            }, 180);
        };
        nextImg.onerror = function(){
            photoSpinner.classList.remove('active');
            setFeedback('That file could not be read as an image.', 'is-error');
            photoInput.value = '';
        };
        nextImg.src = currentObjectUrl;
    }

    photoInput.addEventListener('change', function(e){
        handleFile(e.target.files[0]);
    });

    // whole avatar is clickable, not just the small camera badge
    photoDropZone.addEventListener('click', function(e){
        if (e.target.closest('.profile-img-edit')) return; // avoid double-trigger
        photoInput.click();
    });

    // drag & drop support
    photoDropZone.addEventListener('dragover', function(e){
        e.preventDefault();
        photoDropZone.style.opacity = '.85';
    });
    photoDropZone.addEventListener('dragleave', function(){
        photoDropZone.style.opacity = '1';
    });
    photoDropZone.addEventListener('drop', function(e){
        e.preventDefault();
        photoDropZone.style.opacity = '1';
        const file = e.dataTransfer.files[0];
        if (file) {
            photoInput.files = e.dataTransfer.files;
            handleFile(file);
        }
    });
})();

const toggle = document.getElementById('themeToggle');
if (toggle) {
    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        toggle.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
    });
}
</script>

<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>

</body>
</html>