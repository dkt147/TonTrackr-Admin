<?php
require_once 'config.php';
$pageTitle  = 'Job Details';
$activePage = 'jobs';
$jobId = isset($_GET['id']) ? trim($_GET['id']) : '';
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
        .page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px; }
        .page-title { font-size:28px; font-weight:700; color:#fff; margin:4px 0 0; }
        .page-sub { font-size:13px; color:#888; }
        .section-card { background:#111111; border:1px solid var(--border-color); border-radius:14px; padding:24px; }
        .detail-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px; }
        .detail-box { background:#1a1a1a; border:1px solid var(--border-color); border-radius:12px; padding:16px; }
        .detail-label { display:block; font-size:12px; color:#888; text-transform:uppercase; margin-bottom:8px; }
        .detail-value { color:#fff; font-weight:600; }
        .btn-row { display:flex; gap:10px; flex-wrap:wrap; margin-top:20px; }
        .btn-pill { padding:10px 20px; border-radius:20px; border:1px solid var(--border-color); background:transparent; color:#888; font-size:13px; font-weight:600; cursor:pointer; font-family:'Poppins',sans-serif; }
        .btn-pill.primary { background:var(--green); color:#000; border:none; }
        .btn-pill.danger { background:#4f1f1f; color:#ffb4b4; border:none; }
        .muted { color:#888; }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes\\sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes\\header.php'; ?>
            <div class="page-content">
                <div class="page-head">
                    <div>
                        <p class="page-eyebrow">Jobs</p>
                        <h1 class="page-title" id="jobTitle">Loading...</h1>
                        <p class="page-sub" id="jobSubtitle">Loading job information...</p>
                    </div>
                    <button class="btn-pill" type="button" onclick="location.href='jobs.php'">← BACK TO JOBS</button>
                </div>

                <div class="section-card">
                    <div class="detail-grid" id="detailGrid">
                        <div class="detail-box"><span class="detail-label">Status</span><span class="detail-value">Loading...</span></div>
                    </div>

                    <div class="btn-row">
                        <button class="btn-pill primary" type="button" onclick="editJob()">Edit Job</button>
                        <button class="btn-pill danger" type="button" onclick="deleteJob()">Delete Job</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = <?php echo json_encode($API_URL, JSON_HEX_TAG); ?>;
    </script>
    <script src="assets/js/auth.js"></script>
    <script>
        const jobId = <?php echo json_encode($jobId); ?>;

        function renderJob(job) {
            const title = job.job_name || job.name || `Job ${jobId}`;
            document.getElementById('jobTitle').textContent = title;
            document.getElementById('jobSubtitle').textContent = `Viewing job ${jobId}`;

            const details = [
                ['Contractor', job.contractor_name || 'Unassigned'],
                ['Contractor Email', job.contractor_email || '—'],
                ['Status', String(job.status || 'pending').toUpperCase()],
                ['Mill Rates', Array.isArray(job.mill_rates) ? job.mill_rates.join(', ') : (job.mill_rates || '—')],
                ['Description', job.description || '—'],
                ['ID', job.id || job.job_id || jobId]
            ];

            document.getElementById('detailGrid').innerHTML = details.map(([label, value]) => `
                <div class="detail-box">
                    <span class="detail-label">${label}</span>
                    <span class="detail-value">${value}</span>
                </div>
            `).join('');
        }

        async function loadJob() {
            if (!jobId) {
                document.getElementById('jobTitle').textContent = 'No job selected';
                document.getElementById('jobSubtitle').textContent = 'Select a job from the list.';
                return;
            }

            try {
                const job = await fetchWithAuth(`${window.API_URL}/jobs/${jobId}`, { method: 'GET' });
                renderJob(job);
            } catch (error) {
                console.error(error);
                document.getElementById('jobTitle').textContent = 'Unable to load job';
                document.getElementById('jobSubtitle').textContent = error.message || 'Please try again.';
            }
        }

        function editJob() {
            if (!jobId) return;
            location.href = `add-job.php?id=${jobId}`;
        }

        async function deleteJob() {
            if (!jobId || !confirm('Delete this job?')) return;

            try {
                await fetchWithAuth(`${window.API_URL}/jobs/${jobId}`, { method: 'DELETE' });
                location.href = 'jobs.php';
            } catch (error) {
                console.error(error);
                alert(error.message || 'Unable to delete job.');
            }
        }

        loadJob();
    </script>
</body>
</html>
