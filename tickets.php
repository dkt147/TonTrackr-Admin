<?php
$pageTitle = 'Tickets';
$activePage = 'tickets';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Tickets</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
            --tan: #BAAC88;
            --black: #000000;
            --sidebar-bg: #0a0a0a;
            --sidebar-bg-soft: #141414;
            --sidebar-text: #A0A0A0;
            --sidebar-text-dim: #555555;
            --card-bg: #111111;
            --border-color: #2A2A2A;
            --radius-lg: 20px;
            --radius-md: 14px;
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: var(--black); color: #fff; }
        a { color: inherit; text-decoration: none; }
        button { font-family: 'Poppins', sans-serif; cursor: pointer; }
        .main-wrapper { display: flex; min-height: 100vh; background: var(--black); }
        .sidebar { width: var(--sidebar-w); flex-shrink: 0; background: var(--sidebar-bg); color: var(--sidebar-text); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 40; border-right: 1px solid var(--border-color); transition: transform .25s ease; }
        .sidebar-brand { display: flex; align-items: center; gap: 12px; padding: 13px 20px; border-bottom: 1px solid var(--border-color); }
        .brand-mark { width: 40px; height: 40px; flex-shrink: 0; }
        .brand-mark img { width: 100%; height: 100%; object-fit: contain; }
        .brand-name { font-weight: 700; font-size: 20px; color: #ffffff; letter-spacing: -0.5px; }
        .brand-tag { font-size: 10px; letter-spacing: 0.08em; color: var(--green); text-transform: uppercase; }
        .nav-scroll { flex: 1; overflow-y: auto; padding: 24px 16px; }
        .nav-group { margin-bottom: 32px; }
        .nav-group-label { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--sidebar-text-dim); padding: 0 8px; margin-bottom: 12px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: var(--radius-md); font-size: 14px; font-weight: 500; color: var(--sidebar-text); margin-bottom: 4px; transition: all .15s ease; }
        .nav-link svg { flex-shrink: 0; opacity: .7; }
        .nav-link:hover { background: var(--dark-green); color: #fff; box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4); }
        .nav-link.active { background: var(--dark-green); color: #fff; box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4); }
        .nav-link.active svg { opacity: 1; color: var(--green); }
        .nav-badge { margin-left: auto; background: var(--teal); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px; }
        .sidebar-footer { padding: 16px 20px 24px; border-top: 1px solid var(--border-color); display: flex; align-items: center; gap: 12px; }
        .avatar-sm { width: 40px; height: 40px; border-radius: 50%; background: var(--teal); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0; }
        .sidebar-user-name { font-size: 14px; font-weight: 600; color: #fff; }
        .sidebar-user-role { font-size: 11px; color: var(--sidebar-text-dim); }
        .logout-btn { margin-left: auto; width: 34px; height: 34px; border-radius: 10px; background: var(--sidebar-bg-soft); display: flex; align-items: center; justify-content: center; color: var(--sidebar-text); border: none; cursor: pointer; }
        .logout-btn:hover { background: #c41e3a; color: #fff; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.8); z-index: 35; }
        .page-wrapper { flex: 1; margin-left: var(--sidebar-w); display: flex; flex-direction: column; min-width: 0; }
        .topbar { height: var(--topbar-h); background: #050505; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 18px; padding: 0 32px; position: sticky; top: 0; z-index: 30; }
        .menu-toggle { display: none; width: 38px; height: 38px; border-radius: 10px; background: transparent; border: 1px solid var(--border-color); align-items: center; justify-content: center; cursor: pointer; color: #fff; }
        .topbar-title { font-size: 18px; font-weight: 600; color: #fff; letter-spacing: -0.3px; flex-shrink: 0; }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 16px; }
        .topbar-profile { display: flex; align-items: center; gap: 10px; padding-left: 14px; border-left: 1px solid var(--border-color); cursor: pointer; }
        .topbar-profile .name { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.2; }
        .topbar-profile .role { font-size: 11px; color: #888; }
        .page-content { padding: 32px; flex: 1; }
        .page-head { display:flex; justify-content: space-between; align-items:flex-end; gap:20px; margin-bottom:28px; flex-wrap:wrap; }
        .page-eyebrow { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--green); margin: 0 0 4px; }
        .page-title { font-size: 32px; font-weight: 700; margin: 0; }
        .page-sub { font-size: 14px; color: #888; margin: 0; }
        .filter-row { display:flex; flex-wrap:wrap; gap:12px; align-items:center; margin-bottom:22px; }
        .search-box { flex:1; min-width:220px; position:relative; }
        .search-box input { width:100%; padding:14px 16px 14px 42px; border-radius:999px; border:1px solid var(--border-color); background:#111; color:#fff; }
        .search-box svg { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#666; }
        .chip-group { display:flex; flex-wrap:wrap; gap:10px; }
        .chip { padding:10px 14px; border-radius:999px; background:#111; border:1px solid var(--border-color); color:#fff; font-size:13px; cursor:pointer; }
        .chip.active { background: var(--green); border-color: var(--green); }
        .ticket-list { display:grid; gap:14px; margin-bottom:22px; }
        .ticket-card { display:flex; align-items:center; justify-content:space-between; gap:18px; background:#111; border:1px solid var(--border-color); border-radius:18px; padding:18px 20px; }
        .ticket-meta { display:flex; flex-direction:column; gap:6px; }
        .ticket-number { font-size:18px; font-weight:700; color:#fff; }
        .ticket-sub { font-size:13px; color:#888; }
        .ticket-details { display:flex; gap:10px; flex-wrap:wrap; font-size:13px; color:#888; }
        .ticket-value { font-size:18px; font-weight:700; color: var(--green); min-width:120px; text-align:right; }
        .btn-green { background: var(--green); border:none; color:#fff; border-radius:18px; padding:14px 20px; font-weight:700; }
        .btn-dark { background:#222; border:none; color:#fff; border-radius:18px; padding:14px 20px; font-weight:700; }
        @media (max-width:860px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .page-wrapper { margin-left: 0; }
            .menu-toggle { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding:24px; }
        }
        @media (max-width:560px) { .page-head { align-items:flex-start; } .ticket-card { flex-direction:column; align-items:flex-start; } .ticket-value { width:100%; text-align:left; } }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes/header.php'; ?>
            <div class="page-content">
                <div class="page-head">
                    <div>
                        <p class="page-eyebrow">Tickets</p>
                        <h1 class="page-title">Manage all tickets</h1>
                        <p class="page-sub">Search and export ticket records quickly.</p>
                    </div>
                    <button class="btn-green" onclick="window.location.href='add-ticket.php'">+ SCAN / ENTER TICKET</button>
                </div>
                <div class="filter-row">
                    <div class="search-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                        <input type="search" placeholder="Search ticket, truck, mill...">
                    </div>
                    <div class="chip-group">
                        <div class="chip active">ALL</div>
                        <div class="chip">TRUCK</div>
                        <div class="chip">CONTRACTOR</div>
                        <div class="chip">DATE</div>
                    </div>
                </div>
                <div class="ticket-list">
                    <div class="ticket-card">
                        <div class="ticket-meta">
                            <span class="ticket-number">330</span>
                            <div class="ticket-details"><span>05/14/26</span><span>IFG Grangeville</span></div>
                        </div>
                        <div class="ticket-value">$866.18</div>
                    </div>
                    <div class="ticket-card">
                        <div class="ticket-meta">
                            <span class="ticket-number">1450</span>
                            <div class="ticket-details"><span>05/13/26</span><span>Run Of The Mill</span></div>
                        </div>
                        <div class="ticket-value">$1,292.60</div>
                    </div>
                    <div class="ticket-card">
                        <div class="ticket-meta">
                            <span class="ticket-number">330</span>
                            <div class="ticket-details"><span>05/13/26</span><span>Jungle Badger</span></div>
                        </div>
                        <div class="ticket-value">$22,110.90</div>
                    </div>
                    <div class="ticket-card">
                        <div class="ticket-meta">
                            <span class="ticket-number">110</span>
                            <div class="ticket-details"><span>05/14/26</span><span>Jungle Badger</span></div>
                        </div>
                        <div class="ticket-value">$680.15</div>
                    </div>
                </div>
                <button class="btn-dark" style="width:100%;" onclick="window.location.href='tickets-export.php'">EXPORT</button>
            </div>
        </div>
    </div>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
    </script>
</body>
</html>
