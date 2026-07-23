<?php
$pageTitle  = 'Contractors';
$activePage = 'contractors';
include 'config.php';
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
        .page-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-head-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title-group p {
            margin: 0;
        }

        .page-eyebrow {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--green);
            font-weight: 600;
            letter-spacing: 0.08em;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin: 4px 0;
        }

        .page-sub {
            font-size: 13px;
            color: #888;
        }

        .contractors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .contractor-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            transition: all 0.2s ease;
        }

        .contractor-card:hover {
            border-color: var(--green);
            box-shadow: 0 8px 24px rgba(116, 170, 80, 0.15);
            transform: translateY(-4px);
        }

        .contractor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
            color: #fff;
            margin-bottom: 16px;
        }

        .contractor-name {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .contractor-type {
            font-size: 12px;
            color: #888;
            margin-bottom: 12px;
        }

        .contractor-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 13px;
        }

        .contractor-info-row {
            display: flex;
            justify-content: space-between;
        }

        .contractor-info-label {
            color: #888;
        }

        .contractor-info-value {
            color: #fff;
            font-weight: 500;
        }

        .contractor-actions {
            display: flex;
            gap: 10px;
        }

        .contractor-actions button {
            flex: 1;
            padding: 10px 12px;
            border-radius: 10px;
            border: none;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .btn-view {
            background: var(--green);
            color: #000;
        }

        .btn-view:hover {
            opacity: 0.9;
        }

        .btn-edit {
            background: #2a2a2a;
            color: #fff;
        }

        .btn-edit:hover {
            background: #333;
        }

        .btn-delete {
            background: #6f2020;
            color: #fff;
        }

        .btn-delete:hover {
            background: #8f3030;
        }

        .add-btn-primary {
            background: var(--green);
            color: #000;
            padding: 12px 28px;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
        }

        .add-btn-primary:hover {
            opacity: 0.9;
            transform: scale(1.02);
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

                <div class="page-head">
                    <div class="page-head-left">
                        <div class="page-title-group">
                            <p class="page-eyebrow">Manage</p>
                            <h1 class="page-title">Contractors</h1>
                            <p class="page-sub" id="contractorsSummary">Loading contractors...</p>
                        </div>
                    </div>
                    <button class="add-btn-primary" onclick="location.href='add-contractor.php'">+ ADD CONTRACTOR</button>
                </div>

                <div class="contractors-grid" id="contractorsGrid">
                    <div class="loading-note" style="color:#ddd;">Loading contractors...</div>
                </div>

            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function getInitials(value) {
            if (!value) return '??';
            return value
                .split(' ')
                .map(part => part[0])
                .slice(0, 2)
                .join('')
                .toUpperCase();
        }

        function getStatusColor(status) {
            if (!status) return '#888';
            if (status.toLowerCase() === 'active') return 'var(--green)';
            if (status.toLowerCase() === 'inactive') return '#888';
            if (status.toLowerCase() === 'pending') return '#FFB800';
            return '#888';
        }

        function renderContractorCard(contractor) {
            const initials = getInitials(contractor.company_name || contractor.contact_person || 'CC');
            const statusColor = getStatusColor(contractor.status);
            const location = [contractor.city, contractor.state].filter(Boolean).join(', ') || 'Unknown';
            const contact = contractor.contact_phone || contractor.contact_email || 'No contact';
            const type = contractor.contractor_type ? contractor.contractor_type.replace('_', ' ') : 'Contractor';
            const id = contractor.id || '';

            return `
                <div class="contractor-card">
                    <div class="contractor-avatar">${initials}</div>
                    <div class="contractor-name">${contractor.company_name || 'Unnamed Contractor'}</div>
                    <div class="contractor-type">${type}</div>
                    <div class="contractor-info">
                        <div class="contractor-info-row">
                            <span class="contractor-info-label">Status:</span>
                            <span class="contractor-info-value" style="color: ${statusColor};">${contractor.status || 'Unknown'}</span>
                        </div>
                        <div class="contractor-info-row">
                            <span class="contractor-info-label">Location:</span>
                            <span class="contractor-info-value">${location}</span>
                        </div>
                        <div class="contractor-info-row">
                            <span class="contractor-info-label">Contact:</span>
                            <span class="contractor-info-value">${contact}</span>
                        </div>
                    </div>
                    <div class="contractor-actions">
                        <button class="btn-view" onclick="location.href='contractor-detail.php?id=${encodeURIComponent(id)}'">View Details</button>
                        <button class="btn-edit" onclick="location.href='add-contractor.php?id=${encodeURIComponent(id)}'">Edit</button>
                        <button class="btn-delete" onclick="deleteContractor('${id}')">Delete</button>
                    </div>
                </div>`;
        }

        async function deleteContractor(id) {
            if (!confirm('Delete this contractor?')) {
                return;
            }

            const grid = document.getElementById('contractorsGrid');
            try {
                await requireAuthOrRedirect('login.php');
                await fetchWithAuth(`${window.API_URL}/contractors/${encodeURIComponent(id)}`, {
                    method: 'DELETE'
                });
                alert('Contractor deleted.');
                loadContractors();
            } catch (err) {
                console.error('Delete contractor failed:', err);
                grid.innerHTML = '<div class="loading-note" style="color:#f5f5f5;">Unable to delete contractor. Please refresh.</div>';
            }
        }

        function updateContractorsSummary(totalCount, isEmpty) {
            const summary = document.getElementById('contractorsSummary');
            if (!summary) return;

            if (isEmpty) {
                summary.textContent = 'No contractors found.';
                return;
            }

            summary.textContent = `${totalCount} contractor${totalCount === 1 ? '' : 's'} available`;
        }

        async function loadContractors() {
            const grid = document.getElementById('contractorsGrid');
            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/contractors?include_inactive=true`);
                const contractors = Array.isArray(response.contractors) ? response.contractors : [];
                const totalCount = Number.isFinite(Number(response.count)) ? Number(response.count) : contractors.length;

                if (!contractors.length) {
                    grid.innerHTML = '<div class="loading-note" style="color:#ddd;">No contractors found.</div>';
                    updateContractorsSummary(0, true);
                    return;
                }

                grid.innerHTML = contractors.map(renderContractorCard).join('');
                updateContractorsSummary(totalCount, false);
            } catch (err) {
                console.error('Failed to load contractors:', err);
                grid.innerHTML = '<div class="loading-note" style="color:#f5f5f5;">Unable to load contractors. Please refresh.</div>';
                updateContractorsSummary(0, true);
            }
        }

        document.addEventListener('DOMContentLoaded', loadContractors);
    </script>
</body>
</html>

