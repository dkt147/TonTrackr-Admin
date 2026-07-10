<?php
$pageTitle = 'Tickets - Export';
$activePage = 'tickets';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Export</title>
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
        .filters { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:24px; }
        .filter-pill { padding:10px 16px; border-radius:999px; border:1px solid var(--border-color); background:#111; color:#fff; font-size:13px; display:inline-flex; align-items:center; gap:8px; }
        .filter-pill.active { border-color: var(--green); background: rgba(116,170,80,0.12); color: var(--green); }
        .export-card { background:#111; border:1px solid var(--border-color); border-radius:22px; padding:24px; margin-bottom:24px; }
        .export-header { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; }
        .export-header h2 { margin:0; font-size:22px; }
        .preview-table { width:100%; border-collapse:collapse; margin-top:18px; }
        .preview-table th, .preview-table td { text-align:left; padding:14px 12px; border-bottom:1px solid var(--border-color); font-size:14px; }
        .preview-table th { color:#888; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; }
        .preview-row:last-child td { border-bottom:none; }
        .table-amount { color: var(--green); font-weight:700; }
        .action-row { display:flex; gap:14px; flex-wrap:wrap; }
        .btn-green { background: var(--green); border:none; color:#fff; border-radius:18px; padding:14px 22px; font-weight:700; }
        .btn-dark { background:#222; border:none; color:#fff; border-radius:18px; padding:14px 22px; font-weight:700; }
        @media (max-width:860px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .page-wrapper { margin-left: 0; }
            .menu-toggle { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding:24px; }
        }
        @media (max-width:560px) { .preview-table th, .preview-table td { padding:12px 8px; } .export-header { flex-direction:column; align-items:flex-start; } }
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
                        <p class="page-eyebrow">Admin Export</p>
                        <h1 class="page-title">Tickets - Export</h1>
                        <p class="page-sub">Select filters and preview the export before sending.</p>
                    </div>
                </div>
                <div class="filters">
                    <div class="filter-pill active">TRUCK 330</div>
                    <div class="filter-pill active">IFG</div>
                    <div class="filter-pill active">APR 1-15</div>
                    <div class="filter-pill active">JUNGLE BADGER</div>
                </div>
                <div class="export-card">
                    <div class="export-header">
                        <div>
                            <div style="font-size:13px; letter-spacing:0.1em; text-transform:uppercase; color:#888; margin-bottom:6px;">Preview</div>
                            <h2>12 tickets</h2>
                        </div>
                        <div class="action-row">
                            <button class="btn-dark" onclick="window.location.href='tickets.php'">Back to tickets</button>
                            <button class="btn-green" onclick="alert('Export ready to send');">Update filters</button>
                        </div>
                    </div>
                    <table class="preview-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Truck</th>
                                <th>Mill</th>
                                <th>Tons</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="preview-row"><td>100100</td><td>4/1</td><td>330</td><td>IFG</td><td>19.2</td><td class="table-amount">$22.22</td></tr>
                            <tr class="preview-row"><td>100200</td><td>4/2</td><td>330</td><td>CLW</td><td>15.0</td><td class="table-amount">$34.40</td></tr>
                            <tr class="preview-row"><td>100300</td><td>4/3</td><td>330</td><td>IFG</td><td>17.0</td><td class="table-amount">$22.22</td></tr>
                            <tr class="preview-row"><td>100400</td><td>4/4</td><td>330</td><td>IFG</td><td>20.1</td><td class="table-amount">$22.22</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="action-row">
                    <button class="btn-green" onclick="alert('Email sent to contractor');">EMAIL TO CONTRACTOR</button>
                    <button class="btn-dark" onclick="alert('PDF downloaded');">DOWNLOAD PDF</button>
                </div>
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
