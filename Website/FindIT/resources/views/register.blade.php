<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT | Register</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
 
    @include('nav') 

    
    <div class="container">
    <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data" class="register-form">
    @csrf
@if ($errors->any()) <div class="alert alert-danger"> <ul>
@foreach ($errors->all() as $error) <li>{{ $error }}</li>
@endforeach </ul> </div>
@endif
<div class="login-logo">
        <img src="{{ asset('img/Logo.jpeg') }}" alt="FindIT Logo">
    </div>
<h2>Create Account</h2>


    <div class="input-group">
        <label>Full Name</label>
        <input type="text" name="fullname" required>
    </div>

    <div class="input-group">
        <label>Email Address</label>
        <input type="email" name="email" required>
    </div>

    <div class="input-group">
        <label>Phone Number</label>
        <input type="tel"
               name="phone"
               pattern="[0-9]{11}"
               placeholder="03XXXXXXXXX"
               required>
    </div>

    <div class="input-group">
        <label>CNIC Number</label>
        <input type="text"
               name="cnic"
               pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}"
               placeholder="42101-1234567-1"
               required>
    </div>

    <div class="input-group">
        <label>Address</label>
        <textarea name="address" rows="3" required></textarea>
    </div>

    <div class="input-group">
        <label>Profile Photo</label>
        <input type="file"
               name="photo"
               accept="image/*"
               required>
    </div>

    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>
    </div>

    <div class="input-group">
    <label>Register As</label>
    <select name="role" id="role" required onchange="toggleCommunityFields()">
        <option value="">Select Role</option>
        <option value="member">Member</option>
        <option value="leader">Community Leader</option>
    </select>
</div>

<!-- Member Section -->
<div id="memberFields" style="display:none;">

    <div class="input-group">
        <label>Select Community</label>
        <select name="community">
            <option value="">Choose Community</option>
            <option value="Iqra University">Iqra University</option>
            <option value="FAST University">FAST University</option>
            <option value="NED University">NED University</option>
            <option value="LuckyOne Mall">LuckyOne Mall</option>
            <option value="Dolmen Mall">Dolmen Mall</option>
            <option value="Other">Other</option>
        </select>
    </div>

</div>

<!-- Community Leader Section -->
<div id="leaderFields" style="display:none;">

    <div class="input-group">
        <label>Community Name</label>
        <input type="text" name="community_name">
    </div>

    <div class="input-group">
        <label>Community Type</label>
        <select name="community_type">
            <option value="">Select Type</option>
            <option value="University">University</option>
            <option value="College">College</option>
            <option value="School">School</option>
            <option value="Mall">Mall</option>
            <option value="Office">Office</option>
            <option value="Residential Society">Residential Society</option>
            <option value="Other">Other</option>
        </select>
    </div>

    <div class="input-group">
        <label>Community Address</label>
        <textarea name="community_address"></textarea>
    </div>

    <div class="input-group">
        <label>Leader Designation</label>
        <input type="text" name="designation" placeholder="Manager, Admin, Student Affairs Officer">
    </div>

</div>

    <button type="submit">Register</button>
</form>
</div>


@include('footer')
<script>
function toggleCommunityFields() {

    const role = document.getElementById('role').value;

    document.getElementById('memberFields').style.display =
        role === 'member' ? 'block' : 'none';

    document.getElementById('leaderFields').style.display =
        role === 'leader' ? 'block' : 'none';
}
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