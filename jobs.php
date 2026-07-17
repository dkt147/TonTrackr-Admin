<?php
require_once 'config.php';
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
            gap: 12px;
        }

        .job-info-label {
            color: #888;
        }

        .job-info-value {
            color: #fff;
            font-weight: 500;
            text-align: right;
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

        .btn-danger {
            background: #4f1f1f;
            color: #ffb4b4;
        }

        .btn-danger:hover {
            background: #6a2b2b;
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

        .empty-state {
            grid-column: 1 / -1;
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px;
            color: #888;
            text-align: center;
        }
    </style>
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">
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

                <div id="jobsGrid" class="jobs-grid">
                    <div class="empty-state">Loading jobs...</div>
                </div>

            </div>
        </div>
    </div>

    <script>
        window.API_URL = <?php echo json_encode($API_URL, JSON_HEX_TAG); ?>;
    </script>
    <script src="assets/js/auth.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        const jobsGrid = document.getElementById('jobsGrid');

        function getJobId(job) {
            return job.id || job.job_id || job._id || null;
        }

        function formatStatus(status) {
            const value = String(status || 'pending').toLowerCase();
            if (value === 'active') return 'Active';
            if (value === 'completed') return 'Completed';
            return 'Pending';
        }

        function getStatusClass(status) {
            const value = String(status || 'pending').toLowerCase();
            if (value === 'active') return 'status-active';
            if (value === 'completed') return 'status-completed';
            return 'status-pending';
        }

        function formatMillRatesValue(value) {
            if (!value) return 'Not set';

            if (Array.isArray(value)) {
                if (value.every((item) => item && typeof item === 'object')) {
                    return value
                        .map((item) => {
                            const rate = item.rate_per_ton ?? item.rate ?? item.value ?? item.amount;
                            const millName = item.mill_name || item.name || item.mill_id || '';
                            return rate !== undefined ? (millName ? `${millName}: ${rate}` : rate) : millName;
                        })
                        .filter(Boolean)
                        .join(', ');
                }

                return value
                    .map((item) => (typeof item === 'number' ? item : (item && item.rate_per_ton !== undefined ? item.rate_per_ton : String(item))))
                    .join(', ');
            }

            return String(value);
        }

        function renderJobs(jobs) {
            if (!jobs.length) {
                jobsGrid.innerHTML = '<div class="empty-state">No jobs found yet.</div>';
                return;
            }

            jobsGrid.innerHTML = jobs.map((job) => {
                const id = getJobId(job) || 'new';
                const name = job.job_name || job.name || `Job ${id}`;
                const contractor = job.contractor_name || 'Unassigned';
                const status = formatStatus(job.status);
                const statusClass = getStatusClass(job.status);
                const millRates = formatMillRatesValue(job.mill_rates);
                const progress = Math.max(0, Math.min(100, Number(job.progress) || 0));

                return `
                    <div class="job-card">
                        <div class="job-header">
                            <h3 class="job-title">${name}</h3>
                            <span class="job-status ${statusClass}">${status}</span>
                        </div>
                        <div class="job-id">Job ID: ${id}</div>
                        <div class="job-info">
                            <div class="job-info-row">
                                <span class="job-info-label">Contractor:</span>
                                <span class="job-info-value">${contractor}</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Mill Rates:</span>
                                <span class="job-info-value">${millRates}</span>
                            </div>
                            <div class="job-info-row">
                                <span class="job-info-label">Status:</span>
                                <span class="job-info-value">${status}</span>
                            </div>
                        </div>
                        <div class="job-progress">
                            <div class="progress-label">
                                <span>Progress</span>
                                <span>${progress}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: ${progress}%"></div>
                            </div>
                        </div>
                        <div class="job-actions">
                            <button class="btn-view" onclick="location.href='job-detail.php?id=${id}'">View</button>
                            <button class="btn-edit" onclick="location.href='add-job.php?id=${id}'">Edit</button>
                            <button class="btn-danger" onclick="deleteJob('${id}')">Delete</button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function loadJobs() {
            jobsGrid.innerHTML = '<div class="empty-state">Loading jobs...</div>';

            try {
                const payload = await fetchWithAuth(`${window.API_URL}/jobs`, { method: 'GET' });
                const jobs = Array.isArray(payload) ? payload : (payload && payload.jobs ? payload.jobs : []);
                renderJobs(jobs);
            } catch (error) {
                console.error(error);
                jobsGrid.innerHTML = '<div class="empty-state">Unable to load jobs right now.</div>';
            }
        }

        async function deleteJob(jobId) {
            if (!jobId || !confirm('Delete this job?')) {
                return;
            }

            try {
                await fetchWithAuth(`${window.API_URL}/jobs/${jobId}`, { method: 'DELETE' });
                loadJobs();
            } catch (error) {
                console.error(error);
                alert(error.message || 'Unable to delete job.');
            }
        }

        loadJobs();
    </script>
</body>
</html>
