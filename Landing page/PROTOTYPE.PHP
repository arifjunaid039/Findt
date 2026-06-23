<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FindIt Pakistan - Competition Prototype</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #f4f7fb;
      font-family: Arial, sans-serif;
      overflow-x: hidden;
    }

    .navbar {
      backdrop-filter: blur(10px);
      background: rgba(255,255,255,0.9);
    }

    .navbar-brand {
      font-size: 32px;
      font-weight: bold;
      color: #111 !important;
    }

    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      background:
      linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
      url('https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1400&auto=format&fit=crop');
      background-size: cover;
      background-position: center;
      color: white;
      position: relative;
    }

    .hero h1 {
      font-size: 75px;
      font-weight: 900;
      line-height: 1.1;
    }

    .hero p {
      font-size: 20px;
      color: #ddd;
      max-width: 700px;
    }

    .glass-box {
      background: rgba(255,255,255,0.12);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 25px;
      padding: 30px;
      margin-top: 40px;
    }

    .search-input,
    .search-select {
      border-radius: 15px;
      padding: 14px;
      border: none;
    }

    .btn-main {
      background: black;
      color: white;
      border-radius: 15px;
      padding: 14px 30px;
      font-weight: bold;
      border: none;
      transition: 0.3s;
    }

    .btn-main:hover {
      transform: translateY(-3px);
      background: #222;
    }

    .stats-box {
      background: white;
      border-radius: 25px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      transition: 0.3s;
      height: 100%;
    }

    .stats-box:hover {
      transform: translateY(-8px);
    }

    .stats-box i {
      font-size: 45px;
      margin-bottom: 20px;
    }

    .section-title {
      font-size: 50px;
      font-weight: 900;
      margin-bottom: 15px;
    }

    .section-subtitle {
      color: #666;
      max-width: 700px;
      margin: auto;
    }

    .category-card {
      background: white;
      border-radius: 25px;
      padding: 40px 20px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0,0,0,0.06);
      transition: 0.3s;
      height: 100%;
    }

    .category-card:hover {
      transform: translateY(-10px);
      background: black;
      color: white;
    }

    .category-card i {
      font-size: 40px;
      margin-bottom: 20px;
    }

    .item-card {
      background: white;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(0,0,0,0.08);
      transition: 0.4s;
      height: 100%;
    }

    .item-card:hover {
      transform: translateY(-10px);
    }

    .item-image {
      height: 260px;
      overflow: hidden;
    }

    .item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: 0.4s;
    }

    .item-card:hover img {
      transform: scale(1.08);
    }

    .badge-custom {
      background: #eef1f5;
      padding: 10px 18px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: bold;
    }

    .how-card {
      background: white;
      border-radius: 30px;
      padding: 40px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,0,0,0.06);
      transition: 0.3s;
      height: 100%;
    }

    .how-card:hover {
      transform: translateY(-8px);
    }

    .how-icon {
      width: 90px;
      height: 90px;
      background: black;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: auto;
      margin-bottom: 25px;
      font-size: 35px;
    }

    .cta-section {
      background: black;
      color: white;
      border-radius: 40px;
      padding: 80px 40px;
    }

    footer {
      background: #0f1115;
      color: white;
      padding: 70px 0 30px;
      margin-top: 100px;
    }

    footer p,
    footer li {
      color: #aaa;
    }

    .footer-link {
      margin-bottom: 10px;
      transition: 0.3s;
      cursor: pointer;
    }

    .footer-link:hover {
      color: white;
      transform: translateX(5px);
    }

    @media(max-width:768px) {
      .hero h1 {
        font-size: 48px;
      }

      .section-title {
        font-size: 38px;
      }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand" href="#">FindIt</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto gap-3 align-items-lg-center">
        <li class="nav-item"><a class="nav-link fw-semibold" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="#">Found Items</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="#">Lost Reports</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="#">Universities</a></li>
        <li class="nav-item"><a class="nav-link fw-semibold" href="#">Contact</a></li>

        <li class="nav-item">
          <button class="btn btn-dark rounded-pill px-4">Login</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container text-center">

    <span class="badge bg-light text-dark px-4 py-2 rounded-pill mb-4 fs-6">
      Pakistan's First Smart Lost & Found Platform
    </span>

    <h1>
      Reconnecting Pakistan,<br>One Lost Item At A Time.
    </h1>

    <p class="mx-auto mt-4">
      A nationwide smart lost & found platform that connects people who lost items with people who found them using intelligent matching, secure claims and real-time communication.
    </p>

    <div class="d-flex justify-content-center gap-3 mt-5 flex-wrap">
      <button class="btn-main">
        <i class="fa-solid fa-upload me-2"></i>
        Upload Found Item
      </button>

      <button class="btn btn-light btn-lg rounded-4 px-4 py-3 fw-bold">
        <i class="fa-solid fa-magnifying-glass me-2"></i>
        Search Lost Item
      </button>
    </div>

    <!-- SEARCH BOX -->
    <div class="glass-box mt-5">
      <div class="row g-3 align-items-center">

        <div class="col-md-4">
          <input type="text" class="form-control search-input" placeholder="Search lost item...">
        </div>

        <div class="col-md-3">
          <select class="form-select search-select">
            <option>All Categories</option>
            <option>Mobiles</option>
            <option>Wallets</option>
            <option>ID Cards</option>
            <option>Books</option>
          </select>
        </div>

        <div class="col-md-3">
          <select class="form-select search-select">
            <option>Select University</option>
            <option>NED University</option>
            <option>FAST Karachi</option>
            <option>Iqra University</option>
          </select>
        </div>

        <div class="col-md-2">
          <button class="btn btn-light w-100 fw-bold py-3 rounded-4">
            Search
          </button>
        </div>

      </div>
    </div>

  </div>
</section>

<!-- SOLUTION SECTION -->
<section class="py-5 bg-white">
  <div class="container text-center">
  <span class="badge bg-dark px-4 py-2 rounded-pill mb-3"> WHY FINDIT?</span>    
  <h2 class="section-title">A Smarter Way To Recover Lost Items</h2>    
  <p class="section-subtitle mb-5">FindIT combines AI, verification and institutional support to create Pakistan's first complete Lost & Found ecosystem.</p>
    <div class="row g-4 mt-4">

  <div class="col-lg-3 col-md-6">
    <div class="stats-box">
      <i class="fa-solid fa-brain text-dark"></i>
      <h4 class="fw-bold mt-3">AI Smart Matching</h4>
      <p class="text-muted mt-3">
        Automatically connects lost and found reports using images, keywords and location.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="stats-box">
      <i class="fa-solid fa-id-card text-dark"></i>
      <h4 class="fw-bold mt-3">CNIC Verification</h4>
      <p class="text-muted mt-3">
        Verified identities reduce fake claims and build trust among users.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="stats-box">
      <i class="fa-solid fa-building-shield text-dark"></i>
      <h4 class="fw-bold mt-3">University & Police Portal</h4>
      <p class="text-muted mt-3">
        Institutions can manage lost items through dedicated dashboards.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="stats-box">
      <i class="fa-solid fa-bell text-dark"></i>
      <h4 class="fw-bold mt-3">Instant Recovery Alerts</h4>
      <p class="text-muted mt-3">
        Users receive real-time notifications whenever a possible match is found.
      </p>
    </div>
  </div>

</div>
  </div>
</section>

<!-- CATEGORIES -->
<section class="py-5">
  <div class="container text-center">

    <h2 class="section-title">Popular Categories</h2>
    <p class="section-subtitle mb-5">
      Quickly browse the most commonly found items.
    </p>

    <div class="row g-4">

      <div class="col-lg-2 col-md-4 col-6">
        <div class="category-card">
          <i class="fa-solid fa-mobile-screen-button"></i>
          <h5>Mobiles</h5>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="category-card">
          <i class="fa-solid fa-wallet"></i>
          <h5>Wallets</h5>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="category-card">
          <i class="fa-solid fa-id-card"></i>
          <h5>ID Cards</h5>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="category-card">
          <i class="fa-solid fa-key"></i>
          <h5>Keys</h5>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="category-card">
          <i class="fa-solid fa-book"></i>
          <h5>Books</h5>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <div class="category-card">
          <i class="fa-solid fa-laptop"></i>
          <h5>Laptops</h5>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ITEMS -->
<section class="py-5">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center flex-wrap mb-5">
      <div>
        <h2 class="section-title mb-2">Recently Found Items</h2>
        <p class="text-muted">Browse recently found items uploaded by community members.</p>
      </div>

      <button class="btn btn-dark rounded-pill px-4 py-3 fw-bold">
        View All Items
      </button>
    </div>

    <div class="row g-4">

      <!-- CARD -->
      <div class="col-lg-4">
        <div class="item-card">
          <div class="item-image">
            <img src="https://images.unsplash.com/photo-1627123424574-724758594e93?q=80&w=1200&auto=format&fit=crop" alt="wallet">
          </div>

          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge-custom">Wallet</span>
              <small class="text-muted">2 hours ago</small>
            </div>

            <h3 class="fw-bold mb-3">Black Leather Wallet</h3>

            <p class="text-muted mb-4">
              Found near cafeteria at NED University Karachi.
            </p>

            <div class="d-flex gap-2">
              <button class="btn btn-dark w-100 py-3 rounded-4 fw-bold">
                Claim Item
              </button>

              <button class="btn btn-outline-dark w-100 py-3 rounded-4 fw-bold">
                Details
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- CARD -->
      <div class="col-lg-4">
        <div class="item-card">
          <div class="item-image">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1200&auto=format&fit=crop" alt="phone">
          </div>

          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge-custom">Mobile</span>
              <small class="text-muted">5 hours ago</small>
            </div>

            <h3 class="fw-bold mb-3">iPhone 13 Pro</h3>

            <p class="text-muted mb-4">
              Found in parking area at FAST Karachi.
            </p>

            <div class="d-flex gap-2">
              <button class="btn btn-dark w-100 py-3 rounded-4 fw-bold">
                Claim Item
              </button>

              <button class="btn btn-outline-dark w-100 py-3 rounded-4 fw-bold">
                Details
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- CARD -->
      <div class="col-lg-4">
        <div class="item-card">
          <div class="item-image">
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=1200&auto=format&fit=crop" alt="id card">
          </div>

          <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge-custom">ID Card</span>
              <small class="text-muted">1 day ago</small>
            </div>

            <h3 class="fw-bold mb-3">Student ID Card</h3>

            <p class="text-muted mb-4">
              Found near library at Iqra University.
            </p>

            <div class="d-flex gap-2">
              <button class="btn btn-dark w-100 py-3 rounded-4 fw-bold">
                Claim Item
              </button>

              <button class="btn btn-outline-dark w-100 py-3 rounded-4 fw-bold">
                Details
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- SMART MATCHING -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="badge bg-dark px-4 py-2 rounded-pill mb-3">STAR FEATURE</span>
        <h2 class="section-title text-start">Smart Auto Matching</h2>
        <p class="text-muted fs-5 mt-4">When a user uploads a lost item, FindIt instantly scans all found item posts using category, city and keywords to automatically surface possible matches.</p>
        <div class="mt-5">
          <div class="d-flex align-items-start gap-3 mb-4"><i class="fa-solid fa-circle-check fs-3"></i><div><h5 class="fw-bold">Real-Time Matching</h5><p class="text-muted">Matches appear instantly after posting.</p></div></div>
          <div class="d-flex align-items-start gap-3 mb-4"><i class="fa-solid fa-circle-check fs-3"></i><div><h5 class="fw-bold">City-Based Filtering</h5><p class="text-muted">Items are matched within the same city and area.</p></div></div>
          <div class="d-flex align-items-start gap-3"><i class="fa-solid fa-circle-check fs-3"></i><div><h5 class="fw-bold">Unique In Pakistan</h5><p class="text-muted">No local platform currently offers smart item matching.</p></div></div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="bg-dark text-white p-5 rounded-5 shadow-lg">
          <h3 class="fw-bold mb-4">How Matching Works</h3>
          <div class="d-flex align-items-center gap-3 mb-4"><div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;">1</div><div><h5>Lost Item Uploaded</h5><small class="text-light opacity-75">User posts details and image.</small></div></div>
          <div class="d-flex align-items-center gap-3 mb-4"><div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;">2</div><div><h5>Matching Engine Scans</h5><small class="text-light opacity-75">System scans database automatically.</small></div></div>
          <div class="d-flex align-items-center gap-3"><div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;">3</div><div><h5>Possible Matches Found</h5><small class="text-light opacity-75">Users are notified instantly.</small></div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="py-5">
  <div class="container text-center">

    <h2 class="section-title">How FindIt Works</h2>
    <p class="section-subtitle mb-5">
      Recover lost items in just a few easy steps.
    </p>

    <div class="row g-4">

      <div class="col-lg-4">
        <div class="how-card">
          <div class="how-icon">
            <i class="fa-solid fa-upload"></i>
          </div>

          <h3 class="fw-bold mb-3">Upload Found Item</h3>

          <p class="text-muted">
            Users upload item images, category and location details.
          </p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="how-card">
          <div class="how-icon">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>

          <h3 class="fw-bold mb-3">Search & Match</h3>

          <p class="text-muted">
            Lost item owners search through smart filters and categories.
          </p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="how-card">
          <div class="how-icon">
            <i class="fa-solid fa-handshake"></i>
          </div>

          <h3 class="fw-bold mb-3">Claim Securely</h3>

          <p class="text-muted">
            Owners verify ownership and safely recover their belongings.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FEATURES -->

<section class="py-5 bg-white">
  <div class="container text-center">

```
<span class="badge bg-dark px-4 py-2 rounded-pill mb-3">
  KEY FEATURES
</span>

<h2 class="section-title">
  Everything Needed To Recover Lost Items
</h2>

<p class="section-subtitle mb-5">
  FindIT combines smart technology, security and institutional support to make item recovery faster and more reliable.
</p>

<div class="row g-4">

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-brain"></i>
      </div>
      <h4 class="fw-bold">AI Matching</h4>
      <p class="text-muted mt-3">
        Automatically identifies possible matches between lost and found reports.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-id-card"></i>
      </div>
      <h4 class="fw-bold">CNIC Verification</h4>
      <p class="text-muted mt-3">
        Identity verification helps prevent fake accounts and fraudulent claims.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-comments"></i>
      </div>
      <h4 class="fw-bold">Secure Messaging</h4>
      <p class="text-muted mt-3">
        Owners and finders can communicate safely inside the platform.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-bell"></i>
      </div>
      <h4 class="fw-bold">Instant Alerts</h4>
      <p class="text-muted mt-3">
        Real-time notifications are sent whenever a matching item appears.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-building-columns"></i>
      </div>
      <h4 class="fw-bold">University Portal</h4>
      <p class="text-muted mt-3">
        Educational institutions can manage and track lost items efficiently.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-shield-halved"></i>
      </div>
      <h4 class="fw-bold">Ownership Verification</h4>
      <p class="text-muted mt-3">
        Proof questions ensure that only genuine owners can claim items.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-location-dot"></i>
      </div>
      <h4 class="fw-bold">Location Tracking</h4>
      <p class="text-muted mt-3">
        Search items based on city, university, office or public location.
      </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="how-card">
      <div class="how-icon">
        <i class="fa-solid fa-building-shield"></i>
      </div>
      <h4 class="fw-bold">Authority Dashboard</h4>
      <p class="text-muted mt-3">
        Police and authorized organizations can manage official recoveries.
      </p>
    </div>
  </div>

</div>
```

  </div>
</section>


<!-- CTA -->
<section class="py-5">
  <div class="container">
    <div class="cta-section text-center">

      <h2 class="display-4 fw-bold mb-4">
        Help Pakistan Recover Lost Items Faster
      </h2>

      <p class="lead text-light opacity-75 mb-5">
        Join universities, schools and communities already using FindIt.
      </p>

      <button class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold">
        Get Started Now
      </button>

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">

    <div class="row g-5">

      <div class="col-lg-4">
        <h2 class="fw-bold mb-4">FindIt</h2>

        <p>
          Pakistan's modern lost & found ecosystem helping people recover valuable belongings through community collaboration.
        </p>
      </div>

      <div class="col-lg-2">
        <h5 class="fw-bold mb-4">Quick Links</h5>

        <div class="footer-link">Home</div>
        <div class="footer-link">Found Items</div>
        <div class="footer-link">Lost Reports</div>
        <div class="footer-link">Contact</div>
      </div>

      <div class="col-lg-3">
        <h5 class="fw-bold mb-4">Top Universities</h5>

        <div class="footer-link">NED University</div>
        <div class="footer-link">FAST Karachi</div>
        <div class="footer-link">Iqra University</div>
        <div class="footer-link">IBA Karachi</div>
      </div>

      <div class="col-lg-3">
        <h5 class="fw-bold mb-4">Contact</h5>

        <p><i class="fa-solid fa-envelope me-2"></i> support@findit.pk</p>
        <p><i class="fa-solid fa-location-dot me-2"></i> Karachi, Pakistan</p>
        <p><i class="fa-solid fa-phone me-2"></i> +92 300 1234567</p>
      </div>

    </div>

    <hr class="border-secondary my-5">

    <div class="text-center text-secondary">
      © 2026 FindIt Pakistan. All Rights Reserved.
    </div>

  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
