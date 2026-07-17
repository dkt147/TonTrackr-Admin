<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr | Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Bitter:ital,wght@1,500;1,600&display=swap"
        rel="stylesheet">
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">

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
            --good: #74AA50;
            --good-bg: rgba(116, 170, 80, 0.15);
            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-card: 0 4px 15px rgba(0, 0, 0, 0.6);
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--black);
            color: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font-family: 'Poppins', sans-serif;
        }

        img {
            max-width: 100%;
            display: block;
        }

        h1,
        h2,
        h3,
        h4 {
            margin: 0;
            color: #ffffff;
            font-weight: 600;
        }

        /* ----- SIDEBAR ----- */
        .main-wrapper {
            display: flex;
            min-height: 100vh;
            background: var(--black);
        }

        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 40;
            border-right: 1px solid var(--border-color);
            transition: transform .25s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-name {
            font-weight: 700;
            font-size: 20px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .brand-tag {
            font-size: 10px;
            letter-spacing: 0.08em;
            color: var(--green);
            text-transform: uppercase;
        }

        .nav-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 24px 16px;
        }

        .nav-group {
            margin-bottom: 32px;
        }

        .nav-group-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--sidebar-text-dim);
            padding: 0 8px;
            margin-bottom: 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            color: var(--sidebar-text);
            margin-bottom: 4px;
            transition: all .15s ease;
        }

        .nav-link svg {
            flex-shrink: 0;
            opacity: .7;
        }

        .nav-link:hover {
            background: var(--sidebar-bg-soft);
            color: #fff;
        }

        .nav-link.active {
            background: var(--dark-green);
            color: #fff;
            box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4);
        }

        .nav-link.active svg {
            opacity: 1;
            color: var(--green);
        }

        .nav-badge {
            margin-left: auto;
            background: var(--teal);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 999px;
        }

        .sidebar-footer {
            padding: 16px 20px 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--teal);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .sidebar-user-role {
            font-size: 11px;
            color: var(--sidebar-text-dim);
        }

        .logout-btn {
            margin-left: auto;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--sidebar-bg-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-text);
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 35;
        }

        /* ----- TOPBAR & MAIN ----- */
        .page-wrapper {
            flex: 1;
            margin-left: var(--sidebar-w);
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: var(--topbar-h);
            background: #050505;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 30;
        }

        .menu-toggle {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid var(--border-color);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
        }

        .topbar-title {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.3px;
            flex-shrink: 0;
        }

        .topbar-search {
            flex: 1;
            max-width: 320px;
            position: relative;
        }

        .topbar-search input {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border-radius: 999px;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            outline: none;
        }

        .topbar-search input:focus {
            border-color: var(--green);
            background: var(--sidebar-bg-soft);
        }

        .topbar-search .icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .topbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid var(--border-color);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            cursor: pointer;
            color: #666;
        }

        .icon-btn:hover {
            background: var(--card-bg);
            color: #fff;
        }

        .icon-btn .dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--green);
            border: 1.5px solid #000;
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 14px;
            border-left: 1px solid var(--border-color);
            cursor: pointer;
        }

        .topbar-profile .name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            line-height: 1.2;
        }

        .topbar-profile .role {
            font-size: 11px;
            color: #888;
        }

        /* ----- CONTENT PAGE ----- */
        .page-content {
            padding: 32px;
            flex: 1;
        }

        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-eyebrow {
            font-size: 12px;
            font-weight: 600;
            color: var(--green);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
        }

        .page-sub {
            font-size: 14px;
            color: #888;
            margin-top: 4px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            padding: 22px 20px 20px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--dark-green);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
        }

        .stat-value {
            font-weight: 700;
            font-size: 28px;
            line-height: 1;
            color: var(--green);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: #888;
            font-weight: 500;
        }

        .panel-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
            align-items: stretch;
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            padding: 24px;
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .card-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--green);
            cursor: pointer;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: #888;
            padding: 0 12px 16px;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
        }

        .table td {
            padding: 16px 12px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .cell-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cell-user .name {
            font-weight: 500;
            color: #fff;
        }

        .cell-user .sub {
            font-size: 12px;
            color: #888;
        }

        .color-green {
            color: var(--green);
            font-weight: 600;
        }

        .badge-good {
            background: var(--good-bg);
            color: var(--good);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 50px;
            display: inline-block;
        }

        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background: #000;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            transition: background .15s ease;
        }

        .quick-action-btn:hover {
            background: var(--dark-green);
            border-color: var(--green);
        }

        .quick-action-btn .qi {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--card-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            flex-shrink: 0;
        }

        .chart-placeholder {
            width: 100%;
            height: 200px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .chart-bar {
            flex: 1;
            background: var(--green);
            border-radius: 4px 4px 0 0;
            min-height: 10px;
            opacity: 0.6;
        }

        .chart-bar.active {
            opacity: 1;
            background: var(--teal);
        }

        @media (max-width:1080px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .panel-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width:860px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .page-wrapper {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }

            .sidebar-overlay.open {
                display: block;
            }
        }

        @media (max-width:560px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .topbar-search {
                display: none;
            }

            .page-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'includes/sidebar.php' ?>
        <div class="page-wrapper">
            <?php include 'includes/header.php' ?>
            <div class="page-content">
                <div class="page-head">
                    <div>
                        <p class="page-eyebrow">Fleet Overview</p>
                        <h1 class="page-title">Good morning, John</h1>
                        <p class="page-sub">Here's what's happening across your fleet today.</p>
                    </div>
                </div>
                <!-- ADD THIS INSIDE dashboard.php, just below <div class="page-head"> -->
                <div style="margin-bottom: 25px;">
                    <button onclick="window.location.href='add-ticket.php'" 
                            style="width:100%; background: var(--green); color: #fff; border:none; padding: 16px; border-radius: var(--radius-lg); font-weight: 700; font-size: 16px; letter-spacing: 0.5px; cursor: pointer; display:flex; align-items:center; justify-content:center; gap: 10px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        ENTER TICKET
                    </button>
                </div>
                <!-- STAT CARDS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statRevenue">$0</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statAdminProfit">$0</div>
                        <div class="stat-label">Admin Profit</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statTotalPayouts">$0</div>
                        <div class="stat-label">Total Payouts</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statPendingPayouts">$0</div>
                        <div class="stat-label">Pending Payouts</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statActiveTasks">0</div>
                        <div class="stat-label">Active Tasks</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statPendingTasks">0</div>
                        <div class="stat-label">Pending Tasks</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statMillCount">0</div>
                        <div class="stat-label">Mills</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value" id="statDriverCount">0</div>
                        <div class="stat-label">Drivers</div>
                    </div>
                </div>

                <!-- PANEL GRID -->
                <div class="panel-grid">

                    <div class="card">
                        <div class="card-head">
                            <span class="card-title">Recent Tickets</span>
                            <span class="card-link" onclick="window.location.href='tickets.php'">View all</span>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ticket #</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="recentTicketsBody">
                                <tr>
                                    <td colspan="5" style="color:#888; text-align:center;">Loading recent tickets…</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="display:flex; flex-direction:column; gap:20px;">

                        <div class="card">
                            <div class="card-head">
                                <span class="card-title">Revenue Trend</span>
                                <span class="card-link">Last 7 days</span>
                            </div>
                            <div class="chart-placeholder">
                                <div class="chart-bar" style="height:30%;"></div>
                                <div class="chart-bar" style="height:60%;"></div>
                                <div class="chart-bar" style="height:45%;"></div>
                                <div class="chart-bar active" style="height:85%;"></div>
                                <div class="chart-bar" style="height:55%;"></div>
                                <div class="chart-bar" style="height:70%;"></div>
                                <div class="chart-bar" style="height:90%;"></div>
                            </div>
                            <p style="color:#888; font-size:13px; margin-top:12px; text-align:center;">$14,200 total
                                this week</p>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <span class="card-title">Quick Actions</span>
                            </div>
                            <div class="quick-actions">
                                <button class="quick-action-btn" onclick="window.location.href='add-ticket.php'">
                                    <span class="qi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" /></svg></span>
                                    Create New Ticket
                                </button>
                                <button class="quick-action-btn" onclick="window.location.href='log-miles.php'">
                                    <span class="qi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M4 17l4-5 3 3 4-6 5 8H4Z" stroke="currentColor" stroke-width="1.8"
                                                stroke-linejoin="round" /></svg></span>
                                    Log Miles
                                </button>
                                <button class="quick-action-btn" onclick="window.location.href='drivers.php'">
                                    <span class="qi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <circle cx="9" cy="8" r="3.4" stroke="currentColor" stroke-width="1.8" />
                                        </svg></span>
                                    Manage Drivers
                                </button>
                                <button class="quick-action-btn" onclick="window.location.href='add-mill.php'">
                                    <span class="qi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" /></svg></span>
                                    Add Mill
                                </button>
                            </div>
                        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bars = document.querySelectorAll('.chart-placeholder .chart-bar');
            bars.forEach(bar => {
                const targetHeight = bar.style.height;
                bar.style.height = '0%';
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        bar.style.transition = 'height .6s ease';
                        bar.style.height = targetHeight;
                    }, 50);
                });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.quick-action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.style.opacity = '0.7';
            });
        });
    </script>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        function escapeHtml(value = '') {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function formatCurrency(value) {
            const numeric = Number(value || 0);
            return `$${numeric.toFixed(2)}`;
        }

        function formatDate(value) {
            if (!value) return '—';
            try {
                const date = new Date(value);
                if (Number.isNaN(date.getTime())) return value;
                return date.toLocaleDateString();
            } catch (error) {
                return value;
            }
        }

        async function loadDashboardStats() {
            try {
                const stats = await fetchWithAuth(`${window.API_URL}/dashboard/stats`);
                document.getElementById('statRevenue').textContent = `$${stats.total_revenue.toFixed(2)}`;
                document.getElementById('statAdminProfit').textContent = `$${stats.admin_profit.toFixed(2)}`;
                document.getElementById('statTotalPayouts').textContent = `$${stats.total_payouts.toFixed(2)}`;
                document.getElementById('statPendingPayouts').textContent = `$${stats.pending_payouts.toFixed(2)}`;
                document.getElementById('statActiveTasks').textContent = stats.active_tasks.toString();
                document.getElementById('statPendingTasks').textContent = stats.pending_tasks.toString();
                document.getElementById('statDriverCount').textContent = stats.driver_count.toString();
                document.getElementById('statMillCount').textContent = stats.mill_count.toString();
            } catch (error) {
                console.error('Dashboard stats failed:', error);
            }
        }

        async function loadRecentTickets() {
            try {
                const resp = await fetchWithAuth(`${window.API_URL}/tickets`);
                let tickets = [];
                if (Array.isArray(resp?.tickets)) tickets = resp.tickets;
                else if (Array.isArray(resp)) tickets = resp;

                const recent = tickets; // show all recent tickets on dashboard
                const tbody = document.getElementById('recentTicketsBody');
                if (!recent.length) {
                    tbody.innerHTML = '<tr><td colspan="5" style="color:#888; text-align:center;">No recent tickets</td></tr>';
                    return;
                }

                tbody.innerHTML = recent.map((t) => {
                    const num = t.ticket_number || t.ticket_id || t.id || '—';
                    const date = t.ticket_date || t.created_at || '';
                    const mill = t.mill_name || 'No mill';
                    const amount = t.ticket_amount ?? t.admin_earning ?? t.driver_earning ?? 0;
                    const status = String(t.status || '').toLowerCase();
                    const statusHtml = status === 'paid' ? '<span class="badge-good">Paid</span>' : `<span class="badge-good">${escapeHtml(t.status || '')}</span>`;

                    return `
                        <tr>
                            <td><span style="font-weight:600; color:#fff;">${escapeHtml(num)}</span></td>
                            <td style="color:#888;">${escapeHtml(formatDate(date))}</td>
                            <td>
                                <div class="cell-user">
                                    <div>
                                        <div class="name">${escapeHtml(mill)}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="color-green">${escapeHtml(formatCurrency(amount))}</td>
                            <td>${statusHtml}</td>
                        </tr>
                    `;
                }).join('');
            } catch (error) {
                const tbody = document.getElementById('recentTicketsBody');
                tbody.innerHTML = '<tr><td colspan="5" style="color:#888; text-align:center;">Unable to load tickets</td></tr>';
                console.error('Recent tickets failed:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardStats();
            loadRecentTickets();
        });
    </script>
</body>

</html>