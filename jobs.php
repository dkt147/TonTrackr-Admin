<?php
$pageTitle  = 'Jobs';
$activePage = 'jobs';
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

        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 20px;
        }

        .job-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            transition: all 0.2s ease;
        }

        .job-card:hover {
            border-color: var(--green);
            box-shadow: 0 8px 24px rgba(116, 170, 80, 0.15);
            transform: translateY(-4px);
        }

        .job-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .job-title {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .job-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-active {
            background: rgba(116, 170, 80, 0.2);
            color: var(--green);
        }

        .status-pending {
            background: rgba(255, 184, 0, 0.2);
            color: #FFB800;
        }

        .status-completed {
            background: rgba(0, 200, 150, 0.2);
            color: #00c896;
        }

        .job-id {
            font-size: 12px;
            color: #888;
            margin-bottom: 12px;
        }

        .job-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 13px;
        }

        .job-info-row {
            display: flex;
            justify-content: space-between;
        }

        .job-info-label {
            color: #888;
        }

        .job-info-value {
            color: #fff;
            font-weight: 500;
        }

        .job-progress {
            margin-bottom: 16px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .progress-label {
            font-size: 12px;
            color: #888;
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #1A1A1A;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--green);
            border-radius: 3px;
        }

        .job-actions {
            display: flex;
            gap: 10px;
        }

        .job-actions button {
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
                            <h1 class="page-title">Jobs</h1>
                            <p class="page-sub">View and manage all active jobs</p>
                        </div>
                    </div>
                    <button class="add-btn-primary" onclick="location.href='add-job.php'">+ ADD JOB</button>
                </div>

                <div class="jobs-grid">
                    <!-- Job Card 1 -->
                    <div class="job-card">
                        <div class="job-header">
                            <h3 class="job-title">Snoqualmie Mill Haul</h3>
                            <span class="job-status status-active">Active</span>
                        </div>
                        <div class="job-id">Job ID: JOB-001</div>
                        <div class="job-info">
                            <div class="job-info-row">
                                <span class="job-info-label">Contractor:</span>
                                <span class="job-info-value">John's Timber</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Driver:</span>
                                <span class="job-info-value">Kaylee K.</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Load:</span>
                                <span class="job-info-value">Long Log - 45 tons</span>
                            </div>
                        </div>
                        <div class="job-progress">
                            <div class="progress-label">
                                <span>Progress</span>
                                <span>75%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="job-actions">
                            <button class="btn-view" onclick="location.href='job-detail.php?id=1'">View Job</button>
                            <button class="btn-edit" onclick="location.href='add-job.php?id=1'">Edit</button>
                        </div>
                    </div>

                    <!-- Job Card 2 -->
                    <div class="job-card">
                        <div class="job-header">
                            <h3 class="job-title">North Bend Transport</h3>
                            <span class="job-status status-active">Active</span>
                        </div>
                        <div class="job-id">Job ID: JOB-002</div>
                        <div class="job-info">
                            <div class="job-info-row">
                                <span class="job-info-label">Contractor:</span>
                                <span class="job-info-value">Mountain Lumber</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Driver:</span>
                                <span class="job-info-value">Jake M.</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Load:</span>
                                <span class="job-info-value">Short Log - 38 tons</span>
                            </div>
                        </div>
                        <div class="job-progress">
                            <div class="progress-label">
                                <span>Progress</span>
                                <span>50%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 50%"></div>
                            </div>
                        </div>
                        <div class="job-actions">
                            <button class="btn-view" onclick="location.href='job-detail.php?id=2'">View Job</button>
                            <button class="btn-edit" onclick="location.href='add-job.php?id=2'">Edit</button>
                        </div>
                    </div>

                    <!-- Job Card 3 -->
                    <div class="job-card">
                        <div class="job-header">
                            <h3 class="job-title">Issaquah Delivery</h3>
                            <span class="job-status status-pending">Pending</span>
                        </div>
                        <div class="job-id">Job ID: JOB-003</div>
                        <div class="job-info">
                            <div class="job-info-row">
                                <span class="job-info-label">Contractor:</span>
                                <span class="job-info-value">Crown Wood Works</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Driver:</span>
                                <span class="job-info-value">Unassigned</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Load:</span>
                                <span class="job-info-value">Mixed - 42 tons</span>
                            </div>
                        </div>
                        <div class="job-progress">
                            <div class="progress-label">
                                <span>Progress</span>
                                <span>0%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="job-actions">
                            <button class="btn-view" onclick="location.href='job-detail.php?id=3'">View Job</button>
                            <button class="btn-edit" onclick="location.href='add-job.php?id=3'">Edit</button>
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
