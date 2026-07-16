<?php
require_once 'config.php';
$pageTitle  = 'Add Job';
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
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes\\sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes\\header.php'; ?>

            <div class="page-content">

                <div class="page-head">
                    <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='jobs.php'">
                        <button class="btn-pill small" type="button" onclick="location.href='jobs.php'">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Jobs</p>
                            <h1 class="page-title" id="pageTitle">Add a New Job</h1>
                            <p class="page-sub" id="pageSubtitle" style="margin-top:6px">Create a new job assignment for your fleet.</p>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="width:100%; max-width:none;">
                    <div class="section-title">Job Information</div>
                    <p class="section-sub">Enter the job name and description.</p>

                    <div class="form-field-box"><input type="text" id="job_title" placeholder="Job Title"></div>
                    <div class="form-field-box"><input type="text" id="job_description" placeholder="Job Description"></div>

                    <div class="section-title" style="margin-top:28px">Contractor Details</div>
                    <p class="section-sub">Enter the contractor ID from the API payload and the contractor details for the request.</p>

                    <div class="form-field-box"><select id="contractor">
                        <option value="">Select Preset Contractor</option>
                        <option value="John's Timber">John's Timber</option>
                        <option value="Mountain Lumber">Mountain Lumber</option>
                        <option value="Crown Wood Works">Crown Wood Works</option>
                    </select></div>
                    <div class="form-field-box"><input type="text" id="contractor_id" placeholder="Contractor ID (required by API)"></div>
                    <div class="form-field-box"><input type="text" id="contractor_name" placeholder="Contractor Name"></div>
                    <div class="form-field-box"><input type="email" id="contractor_email" placeholder="Contractor Email"></div>
                    <div class="form-field-box"><input type="text" id="mill_rates" placeholder="Mill rates (comma separated, e.g. 7.5, 8.25)"></div>

                    <div class="section-title" style="margin-top:28px">Status</div>
                    <p class="section-sub">Set the initial job status.</p>

                    <div class="form-field-box"><select id="status">
                        <option value="">Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select></div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:28px">
                        <button class="btn-pill small" type="button" onclick="location.href='jobs.php'">Cancel</button>
                        <button class="btn-pill primary" id="saveJobBtn" type="button" onclick="submitJob()">Save Job</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
            --tan: #BAAC88;
            --cream: #D7D2C9;
            --black: #000000;
            --sidebar-bg: #0a0a0a;
            --sidebar-bg-soft: #141414;
            --sidebar-text: #A0A0A0;
            --sidebar-text-dim: #555555;
            --card-bg: #111111;
            --border-color: #2A2A2A;
            --good: #74AA50;
            --good-bg: rgba(116, 170, 80, 0.15);
            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-card: 0 4px 15px rgba(0, 0, 0, 0.6);
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: var(--black); color: #ffffff; -webkit-font-smoothing: antialiased; }

        .page-content { padding: 32px; flex: 1; }
        .page-head { display: flex; align-items: center; margin-bottom: 32px; }
        .page-eyebrow { font-size: 12px; text-transform: uppercase; color: var(--green); font-weight: 600; letter-spacing: 0.08em; }
        .page-title { font-size: 28px; font-weight: 700; color: #fff; margin: 0; }
        .page-sub { font-size: 13px; color: #888; margin: 4px 0 0 0; }

        .btn-pill {
            padding: 10px 20px;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: #888;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }

        .btn-pill:hover { color: #fff; border-color: #555; }
        .btn-pill.small { padding: 8px 16px; font-size: 12px; }
        .btn-pill.primary { background: var(--green); color: #000; border: none; }
        .btn-pill.primary:hover { opacity: 0.9; }

        .section-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px;
        }

        .section-title { font-size: 16px; font-weight: 600; color: #fff; margin-bottom: 8px; }
        .section-sub { font-size: 13px; color: #888; margin-bottom: 20px; }

        .form-field-box {
            background: #1A1A1A;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            color: #fff;
            transition: border-color 0.2s;
        }

        .form-field-box:focus-within { border-color: var(--green); }
        .form-field-box input,
        .form-field-box select {
            flex: 1;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            padding: 0;
            width: 100%;
        }

        .form-field-box input::placeholder {
            color: #555;
        }

        .form-field-box select option {
            background: #1A1A1A;
            color: #fff;
        }
    </style>

    <script>
        window.API_URL = <?php echo json_encode($API_URL, JSON_HEX_TAG); ?>;
    </script>
    <script src="assets/js/auth.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        const editJobId = <?php echo json_encode($jobId); ?>;
        const isEditing = Boolean(editJobId);

        function parseMillRates(value) {
            if (!value) return [];

            if (Array.isArray(value)) {
                return value
                    .map((item) => {
                        if (typeof item === 'number') return item;
                        if (typeof item === 'string') return Number(item);
                        if (item && typeof item === 'object') {
                            const directValue = item.rate_per_ton ?? item.rate ?? item.value ?? item.amount;
                            return Number(directValue);
                        }
                        return null;
                    })
                    .filter((item) => Number.isFinite(item));
            }

            return String(value)
                .split(',')
                .map((item) => item.trim())
                .filter(Boolean)
                .map((item) => Number(item))
                .filter((item) => Number.isFinite(item));
        }

        function formatMillRatesForInput(value) {
            if (!value) return '';

            if (Array.isArray(value)) {
                return value
                    .map((item) => {
                        if (typeof item === 'number') return item;
                        if (typeof item === 'string') return item;
                        if (item && typeof item === 'object') {
                            return item.rate_per_ton ?? item.rate ?? item.value ?? item.amount ?? '';
                        }
                        return '';
                    })
                    .filter((item) => item !== '' && item !== null && item !== undefined)
                    .join(', ');
            }

            return String(value);
        }

        function getSelectedContractorName() {
            const customName = document.getElementById('contractor_name').value.trim();
            if (customName) {
                return customName;
            }
            return document.getElementById('contractor').value.trim();
        }

        async function loadJobForEdit() {
            if (!isEditing) {
                return;
            }

            document.getElementById('pageTitle').textContent = 'Edit Job';
            document.getElementById('pageSubtitle').textContent = 'Update the selected job details.';
            document.getElementById('saveJobBtn').textContent = 'Update Job';

            try {
                const job = await fetchWithAuth(`${window.API_URL}/jobs/${editJobId}`, { method: 'GET' });
                document.getElementById('job_title').value = job.job_name || job.name || '';
                document.getElementById('job_description').value = job.description || '';
                document.getElementById('contractor').value = job.contractor_name || '';
                document.getElementById('contractor_id').value = job.contractor_id || '';
                document.getElementById('contractor_name').value = job.contractor_name || '';
                document.getElementById('contractor_email').value = job.contractor_email || '';
                document.getElementById('mill_rates').value = formatMillRatesForInput(job.mill_rates);
                document.getElementById('status').value = String(job.status || 'pending').toLowerCase();
            } catch (error) {
                console.error(error);
                alert(error.message || 'Unable to load job details.');
            }
        }

        async function submitJob() {
            const jobTitle = document.getElementById('job_title').value.trim();
            const contractorName = getSelectedContractorName();
            const contractorEmail = document.getElementById('contractor_email').value.trim();
            const contractorId = document.getElementById('contractor_id').value.trim() || document.getElementById('contractor').value.trim();
            const status = document.getElementById('status').value;
            const millRates = parseMillRates(document.getElementById('mill_rates').value);

            if (!jobTitle || !contractorName || !contractorId) {
                alert('Please enter a job name, contractor name, and contractor ID.');
                return;
            }

            const payload = {
                contractor_email: contractorEmail,
                contractor_id: contractorId,
                contractor_name: contractorName,
                job_name: jobTitle,
                mill_rates: millRates,
                status: status || 'pending'
            };

            try {
                const url = isEditing ? `${window.API_URL}/jobs/${encodeURIComponent(editJobId)}` : `${window.API_URL}/jobs`;
                const method = isEditing ? 'PUT' : 'POST';
                await fetchWithAuth(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                alert(isEditing ? 'Job updated successfully.' : 'Job created successfully.');
                location.href = 'jobs.php';
            } catch (error) {
                console.error('Save job error:', error);
                // Try to show server JSON error if available
                try {
                    const parsed = typeof error === 'string' ? JSON.parse(error) : (error && error.message ? JSON.parse(error.message) : null);
                    alert(parsed && parsed.error ? parsed.error : (error.message || 'Unable to save job.'));
                } catch (e) {
                    alert(error.message || 'Unable to save job.');
                }
            }
        }

        loadJobForEdit();
    </script>
</body>
</html>
