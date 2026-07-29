<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FindIT | Privacy Policy</title>

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

.data-table{
    width:100%;
    border-collapse:collapse;
    margin-top:6px;
}

.data-table th{
    text-align:left;
    font-family:'Syne',sans-serif;
    font-size:12.5px;
    text-transform:uppercase;
    letter-spacing:.4px;
    color:var(--text-sub);
    padding:10px 12px;
    border-bottom:1px solid var(--glass-border);
}

.data-table td{
    padding:12px;
    font-size:14px;
    color:var(--text-main);
    border-bottom:1px solid var(--glass-border);
    vertical-align:top;
}

.data-table tr:last-child td{
    border-bottom:none;
}

.data-table i{
    color:var(--accent);
    margin-right:6px;
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

body.dark .data-table td,
body.dark .data-table th{
    border-bottom-color:rgba(255,255,255,.08);
}

@media(max-width:768px){
    .layout{flex-direction:column;}
    .toc{width:100%; position:static;}
}

@media(max-width:576px){
    .wrap{margin:28px auto;}
    .heading{font-size:26px;}
    .term-card{padding:20px;}
    .data-table{font-size:13px;}
    .data-table th, .data-table td{padding:8px;}
}

</style>

</head>

<body>

@include('nav')

<div class="wrap">

    <h1 class="heading">
        <i class="fa-solid fa-shield-halved text-primary"></i>
        Privacy Policy
    </h1>
    <div class="subtitle">How FindIT collects, uses, and protects your information.</div>
    <div class="updated-badge">
        <i class="fa-solid fa-clock-rotate-left text-primary"></i>
        Last updated: July 20, 2026
    </div>

    <div class="layout">

        <div class="toc">
            <h6>On this page</h6>
            <a href="#intro"><i class="fa-solid fa-book-open text-primary"></i> Introduction</a>
            <a href="#collect"><i class="fa-solid fa-database text-primary"></i> Information We Collect</a>
            <a href="#use"><i class="fa-solid fa-gears text-primary"></i> How We Use It</a>
            <a href="#sharing"><i class="fa-solid fa-share-nodes text-primary"></i> Data Sharing</a>
            <a href="#messaging"><i class="fa-solid fa-comments text-primary"></i> Chat &amp; Messaging Data</a>
            <a href="#cookies"><i class="fa-solid fa-cookie-bite text-primary"></i> Cookies</a>
            <a href="#security"><i class="fa-solid fa-lock text-primary"></i> Data Security</a>
            <a href="#retention"><i class="fa-solid fa-box-archive text-primary"></i> Data Retention</a>
            <a href="#rights"><i class="fa-solid fa-user-check text-primary"></i> Your Rights</a>
            <a href="#children"><i class="fa-solid fa-child-reaching text-primary"></i> Children's Privacy</a>
            <a href="#changes"><i class="fa-solid fa-rotate text-primary"></i> Changes to Policy</a>
            <a href="#contact"><i class="fa-solid fa-envelope text-primary"></i> Contact Us</a>
        </div>

        <div class="content">

            <div class="term-card" id="intro">
                <div class="term-icon"><i class="fa-solid fa-book-open text-primary"></i></div>
                <h2>1. Introduction</h2>
                <p>This Privacy Policy explains how FindIT ("we", "us", "our") collects, uses, and protects your personal information when you use our lost &amp; found platform. By using FindIT, you agree to the practices described in this policy.</p>
                <p>We built FindIT to help people in Pakistan reconnect with their lost belongings, and we take the privacy of your data seriously throughout that process.</p>
            </div>

            <div class="term-card" id="collect">
                <div class="term-icon"><i class="fa-solid fa-database text-primary"></i></div>
                <h2>2. Information We Collect</h2>
                <table class="data-table">
                    <tr>
                        <th>Category</th>
                        <th>Examples</th>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-id-card text-primary"></i>Account Info</td>
                        <td>Full name, email address, password (encrypted), profile photo</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-box-open text-primary"></i>Item Reports</td>
                        <td>Item title, category, description, photos, location, date lost/found</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-file-signature text-primary"></i>Claim Data</td>
                        <td>Claim messages, proof-of-ownership details submitted during a claim</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-comment-dots text-primary"></i>Chat Messages</td>
                        <td>Messages exchanged between item owners and claimants</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-laptop text-primary"></i>Usage Data</td>
                        <td>IP address, browser type, device info, pages visited</td>
                    </tr>
                </table>
            </div>

            <div class="term-card" id="use">
                <div class="term-icon"><i class="fa-solid fa-gears text-primary"></i></div>
                <h2>3. How We Use Your Information</h2>
                <ul>
                    <li>To create and manage your FindIT account.</li>
                    <li>To match lost items with found reports and notify relevant users.</li>
                    <li>To process claim requests and verify ownership details.</li>
                    <li>To enable communication between item owners and claimants via chat.</li>
                    <li>To detect and prevent fraud, abuse, or violations of our Terms &amp; Conditions.</li>
                    <li>To improve the platform's features, performance, and user experience.</li>
                </ul>
            </div>

            <div class="term-card" id="sharing">
                <div class="term-icon"><i class="fa-solid fa-share-nodes text-primary"></i></div>
                <h2>4. Data Sharing</h2>
                <ul>
                    <li>We do not sell your personal information to third parties.</li>
                    <li>Your name and item details may be visible to other users when you post a lost/found item, as this is necessary for the platform to function.</li>
                    <li>When you submit or receive a claim, limited contact and item details are shared between the two parties to facilitate the return.</li>
                    <li>We may share data with law enforcement if required by law, or to investigate fraud, safety issues, or violations of our terms.</li>
                    <li>We may use trusted third-party services (e.g. hosting, analytics) that process data on our behalf under confidentiality obligations.</li>
                </ul>
            </div>

            <div class="term-card" id="messaging">
                <div class="term-icon"><i class="fa-solid fa-comments text-primary"></i></div>
                <h2>5. Chat &amp; Messaging Data</h2>
                <p>Messages sent through FindIT's chat system are stored so that conversations can be retrieved by both participants and reviewed if a report or block is filed. We do not routinely monitor private conversations, but reported chats may be reviewed by our team to investigate abuse, harassment, or fraud.</p>
                <p>If you block another user, future messages between you and that user will be restricted according to the platform's block settings.</p>
            </div>

            <div class="term-card" id="cookies">
                <div class="term-icon"><i class="fa-solid fa-cookie-bite text-primary"></i></div>
                <h2>6. Cookies &amp; Tracking</h2>
                <p>FindIT uses cookies and similar technologies to keep you logged in, remember your theme preference (light/dark mode), and understand how the platform is used. You can control cookies through your browser settings, though disabling them may affect certain features.</p>
            </div>

            <div class="term-card" id="security">
                <div class="term-icon"><i class="fa-solid fa-lock text-primary"></i></div>
                <h2>7. Data Security</h2>
                <ul>
                    <li>Passwords are stored using industry-standard hashing and are never saved in plain text.</li>
                    <li>We use reasonable technical and organizational measures to protect your data from unauthorized access, alteration, or loss.</li>
                    <li>No method of transmission or storage is 100% secure, and we cannot guarantee absolute security of your information.</li>
                    <li>If you suspect unauthorized access to your account, please contact us immediately.</li>
                </ul>
            </div>

            <div class="term-card" id="retention">
                <div class="term-icon"><i class="fa-solid fa-box-archive text-primary"></i></div>
                <h2>8. Data Retention</h2>
                <p>We retain your account and activity data for as long as your account remains active, or as needed to provide the service. If you delete your account, we may retain certain records (such as claim history or reported conversations) for a limited period where necessary for security, dispute resolution, or legal compliance.</p>
            </div>

            <div class="term-card" id="rights">
                <div class="term-icon"><i class="fa-solid fa-user-check text-primary"></i></div>
                <h2>9. Your Rights</h2>
                <ul>
                    <li><strong>Access:</strong> You can view and update most of your personal information from your account settings.</li>
                    <li><strong>Correction:</strong> You may request corrections to inaccurate information we hold about you.</li>
                    <li><strong>Deletion:</strong> You may request deletion of your account and associated personal data, subject to any legal retention requirements.</li>
                    <li><strong>Objection:</strong> You may object to certain uses of your data by contacting our support team.</li>
                </ul>
            </div>

            <div class="term-card" id="children">
                <div class="term-icon"><i class="fa-solid fa-child-reaching text-primary"></i></div>
                <h2>10. Children's Privacy</h2>
                <p>FindIT is not intended for children under 13 years of age, and we do not knowingly collect personal information from children under 13. If we become aware that we have collected data from a child under 13, we will take steps to delete it.</p>
            </div>

            <div class="term-card" id="changes">
                <div class="term-icon"><i class="fa-solid fa-rotate text-primary"></i></div>
                <h2>11. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Continued use of FindIT after changes are posted constitutes your acceptance of the updated policy. Significant changes will be communicated through the platform where possible.</p>
            </div>

            <div class="contact-card" id="contact">
                <div class="term-icon"><i class="fa-solid fa-envelope text-primary"></i></div>
                <h2>12. Contact Us</h2>
                <p class="mb-0">Questions about how we handle your data? Reach out to our team at <strong>support@findit.pk</strong> and we'll get back to you as soon as possible.</p>
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