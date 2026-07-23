<?php
// add-mill.php
$pageTitle  = 'Add a Mill';
$activePage = 'mills';
include 'config.php';
$millId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$isEdit = !empty($millId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · <?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <style>
        :root {
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
            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-card: 0 4px 15px rgba(0, 0, 0, 0.6);
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--black);
            color: #ffffff;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
        }

        img {
            max-width: 100%;
            display: block;
        }

        h1,
        h2,
        h3,
        h4 {
            margin: 0;
            color: #ffffff;
            font-weight: 600;
        }

        .main-wrapper {
            display: flex;
            min-height: 100vh;
            background: var(--black);
        }

        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 40;
            border-right: 1px solid var(--border-color);
            transition: transform .25s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-name {
            font-weight: 700;
            font-size: 20px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .brand-tag {
            font-size: 10px;
            letter-spacing: 0.08em;
            color: var(--green);
            text-transform: uppercase;
        }

        .nav-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 24px 16px;
        }

        .nav-group {
            margin-bottom: 32px;
        }

        .nav-group-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--sidebar-text-dim);
            padding: 0 8px;
            margin-bottom: 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            color: var(--sidebar-text);
            margin-bottom: 4px;
            transition: all .15s ease;
        }

        .nav-link svg {
            flex-shrink: 0;
            opacity: .7;
        }

        .nav-link:hover {
            background: var(--sidebar-bg-soft);
            color: #fff;
        }

        .nav-link.active {
            background: var(--dark-green);
            color: #fff;
            box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4);
        }

        .nav-link.active svg {
            opacity: 1;
            color: var(--green);
        }

        .nav-badge {
            margin-left: auto;
            background: var(--teal);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 999px;
        }

        .sidebar-footer {
            padding: 16px 20px 24px;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--teal);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .sidebar-user-role {
            font-size: 11px;
            color: var(--sidebar-text-dim);
        }

        .logout-btn {
            margin-left: auto;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--sidebar-bg-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-text);
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            z-index: 35;
        }

        .page-wrapper {
            flex: 1;
            margin-left: var(--sidebar-w);
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: var(--topbar-h);
            background: #050505;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 30;
        }

        .menu-toggle {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid var(--border-color);
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
        }

        .topbar-title {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.3px;
            flex-shrink: 0;
        }

        .topbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 14px;
            border-left: 1px solid var(--border-color);
            cursor: pointer;
        }

        .topbar-profile .name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            line-height: 1.2;
        }

        .topbar-profile .role {
            font-size: 11px;
            color: #888;
        }

        .page-content {
            padding: 32px;
            flex: 1;
        }

        .back-home-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: none;
            color: #888;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            padding: 0;
        }

        .back-home-btn:hover {
            color: #fff;
        }

        .form-section {
            margin-bottom: 24px;
        }

        .form-section-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--green);
            padding: 0;
            margin-bottom: 16px;
        }

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

        .form-field-box:focus-within {
            border-color: var(--green);
        }

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

        .step-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .helper-text {
            font-size: 12px;
            color: #888;
            margin: 0 0 12px 0;
        }

        .button-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .button-row .btn-block {
            margin-top: 0;
            flex: 1;
            min-width: 140px;
        }

        .btn-block {
            width: 100%;
            padding: 16px;
            border-radius: var(--radius-lg);
            border: none;
            font-weight: 700;
            font-size: 15px;
            margin-top: 12px;
            transition: all 0.15s;
        }

        .btn-green {
            background: var(--green);
            color: #fff;
        }

        .btn-green:hover {
            opacity: 0.9;
            transform: scale(1.01);
        }

        .btn-dark {
            background: #222;
            color: #fff;
        }

        .btn-dark:hover {
            background: #333;
        }

        .btn-danger {
            background: #8b2f2f;
            color: #fff;
        }

        .btn-danger:hover {
            background: #a33b3b;
        }

        .mills-list {
            display: grid;
            gap: 10px;
        }

        .mill-card {
            padding: 12px 14px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: #141414;
            cursor: pointer;
        }

        .mill-card:hover {
            border-color: var(--green);
        }

        .mill-card.active {
            border-color: var(--green);
            background: rgba(116, 170, 80, 0.14);
        }

        .mill-card-title {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .mill-card-meta {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }

        .report-box {
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: #141414;
            font-size: 13px;
            color: #ccc;
        }

        @media (max-width:1080px) {
            .page-content {
                padding: 28px;
            }
        }

        @media (max-width:860px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .page-wrapper {
                margin-left: 0;
            }

            .menu-toggle {
                display: flex;
            }

            .sidebar-overlay.open {
                display: block;
            }
        }

        @media (max-width:560px) {
            .page-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes/header.php'; ?>
            <div class="page-content">
                <!-- Back Button -->
                <button class="back-home-btn" onclick="window.location.href='dashboard.php'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back to Dashboard
                </button>

                <!-- ================= ADD MILL FORM ================= -->
                <h2 class="step-title"><?php echo $isEdit ? 'Edit Mill' : 'Add a Mill'; ?></h2>
                <p class="helper-text">
                    <?php echo $isEdit ? 'Update the selected mill and its reporting details.' : 'Create a new mill entry and keep the directory in sync.'; ?>
                </p>

                <div class="form-section">
                    <div class="form-section-label">MILL DIRECTORY</div>
                    <p class="helper-text">Existing mills loaded from the API.</p>
                    <div id="mills_status" class="helper-text">Loading mills...</div>
                    <div id="mills_list" class="mills-list"></div>
                </div>

                <div class="form-section">
                    <div class="form-section-label">MILL DETAILS</div>
                    <input type="hidden" id="mill_id" value="">

                    <div class="form-field-box">
                        <input type="text" id="mill_name" placeholder="Full Mill Name">
                    </div>

                    <div class="form-field-box">
                        <input type="text" id="mill_abbr" placeholder="Abbreviated Name">
                    </div>

                    <div class="form-field-box">
                        <input type="text" id="mill_location" placeholder="Location (city, state)">
                    </div>

                    <div class="form-field-box">
                        <select id="mill_status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="button-row">
                        <button class="btn-block btn-green" id="submit_mill_btn" type="button" onclick="saveMill()">SAVE
                            MILL</button>
                        <button class="btn-block btn-dark" type="button" onclick="resetMillForm()">CLEAR</button>
                        <button class="btn-block btn-danger" id="delete_mill_btn" type="button"
                            onclick="deleteSelectedMill()" style="display:none;">DELETE MILL</button>
                    </div>
                </div>

                <div class="form-section" id="mill_report_panel" style="display:none;">
                    <div class="form-section-label">MILL REPORT</div>
                    <div id="mill_report" class="report-box">Select a mill to view its report.</div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        window.MILL_ID = '<?php echo addslashes($millId); ?>';
        window.IS_EDIT_MODE = '<?php echo $isEdit ? "1" : "0"; ?>';
    </script>
    <script src="assets/js/auth.js?v=4"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function escapeHtml(value) {
            return String(value ?? '')   // ✅
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/\"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function setSubmitButtonState(isLoading) {
            const button = document.getElementById('submit_mill_btn');
            if (!button) return;
            button.disabled = isLoading;
            button.textContent = isLoading ? 'SAVING...' : 'SAVE MILL';
        }

        function resetMillForm() {
            document.getElementById('mill_id').value = window.MILL_ID || '';
            document.getElementById('mill_name').value = '';
            document.getElementById('mill_abbr').value = '';
            document.getElementById('mill_location').value = '';
            document.getElementById('mill_status').value = 'active';
            document.getElementById('mill_report').innerHTML = 'Select a mill to view its report.';
            document.getElementById('mill_report_panel').style.display = window.MILL_ID ? 'block' : 'none';
            document.getElementById('delete_mill_btn').style.display = window.MILL_ID ? 'inline-block' : 'none';
            document.querySelectorAll('.mill-card').forEach((card) => card.classList.remove('active'));
        }
        async function loadMills() {
            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/mills`);
                const mills = Array.isArray(response?.mills) ? response.mills : [];
                const list = document.getElementById('mills_list');
                const status = document.getElementById('mills_status');
                if (status) {
                    status.textContent = `${mills.length} mill${mills.length === 1 ? '' : 's'} available`;
                }
                if (!list) return;
                if (!mills.length) {
                    list.innerHTML =
                        '<div class="mill-card"><div class="mill-card-title">No mills found</div><div class="mill-card-meta">Create one to get started.</div></div>';
                    return;
                }
                list.innerHTML = mills.map((mill) => `
                <div class="mill-card" data-id="${escapeHtml(mill.id)}" onclick="selectMill('${escapeHtml(mill.id)}')">
                    <div class="mill-card-title">${escapeHtml(mill.full_name || mill.abbreviated_name || 'Unnamed Mill')}</div>
                    <div class="mill-card-meta">${escapeHtml(mill.abbreviated_name || '')} • ${escapeHtml(mill.location || 'No location')}</div>
                </div>
            `).join('');
            } catch (error) {
                console.error('Failed to load mills:', error);
                const list = document.getElementById('mills_list');
                if (list) {
                    list.innerHTML =
                        '<div class="mill-card"><div class="mill-card-title">Unable to load mills</div><div class="mill-card-meta">Please refresh or sign in again.</div></div>';
                }
            }
        }
        async function selectMill(millId) {
            if (!millId) return;
            document.querySelectorAll('.mill-card').forEach((card) => {
                card.classList.toggle('active', card.getAttribute('data-id') === millId);
            });
            try {
                await requireAuthOrRedirect('login.php');
                const mill = await fetchWithAuth(`${window.API_URL}/mills/${encodeURIComponent(millId)}`);
                document.getElementById('mill_id').value = mill.id || millId;
                document.getElementById('mill_name').value = mill.full_name || '';
                document.getElementById('mill_abbr').value = mill.abbreviated_name || '';
                document.getElementById('mill_location').value = mill.location || '';
                document.getElementById('mill_status').value = mill.status || 'active';
                document.getElementById('delete_mill_btn').style.display = 'inline-block';
                document.getElementById('mill_report_panel').style.display = 'block';
                const report = await fetchWithAuth(`${window.API_URL}/mills/${encodeURIComponent(millId)}/report`);
                const reportBox = document.getElementById('mill_report');
                reportBox.innerHTML = `
                <div><strong>Ticket count:</strong> ${escapeHtml(report.ticket_count ?? 0)}</div>
                <div><strong>Total ticket amount:</strong> ${escapeHtml(report.total_ticket_amount ?? 0)}</div>
                <div><strong>Total admin revenue:</strong> ${escapeHtml(report.total_admin_revenue ?? 0)}</div>
                <div><strong>Total driver payouts:</strong> ${escapeHtml(report.total_driver_payouts ?? 0)}</div>
            `;
            } catch (error) {
                console.error('Failed to load mill details:', error);
                alert(error.message || 'Unable to load mill details.');
            }
        }
        async function loadMillForEdit() {
            if (!window.MILL_ID) return;
            try {
                await requireAuthOrRedirect('login.php');
                const mill = await fetchWithAuth(`${window.API_URL}/mills/${encodeURIComponent(window.MILL_ID)}`);
                document.getElementById('mill_id').value = mill.id || window.MILL_ID;
                document.getElementById('mill_name').value = mill.full_name || '';
                document.getElementById('mill_abbr').value = mill.abbreviated_name || '';
                document.getElementById('mill_location').value = mill.location || '';
                document.getElementById('mill_status').value = mill.status || 'active';
                document.getElementById('delete_mill_btn').style.display = 'inline-block';
                document.getElementById('mill_report_panel').style.display = 'block';
                const report = await fetchWithAuth(
                    `${window.API_URL}/mills/${encodeURIComponent(window.MILL_ID)}/report`).catch(() => null);
                const reportBox = document.getElementById('mill_report');
                reportBox.innerHTML = report ? `
                <div><strong>Ticket count:</strong> ${escapeHtml(report.ticket_count ?? 0)}</div>
                <div><strong>Total ticket amount:</strong> ${escapeHtml(report.total_ticket_amount ?? 0)}</div>
                <div><strong>Total admin revenue:</strong> ${escapeHtml(report.total_admin_revenue ?? 0)}</div>
                <div><strong>Total driver payouts:</strong> ${escapeHtml(report.total_driver_payouts ?? 0)}</div>
            ` : '<div class="mini-item">No report data found.</div>';
            } catch (error) {
                console.error('Failed to load mill for edit:', error);
                alert(error.message || 'Unable to load mill.');
            }
        }
        async function saveMill() {
            const millName = document.getElementById('mill_name').value.trim();
            const millAbbr = document.getElementById('mill_abbr').value.trim();
            const millLocation = document.getElementById('mill_location').value.trim();
            const status = document.getElementById('mill_status').value;
            const millId = document.getElementById('mill_id').value.trim();
            if (!millName || !millAbbr || !millLocation) {
                alert('Please fill in all fields');
                return;
            }
            setSubmitButtonState(true);
            try {
                await requireAuthOrRedirect('login.php');
                const payload = {
                    abbreviated_name: millAbbr,
                    full_name: millName,
                    location: millLocation,
                    status
                };
                const url = millId ?
                    `${window.API_URL}/mills/${encodeURIComponent(millId)}` :
                    `${window.API_URL}/mills`;
                const method = millId ? 'PUT' : 'POST';
                const response = await fetchWithAuth(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                const message = response?.message || (millId ? 'Mill updated successfully.' : 'Mill created successfully.');
                alert(message);
                resetMillForm();
                await loadMills();
            } catch (error) {
                console.error('Failed to save mill:', error);
                alert(error.message || 'Unable to save mill.');
            } finally {
                setSubmitButtonState(false);
            }
        }
        async function deleteSelectedMill() {
            const millId = document.getElementById('mill_id').value.trim();
            if (!millId) return;
            const confirmed = confirm('Delete this mill from the API?');
            if (!confirmed) return;
            try {
                await requireAuthOrRedirect('login.php');
                await fetchWithAuth(`${window.API_URL}/mills/${encodeURIComponent(millId)}`, {
                    method: 'DELETE'
                });
                alert('Mill deleted.');
                resetMillForm();
                await loadMills();
            } catch (error) {
                console.error('Failed to delete mill:', error);
                alert(error.message || 'Unable to delete mill.');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            resetMillForm();
            loadMills();
            if (window.MILL_ID) {
                loadMillForEdit();
            }
        });
    </script>
</body>

</html>
