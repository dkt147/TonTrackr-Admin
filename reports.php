<?php
$pageTitle = 'Reports';
$activePage = 'reports';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Reports</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
            --tan: #BAAC88;
            --cream: #D7D2C9;
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
        .page-head { display: flex; justify-content: space-between; align-items: flex-end; gap: 20px; margin-bottom: 28px; flex-wrap: wrap; }
        .page-eyebrow { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--green); margin: 0 0 4px; }
        .page-title { font-size: 32px; font-weight: 700; margin: 0; }
        .page-sub { font-size: 14px; color: #888; margin: 0; }
        .reports-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 24px; margin-top: 32px; }
        .report-card { background: var(--card-bg); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 28px; text-align: center; cursor: pointer; transition: all .25s ease; }
        .report-card:hover { border-color: var(--green); background: rgba(116, 170, 80, 0.08); transform: translateY(-4px); box-shadow: 0 8px 24px rgba(116, 170, 80, 0.15); }
        .report-icon { font-size: 48px; margin-bottom: 16px; }
        .report-card h3 { font-size: 18px; font-weight: 700; margin: 0 0 10px; color: #fff; }
        .report-card p { font-size: 13px; color: #888; margin: 0 0 20px; line-height: 1.5; }
        .report-link { display: inline-flex; align-items: center; gap: 8px; background: var(--green); color: #fff; padding: 12px 20px; border-radius: 999px; font-weight: 600; font-size: 13px; transition: all .2s ease; border: none; text-decoration: none; }
        .report-link:hover { background: #5fa63d; box-shadow: 0 6px 16px rgba(116, 170, 80, 0.3); }
        .report-link svg { width: 16px; height: 16px; }
        .report-card.coming-soon { opacity: 0.6; }
        .report-card.coming-soon:hover { transform: none; border-color: var(--border-color); background: var(--card-bg); box-shadow: none; }
        .coming-soon-badge { display: inline-block; background: var(--teal); color: #fff; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; margin-top: 12px; text-transform: uppercase; }
        @media (max-width:860px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .page-wrapper { margin-left: 0; }
            .menu-toggle { display: flex; }
            .sidebar-overlay.open { display: block; }
            .page-content { padding: 24px; }
        }
        @media (max-width:560px) {
            .page-head { align-items: flex-start; }
            .page-title { font-size: 24px; }
            .reports-grid { grid-template-columns: 1fr; }
        }
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
                        <p class="page-eyebrow">Reports</p>
                        <h1 class="page-title">Reports & Statements</h1>
                        <p class="page-sub">View detailed reports on fleet mileage, driver logs, tickets, and contractor payments.</p>
                    </div>
                </div>

                <div class="reports-grid">
                    <div class="report-card" onclick="window.location.href='report-fleet-mileage.php'">
                        <div class="report-icon">📊</div>
                        <h3>Fleet Mileage Summary</h3>
                        <p>View fleet-wide mileage data by truck and state jurisdiction with IFTA breakdown.</p>
                        <a href="report-fleet-mileage.php" class="report-link">
                            <span>View Report</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    <div class="report-card" onclick="window.location.href='report-quarterly-mileage.php'">
                        <div class="report-icon">📈</div>
                        <h3>Quarterly Mileage Summary</h3>
                        <p>Detailed quarterly breakdown of mileage by date, state, and driver performance.</p>
                        <a href="report-quarterly-mileage.php" class="report-link">
                            <span>View Report</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    <div class="report-card" onclick="window.location.href='tickets-export-admin.php'">
                        <div class="report-icon">🎟️</div>
                        <h3>Contractor Statement</h3>
                        <p>View ticket exports and payment statements for contractors.</p>
                        <a href="tickets-export-admin.php" class="report-link">
                            <span>View Report</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    <div class="report-card" onclick="window.location.href='tickets-export-driver.php'">
                        <div class="report-icon">👤</div>
                        <h3>Driver Statement</h3>
                        <p>Track driver commissions and ticket-by-ticket earnings.</p>
                        <a href="tickets-export-driver.php" class="report-link">
                            <span>View Report</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    <div class="report-card" onclick="window.location.href='tickets-export-fleet-admin.php'">
                        <div class="report-icon">🚚</div>
                        <h3>Fleet Contractor Statement</h3>
                        <p>Complete fleet ticket summary and consolidated payment statements.</p>
                        <a href="tickets-export-fleet-admin.php" class="report-link">
                            <span>View Report</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>

                    <div class="report-card coming-soon">
                        <div class="report-icon">📋</div>
                        <h3>Driver Performance Report</h3>
                        <p>Analyze individual driver performance metrics and efficiency scores.</p>
                        <div class="coming-soon-badge">Coming Soon</div>
                    </div>
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
