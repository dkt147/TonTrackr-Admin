<?php
$pageTitle  = 'Drivers';
$activePage = 'drivers';
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
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes\\sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes\\header.php'; ?>

            <div class="page-content">

                <div class="page-head">
                    <div class="page-head-left">
                        <div class="page-title-group">
                            <p class="page-eyebrow">Manage</p>
                            <h1 class="page-title">Drivers</h1>
                            <p class="page-sub">View and manage all drivers in your fleet</p>
                        </div>
                    </div>
                    <button class="add-btn-primary" onclick="location.href='add-driver.php'">+ ADD DRIVER</button>
                </div>

                <div class="drivers-grid">
                    <!-- Driver Card 1 -->
                    <div class="driver-card">
                        <div class="driver-avatar">KK</div>
                        <div class="driver-name">Kaylee K.</div>
                        <div class="driver-id">Driver ID: DRV-001</div>
                        <div class="driver-info">
                            <div class="driver-info-row">
                                <span class="driver-info-label">Status:</span>
                                <span class="driver-info-value" style="color: var(--green);">Active</span>
                            </div>
                            <div class="driver-info-row">
                                <span class="driver-info-label">Phone:</span>
                                <span class="driver-info-value">(206) 555-0123</span>
                            </div>
                            <div class="driver-info-row">
                                <span class="driver-info-label">License:</span>
                                <span class="driver-info-value">WA12345678</span>
                            </div>
                        </div>
                        <div class="driver-actions">
                            <button class="btn-view" onclick="location.href='driver-detail.php?id=1'">View Profile</button>
                            <button class="btn-edit" onclick="location.href='add-driver.php?id=1'">Edit</button>
                        </div>
                    </div>

                    <!-- Driver Card 2 -->
                    <div class="driver-card">
                        <div class="driver-avatar">JM</div>
                        <div class="driver-name">Jake M.</div>
                        <div class="driver-id">Driver ID: DRV-002</div>
                        <div class="driver-info">
                            <div class="driver-info-row">
                                <span class="driver-info-label">Status:</span>
                                <span class="driver-info-value" style="color: var(--green);">Active</span>
                            </div>
                            <div class="driver-info-row">
                                <span class="driver-info-label">Phone:</span>
                                <span class="driver-info-value">(206) 555-0124</span>
                            </div>
                            <div class="driver-info-row">
                                <span class="driver-info-label">License:</span>
                                <span class="driver-info-value">WA87654321</span>
                            </div>
                        </div>
                        <div class="driver-actions">
                            <button class="btn-view" onclick="location.href='driver-detail.php?id=2'">View Profile</button>
                            <button class="btn-edit" onclick="location.href='add-driver.php?id=2'">Edit</button>
                        </div>
                    </div>

                    <!-- Driver Card 3 -->
                    <div class="driver-card">
                        <div class="driver-avatar">TB</div>
                        <div class="driver-name">Travis B.</div>
                        <div class="driver-id">Driver ID: DRV-003</div>
                        <div class="driver-info">
                            <div class="driver-info-row">
                                <span class="driver-info-label">Status:</span>
                                <span class="driver-info-value" style="color: #FFB800;">On Leave</span>
                            </div>
                            <div class="driver-info-row">
                                <span class="driver-info-label">Phone:</span>
                                <span class="driver-info-value">(206) 555-0125</span>
                            </div>
                            <div class="driver-info-row">
                                <span class="driver-info-label">License:</span>
                                <span class="driver-info-value">WA55555555</span>
                            </div>
                        </div>
                        <div class="driver-actions">
                            <button class="btn-view" onclick="location.href='driver-detail.php?id=3'">View Profile</button>
                            <button class="btn-edit" onclick="location.href='add-driver.php?id=3'">Edit</button>
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
</body>
</html>
