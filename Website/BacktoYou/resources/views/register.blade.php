<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Register</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="{{ asset('css/Register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Mono:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

@include('nav')

<div class="container">

<form action="{{ url('/register') }}"
      method="POST"
      enctype="multipart/form-data"
      class="register-form"
      id="registerForm"
      novalidate>

    @csrf

    <div style="position:absolute;left:-9999px;top:-9999px;" aria-hidden="true">
        <label for="website">Leave this field empty</label>
        <input type="text"
               name="website"
               id="website"
               tabindex="-1"
               autocomplete="off">
    </div>

    <!-- TICKET HEADER -->
    <div class="ticket-head">

        <div class="stamp-seal">
            <img src="{{ asset('img/Logo.jpeg') }}" alt="BackToYou">
        </div>

        <div class="eyebrow">Claim Intake &middot; New Registry Profile</div>

        <h2>Create Your Account</h2>

        <p class="form-subtitle">
            A verified profile helps us match lost items with their owners faster.
        </p>

    </div>

    <div class="ticket-body">

        @if($errors->any())
            <div class="alert-danger" style="margin:0 0 26px;">
                <i class="fa-solid fa-circle-exclamation"></i>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        <!-- 01 IDENTITY -->

        <div class="reg-tag">
            <span class="reg-tag__num">01</span>
            <span class="reg-tag__text">Identity</span>
        </div>

        <div class="input-group">

            <label for="fullname">
                Full Name
            </label>

            <div class="input-wrap">

                <span class="icon-chip icon-name">
                    <i class="fa-solid fa-user"></i>
                </span>

                <input
                    type="text"
                    name="fullname"
                    id="fullname"
                    value="{{ old('fullname') }}"
                    placeholder="Your full name"
                    required>

            </div>

        </div>

        <!-- 02 CONTACT -->

        <div class="reg-tag">
            <span class="reg-tag__num">02</span>
            <span class="reg-tag__text">Contact</span>
        </div>

        <div class="input-group">

            <label for="email">
                Email Address
            </label>

            <div class="input-wrap">

                <span class="icon-chip icon-email">
                    <i class="fa-solid fa-envelope"></i>
                </span>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="you@example.com"
                    required>

            </div>

        </div>

        <!-- PHONE -->

        <div class="input-group">

            <label for="phone">
                Phone Number
            </label>

            <div class="input-wrap">

                <span class="icon-chip icon-phone">
                    <i class="fa-solid fa-phone"></i>
                </span>

                <input
                    type="tel"
                    name="phone"
                    id="phone"
                    value="{{ old('phone') }}"
                    placeholder="03XXXXXXXXX"
                    pattern="[0-9]{11}"
                    required>

            </div>

        </div>

        <!-- 03 ADDRESS -->

        <div class="reg-tag">
            <span class="reg-tag__num">03</span>
            <span class="reg-tag__text">Address</span>
        </div>

        <div class="input-group">

            <label for="address">
                Address
            </label>

            <div class="input-wrap top-align">

                <span class="icon-chip icon-address top-align">
                    <i class="fa-solid fa-location-dot"></i>
                </span>

                <textarea
                    name="address"
                    id="address"
                    rows="3"
                    required>{{ old('address') }}</textarea>

            </div>

        </div>

        <!-- 04 NATIONAL ID -->

        <div class="reg-tag">
            <span class="reg-tag__num">04</span>
            <span class="reg-tag__text">National ID Card</span>
        </div>

        <div class="input-group">

            <label for="cnic">
                CNIC Number
            </label>

            <div class="input-wrap">

                <span class="icon-chip icon-cnic">
                    <i class="fa-solid fa-id-card"></i>
                </span>

                <input
                    type="text"
                    name="cnic"
                    id="cnic"
                    value="{{ old('cnic') }}"
                    placeholder="42101-1234567-1"
                    pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}"
                    required>

            </div>

            <div id="cnicCheckMsg"
                 class="cnic-check-msg"
                 style="font-size:.8rem;margin-top:5px;"></div>

        </div>

        <!-- 05 PROFILE PHOTO -->

        <div class="reg-tag">
            <span class="reg-tag__num">05</span>
            <span class="reg-tag__text">Profile Photo</span>
        </div>

        <div class="input-group">

            <div class="photo-upload">

                <img src="{{ asset('img/community-placeholder.jpg') }}"
                     id="photoPreview"
                     class="photo-preview-circle">

                <div class="photo-upload-text">

                    <strong>
                        Upload Profile Photo
                    </strong>

                    <span>
                        JPG / PNG up to 5MB
                    </span>

                </div>

                <label class="photo-browse-btn">

                    Browse

                    <input
                        type="file"
                        name="photo"
                        id="photoInput"
                        accept="image/*"
                        required>

                </label>

            </div>

        </div>

        <!-- 06 SECURITY -->

        <div class="reg-tag">
            <span class="reg-tag__num">06</span>
            <span class="reg-tag__text">Security</span>
        </div>

        <div class="input-group">

            <label>Password</label>

            <div class="input-wrap password-wrap">

                <span class="icon-chip icon-lock">
                    <i class="fa-solid fa-lock"></i>
                </span>

                <input
                    type="password"
                    name="password"
                    id="password"
                    required>

                <button
                    type="button"
                    class="toggle-pass"
                    data-target="password">

                    <i class="fa-solid fa-eye"></i>

                </button>

            </div>

            <div class="pass-strength">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div id="strengthLabel">
                Password strength
            </div>

        </div>

        <div class="input-group">

            <label>Confirm Password</label>

            <div class="input-wrap password-wrap">

                <span class="icon-chip icon-lock2">
                    <i class="fa-solid fa-lock"></i>
                </span>

                <input
                    type="password"
                    name="confirm_password"
                    id="confirmPassword"
                    required>

                <button
                    type="button"
                    class="toggle-pass"
                    data-target="confirmPassword">

                    <i class="fa-solid fa-eye"></i>

                </button>

            </div>

        </div>

        <div class="input-group">

            <div class="g-recaptcha"
                 data-sitekey="{{ config('services.recaptcha.site_key') }}">
            </div>

        </div>

        <button type="submit" id="submitBtn">

            <i class="fa-solid fa-stamp"></i>

            Submit Registration

        </button>

        <p class="login-link">

            Already have an account?

            <a href="{{ url('/login') }}">
                Log in
            </a>

        </p>

    </div>

</form>

</div>

@include('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.1/jquery.validate.min.js"></script>

<script>
    // ================================
    // PASSWORD SHOW / HIDE
    // ================================

    document.querySelectorAll('.toggle-pass').forEach(btn => {

        btn.addEventListener('click', function () {

            const target = document.getElementById(this.dataset.target);

            const icon = this.querySelector('i');

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


    // ================================
    // PASSWORD STRENGTH
    // ================================

    const passwordInput = document.getElementById('password');

    const strengthBars = document.querySelectorAll('.pass-strength span');

    const strengthLabel = document.getElementById('strengthLabel');

    if (passwordInput) {

        passwordInput.addEventListener('input', function () {

            let value = this.value;

            let score = 0;

            if (value.length >= 8) score++;

            if (/[A-Z]/.test(value)) score++;

            if (/[0-9]/.test(value)) score++;

            if (/[^A-Za-z0-9]/.test(value)) score++;

            const colors = [
                "#DC2626",
                "#38BDF8",
                "#2563EB",
                "#2563EB"
            ];

            const labels = [
                "Weak",
                "Fair",
                "Good",
                "Strong"
            ];

            strengthBars.forEach(function(bar,index){

                if(index < score){

                    bar.style.background = colors[Math.max(score-1,0)];

                }else{

                    bar.style.background = "";

                }

            });

            if(value.length==0){

                strengthLabel.innerHTML="Password strength";

            }else{

                strengthLabel.innerHTML=labels[Math.max(score-1,0)];

            }

        });

    }



    // ================================
    // PROFILE PHOTO PREVIEW
    // ================================

    const photoInput=document.getElementById("photoInput");

    const photoPreview=document.getElementById("photoPreview");

    if(photoInput){

    photoInput.addEventListener("change",function(e){

    const file=e.target.files[0];

    if(file){

    photoPreview.src=URL.createObjectURL(file);

    }

    });

    }

    // ================================
    // JQUERY START
    // ================================

    $(function(){


    // Phone Validation

    $.validator.addMethod(

    "phoneFormat",

    function(value){

    return /^[0-9]{11}$/.test(value);

    },

    "Phone number must be 11 digits."

    );


    // CNIC Validation

    $.validator.addMethod(

    "cnicFormat",

    function(value){

    return /^[0-9]{5}-[0-9]{7}-[0-9]{1}$/.test(value);

    },

    "Enter valid CNIC."

    );


    // Strong Password

    $.validator.addMethod(

    "strongPassword",

    function(value){

    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/.test(value);

    },

    "Password is too weak."

    );


    // Photo Validation

    $.validator.addMethod(

    "photoFile",

    function(value,element){

    if(element.files.length==0)

    return false;

    const file=element.files[0];

    const types=[

    'image/jpeg',

    'image/jpg',

    'image/png'

    ];

    return types.includes(file.type)

    &&

    file.size<=5*1024*1024;

    },

    "Upload JPG/PNG under 5MB."

    );


    // CNIC AJAX CHECK

    $("#cnic").on("blur",function(){

    let cnic=$(this).val();

    if(cnic=="") return;

    $.ajax({

    url:"{{ url('/check-cnic') }}",

    type:"POST",

    data:{

    cnic:cnic,

    _token:"{{ csrf_token() }}"

    },

    success:function(res){

    if(res.exists){

    $("#cnicCheckMsg")

    .text("CNIC already registered.")

    .css("color","#DC2626");

    }else{

    $("#cnicCheckMsg")

    .text("CNIC available.")

    .css("color","#2563EB");

    }

    }

    });

    });


    // ================================
    // FORM VALIDATION
    // ================================

    $("#registerForm").validate({

        rules: {

            fullname: {
                required: true,
                minlength: 3
            },

            email: {
                required: true,
                email: true
            },

            phone: {
                required: true,
                phoneFormat: true
            },

            cnic: {
                required: true,
                cnicFormat: true
            },

            address: {
                required: true,
                minlength: 5
            },

            photo: {
                required: true,
                photoFile: true
            },

            password: {
                required: true,
                strongPassword: true
            },

            confirm_password: {
                required: true,
                equalTo: "#password"
            }

        },

        errorElement: "label",

        errorPlacement: function (error, element) {

            error.insertAfter(element.closest(".input-wrap"));

        },

        highlight: function (element) {

            $(element)
                .closest(".input-wrap")
                .addClass("field-error");

        },

        unhighlight: function (element) {

            $(element)
                .closest(".input-wrap")
                .removeClass("field-error");

        },

        submitHandler: function (form) {

            form.submit();

        }

    });

    }); // END $(function())
</script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>