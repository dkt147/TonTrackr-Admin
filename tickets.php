<?php include 'config.php'; ?>
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
            --warning: #F39C12;
            --warning-bg: rgba(243, 156, 18, 0.16);
            --danger: #FF5B5B;
            --danger-bg: rgba(255, 91, 91, 0.16);
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: var(--black); color: #fff; }
        a { color: inherit; text-decoration: none; }
        button { font-family: 'Poppins', sans-serif; cursor: pointer; }
        .main-wrapper { display: flex; min-height: 100vh; background: var(--black); }
        .sidebar { width: var(--sidebar-w); flex-shrink: 0; background: var(--sidebar-bg); color: var(--sidebar-text); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 40; border-right: 1px solid var(--border-color); transition: transform .25s ease; }
        .page-wrapper { flex: 1; margin-left: var(--sidebar-w); display: flex; flex-direction: column; min-width: 0; }
        .page-content { padding: 32px; flex: 1; }
        .page-head { display:flex; justify-content: space-between; align-items:flex-end; gap:20px; margin-bottom:28px; flex-wrap:wrap; }
        .page-eyebrow { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--green); margin: 0 0 4px; }
        .page-title { font-size: 32px; font-weight: 700; margin: 0; }
        .page-sub { font-size: 14px; color: #888; margin: 0; }
        .page-actions { display:flex; gap:10px; flex-wrap:wrap; }
        .btn-green { background: var(--green); border:none; color:#fff; border-radius:18px; padding:14px 20px; font-weight:700; }
        .btn-dark { background:#222; border:none; color:#fff; border-radius:18px; padding:14px 20px; font-weight:700; }
        .btn-outline { background: transparent; color:#fff; border:1px solid var(--border-color); border-radius:18px; padding:12px 16px; font-weight:600; }
        .btn-small { border:none; color:#fff; border-radius:12px; padding:8px 10px; font-size:12px; font-weight:600; }
        .btn-flag { background: var(--warning); }
        .alert { display:none; padding:12px 14px; border-radius:12px; font-size:13px; margin-bottom:16px; }
        .alert.success { display:block; background: rgba(116,170,80,0.15); color: var(--green); }
        .alert.error { display:block; background: var(--danger-bg); color: var(--danger); }
        .stats-grid { display:grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap:14px; margin-bottom:20px; }
        .stat-card { background: var(--card-bg); border:1px solid var(--border-color); border-radius:18px; padding:18px; }
        .stat-label { font-size:12px; text-transform:uppercase; color:#888; }
        .stat-value { font-size:24px; font-weight:700; color:#fff; margin-top:6px; }
        .filter-row { display:flex; flex-wrap:wrap; gap:12px; align-items:center; margin-bottom:18px; }
        .search-box { flex:1; min-width:220px; position:relative; }
        .search-box input { width:100%; padding:14px 16px 14px 42px; border-radius:999px; border:1px solid var(--border-color); background:#111; color:#fff; }
        .search-box svg { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#666; }
        .chip-group { display:flex; flex-wrap:wrap; gap:10px; }
        .chip { padding:10px 14px; border-radius:999px; background:#111; border:1px solid var(--border-color); color:#fff; font-size:13px; cursor:pointer; }
        .chip.active { background: var(--green); border-color: var(--green); }
        .card { background: var(--card-bg); border:1px solid var(--border-color); border-radius:18px; padding:18px; margin-bottom:18px; }
        .card-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; gap:12px; flex-wrap:wrap; }
        .card-title { font-size:16px; font-weight:600; }
        .ticket-list { display:grid; gap:14px; }
        .ticket-card { display:flex; align-items:center; justify-content:space-between; gap:18px; background:#0d0d0d; border:1px solid var(--border-color); border-radius:16px; padding:16px 18px; }
        .ticket-meta { display:flex; flex-direction:column; gap:6px; }
        .ticket-number { font-size:18px; font-weight:700; color:#fff; }
        .ticket-sub { font-size:13px; color:#888; }
        .ticket-details { display:flex; gap:10px; flex-wrap:wrap; font-size:13px; color:#888; }
        .ticket-actions { display:flex; gap:8px; flex-wrap:wrap; }
        .status-pill { display:inline-block; padding:4px 10px; border-radius:999px; font-size:11px; font-weight:700; text-transform:uppercase; }
        .status-paid { background: rgba(116,170,80,0.15); color: var(--green); }
        .status-pending { background: var(--warning-bg); color: var(--warning); }
        .status-default { background: var(--danger-bg); color: var(--danger); }
        .empty-state { padding:20px; text-align:center; color:#888; border:1px dashed var(--border-color); border-radius:14px; }
        .export-grid { display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap:12px; }
        .export-grid label { display:flex; flex-direction:column; gap:6px; font-size:13px; color:#ccc; }
        .export-grid input, .export-grid select { width:100%; border:1px solid var(--border-color); border-radius:12px; padding:10px 12px; background:#000; color:#fff; }
        .export-result { margin-top:12px; font-size:13px; color:#888; }
        .subtle { color:#888; font-size:12px; }
        @media (max-width:860px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .page-wrapper { margin-left: 0; }
            .page-content { padding:24px; }
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .export-grid { grid-template-columns: 1fr; }
        }
        @media (max-width:560px) { .page-head { align-items:flex-start; } .ticket-card { flex-direction:column; align-items:flex-start; } .stats-grid { grid-template-columns: 1fr; } }
    </style>
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">
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
                        <p class="page-sub">Search, review, and export ticket records from the API.</p>
                    </div>
                    <div class="page-actions">
                        <button class="btn-outline" id="refreshTicketsBtn" type="button">Refresh</button>
                        <button class="btn-green" onclick="window.location.href='add-ticket.php'" type="button">+ ENTER TICKET</button>
                    </div>
                </div>

                <div id="ticketsAlert" class="alert" role="status"></div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Total Tickets</div>
                        <div class="stat-value" id="statsCount">0</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Amount</div>
                        <div class="stat-value" id="statsAmount">$0.00</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Pending</div>
                        <div class="stat-value" id="statsPending">0</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Paid</div>
                        <div class="stat-value" id="statsPaid">0</div>
                    </div>
                </div>

                <div class="filter-row">
                    <div class="search-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                        <input type="search" id="ticketSearch" placeholder="Search ticket, mill, driver, truck...">
                    </div>
                    <div class="chip-group">
                        <button class="chip active" data-filter="all" type="button">ALL</button>
                        <button class="chip" data-filter="pending" type="button">PENDING</button>
                        <button class="chip" data-filter="paid" type="button">PAID</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <span class="card-title">Recent Tickets</span>
                    </div>
                    <div class="ticket-list" id="ticketList">
                        <div class="empty-state">Loading tickets…</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <span class="card-title">Export Tickets</span>
                    </div>
                    <div class="export-grid">
                        <label>
                            Contractor Email
                            <input type="email" id="exportEmail" placeholder="contractor@example.com">
                        </label>
                        <label>
                            Job ID
                            <input type="text" id="exportJobId" placeholder="job001">
                        </label>
                        <label>
                            Date From
                            <input type="date" id="exportDateFrom">
                        </label>
                        <label>
                            Date To
                            <input type="date" id="exportDateTo">
                        </label>
                        <label>
                            Send Email
                            <select id="exportSendEmail">
                                <option value="false">No</option>
                                <option value="true">Yes</option>
                            </select>
                        </label>
                    </div>
                    <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                        <button class="btn-green" id="runExportBtn" type="button">Run Export</button>
                        <a class="btn-dark" href="tickets-export.php" style="display:inline-flex; align-items:center; justify-content:center;">Open Export Page</a>
                    </div>
                    <div id="exportResult" class="export-result"></div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <span class="card-title">Confirm Draft Ticket</span>
                    </div>
                    <p class="subtle">Use the POST /tickets endpoint to confirm an existing draft by supplying its draft ID.</p>
                    <div class="export-grid">
                        <label>
                            Draft ID
                            <input type="text" id="draftId" placeholder="ticket draft id">
                        </label>
                        <label>
                            Confirmed Data
                            <input type="text" id="confirmedData" placeholder="test">
                        </label>
                    </div>
                    <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                        <button class="btn-green" id="confirmDraftBtn" type="button">Confirm Draft</button>
                    </div>
                    <div id="draftResult" class="export-result"></div>
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
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
    </script>
    <script src="assets/js/auth.js?v=5"></script>
    <script>
        const ticketList = document.getElementById('ticketList');
        const ticketSearch = document.getElementById('ticketSearch');
        const ticketsAlert = document.getElementById('ticketsAlert');
        const refreshTicketsBtn = document.getElementById('refreshTicketsBtn');
        const runExportBtn = document.getElementById('runExportBtn');
        const confirmDraftBtn = document.getElementById('confirmDraftBtn');
        const exportResult = document.getElementById('exportResult');
        const draftResult = document.getElementById('draftResult');
        let allTickets = [];
        let activeFilter = 'all';

        function showAlert(message, type = 'success') {
            ticketsAlert.textContent = message;
            ticketsAlert.className = `alert ${type}`;
        }

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

        function getStatusClass(status = '') {
            const normalized = String(status || '').toLowerCase();
            if (normalized === 'paid') return 'status-paid';
            if (normalized === 'pending') return 'status-pending';
            return 'status-default';
        }

        function renderTickets() {
            const searchTerm = ticketSearch.value.toLowerCase().trim();
            const filtered = allTickets.filter((ticket) => {
                const status = String(ticket.status || '').toLowerCase();
                if (activeFilter === 'pending' && status !== 'pending') return false;
                if (activeFilter === 'paid' && status !== 'paid') return false;

                const haystack = [
                    ticket.ticket_number,
                    ticket.ticket_id,
                    ticket.mill_name,
                    ticket.driver_name,
                    ticket.job_name,
                    ticket.truck_number,
                    ticket.status
                ].filter(Boolean).join(' ').toLowerCase();

                return haystack.includes(searchTerm);
            });

            if (!filtered.length) {
                ticketList.innerHTML = '<div class="empty-state">No tickets match your current filters.</div>';
                return;
            }

            ticketList.innerHTML = filtered.map((ticket) => {
                const status = String(ticket.status || 'pending').toLowerCase();
                const statusLabel = status === 'paid' ? 'Paid' : (status === 'pending' ? 'Pending' : 'Other');
                const amount = ticket.ticket_amount ?? ticket.admin_earning ?? ticket.driver_earning ?? 0;
                return `
                    <div class="ticket-card">
                        <div class="ticket-meta">
                            <span class="ticket-number">${escapeHtml(ticket.ticket_number || ticket.ticket_id || ticket.id || '—')}</span>
                            <div class="ticket-details">
                                <span>${escapeHtml(formatDate(ticket.ticket_date || ticket.created_at))}</span>
                                <span>${escapeHtml(ticket.mill_name || 'No mill')}</span>
                                <span>${escapeHtml(ticket.driver_name || 'No driver')}</span>
                            </div>
                            <div class="ticket-sub">
                                <span class="status-pill ${getStatusClass(status)}">${escapeHtml(statusLabel)}</span>
                                <span style="margin-left:8px;">${escapeHtml(ticket.job_name || 'No job')}</span>
                            </div>
                        </div>
                        <div class="ticket-actions">
                            <div class="ticket-value" style="margin-right:10px;">${formatCurrency(amount)}</div>
                            <button class="btn-small btn-flag" data-action="flag" data-ticket-id="${escapeHtml(ticket.id || ticket.ticket_id || '')}" type="button">Flag</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function loadTickets() {
            try {
                const response = await fetchWithAuth(`${window.API_URL}/tickets`);
                allTickets = Array.isArray(response?.tickets) ? response.tickets : [];
                document.getElementById('statsCount').textContent = response?.count ?? allTickets.length;
                document.getElementById('statsAmount').textContent = formatCurrency(response?.total_amount ?? 0);
                document.getElementById('statsPending').textContent = allTickets.filter((ticket) => String(ticket.status || '').toLowerCase() === 'pending').length;
                document.getElementById('statsPaid').textContent = allTickets.filter((ticket) => String(ticket.status || '').toLowerCase() === 'paid').length;
                renderTickets();
            } catch (error) {
                ticketList.innerHTML = '<div class="empty-state">Unable to load tickets.</div>';
                showAlert(error.message || 'Unable to load tickets.', 'error');
            }
        }

        async function loadStats() {
            try {
                const stats = await fetchWithAuth(`${window.API_URL}/tickets/stats`);
                if (stats?.week) {
                    document.getElementById('statsPending').textContent = `${stats.week.count}`;
                }
            } catch (error) {
                console.warn('Ticket stats unavailable:', error);
            }
        }

        async function flagTicket(ticketId) {
            if (!ticketId) return;
            try {
                const payload = {
                    note: 'Flagged from admin tickets view',
                    earning_id: ticketId
                };
                await fetchWithAuth(`${window.API_URL}/tickets/${encodeURIComponent(ticketId)}/flag`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                showAlert('Ticket flagged successfully.', 'success');
            } catch (error) {
                showAlert(error.message || 'Unable to flag ticket.', 'error');
            }
        }

        async function exportTickets() {
            try {
                const payload = {
                    contractor_email: document.getElementById('exportEmail').value || '',
                    date_from: document.getElementById('exportDateFrom').value || '',
                    date_to: document.getElementById('exportDateTo').value || '',
                    job_id: document.getElementById('exportJobId').value || '',
                    send_email: document.getElementById('exportSendEmail').value === 'true'
                };

                const response = await fetchWithAuth(`${window.API_URL}/tickets/export`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const message = response?.message || response?.error || 'Export request completed.';
                exportResult.textContent = message;
                showAlert('Export request sent.', 'success');
            } catch (error) {
                exportResult.textContent = error.message || 'Export request failed.';
                showAlert(error.message || 'Export request failed.', 'error');
            }
        }

        async function confirmDraftTicket() {
            try {
                const payload = {
                    confirmed_data: document.getElementById('confirmedData').value || '',
                    draft_id: document.getElementById('draftId').value || ''
                };

                const response = await fetchWithAuth(`${window.API_URL}/tickets`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const message = response?.message || response?.error || 'Draft confirmed successfully.';
                draftResult.textContent = message;
                showAlert('Draft confirmation request sent.', 'success');
            } catch (error) {
                draftResult.textContent = error.message || 'Draft confirmation failed.';
                showAlert(error.message || 'Draft confirmation failed.', 'error');
            }
        }

        document.querySelectorAll('.chip').forEach((button) => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.chip').forEach((chip) => chip.classList.remove('active'));
                button.classList.add('active');
                activeFilter = button.getAttribute('data-filter') || 'all';
                renderTickets();
            });
        });

        ticketSearch.addEventListener('input', renderTickets);
        refreshTicketsBtn.addEventListener('click', () => loadTickets());
        runExportBtn.addEventListener('click', exportTickets);
        confirmDraftBtn.addEventListener('click', confirmDraftTicket);

        ticketList.addEventListener('click', async (event) => {
            const button = event.target.closest('[data-action="flag"]');
            if (!button) return;
            await flagTicket(button.getAttribute('data-ticket-id'));
        });

        document.addEventListener('DOMContentLoaded', async () => {
            try {
                await requireAuthOrRedirect('login.php');
            } catch (error) {
                // auth redirect handles navigation
            }
            await loadTickets();
            await loadStats();
        });
    </script>
</body>
</html>
