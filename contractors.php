<?php
$pageTitle  = 'Contractors';
$activePage = 'contractors';
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
                            <h1 class="page-title">Contractors</h1>
                            <p class="page-sub">Manage contractor and supplier partnerships</p>
                        </div>
                    </div>
                    <button class="add-btn-primary" onclick="location.href='add-contractor.php'">+ ADD CONTRACTOR</button>
                </div>

                <div class="contractors-grid">
                    <!-- Contractor Card 1 -->
                    <div class="contractor-card">
                        <div class="contractor-avatar">JP</div>
                        <div class="contractor-name">John's Timber</div>
                        <div class="contractor-type">Mill Owner</div>
                        <div class="contractor-info">
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Status:</span>
                                <span class="contractor-info-value" style="color: var(--green);">Active</span>
                            </div>
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Location:</span>
                                <span class="contractor-info-value">Snoqualmie, WA</span>
                            </div>
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Contact:</span>
                                <span class="contractor-info-value">(206) 555-0126</span>
                            </div>
                        </div>
                        <div class="contractor-actions">
                            <button class="btn-view" onclick="location.href='contractor-detail.php?id=1'">View Details</button>
                            <button class="btn-edit" onclick="location.href='add-contractor.php?id=1'">Edit</button>
                        </div>
                    </div>

                    <!-- Contractor Card 2 -->
                    <div class="contractor-card">
                        <div class="contractor-avatar">ML</div>
                        <div class="contractor-name">Mountain Lumber</div>
                        <div class="contractor-type">Supplier</div>
                        <div class="contractor-info">
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Status:</span>
                                <span class="contractor-info-value" style="color: var(--green);">Active</span>
                            </div>
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Location:</span>
                                <span class="contractor-info-value">North Bend, WA</span>
                            </div>
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Contact:</span>
                                <span class="contractor-info-value">(206) 555-0127</span>
                            </div>
                        </div>
                        <div class="contractor-actions">
                            <button class="btn-view" onclick="location.href='contractor-detail.php?id=2'">View Details</button>
                            <button class="btn-edit" onclick="location.href='add-contractor.php?id=2'">Edit</button>
                        </div>
                    </div>

                    <!-- Contractor Card 3 -->
                    <div class="contractor-card">
                        <div class="contractor-avatar">CW</div>
                        <div class="contractor-name">Crown Wood Works</div>
                        <div class="contractor-type">Mill Owner</div>
                        <div class="contractor-info">
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Status:</span>
                                <span class="contractor-info-value" style="color: #FFB800;">Pending</span>
                            </div>
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Location:</span>
                                <span class="contractor-info-value">Issaquah, WA</span>
                            </div>
                            <div class="contractor-info-row">
                                <span class="contractor-info-label">Contact:</span>
                                <span class="contractor-info-value">(206) 555-0128</span>
                            </div>
                        </div>
                        <div class="contractor-actions">
                            <button class="btn-view" onclick="location.href='contractor-detail.php?id=3'">View Details</button>
                            <button class="btn-edit" onclick="location.href='add-contractor.php?id=3'">Edit</button>
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
