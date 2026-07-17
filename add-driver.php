<?php
$pageTitle  = 'Add Driver';
$activePage = 'drivers';
include 'config.php';
$driverId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$isEdit = !empty($driverId);
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
                    <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='drivers.php'">
                        <button class="btn-pill small" type="button" onclick="location.href='drivers.php'">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Drivers</p>
                            <h1 class="page-title"><?php echo $isEdit ? 'Driver Details' : 'Add a New Driver'; ?></h1>
                            <p class="page-sub" style="margin-top:6px"><?php echo $isEdit ? 'This driver can be viewed here, but direct edits are currently not supported by the API.' : 'Enter driver information and assign to the fleet.'; ?></p>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="width:100%; max-width:none;">
                    <div class="section-title">Personal Information</div>
                    <p class="section-sub">Enter driver details and account credentials.</p>

                    <div class="form-field-box"><input type="text" id="display_name" placeholder="Display Name"></div>
                    <div class="form-field-box"><input type="text" id="company_name" placeholder="Company Name"></div>
                    <div class="form-field-box"><input type="email" id="email" placeholder="Email Address"></div>
                    <div class="form-field-box"><input type="password" id="password" placeholder="Password"></div>
                    <div class="form-field-box"><input type="tel" id="phone" placeholder="Phone Number"></div>

                    <div class="section-title" style="margin-top:28px">License Information</div>
                    <p class="section-sub">Enter driver's license details.</p>

                    <div class="form-field-box"><input type="text" id="license_number" placeholder="License Number"></div>
                    <div class="form-field-box"><input type="text" id="license_state" placeholder="License State (e.g., WA)"></div>
                    <div class="form-field-box"><input type="date" id="license_expiry" placeholder="License Expiry Date"></div>

                    <div class="section-title" style="margin-top:28px">Employment Details</div>
                    <p class="section-sub">Set employment status and assignment.</p>

                    <div class="form-field-box"><select id="status">
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="leave">On Leave</option>
                    </select></div>

                    <div class="form-field-box"><select id="assigned_truck">
                        <option value="">Assign Truck</option>
                        <option>Truck #1 - Long Log</option>
                        <option>Truck #2 - Short Log</option>
                        <option>Truck #3 - Super Train</option>
                        <option>Unassigned</option>
                    </select></div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:28px">
                        <button class="btn-pill small" onclick="location.href='drivers.php'">Cancel</button>
                        <button class="btn-pill primary" onclick="submitDriver()"><?php echo $isEdit ? 'Save Unavailable' : 'Save Driver'; ?></button>
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
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        window.DRIVER_ID = '<?php echo addslashes(isset($_GET['id']) ? $_GET['id'] : ''); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function getFieldValue(id) {
            return document.getElementById(id)?.value.trim() || '';
        }

        function setFieldValue(id, value) {
            const element = document.getElementById(id);
            if (element) {
                element.value = value || '';
            }
        }

        function buildDriverPayload() {
            const payload = {
                company_name: getFieldValue('company_name'),
                display_name: getFieldValue('display_name'),
                email: getFieldValue('email'),
                phone: getFieldValue('phone'),
                license_number: getFieldValue('license_number')
            };

            const password = document.getElementById('password').value;
            if (password) {
                payload.password = password;
            }

            const status = getFieldValue('status');
            if (status) {
                payload.status = status;
            }

            return payload;
        }

        async function loadDriverForEdit() {
            if (!window.DRIVER_ID) return;

            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/drivers/${encodeURIComponent(window.DRIVER_ID)}`);
                const profile = response?.profile || response || {};

                setFieldValue('display_name', profile.display_name || profile.displayName);
                setFieldValue('company_name', profile.company_name || profile.companyName);
                setFieldValue('email', profile.email);
                setFieldValue('phone', profile.phone);
                setFieldValue('license_number', profile.license_number || profile.licenseNumber);
                setFieldValue('status', profile.status);
            } catch (error) {
                console.error('Failed to load driver for edit:', error);
                alert('Unable to load driver details.');
            }
        }

        async function submitDriver() {
            if (window.DRIVER_ID) {
                alert('Driver editing is not supported by the current API. You can view the profile or update the status from the driver details page.');
                return;
            }

            const displayName = getFieldValue('display_name');
            const companyName = getFieldValue('company_name');
            const email = getFieldValue('email');
            const password = document.getElementById('password').value;
            const phone = getFieldValue('phone');
            const licenseNumber = getFieldValue('license_number');

            if (!displayName || !companyName || !email || !phone || !licenseNumber || !password) {
                alert('Please fill in all required fields');
                return;
            }

            const submitButton = document.querySelector('.btn-pill.primary');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = window.DRIVER_ID ? 'Updating...' : 'Creating...';
            }

            try {
                await requireAuthOrRedirect('login.php');
                const method = window.DRIVER_ID ? 'PUT' : 'POST';
                const url = window.DRIVER_ID ? `${window.API_URL}/drivers/${encodeURIComponent(window.DRIVER_ID)}` : `${window.API_URL}/drivers`;
                const response = await fetchWithAuth(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(buildDriverPayload())
                });

                const message = response?.message || (window.DRIVER_ID ? 'Driver updated successfully.' : 'Driver created successfully.');
                alert(message);
                location.href = 'drivers.php';
            } catch (error) {
                console.error('Failed to create driver:', error);
                alert(error.message || 'Unable to create driver.');
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Save Driver';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', loadDriverForEdit);
    </script>
</body>
</html>
