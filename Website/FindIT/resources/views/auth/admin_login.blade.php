<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login · FindIT</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root{
    --bg:#0a0e17;
    --bg-soft:#111827;
    --card:rgba(255,255,255,0.05);
    --card-border:rgba(255,255,255,0.10);
    --text:#f4f7fb;
    --text-muted:#8b96a8;
    --blue:#38bdf8;
    --blue-soft:rgba(56,189,248,0.12);
    --blue-glow:rgba(56,189,248,0.35);
    --white:#ffffff;
    --danger:#f87171;
  }
  *{box-sizing:border-box}
  body{
    min-height:100vh;
    margin:0;
    display:flex;
    flex-direction:column;
    background:
      radial-gradient(900px 500px at 15% 10%, rgba(56,189,248,0.14), transparent),
      radial-gradient(700px 500px at 85% 90%, rgba(56,189,248,0.08), transparent),
      var(--bg);
    color:var(--text);
    font-family:'Plus Jakarta Sans', sans-serif;
  }

  .login-wrap{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 20px;
  }

  .login-card{
    width:100%;
    max-width:400px;
    background:var(--card);
    border:1px solid var(--card-border);
    border-radius:20px;
    backdrop-filter:blur(16px);
    padding:36px 32px;
    box-shadow:0 20px 60px rgba(0,0,0,0.5), 0 0 40px rgba(56,189,248,0.06);
  }

  .brand-icon{
    width:56px; height:56px;
    border-radius:14px;
    background:var(--blue-soft);
    border:1px solid rgba(56,189,248,0.25);
    display:flex; align-items:center; justify-content:center;
    margin:0 auto 16px;
    font-size:1.4rem;
    color:var(--blue);
    box-shadow:0 0 24px var(--blue-glow);
  }

  h3{
    font-family:'Syne', sans-serif;
    font-weight:700;
    text-align:center;
    margin-bottom:4px;
    color:var(--white);
  }
  .subtitle{
    text-align:center;
    color:var(--text-muted);
    font-size:.88rem;
    margin-bottom:26px;
  }

  label{
    font-size:.82rem;
    font-weight:600;
    color:var(--text-muted);
    margin-bottom:6px;
    display:block;
  }

  .input-wrap{ position:relative; }
  .input-wrap i{
    position:absolute; left:14px; top:50%; transform:translateY(-50%);
    color:var(--text-muted); font-size:.9rem;
    transition:.15s;
  }
  .input-wrap:focus-within i{ color:var(--blue); }

  .form-control{
    background:var(--bg-soft);
    border:1px solid var(--card-border);
    color:var(--white);
    padding:11px 14px 11px 40px;
    border-radius:10px;
  }
  .form-control:focus{
    background:var(--bg-soft);
    color:var(--white);
    border-color:var(--blue);
    box-shadow:0 0 0 .2rem rgba(56,189,248,.15);
  }
  ::placeholder{ color:var(--text-muted); opacity:.6; }

  .btn-blue{
    background:linear-gradient(135deg, var(--blue), #0ea5e9);
    border:none;
    color:#052033;
    font-weight:700;
    padding:11px;
    border-radius:10px;
    width:100%;
    margin-top:8px;
    transition:.15s;
    box-shadow:0 8px 24px rgba(56,189,248,0.25);
  }
  .btn-blue:hover{
    filter:brightness(1.08);
    color:#052033;
    box-shadow:0 8px 28px rgba(56,189,248,0.4);
  }

  .alert-danger{
    background:rgba(248,113,113,.12);
    border:1px solid rgba(248,113,113,.35);
    color:var(--danger);
    border-radius:10px;
    font-size:.88rem;
    padding:10px 14px;
  }

  .back-link{
    display:block;
    text-align:center;
    margin-top:20px;
    color:var(--text-muted);
    font-size:.85rem;
    text-decoration:none;
  }
  .back-link:hover{ color:var(--blue); }

  .divider{
    height:1px;
    background:var(--card-border);
    margin:22px 0;
  }
</style>
</head>
<body>

@include('nav')

<div class="login-wrap">
  <div class="login-card">
    <div class="brand-icon"><i class="fa-solid fa-shield-halved"></i></div>
    <h3>Admin Login</h3>
    <p class="subtitle">Sign in to manage FindIT</p>

    @if(session('error'))
      <div class="alert alert-danger mb-3">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
      @csrf

      <div class="mb-3">
        <label for="email">Email</label>
        <div class="input-wrap">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" id="email" name="email" class="form-control" placeholder="admin@findit.com" required autofocus>
        </div>
      </div>

      <div class="mb-3">
        <label for="password">Password</label>
        <div class="input-wrap">
          <i class="fa-solid fa-lock"></i>
          <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
      </div>

      <button class="btn-blue"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
    </form>

    <div class="divider"></div>

    <a href="{{ url('/') }}" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to FindIT</a>
  </div>
</div>

@include('footer')

</body>
</html>
