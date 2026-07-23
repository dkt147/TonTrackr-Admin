<?php
$pageTitle  = 'Contractor Details';
$activePage = 'contractors';
include 'config.php';
$contractorId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
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
                        <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='contractors.php'">
                            <button class="btn-pill small" type="button">← BACK</button>
                            <div>
                                <p class="page-eyebrow">Contractors</p>
                                <h1 class="page-title">Contractor Details</h1>
                                <p class="page-sub" style="margin-top:6px">View contractor profile and status.</p>
                            </div>
                        </div>
                        <button class="btn-pill danger" style="margin-left:auto;" onclick="deleteContractor()">Delete Contractor</button>
                    </div>
                </div>

                <div id="contractorDetails">
                    <div class="loading-note">Loading contractor details...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        const contractorId = '<?php echo addslashes($contractorId); ?>';
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

        function statusBadge(status) {
            if (!status) return '<span class="badge inactive">Unknown</span>';
            const normalized = status.toLowerCase();
            return `<span class="badge ${normalized}">${status}</span>`;
        }

        function renderContractor(data) {
            return `
                <div class="detail-grid">
                    <div class="detail-card">
                        <div class="detail-title">Business Profile</div>
                        <div class="detail-row"><span class="detail-label">Company</span><span class="detail-value">${formatValue(data.company_name)}</span></div>
                        <div class="detail-row"><span class="detail-label">Contractor Type</span><span class="detail-value">${formatValue(data.contractor_type)}</span></div>
                        <div class="detail-row"><span class="detail-label">Business License</span><span class="detail-value">${formatValue(data.business_license)}</span></div>
                        <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value">${statusBadge(data.status)}</span></div>
                        <div class="detail-row"><span class="detail-label">Jobs Assigned</span><span class="detail-value">${data.job_count ?? 0}</span></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-title">Contact & Location</div>
                        <div class="detail-row"><span class="detail-label">Contact Person</span><span class="detail-value">${formatValue(data.contact_person)}</span></div>
                        <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">${formatValue(data.contact_email)}</span></div>
                        <div class="detail-row"><span class="detail-label">Phone</span><span class="detail-value">${formatValue(data.contact_phone)}</span></div>
                        <div class="detail-row"><span class="detail-label">Address</span><span class="detail-value">${formatValue(data.address)}</span></div>
                        <div class="detail-row"><span class="detail-label">City / State</span><span class="detail-value">${formatValue(data.city)} / ${formatValue(data.state)}</span></div>
                        <div class="detail-row"><span class="detail-label">ZIP</span><span class="detail-value">${formatValue(data.zip)}</span></div>
                    </div>
                </div>
                <div class="detail-card" style="margin-top:24px;">
                    <div class="detail-title">Audit</div>
                    <div class="detail-row"><span class="detail-label">Created At</span><span class="detail-value">${formatDate(data.created_at)}</span></div>
                    <div class="detail-row"><span class="detail-label">Updated At</span><span class="detail-value">${formatDate(data.updated_at)}</span></div>
                    <div class="detail-row"><span class="detail-label">Created By</span><span class="detail-value">${formatValue(data.created_by)}</span></div>
                </div>
            `;
        }

        async function loadContractorDetails() {
            const container = document.getElementById('contractorDetails');
            if (!contractorId) {
                window.location.href = 'contractors.php';
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const contractor = await fetchWithAuth(`${window.API_URL}/contractors/${contractorId}`);
                container.innerHTML = renderContractor(contractor);
            } catch (error) {
                console.error('Contractor details failed:', error);
                container.innerHTML = '<div class="loading-note">Unable to load contractor details. Please refresh or go back.</div>';
            }
        }

        async function deleteContractor() {
            if (!contractorId) {
                return;
            }
            if (!confirm('Delete this contractor?')) {
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/contractors/${encodeURIComponent(contractorId)}`, {
                    method: 'DELETE'
                });
                const responseData = typeof response === 'string' ? (() => {
                    try {
                        return JSON.parse(response);
                    } catch (error) {
                        return null;
                    }
                })() : response;
                const message = responseData?.message || 'Contractor deleted.';
                alert(message);
                window.location.href = 'contractors.php';
            } catch (error) {
                console.error('Delete contractor failed:', error);
                alert('Unable to delete contractor. Please try again.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadContractorDetails);
    </script>
</body>
</html>

