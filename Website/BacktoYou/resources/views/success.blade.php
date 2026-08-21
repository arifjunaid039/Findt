<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>

<meta http-equiv="refresh" content="3;url=/">
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body{
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:linear-gradient(135deg,#0f172a,#1e293b);
        padding:20px;
    }

    .success-card{
        background:white;
        padding:40px;
        border-radius:20px;
        text-align:center;
        width:100%;
        max-width:420px;
        box-shadow:0 20px 40px rgba(0,0,0,.25);
        animation:pop .5s ease;
    }

    @keyframes pop{
        from{
            transform:scale(.8);
            opacity:0;
        }
        to{
            transform:scale(1);
            opacity:1;
        }
    }

    .check{
        width:90px;
        height:90px;
        margin:auto;
        border-radius:50%;
        background:#22c55e;
        color:white;
        font-size:50px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:20px;
    }

    h1{
        color:#111827;
        margin-bottom:10px;
        font-size:1.5rem;
    }

    p{
        color:#6b7280;
        margin-bottom:20px;
    }

    .countdown{
        color:#2563eb;
        font-weight:bold;
    }

    @media (max-width:480px){
        .success-card{
            padding:30px 24px;
            border-radius:16px;
        }

        .check{
            width:72px;
            height:72px;
            font-size:38px;
            margin-bottom:16px;
        }

        h1{
            font-size:1.25rem;
        }

        p{
            font-size:.92rem;
            margin-bottom:16px;
        }
    }

    @media (max-width:360px){
        body{
            padding:14px;
        }

        .success-card{
            padding:24px 18px;
        }
    }
</style>

</head>
<body>

<div class="success-card">

<div class="check">✓</div>

<h1>Registration Successful</h1>

<p>
    Your account has been created successfully.
</p>

<p>
    Redirecting to Home Page in
    <span class="countdown" id="count">3</span>
    seconds...
</p>

</div>

<script>
let time = 3;

setInterval(() => {
    time--;
    if(time >= 0){
        document.getElementById('count').innerText = time;
    }
},1000);
</script>

</body>
</html>