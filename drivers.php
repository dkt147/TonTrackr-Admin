<?php
$pageTitle  = 'Drivers';
$activePage = 'drivers';
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

        .drivers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .driver-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            transition: all 0.2s ease;
        }

        .driver-card:hover {
            border-color: var(--green);
            box-shadow: 0 8px 24px rgba(116, 170, 80, 0.15);
            transform: translateY(-4px);
        }

        .driver-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
            color: #000;
            margin-bottom: 16px;
        }

        .driver-name {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .driver-id {
            font-size: 12px;
            color: #888;
            margin-bottom: 12px;
        }

        .driver-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 13px;
        }

        .driver-info-row {
            display: flex;
            justify-content: space-between;
        }

        .driver-info-label {
            color: #888;
        }

        .driver-info-value {
            color: #fff;
            font-weight: 500;
        }

        .driver-actions {
            display: flex;
            gap: 10px;
        }

        .driver-actions button {
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

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state-title {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .empty-state-text {
            font-size: 14px;
            color: #888;
            margin-bottom: 20px;
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
                            <h1 class="page-title">Drivers</h1>
                            <p class="page-sub" id="driversSummary">Loading drivers...</p>
                        </div>
                    </div>
                    <button class="add-btn-primary" onclick="location.href='add-driver.php'">+ ADD DRIVER</button>
                </div>

                <div class="drivers-grid" id="driversGrid">
                    <div class="empty-state">
                        <div class="empty-state-icon">⏳</div>
                        <div class="empty-state-title">Loading drivers...</div>
                        <div class="empty-state-text">Please wait while we load your fleet drivers.</div>
                    </div>
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

        function getInitials(name) {
            if (!name) return 'DR';
            return name
                .split(' ')
                .map(part => part[0])
                .slice(0, 2)
                .join('')
                .toUpperCase();
        }

        function getField(value, alt) {
            return value || alt || '—';
        }

        function getDriverTitle(driver) {
            return driver.display_name || driver.displayName || driver.email || 'Unnamed Driver';
        }

        function getDriverStatus(driver) {
            const status = driver.status || (driver.is_subscription_active === false ? 'inactive' : 'active');
            if (status.toLowerCase() === 'active') return 'var(--green)';
            if (status.toLowerCase() === 'inactive') return '#888';
            return '#FFB800';
        }

        function renderDriverCard(driver) {
            const initials = getInitials(getDriverTitle(driver));
            const statusColor = getDriverStatus(driver);
            const phone = getField(driver.contact_phone, driver.phone);
            const email = getField(driver.email, driver.contact_email);
            const vehicle = driver.assigned_vehicle ? driver.assigned_vehicle.plate_number || driver.assigned_vehicle.truck_number : 'None';
            const id = driver.uid || '';

            return `
                <div class="driver-card">
                    <div class="driver-avatar">${initials}</div>
                    <div class="driver-name">${getDriverTitle(driver)}</div>
                    <div class="driver-id">Driver ID: ${id || 'N/A'}</div>
                    <div class="driver-info">
                        <div class="driver-info-row">
                            <span class="driver-info-label">Status:</span>
                            <span class="driver-info-value" style="color: ${statusColor};">${getField(driver.status, driver.is_subscription_active === false ? 'Inactive' : 'Active')}</span>
                        </div>
                        <div class="driver-info-row">
                            <span class="driver-info-label">Phone:</span>
                            <span class="driver-info-value">${phone}</span>
                        </div>
                        <div class="driver-info-row">
                            <span class="driver-info-label">Email:</span>
                            <span class="driver-info-value">${email}</span>
                        </div>
                        <div class="driver-info-row">
                            <span class="driver-info-label">Vehicle:</span>
                            <span class="driver-info-value">${vehicle}</span>
                        </div>
                    </div>
                    <div class="driver-actions">
                        <button class="btn-view" onclick="location.href='driver-detail.php?id=${encodeURIComponent(id)}'">View Profile</button>
                        <button class="btn-edit" onclick="location.href='driver-detail.php?id=${encodeURIComponent(id)}'">Details</button>
                    </div>
                </div>`;
        }

        function showEmptyState(message) {
            const grid = document.getElementById('driversGrid');
            grid.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">⚠️</div>
                    <div class="empty-state-title">${message}</div>
                    <div class="empty-state-text">Try refreshing or checking your network.</div>
                </div>`;
        }

        function updateDriversSummary(totalCount) {
            const summary = document.getElementById('driversSummary');
            if (!summary) return;
            summary.textContent = totalCount > 0 ? `${totalCount} driver${totalCount === 1 ? '' : 's'} found` : 'No drivers found';
        }

        async function loadDrivers() {
            const grid = document.getElementById('driversGrid');

            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/drivers`);
                const drivers = Array.isArray(response?.drivers) ? response.drivers : (Array.isArray(response) ? response : []);
                const totalCount = Number.isFinite(Number(response?.count)) ? Number(response.count) : drivers.length;

                if (!drivers.length) {
                    updateDriversSummary(0);
                    showEmptyState('No drivers found.');
                    return;
                }

                updateDriversSummary(totalCount);
                grid.innerHTML = drivers.map(renderDriverCard).join('');
            } catch (error) {
                console.error('Failed to load drivers:', error);
                updateDriversSummary(0);
                showEmptyState('Unable to load drivers.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadDrivers);
    </script>
</body>
</html>

