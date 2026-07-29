<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FindIT | Messages</title>

<link rel="icon" href="{{ asset('img/Logo.jpeg') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>

:root{

    /* Primary Blue Theme */
    --accent:#2563eb;
    --accent-dark:#1d4ed8;
    --accent-light:#3b82f6;
    --accent-soft:rgba(37,99,235,.10);

    /* Secondary */
    --secondary:#60a5fa;
    --secondary-soft:rgba(96,165,250,.15);

    /* Lost & Found (kept semantic — untouched) */
    --lost:#ef4444;
    --lost-soft:rgba(239,68,68,.12);

    --found:#10b981;
    --found-soft:rgba(16,185,129,.12);

    /* Background — clean blue & white */
    --page-bg-1:#ffffff;
    --page-bg-2:#eaf2ff;
    --page-bg-3:#dbeafe;

    /* Glass */
    --glass-bg:rgba(255,255,255,.85);
    --glass-border:rgba(37,99,235,.14);

    /* Neutral lines/tints — blue-based instead of black-based */
    --line:rgba(37,99,235,.10);
    --line-soft:rgba(37,99,235,.06);
    --bubble-other:rgba(37,99,235,.07);

    /* Text */
    --text-main:#0f172a;
    --text-sub:#64748b;

    /* Status (kept semantic — untouched) */
    --pending-bg:#fef3c7;
    --pending-text:#b45309;

    --approved-bg:#dcfce7;
    --approved-text:#166534;

    --rejected-bg:#fee2e2;
    --rejected-text:#991b1b;

}
*{
    font-family:'Plus Jakarta Sans',sans-serif;
    box-sizing:border-box;
}

body{
    margin:0;
    background:linear-gradient(135deg,var(--page-bg-1) 0%,var(--page-bg-2) 100%);
    min-height:100vh;
    color:var(--text-main);
    transition:background .3s ease,color .3s ease;
}

.page-wrap{
    width:96%;
    max-width:1300px;
    margin:30px auto;
}

.page-title{
    font-family:'Syne',sans-serif;
    font-size:28px;
    font-weight:800;
    margin-bottom:16px;
    display:flex;
    align-items:center;
    gap:12px;
}

.page-title i{ color:var(--accent); }

.app-shell{
    display:flex;
    height:78vh;
    min-height:560px;
    background:var(--glass-bg);
    backdrop-filter:blur(24px);
    -webkit-backdrop-filter:blur(24px);
    border:1px solid var(--glass-border);
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 15px 45px rgba(37,99,235,.12);
}

/* ===== SIDEBAR ===== */

.sidebar{
    width:340px;
    flex-shrink:0;
    border-right:1px solid var(--line);
    display:flex;
    flex-direction:column;
}

.sidebar-head{
    padding:18px 18px 12px;
    border-bottom:1px solid var(--line);
}

.sidebar-head-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:12px;
}

.sidebar-heading{
    font-family:'Syne',sans-serif;
    font-weight:700;
    font-size:18px;
}

.claim-link{
    color:var(--accent);
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:5px;
}

.claim-link:hover{ color:var(--accent-dark); }

.search-bar{
    position:relative;
    margin-bottom:10px;
}

.search-bar input{
    width:100%;
    padding:10px 14px 10px 38px;
    border-radius:12px;
    border:1px solid var(--line);
    background:var(--line-soft);
    font-size:13.5px;
    color:var(--text-main);
    outline:none;
    transition:.2s;
}

.search-bar input:focus{
    border-color:var(--accent);
    background:#fff;
}

.search-bar i{
    position:absolute;
    left:13px;
    top:50%;
    transform:translateY(-50%);
    color:var(--text-sub);
    font-size:13px;
}

.filters{
    display:flex;
    gap:6px;
    overflow-x:auto;
}

.filter-btn{
    border:none;
    background:transparent;
    padding:6px 12px;
    border-radius:9px;
    font-size:12.5px;
    font-weight:600;
    color:var(--text-sub);
    cursor:pointer;
    white-space:nowrap;
    transition:.2s;
}

.filter-btn.active{
    background:var(--accent);
    color:#fff;
}

.convo-list{
    flex:1;
    overflow-y:auto;
}

.convo-list::-webkit-scrollbar{ width:5px; }
.convo-list::-webkit-scrollbar-thumb{ background:rgba(37,99,235,.25); border-radius:10px; }

.convo-item{
    display:flex;
    align-items:center;
    gap:12px;
    padding:13px 16px;
    text-decoration:none;
    color:var(--text-main);
    border-bottom:1px solid var(--line-soft);
    position:relative;
    transition:.15s;
}

.convo-item:hover{
    background:var(--accent-soft);
}

.convo-item.active{
    background:var(--accent-soft);
}

.convo-item.active::before{
    content:'';
    position:absolute;
    left:0; top:0; bottom:0;
    width:3px;
    background:var(--accent);
}

.convo-item.unread .convo-name{
    font-weight:800;
}

/* Stretched-link overlay: makes the whole row clickable while still
   letting the menu button (higher z-index) intercept its own clicks */
.convo-link-overlay{
    position:absolute;
    inset:0;
    z-index:1;
}

.avatar-wrap{ position:relative; flex-shrink:0; z-index:0; }

.convo-photo{
    width:48px;
    height:48px;
    border-radius:14px;
    object-fit:cover;
    border:2px solid var(--glass-border);
}

.convo-placeholder{
    width:48px;
    height:48px;
    border-radius:14px;
    background:var(--accent-soft);
    color:var(--accent);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.convo-photo.lost, .convo-placeholder.lost{ border-color:var(--lost); }
.convo-photo.found, .convo-placeholder.found{ border-color:var(--found); }
.convo-placeholder.lost{ background:var(--lost-soft); color:var(--lost); }
.convo-placeholder.found{ background:var(--found-soft); color:var(--found); }

.convo-info{
    flex:1;
    min-width:0;
}

.convo-name{
    font-size:14.5px;
    font-weight:600;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.convo-last{
    color:var(--text-sub);
    font-size:12.5px;
    margin-top:2px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.convo-meta{
    text-align:right;
    flex-shrink:0;
}

.convo-time{
    color:var(--text-sub);
    font-size:11px;
}

.convo-badge{
    margin-top:5px;
    min-width:18px;
    height:18px;
    padding:0 5px;
    background:var(--accent);
    color:#fff;
    border-radius:20px;
    font-size:10.5px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

/* ===== PER-CONVERSATION OPTIONS MENU (WhatsApp-Web style) ===== */

.convo-menu-wrap{
    position:relative;
    z-index:2;
    flex-shrink:0;
}

.convo-menu-btn{
    width:30px;
    height:30px;
    border-radius:50%;
    border:none;
    background:transparent;
    color:var(--text-sub);
    font-size:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    opacity:0;
    transition:.15s;
}

.convo-item:hover .convo-menu-btn{
    opacity:1;
}

.convo-menu-btn:hover{
    background:var(--line);
    color:var(--text-main);
}

body.dark .convo-menu-btn:hover{
    background:rgba(56,189,248,.14);
}

.convo-menu{
    position:absolute;
    top:34px;
    right:0;
    min-width:170px;
    background:#fff;
    border:1px solid var(--line);
    border-radius:12px;
    box-shadow:0 10px 28px rgba(37,99,235,.16);
    overflow:hidden;
    z-index:30;
}

body.dark .convo-menu{
    background:#1e293b;
    border-color:rgba(56,189,248,.16);
}

.convo-menu button{
    width:100%;
    display:flex;
    align-items:center;
    gap:9px;
    padding:10px 14px;
    border:none;
    background:transparent;
    font-size:13px;
    font-weight:600;
    color:var(--text-main);
    cursor:pointer;
    text-align:left;
    transition:.15s;
}

.convo-menu button:hover{
    background:var(--line-soft);
}

body.dark .convo-menu button:hover{
    background:rgba(56,189,248,.08);
}

.convo-menu button.danger{
    color:var(--rejected-text);
}

.sidebar-empty{
    text-align:center;
    padding:50px 20px;
    color:var(--text-sub);
}

.sidebar-empty i{
    font-size:38px;
    color:var(--accent);
    opacity:.4;
    margin-bottom:10px;
}

/* ===== CHAT PANEL ===== */

.chat-panel{
    flex:1;
    display:flex;
    flex-direction:column;
    min-width:0;
}

.chat-header{
    display:flex;
    align-items:flex-start;
    gap:14px;
    padding:16px 22px;
    border-bottom:1px solid var(--line);
    flex-wrap:wrap;
}

.back-btn{
    display:none;
    background:none;
    border:none;
    font-size:18px;
    color:var(--text-sub);
    margin-right:2px;
    cursor:pointer;
}

.chat-photo{
    width:52px;
    height:52px;
    border-radius:14px;
    object-fit:cover;
    border:2px solid var(--glass-border);
}

.chat-placeholder{
    width:52px;
    height:52px;
    border-radius:14px;
    background:var(--accent-soft);
    color:var(--accent);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.chat-photo.lost, .chat-placeholder.lost{ border-color:var(--lost); }
.chat-photo.found, .chat-placeholder.found{ border-color:var(--found); }
.chat-placeholder.lost{ background:var(--lost-soft); color:var(--lost); }
.chat-placeholder.found{ background:var(--found-soft); color:var(--found); }

.chat-header-info{ flex:1; min-width:150px; }

.chat-title{ font-family:'Syne',sans-serif; font-size:17px; font-weight:700; }

.status-pill{
    padding:4px 11px;
    border-radius:20px;
    font-size:11.5px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:5px;
    margin-top:4px;
}

.status-pill.pending{ background:var(--pending-bg); color:var(--pending-text); }
.status-pill.approved{ background:var(--approved-bg); color:var(--approved-text); }
.status-pill.rejected{ background:var(--rejected-bg); color:var(--rejected-text); }

.claim-actions{ margin-top:10px; display:flex; gap:8px; flex-wrap:wrap; }

.btn-approve-sm{
    background:var(--found); border:none; color:#fff; border-radius:9px;
    padding:6px 14px; font-weight:600; font-size:12.5px; transition:.2s;
}
.btn-approve-sm:hover{ background:#16a34a; color:#fff; }

.btn-reject-sm{
    background:transparent; border:1.5px solid var(--rejected-text); color:var(--rejected-text);
    border-radius:9px; padding:5px 14px; font-weight:600; font-size:12.5px; transition:.2s;
}
.btn-reject-sm:hover{ background:var(--rejected-bg); }

/* ===== HEADER OPTIONS (block / report) ===== */

.header-options{
    margin-left:auto;
    position:relative;
    flex-shrink:0;
}

.options-btn{
    width:36px;
    height:36px;
    border-radius:50%;
    border:none;
    background:transparent;
    color:var(--text-sub);
    font-size:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.2s;
}

.options-btn:hover{
    background:var(--line-soft);
    color:var(--text-main);
}

.options-menu{
    position:absolute;
    top:44px;
    right:0;
    min-width:190px;
    background:#fff;
    border:1px solid var(--line);
    border-radius:14px;
    box-shadow:0 12px 32px rgba(37,99,235,.14);
    overflow:hidden;
    z-index:20;
}

body.dark .options-menu{
    background:#1e293b;
    border-color:rgba(56,189,248,.16);
}

.options-menu button{
    width:100%;
    display:flex;
    align-items:center;
    gap:10px;
    padding:11px 16px;
    border:none;
    background:transparent;
    font-size:13.5px;
    font-weight:600;
    color:var(--text-main);
    cursor:pointer;
    text-align:left;
    transition:.15s;
}

.options-menu button:hover{
    background:var(--line-soft);
}

body.dark .options-menu button:hover{
    background:rgba(56,189,248,.08);
}

.options-menu button i{
    width:16px;
    text-align:center;
}

.options-menu button.danger{
    color:var(--rejected-text);
}

.options-menu .menu-divider{
    height:1px;
    background:var(--line);
}

body.dark .options-menu .menu-divider{
    background:rgba(56,189,248,.16);
}

/* ===== BLOCKED BANNER ===== */

.blocked-banner{
    display:flex;
    align-items:center;
    gap:10px;
    background:var(--rejected-bg);
    color:var(--rejected-text);
    padding:12px 20px;
    font-size:13.5px;
    font-weight:600;
    flex-wrap:wrap;
}

.blocked-banner i{ font-size:15px; }

.blocked-banner .unblock-link{
    margin-left:auto;
    background:none;
    border:1.5px solid var(--rejected-text);
    color:var(--rejected-text);
    border-radius:8px;
    padding:5px 12px;
    font-size:12px;
    font-weight:700;
    cursor:pointer;
    transition:.2s;
}

.blocked-banner .unblock-link:hover{
    background:var(--rejected-text);
    color:#fff;
}

/* ===== REPORT MODAL (redesigned) ===== */

.report-modal-icon{
    width:44px;
    height:44px;
    border-radius:12px;
    background:var(--rejected-bg);
    color:var(--rejected-text);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    flex-shrink:0;
}

.report-target-line{
    font-size:13.5px;
    color:var(--text-sub);
    margin-bottom:16px;
    line-height:1.5;
}

.report-section-label{
    font-size:11.5px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.04em;
    color:var(--text-sub);
    margin-bottom:10px;
}

.report-reason-group{
    display:flex;
    flex-direction:column;
    gap:8px;
    margin-bottom:18px;
}

.report-reason-option{
    display:flex;
    align-items:center;
    gap:12px;
    padding:11px 13px;
    border:1.5px solid var(--line);
    border-radius:12px;
    cursor:pointer;
    font-size:13.5px;
    font-weight:600;
    color:var(--text-main);
    transition:.15s;
    position:relative;
}

.report-reason-option:hover{
    border-color:var(--accent-light);
    background:var(--accent-soft);
}

.report-reason-option.selected{
    border-color:var(--rejected-text);
    background:var(--rejected-bg);
}

.report-reason-option .reason-icon{
    width:32px;
    height:32px;
    border-radius:9px;
    background:var(--line-soft);
    color:var(--text-sub);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13.5px;
    flex-shrink:0;
    transition:.15s;
}

.report-reason-option.selected .reason-icon{
    background:var(--rejected-text);
    color:#fff;
}

.report-reason-option input{
    position:absolute;
    opacity:0;
    pointer-events:none;
}

.report-reason-option .reason-check{
    margin-left:auto;
    width:18px;
    height:18px;
    border-radius:50%;
    border:2px solid var(--line);
    flex-shrink:0;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:10px;
    color:#fff;
    transition:.15s;
}

.report-reason-option.selected .reason-check{
    background:var(--rejected-text);
    border-color:var(--rejected-text);
}

.report-details-wrap textarea{
    border-radius:12px;
    font-size:13.5px;
    border-color:var(--line);
    resize:none;
}

.report-details-wrap textarea:focus{
    border-color:var(--accent);
    box-shadow:0 0 0 3px var(--accent-soft);
}

.modal-content{
    border-radius:18px;
    border:none;
}

.modal-header{
    border-bottom:1px solid var(--line);
    align-items:center;
}

body.dark .modal-content{
    background:#1e293b;
    color:var(--text-main);
}

body.dark .modal-header{
    border-color:rgba(56,189,248,.16);
}

body.dark .report-reason-option{
    border-color:rgba(56,189,248,.16);
}

body.dark .report-reason-option .reason-icon{
    background:rgba(56,189,248,.08);
}

[x-cloak]{ display:none !important; }

/* ===== TOAST NOTIFICATIONS (replaces alert()) ===== */

.toast-stack{
    position:fixed;
    top:20px;
    right:20px;
    z-index:2000;
    display:flex;
    flex-direction:column;
    gap:10px;
    width:320px;
    max-width:90vw;
}

.toast-item{
    display:flex;
    align-items:flex-start;
    gap:11px;
    padding:14px 16px;
    border-radius:14px;
    background:#fff;
    box-shadow:0 12px 32px rgba(15,23,42,.16);
    border:1px solid var(--line);
    font-size:13.5px;
    font-weight:600;
    color:var(--text-main);
}

body.dark .toast-item{
    background:#1e293b;
    border-color:rgba(56,189,248,.16);
}

.toast-item i{
    font-size:16px;
    margin-top:1px;
    flex-shrink:0;
}

.toast-item.success i{ color:var(--found); }
.toast-item.error i{ color:var(--rejected-text); }

.toast-item .toast-close{
    margin-left:auto;
    background:none;
    border:none;
    color:var(--text-sub);
    cursor:pointer;
    font-size:12px;
    padding:2px;
}

.messages{
    flex:1;
    overflow-y:auto;
    padding:22px 24px;
    display:flex;
    flex-direction:column;
}

.messages::-webkit-scrollbar{ width:5px; }
.messages::-webkit-scrollbar-thumb{ background:rgba(37,99,235,.25); border-radius:10px; }

.message-row{ display:flex; margin-bottom:12px; }
.mine{ justify-content:flex-end; }
.other{ justify-content:flex-start; }

.bubble{
    max-width:68%;
    padding:11px 15px;
    border-radius:16px;
    word-wrap:break-word;
    font-size:14px;
    line-height:1.4;
}

.mine .bubble{ background:var(--accent); color:#fff; border-bottom-right-radius:5px; }
.other .bubble{ background:var(--bubble-other); color:var(--text-main); border-bottom-left-radius:5px; }

.sender{ font-size:11.5px; font-weight:700; margin-bottom:4px; opacity:.8; }
.time{ margin-top:5px; font-size:10px; opacity:.65; }

.chat-footer{ border-top:1px solid var(--line); padding:14px 18px; }

.chat-form{
    display:flex; align-items:flex-end; gap:10px;
    background:var(--line-soft); border-radius:20px; padding:7px 7px 7px 16px;
}

.chat-form textarea{
    flex:1; border:none; background:transparent; resize:none; outline:none;
    font-size:14px; color:var(--text-main); max-height:110px; padding:7px 0;
    font-family:'Plus Jakarta Sans',sans-serif;
}

.send-btn{
    width:38px; height:38px; border-radius:50%; background:var(--accent); color:#fff;
    border:none; display:flex; align-items:center; justify-content:center; font-size:14px;
    flex-shrink:0; transition:.2s; cursor:pointer;
}
.send-btn:hover{ background:var(--accent-dark); }
.send-btn:disabled{ opacity:.5; cursor:not-allowed; }

/* placeholder when no chat selected */
.no-chat-selected{
    flex:1;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    color:var(--text-sub);
    text-align:center;
    padding:40px;
}

.no-chat-selected i{
    font-size:70px;
    color:var(--accent);
    opacity:.35;
    margin-bottom:16px;
}

/* Dark mode */
body.dark{
    --glass-bg:rgba(30,41,59,.65);
    --glass-border:rgba(56,189,248,.18);
    --line:rgba(56,189,248,.15);
    --line-soft:rgba(56,189,248,.08);
    --bubble-other:rgba(56,189,248,.10);
    --text-main:#f1f5f9;
    --text-sub:#94a3b8;
    --page-bg-1:#0f172a;
    --page-bg-2:#111c33;
    --pending-bg:rgba(251,191,36,.15);
    --pending-text:#fbbf24;
    --approved-bg:rgba(220,252,231,.12);
    --approved-text:#4ade80;
    --rejected-bg:rgba(254,226,226,.12);
    --rejected-text:#f87171;
}

body.dark .sidebar{ border-color:var(--line); }
body.dark .sidebar-head{ border-color:var(--line); }
body.dark .search-bar input{ background:var(--line-soft); }
body.dark .convo-item{ border-color:var(--line-soft); }
body.dark .chat-header{ border-color:var(--line); }
body.dark .chat-footer{ border-color:var(--line); }
body.dark .chat-form{ background:var(--line-soft); }
body.dark .other .bubble{ background:var(--bubble-other); }

/* ===== RESPONSIVE: collapse to WhatsApp-mobile style ===== */

@media(max-width:768px){
    .page-wrap{ width:100%; margin:14px auto; padding:0 10px; }
    .page-title{ font-size:22px; margin-bottom:12px; }

    .app-shell{
        height:82vh;
        border-radius:16px;
        position:relative;
    }

    .sidebar{
        width:100%;
        position:absolute;
        inset:0;
        z-index:2;
        background:var(--glass-bg);
        transition:.25s ease;
    }

    .chat-panel{
        position:absolute;
        inset:0;
        z-index:1;
        background:var(--glass-bg);
        transform:translateX(100%);
        transition:.25s ease;
    }

    /* toggled via JS: shell gets .chat-open when a conversation is active on mobile */
    .app-shell.chat-open .sidebar{
        transform:translateX(-100%);
    }

    .app-shell.chat-open .chat-panel{
        transform:translateX(0);
    }

    .back-btn{ display:inline-block; }

    /* no hover on touch devices — keep the menu button reachable */
    .convo-menu-btn{ opacity:.6; }

    .toast-stack{
        left:12px;
        right:12px;
        width:auto;
        top:12px;
    }

    .chat-header{ padding:12px 14px; gap:10px; }
    .messages{ padding:16px 14px; }
    .chat-footer{ padding:10px 12px; }

    /* Bubbles get a bigger share of the (now narrower) screen so text
       doesn't wrap into a tall, skinny column. */
    .bubble{ max-width:82%; }
}

@media(max-width:400px){
    .chat-photo, .chat-placeholder{ width:42px; height:42px; }
    .chat-title{ font-size:15.5px; }
    .bubble{ max-width:88%; font-size:13.5px; }
}
</style>

</head>

<body>

@include('nav')

{{-- Global toast notification stack — replaces browser alert() for a native, non-blocking feel --}}
<div class="toast-stack" x-data="toastHub()" x-cloak>
    <template x-for="t in toasts" :key="t.id">
        <div class="toast-item" :class="t.type" x-show="true" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <i :class="t.type === 'success' ? 'fa-solid fa-circle-check' : 'fa-solid fa-triangle-exclamation'"></i>
            <span x-text="t.message"></span>
            <button type="button" class="toast-close" @click="dismiss(t.id)"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </template>
</div>

<div class="page-wrap" x-data="whatsappInbox()">

    <h1 class="page-title">
        <i class="fa-solid fa-comments text-primary"></i>
        Messages
    </h1>

    <div class="app-shell" :class="{ 'chat-open': hasActiveChat }">

        {{-- ===== SIDEBAR ===== --}}
        <div class="sidebar">

            <div class="sidebar-head">
                <div class="sidebar-head-top">
                    <div class="sidebar-heading">Chats</div>
                    <a href="{{ route('claim.requests') }}" class="claim-link text-primary">
                        <i class="fa-solid fa-file-circle-check"></i> Claims
                    </a>
                </div>

                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" x-model="search" @input="applyFilters()" placeholder="Search conversations...">
                </div>

                <div class="filters">
                    <button class="filter-btn" :class="{active: filter==='all'}" @click="setFilter('all')">All</button>
                    <button class="filter-btn" :class="{active: filter==='unread'}" @click="setFilter('unread')">Unread</button>
                    <button class="filter-btn" :class="{active: filter==='lost'}" @click="setFilter('lost')">Lost</button>
                    <button class="filter-btn" :class="{active: filter==='found'}" @click="setFilter('found')">Found</button>
                </div>
            </div>

            <div class="convo-list" id="convoList">

                @forelse($conversations as $convo)
                    @php $type = strtolower($convo->item_type ?? ''); @endphp

                    <div class="convo-item {{ $convo->unread > 0 ? 'unread' : '' }} {{ (isset($conversation) && $conversation->id == $convo->id) ? 'active' : '' }}"
                       data-name="{{ strtolower($convo->title) }}"
                       data-unread="{{ $convo->unread > 0 ? '1' : '0' }}"
                       data-type="{{ $type }}">

                        {{-- Stretched click target: opens the conversation --}}
                        <a href="{{ route('messages.show', $convo->id) }}" class="convo-link-overlay" aria-label="Open conversation with {{ $convo->title }}"></a>

                        <div class="avatar-wrap">
                            @if($convo->photo)
                                <img src="{{ asset('uploads/items/'.$convo->photo) }}" class="convo-photo {{ $type }}">
                            @else
                                <div class="convo-placeholder {{ $type }}">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                            @endif
                        </div>

                        <div class="convo-info">
                            <div class="convo-name">{{ $convo->title }}</div>
                            <div class="convo-last">{{ $convo->last_message ?? 'No messages yet' }}</div>
                        </div>

                        <div class="convo-meta">
                            @if($convo->updated_at)
                                <div class="convo-time">{{ \Carbon\Carbon::parse($convo->updated_at)->diffForHumans(null, true) }}</div>
                            @endif
                            @if($convo->unread > 0)
                                <span class="convo-badge">{{ $convo->unread }}</span>
                            @endif
                        </div>

                        {{-- WhatsApp-Web style per-chat options: block / report without opening the chat --}}
                        <div class="convo-menu-wrap">
                            <button type="button" class="convo-menu-btn" @click="toggleMenu({{ $convo->id }}, $event)" title="More options" aria-label="More options">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>

                            <div class="convo-menu" x-show="openMenu === {{ $convo->id }}" x-cloak x-transition @click.away="openMenu = null">
                                <button type="button" @click="blockConvo({{ $convo->id }}, $event)">
                                    <i class="fa-solid fa-ban"></i> Block
                                </button>
                                <button type="button" class="danger" @click="openReportFor({{ $convo->id }}, {{ Js::from($convo->title) }}, $event)">
                                    <i class="fa-solid fa-flag"></i> Report
                                </button>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="sidebar-empty">
                        <i class="fa-solid fa-comments"></i>
                        <p>No conversations yet.</p>
                    </div>
                @endforelse

            </div>
        </div>

        {{-- ===== CHAT PANEL ===== --}}
        <div class="chat-panel">

            @if(isset($conversation))

                @php
                    $activeType = strtolower($conversation->item_type ?? '');
                    $isOwner = isset($conversation->owner_id) && $conversation->owner_id == Auth::id();
                    $isBlocked = (bool)($conversation->is_blocked ?? false);
                    $blockedByMe = (bool)($conversation->blocked_by_me ?? $isBlocked);
                @endphp

                <div x-data="chatOptionsMenu()" @click.away="menuOpen = false" style="display:contents">

                <div class="chat-header">
                    <button class="back-btn" onclick="window.location='{{ route('messages.index') }}'">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    @if($conversation->photo)
                        <img src="{{ asset('uploads/items/'.$conversation->photo) }}" class="chat-photo {{ $activeType }}">
                    @else
                        <div class="chat-placeholder {{ $activeType }}">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                    @endif

                    <div class="chat-header-info">
                        <div class="chat-title">{{ $conversation->title }}</div>
                        <span class="status-pill {{ $conversation->status }}">
                            @if($conversation->status == 'pending') <i class="fa-solid fa-clock"></i>
                            @elseif($conversation->status == 'approved') <i class="fa-solid fa-check"></i>
                            @else <i class="fa-solid fa-xmark"></i>
                            @endif
                            {{ ucfirst($conversation->status) }}
                        </span>

                        @if($conversation->status == 'pending' && $isOwner)
                        <div class="claim-actions">
                            <form action="{{ route('claim.approve', $conversation->id) }}" method="POST" onsubmit="return confirm('Approve this claim?')">
                                @csrf
                                <button class="btn-approve-sm"><i class="fa-solid fa-check"></i> Approve</button>
                            </form>
                            <form action="{{ route('claim.reject', $conversation->id) }}" method="POST" onsubmit="return confirm('Reject this claim?')">
                                @csrf
                                <button class="btn-reject-sm"><i class="fa-solid fa-xmark"></i> Reject</button>
                            </form>
                        </div>
                        @endif
                    </div>

                    <div class="header-options">
                        <button type="button" class="options-btn" @click="menuOpen = !menuOpen" title="More options" aria-label="More options">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>

                        <div class="options-menu" x-show="menuOpen" x-cloak x-transition>
                            @if(!$blockedByMe)
                            <button type="button" class="danger" @click="menuOpen = false; confirmBlock()">
                                <i class="fa-solid fa-ban"></i> Block user
                            </button>
                            @else
                            <button type="button" @click="menuOpen = false; confirmUnblock()">
                                <i class="fa-solid fa-circle-check"></i> Unblock user
                            </button>
                            @endif
                            <div class="menu-divider"></div>
                            <button type="button" class="danger" @click="menuOpen = false; window.dispatchEvent(new CustomEvent('open-report', { detail: { id: {{ $conversation->id }}, name: {{ Js::from($conversation->title) }} } }))">
                                <i class="fa-solid fa-flag"></i> Report conversation
                            </button>
                        </div>
                    </div>
                </div>

                @if($blockedByMe)
                <div class="blocked-banner">
                    <i class="fa-solid fa-ban"></i>
                    <span>You've blocked this user. You won't receive messages from them.</span>
                    <button type="button" class="unblock-link" @click="confirmUnblock()">Unblock</button>
                </div>
                @elseif($isBlocked)
                <div class="blocked-banner">
                    <i class="fa-solid fa-ban"></i>
                    <span>This user has blocked you. You can no longer send messages in this conversation.</span>
                </div>
                @endif

                <div class="messages" id="chatBody">
                    @forelse($messages as $message)
                        <div class="message-row {{ $message->sender_id == Auth::id() ? 'mine' : 'other' }}" data-id="{{ $message->id }}">
                            <div class="bubble">
                                <div class="sender">{{ $message->fullname }}</div>
                                <div class="msg-text">{{ $message->message }}</div>
                                <div class="time">{{ \Carbon\Carbon::parse($message->created_at)->format('d M, h:i A') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="no-chat-selected" style="flex:none; padding:40px;">
                        <i class="fa-solid fa-comment-dots text-primary"></i>       
                        <p>No messages yet. Say hello!</p>
                        </div>
                    @endforelse
                </div>

                <div class="chat-footer">
                    @if(!$isBlocked)
                    <form id="chatForm">
                        @csrf
                        <div class="chat-form">
                            <textarea id="message" name="message" rows="1" placeholder="Type your message..." required></textarea>
                            <button type="submit" class="send-btn" id="sendBtn">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                    @else
                    <div style="text-align:center;color:var(--text-sub);font-size:13px;padding:8px;">
                        <i class="fa-solid fa-lock"></i> Messaging is disabled in this conversation.
                    </div>
                    @endif
                </div>

                </div>

            @else

                <div class="no-chat-selected">
                    <i class="fa-solid fa-comments text-primary"></i>                    
                    <h3>Select a conversation</h3>
                    <p>Pick a chat from the left to start messaging.</p>
                </div>

            @endif

        </div>

    </div>

    {{-- Sidebar report modal — used when reporting a conversation directly from the chat list --}}
    <div class="modal fade" id="sidebarReportModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div class="report-modal-icon"><i class="fa-solid fa-flag"></i></div>
                        <h5 class="modal-title" style="margin:0;">Report conversation</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="report-target-line">
                        Tell us what's wrong with <strong x-text="reportTargetName"></strong>. Our team will review it shortly.
                    </p>

                    <div class="report-section-label">Reason</div>
                    <div class="report-reason-group">
                        @php
                            $sidebarReasons = [
                                'spam' => ['fa-solid fa-ban', 'Spam or scam'],
                                'inappropriate' => ['fa-solid fa-triangle-exclamation', 'Inappropriate content'],
                                'harassment' => ['fa-solid fa-user-shield', 'Harassment or abuse'],
                                'fake_item' => ['fa-solid fa-box-open', 'Fake or fraudulent item'],
                                'other' => ['fa-solid fa-ellipsis', 'Other'],
                            ];
                        @endphp
                        @foreach($sidebarReasons as $value => [$icon, $label])
                        <label class="report-reason-option" :class="{ selected: reportReason === '{{ $value }}' }">
                            <span class="reason-icon"><i class="{{ $icon }}"></i></span>
                            <input type="radio" name="sidebarReportReason" value="{{ $value }}" x-model="reportReason">
                            {{ $label }}
                            <span class="reason-check"><i class="fa-solid fa-check" x-show="reportReason === '{{ $value }}'"></i></span>
                        </label>
                        @endforeach
                    </div>

                    <div class="report-section-label">Details (optional)</div>
                    <div class="report-details-wrap">
                        <textarea class="form-control" rows="3" placeholder="Add any extra context that will help our team..." x-model="reportDetails"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-reject-sm" style="background:var(--rejected-text);color:#fff;border:none;padding:8px 16px;" :disabled="!reportReason || submittingReport" @click="submitSidebarReport()">
                        <span x-show="!submittingReport"><i class="fa-solid fa-flag" style="margin-right:6px;"></i>Submit report</span>
                        <span x-show="submittingReport">Submitting...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ===== Global toast hub — dispatch window event 'notify' with {type, message} ===== */
function toastHub(){
    return {
        toasts: [],
        init(){
            window.addEventListener('notify', (e) => {
                const id = Date.now() + Math.random();
                this.toasts.push({ id, type: e.detail.type || 'success', message: e.detail.message || '' });
                setTimeout(() => this.dismiss(id), 4500);
            });
        },
        dismiss(id){
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }
}

function notify(type, message){
    window.dispatchEvent(new CustomEvent('notify', { detail: { type, message } }));
}

function whatsappInbox(){
    return {
        search: '',
        filter: 'all',
        hasActiveChat: {{ isset($conversation) ? 'true' : 'false' }},

        // per-conversation options menu (WhatsApp-Web style, from the chat list)
        openMenu: null,
        reportTargetId: null,
        reportTargetName: '',
        reportReason: '',
        reportDetails: '',
        submittingReport: false,

        init(){
            // allows the chat header's "Report conversation" button (a separate
            // Alpine component) to trigger this component's report modal
            window.addEventListener('open-report', (e) => {
                this.openReportFor(e.detail.id, e.detail.name);
            });
        },

        setFilter(f){
            this.filter = f;
            this.applyFilters();
        },
        applyFilters(){
            const term = this.search.toLowerCase().trim();
            const filter = this.filter;

            document.querySelectorAll('#convoList .convo-item').forEach(item => {
                const name = item.getAttribute('data-name') || '';
                const unread = item.getAttribute('data-unread') === '1';
                const type = item.getAttribute('data-type') || '';

                let matchesFilter = true;
                if(filter === 'unread') matchesFilter = unread;
                if(filter === 'lost') matchesFilter = type === 'lost';
                if(filter === 'found') matchesFilter = type === 'found';

                const matchesSearch = name.includes(term);
                item.style.display = (matchesFilter && matchesSearch) ? 'flex' : 'none';
            });
        },

        toggleMenu(id, e){
            e.preventDefault();
            e.stopPropagation();
            this.openMenu = (this.openMenu === id) ? null : id;
        },

        blockConvo(id, e){
            e.preventDefault();
            e.stopPropagation();
            this.openMenu = null;

            if(!confirm('Block this conversation? You will no longer receive messages from them.')) return;

            const url = "{{ route('messages.block', ['claim' => '__ID__']) }}".replace('__ID__', id);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    location.reload();
                } else {
                    notify('error', data.message || 'Could not block this conversation. Please try again.');
                }
            })
            .catch(() => notify('error', 'Something went wrong. Please check your connection and try again.'));
        },

        openReportFor(id, name, e){
            if(e){
                e.preventDefault();
                e.stopPropagation();
            }
            this.openMenu = null;

            this.reportTargetId = id;
            this.reportTargetName = name;
            this.reportReason = '';
            this.reportDetails = '';

            const modalEl = document.getElementById('sidebarReportModal');
            bootstrap.Modal.getOrCreateInstance(modalEl).show();
        },

        submitSidebarReport(){
            if(!this.reportReason || this.submittingReport || !this.reportTargetId) return;
            this.submittingReport = true;

            const url = "{{ route('messages.report', ['claim' => '__ID__']) }}".replace('__ID__', this.reportTargetId);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    reason: this.reportReason,
                    details: this.reportDetails
                })
            })
            .then(res => res.json().then(data => ({ status: res.status, data })))
            .then(({ status, data }) => {
                this.submittingReport = false;
                bootstrap.Modal.getOrCreateInstance(document.getElementById('sidebarReportModal')).hide();

                if(data.success){
                    notify('success', 'Thanks — your report has been submitted and will be reviewed by our team.');
                } else {
                    notify('error', data.message || 'Could not submit your report. Please try again.');
                }
            })
            .catch(() => {
                this.submittingReport = false;
                notify('error', 'Something went wrong. Please check your connection and try again.');
            });
        }
    }
}

function chatOptionsMenu(){
    return {
        menuOpen: false,

        confirmBlock(){
            if(!confirm('Block this user? They will no longer be able to message you.')) return;

            fetch("{{ isset($conversation) ? route('messages.block', $conversation->id) : '' }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    location.reload();
                } else {
                    notify('error', data.message || 'Could not block this user. Please try again.');
                }
            })
            .catch(() => notify('error', 'Something went wrong. Please check your connection and try again.'));
        },

        confirmUnblock(){
            if(!confirm('Unblock this user? They will be able to message you again.')) return;

            fetch("{{ isset($conversation) ? route('messages.unblock', $conversation->id) : '' }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    location.reload();
                } else {
                    notify('error', data.message || 'Could not unblock this user. Please try again.');
                }
            })
            .catch(() => notify('error', 'Something went wrong. Please check your connection and try again.'));
        }
    }
}

@if(isset($conversation))
(function(){
    const form = document.getElementById('chatForm');
    const messageInput = document.getElementById('message');
    const chatBody = document.getElementById('chatBody');
    const sendBtn = document.getElementById('sendBtn');
    const currentUserId = {{ Auth::id() }};

    let knownIds = new Set();
    document.querySelectorAll('#chatBody .message-row').forEach(row => {
        knownIds.add(row.getAttribute('data-id'));
    });

    function escapeHtml(str){
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }

    function isNearBottom(){
        return chatBody.scrollHeight - chatBody.scrollTop - chatBody.clientHeight < 80;
    }

    function scrollToBottom(){
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    if(form && messageInput && sendBtn){
        messageInput.addEventListener('input', function(){
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 110) + 'px';
        });

        messageInput.addEventListener('keydown', function(e){
            if(e.key === 'Enter' && !e.shiftKey){
                e.preventDefault();
                form.requestSubmit();
            }
        });

        form.addEventListener('submit', function(e){
            e.preventDefault();
            const text = messageInput.value.trim();
            if(!text) return;

            sendBtn.disabled = true;

            fetch("{{ route('messages.send.ajax', $conversation->id) }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: new FormData(form)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    messageInput.value = "";
                    messageInput.style.height = 'auto';
                    loadMessages(true);
                }
            })
            .catch(() => notify('error', 'Message failed to send. Check your connection and try again.'))
            .finally(() => {
                sendBtn.disabled = false;
                messageInput.focus();
            });
        });
    }

    function loadMessages(forceScroll = false){
        const shouldStickToBottom = forceScroll || isNearBottom();

        fetch("{{ route('messages.load', $conversation->id) }}")
        .then(response => response.json())
        .then(messages => {
            const emptyState = chatBody.querySelector('.no-chat-selected');

            messages.forEach(msg => {
                const idStr = String(msg.id);
                if(knownIds.has(idStr)) return;
                knownIds.add(idStr);

                if(emptyState) emptyState.remove();

                const mine = msg.sender_id == currentUserId;
                const row = document.createElement('div');
                row.className = 'message-row ' + (mine ? 'mine' : 'other');
                row.setAttribute('data-id', idStr);

                row.innerHTML = `
                    <div class="bubble">
                        <div class="sender">${escapeHtml(msg.fullname)}</div>
                        <div class="msg-text">${escapeHtml(msg.message)}</div>
                        <div class="time">${escapeHtml(msg.created_at)}</div>
                    </div>
                `;

                chatBody.appendChild(row);
            });

            if(shouldStickToBottom) scrollToBottom();
        })
        .catch(() => {});
    }

    scrollToBottom();
    setInterval(() => loadMessages(false), 3000);
})();
@endif
</script>

</body>
</html>