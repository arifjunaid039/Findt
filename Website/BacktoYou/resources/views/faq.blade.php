  <!DOCTYPE html>
  <html lang="en" data-bs-theme="dark">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ — BackToYou</title>
  <meta name="description" content="Answers to common questions about reporting lost or found items, submitting claims, chatting safely, and joining communities on BackToYou.">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="icon" type="image/png" href="{{ asset('img/Logo.jpeg') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- FAQPage structured data for search engines -->
  @verbatim
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"What is BackToYou?","acceptedAnswer":{"@type":"Answer","text":"BackToYou is a lost-and-found platform for Pakistan where you can report lost items, report found items, search listings, submit claim requests, chat with the owner or finder after a claim, and join university or community lost-and-found groups."}},
      {"@type":"Question","name":"How do I report a lost item?","acceptedAnswer":{"@type":"Answer","text":"When reporting a lost item, you'll provide item title & description, category, brand, and color, location where it was lost, date lost, contact number, and optionally IMEI, serial number, and a photo."}},
      {"@type":"Question","name":"How do I claim an item that might be mine?","acceptedAnswer":{"@type":"Answer","text":"Open the item listing, click 'Claim Item,' write a message proving ownership, and submit your request. The item owner will then review it."}},
      {"@type":"Question","name":"Do I need to pay anything to claim my item?","acceptedAnswer":{"@type":"Answer","text":"No. You should never pay money to claim an item on BackToYou."}}
    ]
  }
  </script>
  @endverbatim

  <style>
    :root{
      --accent:#3b82f6;
      --accent-2:#2563eb;
      --accent-soft:rgba(59,130,246,.14);
      --accent-glow:rgba(59,130,246,.35);
      --bg:#080b12;
      --bg-2:#0d111a;
      --glass-bg:rgba(255,255,255,.04);
      --glass-border:rgba(255,255,255,.09);
      --text-1:#f4f6f9;
      --text-2:#95a0b3;
      --radius:18px;
    }
    [data-bs-theme="light"]{
      --bg:#f2f5fa;
      --bg-2:#e7edf6;
      --glass-bg:rgba(255,255,255,.6);
      --glass-border:rgba(20,30,50,.08);
      --text-1:#101420;
      --text-2:#586074;
    }

    *{box-sizing:border-box;}
    body{
      background:
        radial-gradient(900px 500px at 12% -10%, var(--accent-soft), transparent 60%),
        radial-gradient(700px 500px at 100% 10%, rgba(37,99,235,.12), transparent 55%),
        var(--bg);
      color:var(--text-1);
      font-family:'Plus Jakarta Sans', sans-serif;
      min-height:100vh;
      transition:background .3s ease, color .3s ease;
    }
    h1,h2,h3,.display-font{ font-family:'Syne', sans-serif; letter-spacing:-.02em; }
    a{ color:var(--accent); }

    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; animation:none !important; }
    }

    /* Visible keyboard focus ring everywhere interactive */
    .cat-pill:focus-visible,
    .faq-q:focus-visible,
    .theme-toggle:focus-visible,
    .link-icon:focus-visible,
    .search-box input:focus-visible{
      outline:2px solid var(--accent);
      outline-offset:2px;
    }

    .glass{
      background:var(--glass-bg);
      border:1px solid var(--glass-border);
      backdrop-filter:blur(18px);
      -webkit-backdrop-filter:blur(18px);
      border-radius:var(--radius);
    }

    /* Top bar */
    .topbar{ padding:1.1rem 0; }
    .brand{
      font-family:'Syne', sans-serif; font-weight:800; font-size:1.35rem;
      color:var(--text-1); text-decoration:none; letter-spacing:-.03em;
      display:flex; align-items:center; gap:.5rem;
    }
    .brand i{ color:var(--accent); }
    .theme-toggle{
      width:42px; height:42px; border-radius:50%;
      display:flex; align-items:center; justify-content:center;
      color:var(--text-1); cursor:pointer; border:1px solid var(--glass-border);
      background:var(--glass-bg); transition:.2s;
    }
    .theme-toggle:hover{ border-color:var(--accent); color:var(--accent); }

    /* Hero */
    .faq-hero{ padding:3.5rem 0 2.5rem; text-align:center; }
    .eyebrow{
      display:inline-flex; align-items:center; gap:.5rem;
      background:var(--accent-soft); color:var(--accent);
      padding:.4rem .9rem; border-radius:99px; font-size:.8rem; font-weight:600;
      border:1px solid var(--accent-glow); margin-bottom:1.1rem;
    }
    .faq-hero h1{ font-size:clamp(2rem, 4.5vw, 3.1rem); font-weight:800; margin-bottom:.7rem; }
    .faq-hero p{ color:var(--text-2); font-size:1.05rem; max-width:560px; margin:0 auto; }

    /* Search */
    .search-wrap{ max-width:600px; margin:2rem auto 0; }
    .search-box{
      display:flex; align-items:center; gap:.7rem;
      padding:.9rem 1.2rem; border-radius:99px;
    }
    .search-box i{ color:var(--accent); font-size:1.1rem; }
    .search-box input{
      background:transparent; border:none; outline:none; color:var(--text-1);
      width:100%; font-size:.98rem; font-family:'Plus Jakarta Sans', sans-serif;
    }
    .search-box input::placeholder{ color:var(--text-2); }
    .search-hint{
      text-align:center; font-size:.78rem; color:var(--text-2); margin-top:.5rem;
    }
    .search-hint kbd{
      background:var(--glass-bg); border:1px solid var(--glass-border);
      border-radius:5px; padding:.05rem .4rem; font-family:inherit; color:var(--text-1);
    }

    /* Category pills */
    .cat-row{ display:flex; flex-wrap:wrap; gap:.6rem; justify-content:center; margin:1.8rem 0 1rem; }
    .cat-pill{
      padding:.55rem 1.15rem; border-radius:99px; font-size:.87rem; font-weight:600;
      color:var(--text-2); border:1px solid var(--glass-border); background:var(--glass-bg);
      cursor:pointer; transition:.2s; white-space:nowrap;
    }
    .cat-pill:hover{ color:var(--text-1); border-color:var(--accent-glow); }
    .cat-pill.active{
      background:var(--accent); color:#ffffff; border-color:var(--accent);
    }

    .result-count{
      text-align:center; font-size:.85rem; color:var(--text-2); margin-bottom:1.5rem;
    }

    /* Accordion */
    .faq-list{ max-width:760px; margin:0 auto; display:flex; flex-direction:column; gap:.85rem; }
    .faq-item{ overflow:hidden; transition:border-color .2s; }
    .faq-item.open{ border-color:var(--accent-glow); }
    .faq-q{
      display:flex; align-items:center; justify-content:space-between; gap:1rem;
      padding:1.15rem 1.4rem; cursor:pointer; user-select:none;
    }
    .faq-q .num{
      font-family:'Syne', sans-serif; font-weight:700; font-size:.78rem;
      color:var(--accent); background:var(--accent-soft);
      width:30px; height:30px; border-radius:50%;
      display:flex; align-items:center; justify-content:center; flex-shrink:0;
    }
    .faq-q .qtext{ font-weight:600; font-size:1rem; flex:1; }
    .faq-q .chev{ color:var(--text-2); transition:transform .25s ease; flex-shrink:0; }
    .faq-item.open .chev{ transform:rotate(180deg); color:var(--accent); }
    .faq-a{
      padding:0 1.4rem 1.3rem 4.2rem; color:var(--text-2); font-size:.94rem; line-height:1.65;
    }
    .faq-a ul{ margin:.4rem 0 0; padding-left:1.1rem; }
    .faq-a li{ margin-bottom:.25rem; }
    .faq-a a{ color:var(--accent); text-decoration:none; font-weight:600; }
    .faq-a a:hover{ text-decoration:underline; }
    .faq-a strong{ color:var(--text-1); }

    .link-icon{
      background:none; border:none; color:var(--text-2); cursor:pointer;
      padding:.2rem .4rem; border-radius:6px; font-size:.85rem; flex-shrink:0;
    }
    .link-icon:hover{ color:var(--accent); }
    .link-icon.copied{ color:#22c55e; }

    .no-results{ text-align:center; padding:3rem 1rem; color:var(--text-2); display:none; }
    .no-results.show{ display:block; }
    .no-results i{ font-size:2.2rem; color:var(--accent); margin-bottom:.8rem; display:block; }
    .no-results button{
      margin-top:1rem; background:var(--accent); color:#fff; border:none;
      padding:.55rem 1.3rem; border-radius:99px; font-weight:600; font-size:.88rem;
    }
    .no-results button:hover{ background:var(--accent-2); }

    /* Safety note strip */
    .safety-strip{
      max-width:760px; margin:2.2rem auto 0; padding:1.1rem 1.4rem;
      display:flex; align-items:flex-start; gap:.8rem;
    }
    .safety-strip i{ color:var(--accent); font-size:1.2rem; margin-top:.1rem; }
    .safety-strip p{ margin:0; font-size:.88rem; color:var(--text-2); line-height:1.6; }

    /* CTA */
    .cta-band{
      max-width:760px; margin:2.5rem auto 4rem; padding:2.4rem 2rem; text-align:center;
      position:relative; overflow:hidden;
    }
    .cta-band::before{
      content:''; position:absolute; inset:0;
      background:radial-gradient(400px 200px at 50% 0%, var(--accent-soft), transparent 70%);
      pointer-events:none;
    }
    .cta-band h3{ font-size:1.4rem; margin-bottom:.4rem; }
    .cta-band p{ color:var(--text-2); margin-bottom:1.3rem; font-size:.95rem; }
    .cta-btns{ display:flex; gap:.8rem; justify-content:center; flex-wrap:wrap; }
    .btn-primary-glow{
      background:var(--accent); color:#ffffff; border:none; font-weight:700;
      padding:.7rem 1.6rem; border-radius:99px; font-size:.92rem; transition:.2s; text-decoration:none; display:inline-block;
    }
    .btn-primary-glow:hover{ background:var(--accent-2); color:#ffffff; }
    .btn-ghost{
      background:transparent; color:var(--text-1); border:1px solid var(--glass-border);
      padding:.7rem 1.6rem; border-radius:99px; font-size:.92rem; font-weight:600; transition:.2s; text-decoration:none; display:inline-block;
    }
    .btn-ghost:hover{ border-color:var(--accent); color:var(--accent); }

    @media (max-width:576px){
      .faq-a{ padding-left:1.4rem; }
      .faq-q .qtext{ font-size:.93rem; }
    }

[data-bs-theme="light"] .safety-strip strong{
    color:#000;
}

[data-bs-theme="dark"] .safety-strip strong{
    color:white;
}

/* ---------- Tablet & below ---------- */
@media (max-width:768px){
  .faq-hero{ padding:2.5rem 1.25rem 2rem; }
  .search-wrap{ padding:0 1.25rem; }
  .cat-row{ padding:0 1rem; gap:.5rem; }
  .faq-list{ padding:0 1rem; gap:.65rem; }
  .safety-strip{ margin-left:1rem; margin-right:1rem; padding:1rem 1.1rem; }
  .cta-band{ margin-left:1rem; margin-right:1rem; padding:2rem 1.25rem; }
  .faq-q{ padding:1rem 1rem; gap:.7rem; }
  .faq-q .qtext{ min-width:0; }
  .faq-q .num{ width:26px; height:26px; font-size:.7rem; }
  .faq-a{ padding-left:1rem; padding-right:1rem; }
}

/* ---------- Phone ---------- */
@media (max-width:576px){
  .faq-hero h1{ font-size:1.7rem; }
  .faq-hero p{ font-size:.95rem; }
  .search-box{ padding:.75rem 1rem; }
  .cat-pill{ font-size:.8rem; padding:.5rem .9rem; }
  .faq-q .qtext{ font-size:.93rem; }
  .faq-a{ padding-left:1rem; }
  .cta-band h3{ font-size:1.2rem; }
  .cta-btns{ flex-direction:column; align-items:stretch; }
  .cta-btns .btn-primary-glow,
  .cta-btns .btn-ghost{ width:100%; text-align:center; }
}
  </style>
  </head>
  <body x-data="faqPage()" x-init="init()">

  @include('nav')

    <!-- Hero -->
    <div class="faq-hero">
      <span class="eyebrow"><i class="bi bi-patch-question-fill"></i> Help Center</span>
      <h1>Frequently Asked <span style="color:var(--accent)">Questions</span></h1>
      <p>Everything you need to know about reporting, searching, claiming, and recovering items on BackToYou.</p>

      <div class="search-wrap">
        <div class="glass search-box">
          <i class="bi bi-search"></i>
          <input
            type="text"
            id="faq-search"
            placeholder="Search questions… e.g. how do I claim an item?"
            x-model="query"
            aria-label="Search FAQ questions">
          <i class="bi bi-x-lg" style="cursor:pointer" x-show="query.length" @click="query=''; $refs.searchInput?.focus()" role="button" tabindex="0" aria-label="Clear search"></i>
        </div>
      </div>
    </div>

    <!-- Category pills -->
    <div class="cat-row" role="tablist" aria-label="FAQ categories">
      <template x-for="cat in categories" :key="cat">
        <div
          class="cat-pill"
          :class="activeCat === cat ? 'active' : ''"
          role="tab"
          tabindex="0"
          :aria-selected="activeCat === cat"
          @click="activeCat = cat"
          @keydown.enter.prevent="activeCat = cat"
          @keydown.space.prevent="activeCat = cat">
          <span x-text="cat"></span>
        </div>
      </template>
    </div>

    <p class="result-count" x-text="`Showing ${filtered.length} of ${faqs.length} questions${activeCat !== 'All' ? ' in ' + activeCat : ''}`" aria-live="polite"></p>

    <!-- FAQ list -->
    <div class="faq-list">
      <template x-for="(item, index) in filtered" :key="item.q">
        <div class="glass faq-item" :class="openIndex === item.q ? 'open' : ''" :id="slugify(item.q)">
          <div
            class="faq-q"
            role="button"
            tabindex="0"
            :aria-expanded="openIndex === item.q"
            :aria-controls="'answer-' + slugify(item.q)"
            @click="openIndex = (openIndex === item.q ? null : item.q)"
            @keydown.enter.prevent="openIndex = (openIndex === item.q ? null : item.q)"
            @keydown.space.prevent="openIndex = (openIndex === item.q ? null : item.q)">
            <div class="num" x-text="String(index+1).padStart(2,'0')"></div>
            <div class="qtext" x-text="item.q"></div>
            <button
              class="link-icon"
              :class="copiedId === item.q ? 'copied' : ''"
              @click.stop="copyLink(item.q)"
              :aria-label="'Copy link to ' + item.q"
              title="Copy link to this question">
              <i :class="copiedId === item.q ? 'bi bi-check2' : 'bi bi-link-45deg'"></i>
            </button>
            <i class="bi bi-chevron-down chev"></i>
          </div>
          <div class="faq-a" :id="'answer-' + slugify(item.q)" x-show="openIndex === item.q" x-collapse x-html="item.a"></div>
        </div>
      </template>
    </div>

    <div class="no-results" :class="filtered.length === 0 ? 'show' : ''">
      <i class="bi bi-emoji-frown"></i>
      <p class="mb-1 fw-semibold" style="color:var(--text-1)">No matching questions</p>
      <p class="mb-0">Try a different search term or browse another category.</p>
      <button @click="query=''; activeCat='All'">Clear filters</button>
    </div>

    <!-- Safety note -->
    <div class="glass safety-strip">
      <i class="bi bi-shield-check"></i>
      <p><strong>Stay safe:</strong> always meet in a public place, verify ownership before handing an item over, and never share your password, OTP, PIN, or banking details in chat. BackToYou never asks you to pay to claim an item.</p>
    </div>

    @include('cta')
    @include('footer')

  <script>
  function faqPage(){
    return {
      theme: 'dark',
      query: '',
      activeCat: 'All',
      openIndex: null,
      copiedId: null,
      categories: ['All','Getting Started','Reporting & Searching','Claims & Recovery','Chat & Safety','Communities'],
      faqs: [
        {cat:'Getting Started', q:'What is BackToYou?', a:'BackToYou is a lost-and-found platform for Pakistan where you can report lost items, report found items, search listings, submit claim requests, chat with the owner or finder after a claim, and join university or community lost-and-found groups.'},
        {cat:'Getting Started', q:'How do I create an account?', a:'You can register for an account, log in securely, and update your profile at any time from your account settings.'},

        {cat:'Reporting & Searching', q:'How do I report a lost item?', a:'When reporting a lost item, you\'ll provide: <ul><li>Item title & description</li><li>Category, brand, and color</li><li>Location where it was lost</li><li>Date lost</li><li>Contact number</li><li>IMEI (optional)</li><li>Serial number (optional)</li><li>Photo (optional)</li></ul>'},
        {cat:'Reporting & Searching', q:'How do I report a found item?', a:'When reporting a found item, you\'ll provide: <ul><li>Item title & description</li><li>Category, brand, and color</li><li>Location where it was found</li><li>Date found</li><li>Contact number</li><li>Photo</li></ul> Unlike a lost item report, a photo is required when reporting a found item.'},
        {cat:'Reporting & Searching', q:'What item categories does BackToYou support?', a:'BackToYou covers a wide range of personal belongings, including mobile phones, laptops, wallets, ID cards, passports, keys, bags, books, watches, glasses, jewelry, documents, chargers, earbuds, clothing, and other personal items.'},
        {cat:'Reporting & Searching', q:'How do I search for an item?', a:'You can search listings by item name, brand, category, color, or location to find a possible match.'},

        {cat:'Claims & Recovery', q:'How do I claim an item that might be mine?', a:'Open the item listing, click <strong>"Claim Item,"</strong> write a message proving ownership, and submit your request. The item owner will then review it.'},
        {cat:'Claims & Recovery', q:'What happens after I submit a claim?', a:'Your claim request will show one of three statuses: <strong>Pending</strong>, <strong>Approved</strong>, or <strong>Rejected</strong>, depending on the item owner\'s review.'},
        {cat:'Claims & Recovery', q:'What happens once my claim is approved?', a:'Once a claim is approved, any other pending claim requests on that item are automatically rejected, the item is marked as <strong>Claimed</strong>, and you and the owner can begin chatting to arrange the return.'},
        {cat:'Claims & Recovery', q:'Can more than one person claim the same item?', a:'Yes, multiple people can submit a claim request on the same item, but only one claim can be approved. Once it is, all other requests for that item are rejected.'},

        {cat:'Chat & Safety', q:'When can I chat with the finder or owner?', a:'Chat becomes available once a claim request is approved, so you can discuss ownership details, arrange a meeting, and exchange recovery details directly.'},
        {cat:'Chat & Safety', q:'Is it safe to meet up to exchange an item?', a:'Always meet in a safe, public place and verify ownership before handing an item over.'},
        {cat:'Chat & Safety', q:'Do I need to pay anything to claim my item?', a:'No. You should never pay money to claim an item — be cautious of anyone asking you to.'},
        {cat:'Chat & Safety', q:'Should I share personal info like OTP or passwords in chat?', a:'No, never share your password, OTP, PIN, or banking information with anyone on BackToYou, including someone claiming to be the finder or owner.'},

        {cat:'Communities', q:'What are BackToYou communities?', a:'Communities are groups such as universities, colleges, schools, and organizations. Members of a community can report and search for items specifically within that group.'},
        {cat:'Communities', q:'Why would I join a community?', a:'Joining a community, like your university or organization, narrows reporting and searching to people around you, which can make it easier to reconnect lost items with their owners nearby.'},
      ],

      init(){
        const saved = localStorage.getItem('findit-theme');
        this.theme = saved || 'dark';
        document.documentElement.setAttribute('data-bs-theme', this.theme);

        // Keyboard shortcut: "/" focuses search (unless already typing somewhere)
        window.addEventListener('keydown', (e) => {
          if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
            e.preventDefault();
            document.getElementById('faq-search')?.focus();
          }
        });

        // Open + scroll to a question if the URL has a matching hash on load
        if (window.location.hash) {
          const id = decodeURIComponent(window.location.hash.slice(1));
          const match = this.faqs.find(f => this.slugify(f.q) === id);
          if (match) {
            this.openIndex = match.q;
            this.$nextTick(() => {
              document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
          }
        }
      },
      toggleTheme(){
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-bs-theme', this.theme);
        localStorage.setItem('findit-theme', this.theme);
      },
      slugify(text){
        return text.toLowerCase().replace(/[^\w\s-]/g,'').trim().replace(/\s+/g,'-');
      },
      copyLink(q){
        const url = `${window.location.origin}${window.location.pathname}#${this.slugify(q)}`;
        navigator.clipboard?.writeText(url).then(() => {
          this.copiedId = q;
          setTimeout(() => { if (this.copiedId === q) this.copiedId = null; }, 1500);
        });
      },
      get filtered(){
        let list = this.faqs;
        if(this.activeCat !== 'All'){
          list = list.filter(i => i.cat === this.activeCat);
        }
        if(this.query.trim().length){
          const q = this.query.toLowerCase();
          list = list.filter(i => i.q.toLowerCase().includes(q) || i.a.toLowerCase().includes(q));
        }
        return list;
      }
    }
  }
  </script>
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="pWqLqk5Y3XFJodIGm8Ue0";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>