<?php
$pageTitle  = 'Mill Details';
$activePage = 'mills';
include 'config.php';
$millId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
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
        .detail-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 24px; }
        .detail-card { background: #111111; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 24px; }
        .detail-row { display: flex; justify-content: space-between; gap: 12px; margin-bottom: 16px; }
        .detail-label { color: #888; font-size: 13px; width: 180px; }
        .detail-value { color: #fff; font-size: 14px; flex: 1; text-align: right; }
        .detail-title { font-size: 16px; font-weight: 700; margin-bottom: 16px; color: #fff; }
        .mini-list { display: flex; flex-direction: column; gap: 10px; }
        .mini-item { padding: 12px 14px; border: 1px solid var(--border-color); border-radius: 12px; background: #1a1a1a; color: #fff; }
        .status-pill { display: inline-flex; align-items: center; padding: 8px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; background: rgba(116, 170, 80, 0.18); color: var(--green); }
        .status-pill.inactive { background: rgba(255, 184, 0, 0.15); color: #FFB800; }
        .loading-note { color: #ddd; padding: 24px; text-align: center; }
        @media (max-width: 900px) { .detail-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes\\sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes\\header.php'; ?>

            <div class="page-content">
                <div class="page-head" style="align-items:flex-start; gap:16px; flex-wrap:wrap;">
                    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='mills.php'">
                            <button class="btn-pill small" type="button">← BACK</button>
                            <div>
                                <p class="page-eyebrow">Mills</p>
                                <h1 class="page-title">Mill Details</h1>
                                <p class="page-sub" style="margin-top:6px">View mill profile and reporting details.</p>
                            </div>
                        </div>
                    </div>
                    <div id="statusActions" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                        <span class="status-pill" id="statusBadge">Loading...</span>
                        <button class="btn-pill small" type="button" onclick="location.href='add-mill.php?id=' + encodeURIComponent(millId)">Edit Mill</button>
                    </div>
                </div>

                <div id="millDetails">
                    <div class="loading-note">Loading mill details...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        const millId = '<?php echo addslashes($millId); ?>';
    </script>
    <script src="assets/js/auth.js?v=5"></script>
    <script>
        function formatValue(value) {
            return value || '—';
        }

        function renderMill(data, report) {
            const profile = data || {};
            const statusValue = (profile.status || 'active').toLowerCase();
            const badge = document.getElementById('statusBadge');
            if (badge) {
                badge.textContent = statusValue;
                badge.className = `status-pill ${statusValue === 'active' ? '' : 'inactive'}`;
            }

            const reportRows = report ? `
                <div class="detail-row"><span class="detail-label">Ticket count</span><span class="detail-value">${formatValue(report.ticket_count ?? 0)}</span></div>
                <div class="detail-row"><span class="detail-label">Total ticket amount</span><span class="detail-value">${formatValue(report.total_ticket_amount ?? 0)}</span></div>
                <div class="detail-row"><span class="detail-label">Admin revenue</span><span class="detail-value">${formatValue(report.total_admin_revenue ?? 0)}</span></div>
                <div class="detail-row"><span class="detail-label">Driver payouts</span><span class="detail-value">${formatValue(report.total_driver_payouts ?? 0)}</span></div>
            ` : '';

            return `
                <div class="detail-grid">
                    <div class="detail-card">
                        <div class="detail-title">Mill Overview</div>
                        <div class="detail-row"><span class="detail-label">Full name</span><span class="detail-value">${formatValue(profile.full_name)}</span></div>
                        <div class="detail-row"><span class="detail-label">Abbreviated name</span><span class="detail-value">${formatValue(profile.abbreviated_name)}</span></div>
                        <div class="detail-row"><span class="detail-label">Location</span><span class="detail-value">${formatValue(profile.location)}</span></div>
                        <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value">${formatValue(profile.status)}</span></div>
                        <div class="detail-row"><span class="detail-label">Created by</span><span class="detail-value">${formatValue(profile.created_by)}</span></div>
                        <div class="detail-row"><span class="detail-label">Created at</span><span class="detail-value">${formatValue(profile.created_at)}</span></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-title">Report Summary</div>
                        ${reportRows || '<div class="mini-item">No report data found.</div>'}
                    </div>
                </div>
            `;
        }

        async function loadMillDetails() {
            if (!millId) {
                document.getElementById('millDetails').innerHTML = '<div class="loading-note">No mill selected.</div>';
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const [mill, report] = await Promise.all([
                    fetchWithAuth(`${window.API_URL}/mills/${encodeURIComponent(millId)}`),
                    fetchWithAuth(`${window.API_URL}/mills/${encodeURIComponent(millId)}/report`).catch(() => null)
                ]);
                document.getElementById('millDetails').innerHTML = renderMill(mill, report);
            } catch (error) {
                console.error('Failed to load mill details:', error);
                document.getElementById('millDetails').innerHTML = '<div class="loading-note">Unable to load mill details.</div>';
            }
        }

        document.addEventListener('DOMContentLoaded', loadMillDetails);
    </script>
</body>
</html>
