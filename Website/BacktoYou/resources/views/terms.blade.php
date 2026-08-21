<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>BackToYou | Terms &amp; Conditions</title>

<link rel="icon" href="{{ asset('img/Logo.jpeg') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>

:root{
    --accent:#38bdf8;
    --accent-dark:#0ea5e9;
    --accent-soft:rgba(56,189,248,.12);
    --glass-bg:rgba(255,255,255,.65);
    --glass-border:rgba(255,255,255,.5);
    --text-main:#1e293b;
    --text-sub:#64748b;
    --page-bg-1:#fdf6ec;
    --page-bg-2:#eef2f9;
}

*{
    font-family:'Plus Jakarta Sans',sans-serif;
}

body{
    background:linear-gradient(135deg,var(--page-bg-1) 0%,var(--page-bg-2) 100%);
    min-height:100vh;
    color:var(--text-main);
    transition:background .3s ease,color .3s ease;
}

.wrap{
    width:95%;
    max-width:1000px;
    margin:50px auto;
}

.heading{
    font-family:'Syne',sans-serif;
    font-size:32px;
    font-weight:800;
    margin-bottom:0;
    display:flex;
    align-items:center;
    gap:12px;
}

.heading i{
    color:var(--accent);
}

.subtitle{
    color:var(--text-sub);
    font-size:14px;
    margin-top:4px;
    margin-bottom:8px;
}

.updated-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:var(--accent-soft);
    color:var(--accent-dark);
    padding:6px 14px;
    border-radius:20px;
    font-size:12.5px;
    font-weight:700;
    margin-bottom:26px;
}

.layout{
    display:flex;
    gap:22px;
    align-items:flex-start;
}

.toc{
    width:250px;
    flex-shrink:0;
    position:sticky;
    top:24px;
    background:var(--glass-bg);
    backdrop-filter:blur(20px);
    -webkit-backdrop-filter:blur(20px);
    border:1px solid var(--glass-border);
    border-radius:18px;
    padding:20px;
    box-shadow:0 8px 24px rgba(0,0,0,.05);
}

.toc h6{
    font-family:'Syne',sans-serif;
    font-weight:700;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:.5px;
    color:var(--text-sub);
    margin-bottom:12px;
}

.toc a{
    display:flex;
    align-items:center;
    gap:8px;
    color:var(--text-sub);
    text-decoration:none;
    font-size:13.5px;
    font-weight:600;
    padding:8px 10px;
    border-radius:10px;
    margin-bottom:2px;
    transition:.2s;
}

.toc a i{
    color:var(--accent);
    font-size:12px;
    width:14px;
}

.toc a:hover{
    background:var(--accent-soft);
    color:var(--accent-dark);
}

.content{
    flex:1;
    min-width:0;
}

.term-card{
    background:var(--glass-bg);
    backdrop-filter:blur(24px);
    -webkit-backdrop-filter:blur(24px);
    border:1px solid var(--glass-border);
    border-radius:20px;
    padding:26px 28px;
    margin-bottom:18px;
    box-shadow:0 12px 35px rgba(0,0,0,.06);
    transition:.3s ease;
    scroll-margin-top:24px;
}

.term-card:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 45px rgba(0,0,0,.09);
}

.term-icon{
    width:42px;
    height:42px;
    border-radius:12px;
    background:var(--accent-soft);
    color:var(--accent);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:17px;
    margin-bottom:14px;
}

.term-card h2{
    font-family:'Syne',sans-serif;
    font-size:19px;
    font-weight:700;
    margin-bottom:10px;
    color:var(--text-main);
}

.term-card p{
    color:var(--text-sub);
    font-size:14.5px;
    line-height:1.75;
    margin-bottom:10px;
}

.term-card p:last-child{
    margin-bottom:0;
}

.term-card ul{
    padding-left:18px;
    margin-bottom:0;
}

.term-card ul li{
    color:var(--text-sub);
    font-size:14.5px;
    line-height:1.75;
    margin-bottom:8px;
}

.term-card ul li:last-child{
    margin-bottom:0;
}

.term-card strong{
    color:var(--text-main);
}

.contact-card{
    background:linear-gradient(135deg, var(--accent-soft), transparent);
    border:1px solid var(--glass-border);
    border-radius:20px;
    padding:32px;
    text-align:center;
}

.contact-card .term-icon{
    width:54px;
    height:54px;
    border-radius:50%;
    background:var(--accent);
    color:#fff;
    margin:0 auto 14px;
    font-size:20px;
}

/* Dark mode */
body.dark{
    --glass-bg:rgba(30,41,59,.65);
    --glass-border:rgba(255,255,255,.08);
    --text-main:#f1f5f9;
    --text-sub:#94a3b8;
    --page-bg-1:#0f172a;
    --page-bg-2:#111c33;
}

@media(max-width:768px){
    .layout{flex-direction:column;}
    .toc{width:100%; position:static;}
}

@media(max-width:576px){
    .wrap{margin:28px auto;}
    .heading{font-size:26px;}
    .term-card{padding:20px;}
}

</style>

</head>

<body>

@include('nav')

<div class="wrap">

    <h1 class="heading">
        <i class="fa-solid fa-file-contract text-primary"></i>
        Terms &amp; Conditions
    </h1>
    <div class="subtitle">Please read these terms carefully before using BackToYou.</div>
    <div class="updated-badge text-primary">
        <i class="fa-solid fa-clock-rotate-left text-primary"></i>
        Last updated: July 20, 2026
    </div>

    <div class="layout">

        <div class="toc">
            <h6>On this page</h6>
            <a href="#acceptance"><i class="fa-solid fa-circle-check text-primary"></i> Acceptance of Terms</a>
            <a href="#accounts"><i class="fa-solid fa-user-shield text-primary"></i> User Accounts</a>
            <a href="#items"><i class="fa-solid fa-box-open text-primary"></i> Reporting &amp; Claiming</a>
            <a href="#conduct"><i class="fa-solid fa-triangle-exclamation text-primary"></i> Prohibited Conduct</a>
            <a href="#messaging"><i class="fa-solid fa-comments text-primary"></i> Messaging</a>
            <a href="#content"><i class="fa-solid fa-images text-primary"></i> Content Ownership</a>
            <a href="#liability"><i class="fa-solid fa-scale-balanced text-primary"></i> Liability</a>
            <a href="#termination"><i class="fa-solid fa-ban text-primary"></i> Termination</a>
            <a href="#changes"><i class="fa-solid fa-rotate text-primary"></i> Changes to Terms</a>
            <a href="#contact"><i class="fa-solid fa-envelope text-primary"></i> Contact Us</a>
        </div>

        <div class="content">

            <div class="term-card" id="acceptance">
                <div class="term-icon"><i class="fa-solid fa-circle-check text-primary"></i></div>
                <h2>1. Acceptance of Terms</h2>
                <p>By creating an account or using BackToYou in any way, you agree to be bound by these Terms &amp; Conditions and our Privacy Policy. If you do not agree with any part of these terms, please do not use the platform.</p>
                <p>BackToYou is intended for users located in Pakistan and is designed to help people report, search for, and reclaim lost belongings within their community.</p>
            </div>

            <div class="term-card" id="accounts">
                <div class="term-icon"><i class="fa-solid fa-user-shield text-primary"></i></div>
                <h2>2. User Accounts</h2>
                <ul>
                    <li>You must provide accurate, current, and complete information when creating your account.</li>
                    <li>You are responsible for maintaining the confidentiality of your login credentials and for all activity under your account.</li>
                    <li>You must be at least 13 years old to create an account on BackToYou.</li>
                    <li>One person may not maintain more than one active account without permission.</li>
                    <li>We reserve the right to suspend or delete accounts that provide false information or violate these terms.</li>
                </ul>
            </div>

            <div class="term-card" id="items">
                <div class="term-icon"><i class="fa-solid fa-box-open text-primary"></i></div>
                <h2>3. Reporting &amp; Claiming Items</h2>
                <ul>
                    <li><strong>Accuracy:</strong> When reporting a lost or found item, you agree to provide truthful and accurate details, including category, location, and description.</li>
                    <li><strong>Claim requests:</strong> Claimants must provide sufficient proof of ownership before a claim is approved. BackToYou does not guarantee the return of any item and is not a party to the exchange itself.</li>
                    <li><strong>False claims:</strong> Submitting a fraudulent claim or falsely reporting an item as lost/found may result in account suspension.</li>
                    <li><strong>Handover of items:</strong> Any physical exchange of items between users takes place at their own risk. We strongly recommend meeting in safe, public locations.</li>
                    <li>BackToYou is not responsible for verifying the legal ownership of any item posted or claimed on the platform.</li>
                </ul>
            </div>

            <div class="term-card" id="conduct">
                <div class="term-icon"><i class="fa-solid fa-triangle-exclamation text-primary"></i></div>
                <h2>4. Prohibited Conduct</h2>
                <p>While using BackToYou, you agree not to:</p>
                <ul>
                    <li>Post false, misleading, or fraudulent item reports or claims.</li>
                    <li>Harass, threaten, or abuse other users through the messaging system.</li>
                    <li>Use the platform to advertise, sell, or solicit unrelated goods and services.</li>
                    <li>Attempt to access another user's account or personal data without authorization.</li>
                    <li>Upload content that is illegal, defamatory, obscene, or infringes on someone else's rights.</li>
                    <li>Interfere with the platform's normal operation, including through bots, scraping, or exploits.</li>
                </ul>
                <p>Violation of these rules may result in a warning, temporary suspension, or permanent ban, at our discretion.</p>
            </div>

            <div class="term-card" id="messaging">
                <div class="term-icon"><i class="fa-solid fa-comments text-primary"></i></div>
                <h2>5. Messaging &amp; Communication</h2>
                <ul>
                    <li>The in-app chat system is intended solely for coordinating the return of lost/found items between owners and claimants.</li>
                    <li>Users can block or report other users who engage in abusive, suspicious, or inappropriate behavior in chat.</li>
                    <li>We may review reported conversations to investigate violations of these terms, but we do not routinely monitor private messages.</li>
                    <li>Do not share sensitive personal or financial information through the chat system.</li>
                </ul>
            </div>

            <div class="term-card" id="content">
                <div class="term-icon"><i class="fa-solid fa-images text-primary"></i></div>
                <h2>6. Content Ownership</h2>
                <p>You retain ownership of any photos, descriptions, and other content you upload to BackToYou. By posting content, you grant BackToYou a limited, non-exclusive license to display, store, and distribute that content within the platform for the purpose of operating the service.</p>
                <p>You are solely responsible for ensuring that you have the right to upload any content you submit.</p>
            </div>

            <div class="term-card" id="liability">
                <div class="term-icon"><i class="fa-solid fa-scale-balanced text-primary"></i></div>
                <h2>7. Limitation of Liability</h2>
                <ul>
                    <li>BackToYou is a platform that connects people who have lost items with people who have found them — we do not guarantee the recovery, authenticity, or condition of any item.</li>
                    <li>We are not liable for any loss, damage, theft, or dispute arising from the exchange of items between users.</li>
                    <li>The platform is provided on an "as is" and "as available" basis, without warranties of any kind.</li>
                    <li>To the maximum extent permitted by law, BackToYou and its team shall not be liable for any indirect, incidental, or consequential damages arising from your use of the service.</li>
                </ul>
            </div>

            <div class="term-card" id="termination">
                <div class="term-icon"><i class="fa-solid fa-ban text-primary"></i></div>
                <h2>8. Termination</h2>
                <p>We reserve the right to suspend or terminate your account, without prior notice, if you violate these Terms &amp; Conditions or engage in behavior that is harmful to the platform or its users. You may also delete your account at any time from your account settings.</p>
            </div>

            <div class="term-card" id="changes">
                <div class="term-icon"><i class="fa-solid fa-rotate text-primary"></i></div>
                <h2>9. Changes to These Terms</h2>
                <p>We may update these Terms &amp; Conditions from time to time to reflect changes in our platform or legal requirements. Continued use of BackToYou after changes are posted constitutes your acceptance of the updated terms. Significant changes will be communicated through the platform where possible.</p>
            </div>

            <div class="contact-card" id="contact">
                <div class="term-icon"><i class="fa-solid fa-envelope text-primary"></i></div>
                <h2>10. Contact Us</h2>
                <p class="mb-0">Questions about these terms? Reach out to our team at <strong>support@findit.pk</strong> and we'll get back to you as soon as possible.</p>
            </div>

        </div>

    </div>

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
</body>
</html>