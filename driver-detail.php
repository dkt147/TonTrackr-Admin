<?php
$pageTitle  = 'Driver Details';
$activePage = 'drivers';
include 'config.php';
$driverId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · <?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .detail-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
        }

        .detail-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .detail-label {
            color: #888;
            font-size: 13px;
            width: 180px;
        }

        .detail-value {
            color: #fff;
            font-size: 14px;
            flex: 1;
            text-align: right;
        }

        .detail-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #fff;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge.active { background: rgba(116, 170, 80, 0.18); color: var(--green); }
        .badge.inactive { background: rgba(255, 184, 0, 0.15); color: #FFB800; }
        .badge.pending { background: rgba(116, 170, 80, 0.12); color: #FFB800; }

        .loading-note {
            color: #ddd;
            padding: 24px;
            text-align: center;
        }

        .mini-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mini-item {
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: #1a1a1a;
            color: #fff;
        }

        .status-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: rgba(116, 170, 80, 0.18);
            color: var(--green);
        }

        .status-pill.inactive {
            background: rgba(255, 184, 0, 0.15);
            color: #FFB800;
        }

        @media (max-width: 900px) {
            .detail-grid { grid-template-columns: 1fr; }
        }
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
                <div class="page-head" style="align-items:flex-start; gap:16px; flex-wrap:wrap;">
                    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='drivers.php'">
                            <button class="btn-pill small" type="button">← BACK</button>
                            <div>
                                <p class="page-eyebrow">Drivers</p>
                                <h1 class="page-title">Driver Details</h1>
                                <p class="page-sub" style="margin-top:6px">View driver profile, assignments, and recent activity.</p>
                            </div>
                        </div>
                    </div>
                    <div class="status-actions" id="statusActions">
                        <span class="status-pill" id="statusBadge">Loading...</span>
                    </div>
                </div>

                <div id="driverDetails">
                    <div class="loading-note">Loading driver details...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        const driverId = '<?php echo addslashes($driverId); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        function formatValue(value) {
            return value || '—';
        }

        function formatDate(value) {
            if (!value) return '—';
            const date = new Date(value);
            return date.toLocaleString([], { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });
        }

        function formatCurrency(value) {
            const amount = Number(value);
            if (!Number.isFinite(amount)) return '—';
            return `$${amount.toFixed(2)}`;
        }

        function renderVehicleList(vehicles) {
            if (!Array.isArray(vehicles) || !vehicles.length) {
                return '<div class="mini-item">No vehicles assigned.</div>';
            }

            return vehicles.map((vehicle) => {
                const label = vehicle.plate_number || vehicle.truck_number || vehicle.name || vehicle.id || 'Vehicle';
                return `<div class="mini-item">${formatValue(label)}</div>`;
            }).join('');
        }

        function renderRecentList(items, type) {
            if (!Array.isArray(items) || !items.length) {
                return `<div class="mini-item">No ${type} found.</div>`;
            }

            return items.map((item) => {
                if (type === 'earnings') {
                    return `<div class="mini-item">${formatValue(item.description || item.label || 'Earning')} — ${formatCurrency(item.amount || item.value)}</div>`;
                }

                return `<div class="mini-item">${formatValue(item.ticket_number || item.title || item.description || 'Ticket')}</div>`;
            }).join('');
        }

        function renderEarningsSummary(earnings) {
            const groups = ['today', 'week', 'biweekly'];
            const rows = groups.map((key) => {
                const entry = earnings?.[key] || {};
                const count = entry.count ?? 0;
                const amount = entry.estimated_income ?? 0;
                const label = key === 'today' ? 'Today' : key === 'week' ? 'This Week' : 'Biweekly';
                return `<div class="detail-row"><span class="detail-label">${label}</span><span class="detail-value">${count} jobs · ${formatCurrency(amount)}</span></div>`;
            }).join('');

            return `
                <div class="detail-card" style="margin-top:24px;">
                    <div class="detail-title">Earnings Summary</div>
                    ${rows}
                </div>
            `;
        }

        function renderTicketsList(data) {
            const tickets = Array.isArray(data?.tickets) ? data.tickets : [];
            if (!tickets.length) {
                return `
                    <div class="detail-card" style="margin-top:24px;">
                        <div class="detail-title">Tickets</div>
                        <div class="mini-item">No tickets found.</div>
                    </div>
                `;
            }

            const rows = tickets.map((ticket) => `
                <div class="mini-item">
                    <div style="font-weight:700; margin-bottom:4px;">${formatValue(ticket.ticket_number || ticket.ticket_id)}</div>
                    <div style="font-size:12px; color:#888;">${formatValue(ticket.mill_name)} · ${formatValue(ticket.status)}</div>
                    <div style="font-size:12px; color:#888; margin-top:4px;">${formatDate(ticket.created_at)}</div>
                </div>
            `).join('');

            return `
                <div class="detail-card" style="margin-top:24px;">
                    <div class="detail-title">Tickets (${data.count ?? tickets.length})</div>
                    <div class="mini-list">${rows}</div>
                </div>
            `;
        }

        function renderDriver(data) {
            const profile = data?.profile || data || {};
            const statusValue = (profile.status || data?.status || 'active').toLowerCase();
            const badge = document.getElementById('statusBadge');
            if (badge) {
                badge.textContent = statusValue;
                badge.className = `status-pill ${statusValue === 'active' ? '' : 'inactive'}`;
            }

            const statusButtons = `
                <button class="btn-pill small" type="button" onclick="updateDriverStatus('active')">Set Active</button>
                <button class="btn-pill small" type="button" onclick="updateDriverStatus('inactive')">Set Inactive</button>
            `;
            const statusActions = document.getElementById('statusActions');
            if (statusActions) {
                statusActions.innerHTML = `<span class="status-pill ${statusValue === 'active' ? '' : 'inactive'}" id="statusBadge">${statusValue}</span>${statusButtons}`;
            }

            return `
                <div class="detail-grid">
                    <div class="detail-card">
                        <div class="detail-title">Profile</div>
                        <div class="detail-row"><span class="detail-label">Display Name</span><span class="detail-value">${formatValue(profile.displayName || profile.display_name)}</span></div>
                        <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">${formatValue(profile.email)}</span></div>
                        <div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">${formatValue(profile.phone)}</span></div>
                        <div class="detail-row"><span class="detail-label">Company</span><span class="detail-value">${formatValue(profile.companyName || profile.company_name)}</span></div>
                        <div class="detail-row"><span class="detail-label">Country</span><span class="detail-value">${formatValue(profile.country)}</span></div>
                        <div class="detail-row"><span class="detail-label">Role</span><span class="detail-value">${formatValue(profile.role)}</span></div>
                        <div class="detail-row"><span class="detail-label">UID</span><span class="detail-value">${formatValue(profile.uid)}</span></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-title">Assigned Vehicles</div>
                        <div class="mini-list">${renderVehicleList(data.vehicles || [])}</div>
                    </div>
                </div>

                <div class="detail-card" style="margin-top:24px;">
                    <div class="detail-title">Recent Activity</div>
                    <div class="detail-row"><span class="detail-label">Created At</span><span class="detail-value">${formatDate(profile.createdAt || profile.created_at)}</span></div>
                    <div class="detail-row"><span class="detail-label">Disclaimer Accepted</span><span class="detail-value">${formatDate(profile.disclaimerAcceptedAt || profile.disclaimer_accepted_at)}</span></div>
                </div>

                <div class="detail-grid" style="margin-top:24px;">
                    <div class="detail-card">
                        <div class="detail-title">Recent Earnings</div>
                        <div class="mini-list">${renderRecentList(data.recent_earnings || [], 'earnings')}</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-title">Recent Tickets</div>
                        <div class="mini-list">${renderRecentList(data.recent_tickets || [], 'tickets')}</div>
                    </div>
                </div>
            `;
        }

        async function updateDriverStatus(status) {
            if (!driverId) {
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/drivers/${encodeURIComponent(driverId)}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status })
                });

                const newStatus = response?.status || status;
                const badge = document.getElementById('statusBadge');
                if (badge) {
                    badge.textContent = newStatus;
                    badge.className = `status-pill ${newStatus === 'active' ? '' : 'inactive'}`;
                }

                const statusActions = document.getElementById('statusActions');
                if (statusActions) {
                    statusActions.innerHTML = `<span class="status-pill ${newStatus === 'active' ? '' : 'inactive'}" id="statusBadge">${newStatus}</span><button class="btn-pill small" type="button" onclick="updateDriverStatus('active')">Set Active</button><button class="btn-pill small" type="button" onclick="updateDriverStatus('inactive')">Set Inactive</button>`;
                }

                alert(`Driver status updated to ${newStatus}.`);
            } catch (error) {
                console.error('Driver status update failed:', error);
                alert('Unable to update driver status.');
            }
        }

        async function loadDriverDetails() {
            const container = document.getElementById('driverDetails');
            if (!driverId) {
                window.location.href = 'drivers.php';
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const driver = await fetchWithAuth(`${window.API_URL}/drivers/${encodeURIComponent(driverId)}`);
                const earnings = await fetchWithAuth(`${window.API_URL}/drivers/${encodeURIComponent(driverId)}/earnings`);
                const tickets = await fetchWithAuth(`${window.API_URL}/drivers/${encodeURIComponent(driverId)}/tickets`);
                container.innerHTML = `${renderDriver(driver)}${renderEarningsSummary(earnings)}${renderTicketsList(tickets)}`;
            } catch (error) {
                console.error('Driver details failed:', error);
                container.innerHTML = '<div class="loading-note">Unable to load driver details. Please refresh or go back.</div>';
            }
        }

        document.addEventListener('DOMContentLoaded', loadDriverDetails);
    </script>
</body>
</html>

