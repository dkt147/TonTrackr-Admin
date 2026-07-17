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
                        <option value="">Loading contractors…</option>
                    </select></div>
                    <div class="form-field-box"><input type="text" id="contractor_id" placeholder="Contractor ID (required by API)"></div>
                    <div class="form-field-box"><input type="text" id="contractor_name" placeholder="Contractor Name"></div>
                    <div class="form-field-box"><input type="email" id="contractor_email" placeholder="Contractor Email"></div>
                    <div class="form-field-box" id="millsContainer">Loading mills…</div>

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
                // populate mill rate inputs if present
                if (job.mill_rates && Array.isArray(job.mill_rates)) {
                    job.mill_rates.forEach((mr) => {
                        const input = document.querySelector(`.mill-rate-input[data-mill-id="${mr.mill_id}"]`);
                        if (input) input.value = mr.rate_per_ton ?? mr.rate ?? mr.value ?? '';
                    });
                } else {
                    document.querySelectorAll('.mill-rate-input').forEach((el) => el.value = '');
                }
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
            // collect mill rates from inputs
            const millRates = Array.from(document.querySelectorAll('.mill-rate-input'))
                .map((el) => {
                    const id = el.getAttribute('data-mill-id');
                    const name = el.getAttribute('data-mill-name');
                    const raw = el.value.trim();
                    const rate = Number(raw);
                    if (!id || !Number.isFinite(rate)) return null;
                    return { mill_id: id, mill_name: name || '', rate_per_ton: rate };
                })
                .filter(Boolean);

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

        async function loadContractors() {
            try {
                const resp = await fetchWithAuth(`${window.API_URL}/contractors`);
                let contractors = [];
                if (Array.isArray(resp?.contractors)) contractors = resp.contractors;
                else if (Array.isArray(resp)) contractors = resp;

                const sel = document.getElementById('contractor');
                sel.innerHTML = '<option value="">Select Contractor</option>';
                contractors.forEach((c) => {
                    const id = c.id ?? c.contractor_id ?? c.uid ?? c._id ?? '';
                    const name = c.name ?? c.display_name ?? c.company_name ?? c.email ?? '';
                    const opt = document.createElement('option');
                    opt.value = id;
                    opt.textContent = name;
                    opt.setAttribute('data-email', c.email || '');
                    opt.setAttribute('data-name', name);
                    sel.appendChild(opt);
                });

                sel.addEventListener('change', () => {
                    const value = sel.value;
                    const selected = sel.selectedOptions[0];
                    document.getElementById('contractor_id').value = value;
                    if (selected) {
                        const name = selected.getAttribute('data-name') || '';
                        const email = selected.getAttribute('data-email') || '';
                        // backend can fill name/email but prefill here for convenience
                        document.getElementById('contractor_name').value = name;
                        document.getElementById('contractor_email').value = email;
                    }
                });
            } catch (error) {
                console.error('Failed to load contractors:', error);
                const sel = document.getElementById('contractor');
                sel.innerHTML = '<option value="">Unable to load contractors</option>';
            }
        }

        async function loadMills() {
            try {
                const resp = await fetchWithAuth(`${window.API_URL}/mills`);
                let mills = [];
                if (Array.isArray(resp?.mill_rates)) mills = resp.mill_rates;
                else if (Array.isArray(resp?.mills)) mills = resp.mills;
                else if (Array.isArray(resp)) mills = resp;

                const container = document.getElementById('millsContainer');
                if (!mills.length) {
                    container.innerHTML = '<div style="color:#888;">No mills available</div>';
                    return;
                }

                container.innerHTML = '';
                mills.forEach((m) => {
                    const id = m.mill_id ?? m.id ?? m._id ?? '';
                    const name = m.mill_name ?? m.name ?? '';
                    const rate = m.rate_per_ton ?? m.rate ?? '';

                    const row = document.createElement('div');
                    row.style.display = 'flex';
                    row.style.gap = '8px';
                    row.style.marginBottom = '8px';

                    const label = document.createElement('div');
                    label.style.minWidth = '160px';
                    label.textContent = name || id;

                    const inputBox = document.createElement('div');
                    inputBox.style.flex = '1';
                    inputBox.style.background = 'transparent';

                    const input = document.createElement('input');
                    input.type = 'number';
                    input.step = '0.01';
                    input.className = 'mill-rate-input';
                    input.setAttribute('data-mill-id', id);
                    input.setAttribute('data-mill-name', name);
                    input.placeholder = 'Rate per ton';
                    if (rate !== undefined && rate !== null) input.value = rate;

                    inputBox.appendChild(input);
                    row.appendChild(label);
                    row.appendChild(inputBox);
                    container.appendChild(row);
                });
            } catch (error) {
                console.error('Failed to load mills:', error);
                const container = document.getElementById('millsContainer');
                container.innerHTML = '<div style="color:#888;">Unable to load mills</div>';
            }
        }

        // initialize contractors and mills then load job (if editing)
        (async function init() {
            try {
                await requireAuthOrRedirect('login.php');
            } catch (e) {
                // handled by auth
            }
            await Promise.all([loadContractors(), loadMills()]);
            await loadJobForEdit();
        })();
    </script>
</body>
</html>
