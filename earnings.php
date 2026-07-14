<?php
$pageTitle = 'Earnings';
$activePage = 'earnings';
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Earnings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
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
            color: #fff;
        }

        button {
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }

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

        .nav-link:hover {
            background: var(--dark-green);
            color: #fff;
        }

        .nav-link.active {
            background: var(--dark-green);
            color: #fff;
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
            background: #c41e3a;
            color: #fff;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 35;
        }

        .page-wrapper {
            flex: 1;
            margin-left: var(--sidebar-w);
            display: flex;
            flex-direction: column;
            min-width: 0;
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

        .topbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 16px;
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

        .page-content {
            padding: 32px;
            flex: 1;
        }

        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 20px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .page-eyebrow {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--green);
            margin: 0 0 4px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .page-sub {
            font-size: 14px;
            color: #888;
            margin: 0;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 18px 20px;
        }

        .summary-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 6px;
        }

        .summary-value {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
        }

        .panel {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .panel-head h2 {
            margin: 0;
            font-size: 18px;
        }

        .muted {
            color: #888;
            font-size: 13px;
        }

        .message {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 14px;
        }

        .message.success {
            background: rgba(116, 170, 80, 0.16);
            color: #bfe0a4;
            border: 1px solid rgba(116, 170, 80, 0.3);
        }

        .message.error {
            background: rgba(196, 30, 58, 0.16);
            color: #f4b0bb;
            border: 1px solid rgba(196, 30, 58, 0.28);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        th {
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-size: 11px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-paid {
            background: rgba(116, 170, 80, 0.16);
            color: #bfe0a4;
        }

        .status-pending {
            background: rgba(255, 184, 0, 0.14);
            color: #ffd27d;
        }

        .btn {
            border: none;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            background: var(--green);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: progress;
        }

        .empty {
            text-align: center;
            color: #888;
            padding: 24px 10px;
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

            .page-content {
                padding: 24px;
            }

            .summary-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width:560px) {
            .page-title {
                font-size: 24px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .panel {
                padding: 16px;
            }

            table {
                display: block;
                overflow-x: auto;
            }
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
                        <p class="page-eyebrow">Finance</p>
                        <h1 class="page-title">Earnings Overview</h1>
                        <p class="page-sub">Review driver earnings, track pending payouts, and mark completed records as
                            paid.</p>
                    </div>
                </div>

                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-label">Total Admin</div>
                        <div class="summary-value" id="summaryAdmin">$0.00</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Total Driver</div>
                        <div class="summary-value" id="summaryDriver">$0.00</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Paid</div>
                        <div class="summary-value" id="summaryPaid">$0.00</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Pending</div>
                        <div class="summary-value" id="summaryPending">$0.00</div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <h2>Earnings Records</h2>
                        <div class="muted" id="tableStatus">Loading earnings…</div>
                    </div>
                    <div id="messageBox"></div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ticket</th>
                                    <th>Driver</th>
                                    <th>Mill</th>
                                    <th>Amount</th>
                                    <th>Rate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="earningsBody">
                                <tr>
                                    <td colspan="7" class="empty">Loading records…</td>
                                </tr>
                            </tbody>
                        </table>
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
        window.API_URL = <?php echo json_encode($API_URL, JSON_HEX_TAG); ?>;
    </script>
    <script src="assets/js/auth.js?v=4"></script>
    <script>
        const earningsBody = document.getElementById('earningsBody');
        const tableStatus = document.getElementById('tableStatus');
        const messageBox = document.getElementById('messageBox');

        function formatCurrency(value) {
            const amount = Number(value || 0);
            return `$${amount.toFixed(2)}`;
        }

        function getStatusClass(status) {
            return status === 'paid' ? 'status-paid' : 'status-pending';
        }

        function renderMessage(message, type = 'success') {
            messageBox.innerHTML = message ? `<div class="message ${type}">${message}</div>` : '';
        }

        function renderRows(items) {
            if (!items.length) {
                earningsBody.innerHTML = '<tr><td colspan="7" class="empty">No earnings data found.</td></tr>';
                return;
            }
            earningsBody.innerHTML = items.map(item => `
                <tr>
                    <td>${item.ticket_number || item.ticket_id || '—'}</td>
                    <td>${item.driver_name || '—'}</td>
                    <td>${item.mill_name || '—'}</td>
                    <td>${formatCurrency(item.ticket_amount || item.admin_earning || item.driver_earning)}</td>
                    <td>${item.rate != null ? `${item.rate}%` : '—'}</td>
                    <td><span class="status-pill ${getStatusClass(item.status)}">${item.status || 'pending'}</span></td>
                    <td>
                        ${item.status === 'paid' ? '<span class="muted">Completed</span>' : `<button class="btn" type="button" data-action="pay" data-id="${item.id || item.earning_id}">Mark as Paid</button>`}
                    </td>
                </tr>
            `).join('');
        }
        async function loadEarnings() {
            tableStatus.textContent = 'Loading earnings…';
            renderMessage('');
            try {
                const data = await fetchWithAuth(`${window.API_URL}/earnings`);
                const items = (data && data.earnings) || [];
                const totals = (data && data.totals) || {};
                document.getElementById('summaryAdmin').textContent = formatCurrency(totals.admin_earning);
                document.getElementById('summaryDriver').textContent = formatCurrency(totals.driver_earning);
                document.getElementById('summaryPaid').textContent = formatCurrency(totals.paid);
                document.getElementById('summaryPending').textContent = formatCurrency(totals.pending);
                tableStatus.textContent = `${items.length} record${items.length === 1 ? '' : 's'} loaded`;
                renderRows(items);
            } catch (error) {
                console.error('Earnings load failed:', error);
                tableStatus.textContent = 'Unable to load earnings';
                renderMessage(error.message || 'Unable to load earnings.', 'error');
                earningsBody.innerHTML =
                    '<tr><td colspan="7" class="empty">Unable to load earnings right now.</td></tr>';
            }
        }
        async function markAsPaid(earningId) {
            if (!earningId) return;
            const button = document.querySelector(`[data-id="${earningId}"]`);
            if (button) {
                button.disabled = true;
                button.textContent = 'Updating…';
            }
            try {
                await fetchWithAuth(`${window.API_URL}/earnings/${earningId}/paid`, {
                    method: 'POST'
                });
                renderMessage('Earning marked as paid.', 'success');
                await loadEarnings();
            } catch (error) {
                console.error('Mark as paid failed:', error);
                renderMessage(error.message || 'Unable to mark this earning as paid.', 'error');
                if (button) {
                    button.disabled = false;
                    button.textContent = 'Mark as Paid';
                }
            }
        }
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                await requireAuthOrRedirect('login.php');
                await loadEarnings();
            } catch (error) {
                console.error('Authentication failed:', error);
            }
            document.addEventListener('click', async (event) => {
                const button = event.target.closest('[data-action="pay"]');
                if (!button) return;
                await markAsPaid(button.getAttribute('data-id'));
            });
        });
    </script>
</body>

</html>