<?php
// log-miles.php
$pageTitle  = 'Log Miles';
$activePage = 'miles';
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
            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-card: 0 4px 15px rgba(0, 0, 0, 0.6);
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: var(--black); color: #ffffff; -webkit-font-smoothing: antialiased; }
        a { color: inherit; text-decoration: none; }
        button { font-family: 'Poppins', sans-serif; cursor: pointer; }
        img { max-width: 100%; display: block; }
        h1, h2, h3, h4 { margin: 0; color: #ffffff; font-weight: 600; }

        .main-wrapper { display: flex; min-height: 100vh; background: var(--black); }
        .sidebar { width: var(--sidebar-w); flex-shrink: 0; background: var(--sidebar-bg); color: var(--sidebar-text); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 40; border-right: 1px solid var(--border-color); transition: transform .25s ease; }
        .sidebar-brand { display: flex; align-items: center; gap: 12px; padding: 13px 20px; border-bottom: 1px solid var(--border-color); }
        .brand-mark { width: 40px; height: 40px; flex-shrink: 0; }
        .brand-mark img { width: 100%; height: 100%; object-fit: contain; }
        .brand-name { font-weight: 700; font-size: 20px; color: #ffffff; letter-spacing: -0.5px; }
        .brand-tag { font-size: 10px; letter-spacing: 0.08em; color: var(--green); text-transform: uppercase; }
        .nav-scroll { flex: 1; overflow-y: auto; padding: 24px 16px; }
        .nav-group { margin-bottom: 32px; }
        .nav-group-label { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--sidebar-text-dim); padding: 0 8px; margin-bottom: 12px; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 12px 14px; border-radius: var(--radius-md); font-size: 14px; font-weight: 500; color: var(--sidebar-text); margin-bottom: 4px; transition: all .15s ease; }
        .nav-link svg { flex-shrink: 0; opacity: .7; }
        .nav-link:hover { background: var(--sidebar-bg-soft); color: #fff; }
        .nav-link.active { background: var(--dark-green); color: #fff; box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4); }
        .nav-link.active svg { opacity: 1; color: var(--green); }
        .nav-badge { margin-left: auto; background: var(--teal); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px; }
        .sidebar-footer { padding: 16px 20px 24px; border-top: 1px solid var(--border-color); display: flex; align-items: center; gap: 12px; }
        .avatar-sm { width: 40px; height: 40px; border-radius: 50%; background: var(--teal); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0; }
        .sidebar-user-name { font-size: 14px; font-weight: 600; color: #fff; }
        .sidebar-user-role { font-size: 11px; color: var(--sidebar-text-dim); }
        .logout-btn { margin-left: auto; width: 34px; height: 34px; border-radius: 10px; background: var(--sidebar-bg-soft); display: flex; align-items: center; justify-content: center; color: var(--sidebar-text); border: none; cursor: pointer; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.08); color: #fff; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.8); z-index: 35; }

        .page-wrapper { flex: 1; margin-left: var(--sidebar-w); min-width: 0; display: flex; flex-direction: column; }
        .topbar { height: var(--topbar-h); background: #050505; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 18px; padding: 0 32px; position: sticky; top: 0; z-index: 30; }
        .menu-toggle { display: none; width: 38px; height: 38px; border-radius: 10px; background: transparent; border: 1px solid var(--border-color); align-items: center; justify-content: center; cursor: pointer; color: #fff; }
        .topbar-title { font-size: 18px; font-weight: 600; color: #fff; letter-spacing: -0.3px; flex-shrink: 0; }
        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 16px; }
        .topbar-profile { display: flex; align-items: center; gap: 10px; padding-left: 14px; border-left: 1px solid var(--border-color); cursor: pointer; }
        .topbar-profile .name { font-size: 13px; font-weight: 600; color: #fff; line-height: 1.2; }
        .topbar-profile .role { font-size: 11px; color: #888; }

        .page-content { padding: 32px; flex: 1; }

        .back-home-btn { display: inline-flex; align-items: center; gap: 8px; background: transparent; border: none; color: #888; font-size: 14px; font-weight: 500; margin-bottom: 20px; padding: 0; }
        .back-home-btn:hover { color: #fff; }

        .form-field-box { background: #1A1A1A; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 12px 16px; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; color: #fff; transition: border-color 0.2s; }
        .form-field-box:focus-within { border-color: var(--green); }
        .form-field-box label { font-size: 13px; color: #888; font-weight: 500; flex-shrink: 0; min-width: 120px; }
        .form-field-box input, .form-field-box select { flex: 1; background: transparent; border: none; color: #fff; font-size: 14px; font-family: 'Poppins', sans-serif; outline: none; text-align: left; padding: 4px 0; }
        .form-field-box input::placeholder { color: #555; text-align: left; }
        .form-field-box .chevron { color: #555; margin-left: 6px; }

        .step-title { font-size: 20px; font-weight: 600; margin-bottom: 8px; }
        .step-sub { font-size: 13px; color: #888; margin-bottom: 20px; }

        .btn-block { width: 100%; padding: 16px; border-radius: var(--radius-lg); border: none; font-weight: 700; font-size: 15px; margin-top: 12px; transition: all 0.15s; }
        .btn-green { background: var(--green); color: #fff; }
        .btn-green:hover { opacity: 0.9; transform: scale(1.01); }
        .btn-dark { background: #222; color: #fff; }
        .btn-dark:hover { background: #333; }

        @media (max-width:1080px) { .page-content { padding: 28px; } }
        @media (max-width:860px) { .sidebar { transform: translateX(-100%); } .sidebar.open { transform: translateX(0); } .page-wrapper { margin-left: 0; } .menu-toggle { display: flex; } .sidebar-overlay.open { display: block; } }
        @media (max-width:560px) { .page-content { padding: 20px; } }
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
                <!-- Back Button -->
                <button class="back-home-btn" onclick="window.location.href='dashboard.php'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to Dashboard
                </button>

                <!-- ================= LOG MILES FORM ================= -->
                <h2 class="step-title">Log Miles</h2>
                <p class="step-sub" style="color: var(--green); font-weight:600; letter-spacing:0.5px;">ALL FIELDS ARE REQUIRED.</p>

                <div class="form-field-box">
                    <label>Date</label>
                    <input type="date" id="log_date" value="2026-07-10">
                </div>

                <div class="form-field-box">
                    <label>Starting Miles</label>
                    <input type="number" id="starting_miles" placeholder="150,000" value="150000">
                </div>

                <div class="form-field-box">
                    <label>Ending Miles</label>
                    <input type="number" id="ending_miles" placeholder="150,450" value="150450">
                </div>

                <div class="form-field-box">
                    <label>State</label>
                    <select id="state_select">
                        <option value="AK">AK - Alaska</option>
                        <option value="AL">AL - Alabama</option>
                        <option value="AR">AR - Arkansas</option>
                        <option value="AZ">AZ - Arizona</option>
                        <option value="CA">CA - California</option>
                        <option value="CO">CO - Colorado</option>
                        <option value="CT">CT - Connecticut</option>
                        <option value="DE">DE - Delaware</option>
                        <option value="FL">FL - Florida</option>
                        <option value="GA">GA - Georgia</option>
                        <option value="HI">HI - Hawaii</option>
                        <option value="IA">IA - Iowa</option>
                        <option value="ID">ID - Idaho</option>
                        <option value="IL">IL - Illinois</option>
                        <option value="IN">IN - Indiana</option>
                        <option value="KS">KS - Kansas</option>
                        <option value="KY">KY - Kentucky</option>
                        <option value="LA">LA - Louisiana</option>
                        <option value="MA">MA - Massachusetts</option>
                        <option value="MD">MD - Maryland</option>
                        <option value="ME">ME - Maine</option>
                        <option value="MI">MI - Michigan</option>
                        <option value="MN">MN - Minnesota</option>
                        <option value="MO">MO - Missouri</option>
                        <option value="MS">MS - Mississippi</option>
                        <option value="MT">MT - Montana</option>
                        <option value="NC">NC - North Carolina</option>
                        <option value="ND">ND - North Dakota</option>
                        <option value="NE">NE - Nebraska</option>
                        <option value="NH">NH - New Hampshire</option>
                        <option value="NJ">NJ - New Jersey</option>
                        <option value="NM">NM - New Mexico</option>
                        <option value="NV">NV - Nevada</option>
                        <option value="NY">NY - New York</option>
                        <option value="OH">OH - Ohio</option>
                        <option value="OK">OK - Oklahoma</option>
                        <option value="OR">OR - Oregon</option>
                        <option value="PA">PA - Pennsylvania</option>
                        <option value="RI">RI - Rhode Island</option>
                        <option value="SC">SC - South Carolina</option>
                        <option value="SD">SD - South Dakota</option>
                        <option value="TN">TN - Tennessee</option>
                        <option value="TX">TX - Texas</option>
                        <option value="UT">UT - Utah</option>
                        <option value="VA">VA - Virginia</option>
                        <option value="VT">VT - Vermont</option>
                        <option value="WA" selected>WA - Washington</option>
                        <option value="WI">WI - Wisconsin</option>
                        <option value="WV">WV - West Virginia</option>
                        <option value="WY">WY - Wyoming</option>
                    </select>
                    <span class="chevron">▼</span>
                </div>

                <div class="form-field-box">
                    <label>Driver ID</label>
                    <input type="text" id="driver_id" placeholder="Optional driver reference">
                </div>

                <div class="form-field-box">
                    <label>Vehicle ID</label>
                    <input type="text" id="vehicle_id" placeholder="Optional vehicle reference">
                </div>

                <div class="form-field-box">
                    <label>Notes</label>
                    <input type="text" id="notes" placeholder="Optional trip notes">
                </div>

                <div style="background: #1A1A1A; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 16px; margin-bottom: 12px;">
                    <p style="font-size: 12px; color: #888; margin: 0 0 8px 0;">TOTAL MILES LOGGED</p>
                    <p style="font-size: 24px; font-weight: 700; color: var(--green); margin: 0;" id="total_miles">450</p>
                </div>

                <button class="btn-block btn-green" id="submit_miles_btn" onclick="submitMiles()">SUBMIT</button>

                <div style="margin-top:24px; background:#111111; border:1px solid var(--border-color); border-radius:var(--radius-md); padding:16px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:12px;">
                        <div>
                            <h3 style="font-size:16px; margin-bottom:4px;">Recent Mileage Entries</h3>
                            <p id="mileage_summary" style="font-size:12px; color:#888; margin:0;">Loading entries...</p>
                        </div>
                        <button class="btn-dark" type="button" onclick="loadMileageEntries()" style="padding:10px 14px; border:none; border-radius:999px; font-size:12px;">Refresh</button>
                    </div>
                    <div id="mileage_list" style="display:grid; gap:10px;"></div>
                </div>

                <p style="text-align:center; font-size:11px; color:#666; margin-top:16px;">All mile logs are recorded in your account history.</p>
            </div>
        </div>
    </div>

</div>

<script>
    window.API_URL = '<?php echo addslashes($API_URL); ?>';
</script>
<script src="assets/js/auth.js?v=3"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }

    function calculateMiles() {
        const starting = parseInt(document.getElementById('starting_miles').value) || 0;
        const ending = parseInt(document.getElementById('ending_miles').value) || 0;
        const total = ending - starting;
        document.getElementById('total_miles').textContent = total > 0 ? total.toLocaleString() : '0';
    }

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/\"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function setSubmitButtonState(isLoading) {
        const button = document.getElementById('submit_miles_btn');
        if (!button) return;
        button.disabled = isLoading;
        button.textContent = isLoading ? 'SUBMITTING...' : 'SUBMIT';
    }

    document.getElementById('starting_miles').addEventListener('change', calculateMiles);
    document.getElementById('ending_miles').addEventListener('change', calculateMiles);
    document.getElementById('ending_miles').addEventListener('input', calculateMiles);
    document.getElementById('starting_miles').addEventListener('input', calculateMiles);

    function buildMileagePayload() {
        const date = document.getElementById('log_date').value;
        const startingMiles = document.getElementById('starting_miles').value;
        const endingMiles = document.getElementById('ending_miles').value;
        const state = document.getElementById('state_select').value;
        const notes = document.getElementById('notes').value.trim();
        const driverId = document.getElementById('driver_id').value.trim();
        const vehicleId = document.getElementById('vehicle_id').value.trim();

        const payload = {
            ending_miles: Number(endingMiles),
            log_date: date,
            starting_miles: Number(startingMiles),
            state: state,
            notes: notes || ''
        };

        if (driverId) {
            payload.driver_id = driverId;
        }

        if (vehicleId) {
            payload.vehicle_id = vehicleId;
        }

        return payload;
    }

    async function loadMileageEntries() {
        try {
            await requireAuthOrRedirect('login.php');
            const response = await fetchWithAuth(`${window.API_URL}/mileage`);
            const entries = Array.isArray(response?.mileage) ? response.mileage : [];
            const summary = document.getElementById('mileage_summary');
            const list = document.getElementById('mileage_list');

            if (summary) {
                const total = typeof response?.total_miles === 'number' ? response.total_miles : entries.length;
                summary.textContent = `${entries.length} entries • ${total} total miles`;
            }

            if (!list) return;

            if (!entries.length) {
                list.innerHTML = '<div style="padding:12px; border:1px dashed #2A2A2A; border-radius:12px; color:#888;">No mileage entries yet.</div>';
                return;
            }

            list.innerHTML = entries.map((entry) => {
                const id = entry.id ?? entry._id ?? '';
                const date = entry.log_date || entry.date || '—';
                const state = entry.state || '—';
                const miles = entry.ending_miles && entry.starting_miles
                    ? Number(entry.ending_miles) - Number(entry.starting_miles)
                    : entry.total_miles || 0;
                const notes = entry.notes || 'No notes';
                return `
                    <div style="padding:12px 14px; border:1px solid var(--border-color); border-radius:12px; background:#1A1A1A; display:flex; justify-content:space-between; gap:12px; align-items:flex-start;">
                        <div>
                            <div style="font-size:13px; color:var(--green); font-weight:600;">${escapeHtml(date)} • ${escapeHtml(state)}</div>
                            <div style="font-size:12px; color:#ccc; margin-top:4px;">${escapeHtml(notes)}</div>
                            <div style="font-size:12px; color:#888; margin-top:6px;">${escapeHtml(miles)} miles</div>
                        </div>
                        <button type="button" onclick="deleteMileageEntry('${escapeHtml(id)}')" style="padding:8px 10px; border:none; border-radius:999px; background:#222; color:#fff; font-size:12px;">Delete</button>
                    </div>`;
            }).join('');
        } catch (error) {
            console.error('Failed to load mileage entries:', error);
            const list = document.getElementById('mileage_list');
            if (list) {
                list.innerHTML = '<div style="padding:12px; border:1px dashed #2A2A2A; border-radius:12px; color:#888;">Unable to load mileage entries.</div>';
            }
        }
    }

    async function submitMiles() {
        const date = document.getElementById('log_date').value;
        const startingMiles = document.getElementById('starting_miles').value;
        const endingMiles = document.getElementById('ending_miles').value;
        const state = document.getElementById('state_select').value;

        if (!date || !startingMiles || !endingMiles || !state) {
            alert('Please fill in all fields');
            return;
        }

        setSubmitButtonState(true);

        try {
            await requireAuthOrRedirect('login.php');
            const payload = buildMileagePayload();
            const response = await fetchWithAuth(`${window.API_URL}/mileage`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const message = response?.message || 'Miles logged successfully.';
            alert(message);

            document.getElementById('starting_miles').value = '';
            document.getElementById('ending_miles').value = '';
            document.getElementById('notes').value = '';
            document.getElementById('driver_id').value = '';
            document.getElementById('vehicle_id').value = '';
            document.getElementById('log_date').value = new Date().toISOString().split('T')[0];
            calculateMiles();
            await loadMileageEntries();
        } catch (error) {
            console.error('Failed to submit mileage:', error);
            alert(error.message || 'Unable to submit mileage.');
        } finally {
            setSubmitButtonState(false);
        }
    }

    async function deleteMileageEntry(id) {
        if (!id) return;

        const confirmed = confirm('Delete this mileage entry?');
        if (!confirmed) return;

        try {
            await requireAuthOrRedirect('login.php');
            await fetchWithAuth(`${window.API_URL}/mileage/${encodeURIComponent(id)}`, {
                method: 'DELETE'
            });
            await loadMileageEntries();
            alert('Mileage entry deleted.');
        } catch (error) {
            console.error('Failed to delete mileage entry:', error);
            alert(error.message || 'Unable to delete mileage entry.');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        calculateMiles();
        loadMileageEntries();
    });
</script>
</body>
</html>

