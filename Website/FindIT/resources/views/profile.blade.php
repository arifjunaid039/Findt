<!DOCTYPE html>
<html>
<head>
    <title> FindIT | Manage Profile</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <style>
body{
    margin:0;
    font-family:'Segoe UI', system-ui, sans-serif;
    background: linear-gradient(135deg,#eef2ff,#f8fafc);
}

/* MAIN CARD */
.container{
    max-width:520px;
    margin:70px auto;
    background:rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    padding:35px;
    border-radius:20px;
    box-shadow:0 20px 50px rgba(0,0,0,0.10);
    border:1px solid rgba(0,0,0,0.05);
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:25px;
    font-size:26px;
    color:#111827;
}

/* PROFILE IMAGE */
.profile-img{
    display:block;
    margin:0 auto 15px;
    width:100px;
    height:100px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #2563eb;
    box-shadow:0 10px 20px rgba(37,99,235,0.2);
}

/* INPUT FIELDS */
.form-group{
    margin-bottom:14px;
}

input, textarea{
    width:100%;
    padding:12px 14px;
    border:1px solid #e5e7eb;
    border-radius:10px;
    outline:none;
    font-size:14px;
    transition:0.3s;
    background:#fff;
}

input:focus, textarea:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

/* SAVE BUTTON */
button{
    width:100%;
    padding:12px;
    border:none;
    background:linear-gradient(90deg,#2563eb,#1d4ed8);
    color:white;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

button:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(37,99,235,0.25);
}

/* LOGOUT BUTTON */
.logout-btn{
    width:100%;
    margin-top:10px;
    padding:12px;
    border:none;
    background:#ef4444;
    color:white;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

.logout-btn:hover{
    background:#dc2626;
}

/* LABEL STYLE (optional) */
label{
    font-size:13px;
    color:#374151;
    display:block;
    margin-bottom:6px;
}

.success-box{
    background:#22c55e;
    color:white;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:15px;
    font-size:14px;
    text-align:center;
    box-shadow:0 10px 20px rgba(34,197,94,0.2);
    animation:fadeIn 0.4s ease;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(-10px);}
    to{opacity:1; transform:translateY(0);}
}

.delete-btn{
    background:#111827;
    color:#fff;
    width:100%;
    margin-top:10px;
    padding:12px;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.delete-btn:hover{
    background:#000;
    transform:translateY(-2px);
}
</style>
</head>
<body>

<div class="container">

    <h2>Manage Profile</h2>

    <img src="{{ asset('uploads/'.$user->photo) }}" class="profile-img">

    @if(session('success'))
    <div class="success-box">
        {{ session('success') }}
    </div>
@endif

    <form method="POST" action="/profile/update" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="fullname" value="{{ $user->fullname }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $user->phone }}">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address">{{ $user->address }}</textarea>
        </div>

        <div class="form-group">
            <label>Change Photo</label>
            <input type="file" name="photo">
        </div>

        <button type="submit">Update Profile</button>
    </form>

<form method="POST" action="/profile/delete" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
    @csrf

    <button type="submit" class="delete-btn">
        Delete Profile
    </button>
</form>
    <!-- LOGOUT -->
    <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>

</div>

<script>
setTimeout(() => {
    const box = document.querySelector('.success-box');
    if(box) box.style.display = 'none';
}, 3000);
</script>

</body>
</html>