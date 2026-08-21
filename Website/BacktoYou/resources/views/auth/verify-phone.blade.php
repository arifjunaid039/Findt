<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackToYou | Verify Phone</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f9fafb;
        }
        .otp-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .otp-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
            padding: 2.5rem;
            max-width: 420px;
            width: 100%;
            text-align: center;
        }
        .otp-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(37,99,235,0.1);
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin: 0 auto 1.25rem;
        }
        .otp-card h3 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: #111827;
        }
        .otp-card p.subtitle {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .otp-inputs {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-bottom: 1.25rem;
        }
        .otp-inputs input {
            width: 48px;
            height: 56px;
            text-align: center;
            font-size: 1.4rem;
            font-weight: 600;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            transition: border-color 0.2s;
        }
        .otp-inputs input:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
        }
        .btn-verify {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-verify:hover { background: #1d4ed8; color: #fff; }
        .resend-link {
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #6b7280;
        }
        .resend-link button {
            background: none;
            border: none;
            color: #2563eb;
            font-weight: 600;
            padding: 0;
        }
        .dev-otp-box {
            margin-top: 1rem;
            padding: 0.75rem 1rem;
            background: #eff6ff;
            border: 1.5px dashed #2563eb;
            border-radius: 10px;
            font-size: 0.85rem;
            color: #1d4ed8;
        }
        .dev-otp-box strong {
            font-size: 1.1rem;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>

@include('nav')

<div class="otp-wrapper">
    <div class="otp-card">
        <div class="otp-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
        <h3>Verify Your Phone</h3>
        <p class="subtitle">We've sent a 6-digit code to <strong>{{ $phone }}</strong></p>

        @if(session('success'))
            <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger py-2">{{ session('error') }}</div>
        @endif
        @if(session('dev_otp'))
            <div class="dev-otp-box">
                <i class="fa-solid fa-circle-info"></i> Dev Mode &mdash; Your OTP: <strong>{{ session('dev_otp') }}</strong>
            </div>
        @endif

        <form action="{{ route('verify-phone.verify') }}" method="POST" id="otpForm">
            @csrf
            <div class="otp-inputs" id="otpInputs">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
                <input type="text" maxlength="1" inputmode="numeric" class="otp-box">
            </div>
            <input type="hidden" name="otp" id="otpFull">
            <button type="submit" class="btn-verify">Verify Code</button>
        </form>

        <div class="resend-link">
            Didn't receive code?
            <form action="{{ route('verify-phone.resend') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Resend OTP</button>
            </form>
        </div>
    </div>
</div>

@include('footer')

<script>
    const boxes = document.querySelectorAll('.otp-box');
    const fullInput = document.getElementById('otpFull');

    boxes.forEach((box, i) => {
        box.addEventListener('input', () => {
            box.value = box.value.replace(/[^0-9]/g, '');
            if (box.value && i < boxes.length - 1) boxes[i + 1].focus();
            updateFull();
        });
        box.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !box.value && i > 0) boxes[i - 1].focus();
        });
        box.addEventListener('paste', (e) => {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
            paste.split('').forEach((char, idx) => {
                if (boxes[idx]) boxes[idx].value = char;
            });
            updateFull();
            boxes[Math.min(paste.length, boxes.length - 1)].focus();
        });
    });

    function updateFull() {
        fullInput.value = Array.from(boxes).map(b => b.value).join('');
    }
</script>

</body>
</html>