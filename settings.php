<?php
$pageTitle  = 'Admin Settings';
$activePage = 'settings';
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
    <link rel="stylesheet" href="assets/css/app.css">
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
        .page-head { margin-bottom: 32px; }
        .page-eyebrow { font-size: 12px; text-transform: uppercase; color: var(--green); font-weight: 600; letter-spacing: 0.08em; }
        .page-title { font-size: 28px; font-weight: 700; color: #fff; margin: 0; }
        .page-sub { font-size: 13px; color: #888; margin: 8px 0 0 0; }

        .settings-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .settings-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 28px;
            border-bottom: 1px solid var(--border-color);
            overflow-x: auto;
        }

        .settings-tab {
            padding: 12px 20px;
            border: none;
            background: transparent;
            color: #888;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
        }

        .settings-tab:hover {
            color: #fff;
        }

        .settings-tab.active {
            color: var(--green);
            border-bottom-color: var(--green);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .settings-section {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 28px;
            margin-bottom: 24px;
        }

        .section-header {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            margin: 0 0 6px 0;
        }

        .section-desc {
            font-size: 13px;
            color: #888;
            margin: 0;
        }

        .form-field-box {
            background: #1A1A1A;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            margin-bottom: 16px;
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
            text-align: left;
        }

        .form-field-box input::placeholder {
            color: #555;
            text-align: left;
        }

        .form-field-box select option {
            background: #1A1A1A;
            color: #fff;
        }

        .form-field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .form-field-group {
            margin-bottom: 20px;
        }

        .form-field-group:last-child {
            margin-bottom: 0;
        }

        .settings-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .settings-row {
                grid-template-columns: 1fr;
            }
        }

        .current-plan {
            background: rgba(116, 170, 80, 0.1);
            border: 1px solid rgba(116, 170, 80, 0.3);
            border-radius: var(--radius-md);
            padding: 20px;
            margin-bottom: 20px;
        }

        .current-plan-title {
            font-size: 13px;
            color: var(--green);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
        }

        .current-plan-name {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin: 0 0 12px 0;
        }

        .current-plan-details {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #888;
        }

        .toggle-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .toggle-option:last-child {
            border-bottom: none;
        }

        .toggle-label {
            flex: 1;
        }

        .toggle-title {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .toggle-desc {
            font-size: 12px;
            color: #888;
        }

        .toggle-switch {
            width: 48px;
            height: 24px;
            background: #2a2a2a;
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid #3a3a3a;
        }

        .toggle-switch.on {
            background: var(--green);
            border-color: var(--green);
        }

        .toggle-knob {
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: left 0.2s;
        }

        .toggle-switch.on .toggle-knob {
            left: 26px;
        }

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
            margin-right: 10px;
        }

        .btn-pill:hover { color: #fff; border-color: #555; }
        .btn-pill.primary { background: var(--green); color: #000; border: none; }
        .btn-pill.primary:hover { opacity: 0.9; }

        .btn-danger {
            background: #c41e3a;
            border: none;
            color: #fff;
        }

        .btn-danger:hover {
            opacity: 0.9;
        }

        .button-group {
            margin-top: 28px;
            display: flex;
            gap: 10px;
        }
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

                <div class="page-head">
                    <p class="page-eyebrow">System</p>
                    <h1 class="page-title">Admin Settings</h1>
                    <p class="page-sub">Manage your account, subscription, and preferences</p>
                </div>

                <div class="user-profile-card" id="userProfileCard" style="margin-bottom: 24px; padding: 24px; background: #111111; border: 1px solid #2A2A2A; border-radius: 20px; display: none;">
                    <div style="display:flex; align-items:center; justify-content:space-between; gap: 20px; flex-wrap:wrap;">
                        <div>
                            <p style="margin:0;font-size:12px;text-transform:uppercase;letter-spacing:.12em;color:var(--green);">Signed in as</p>
                            <h2 id="profileDisplayName" style="margin:8px 0 6px; font-size:24px; color:#fff;">Loading...</h2>
                            <p id="profileEmail" style="margin:0;color:#aaa;font-size:14px;">admin@tontracker.com</p>
                        </div>
                        <div style="text-align:right; min-width:180px;">
                            <p id="profileRole" style="margin:0;font-size:12px;text-transform:uppercase;letter-spacing:.12em;color:#74AA50;"></p>
                            <p id="profileStatus" style="margin:8px 0 0; font-size:14px; color:#fff;"></p>
                            <p id="profileUid" style="margin:8px 0 0; font-size:12px; color:#888;"></p>
                        </div>
                    </div>
                </div>

                <div class="settings-container">

                    <!-- Settings Tabs -->
                    <div class="settings-tabs">
                        <button class="settings-tab active" onclick="switchTab(event, 'account')">Account</button>
                        <button class="settings-tab" onclick="switchTab(event, 'subscription')">Subscription</button>
                        <button class="settings-tab" onclick="switchTab(event, 'notifications')">Notifications</button>
                        <button class="settings-tab" onclick="switchTab(event, 'billing')">Billing</button>
                    </div>

                    <!-- Account Tab -->
                    <div id="account" class="tab-content active">
                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Profile Information</h3>
                                <p class="section-desc">Update your account details</p>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Display Name</label>
                                <div class="form-field-box">
                                    <input type="text" id="display_name" value="" placeholder="Display Name">
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Email Address</label>
                                <div class="form-field-box">
                                    <input type="email" id="profile_email" value="" placeholder="Email Address" disabled>
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Phone Number</label>
                                <div class="form-field-box">
                                    <input type="tel" id="phone" value="" placeholder="Phone Number">
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Company Name</label>
                                <div class="form-field-box">
                                    <input type="text" id="company_name" value="" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Country</label>
                                <div class="form-field-box">
                                    <input type="text" id="country" value="" placeholder="Country">
                                </div>
                            </div>

                            <div class="button-group">
                                <button class="btn-pill primary" id="saveProfileBtn">Save Changes</button>
                                <button class="btn-pill" type="button" id="cancelProfileBtn">Cancel</button>
                            </div>
                        </div>

                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Security</h3>
                                <p class="section-desc">Manage your password and security settings</p>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Current Password</label>
                                <div class="form-field-box">
                                    <input type="password" placeholder="Enter current password">
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">New Password</label>
                                <div class="form-field-box">
                                    <input type="password" placeholder="Enter new password">
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Confirm Password</label>
                                <div class="form-field-box">
                                    <input type="password" placeholder="Confirm new password">
                                </div>
                            </div>

                            <div class="button-group">
                                <button class="btn-pill primary">Update Password</button>
                                <button class="btn-pill">Cancel</button>
                            </div>
                        </div>
                    </div>

                    <!-- Subscription Tab -->
                    <div id="subscription" class="tab-content">
                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Current Plan</h3>
                                <p class="section-desc">View and manage your subscription</p>
                            </div>

                            <div class="current-plan">
                                <div class="current-plan-title">Active Subscription</div>
                                <h3 class="current-plan-name">Fleet Manager</h3>
                                <div class="current-plan-details">
                                    <span>$55/month • Annual billing</span>
                                    <span>Renews Jan 15, 2025</span>
                                </div>
                            </div>

                            <div style="background: var(--good-bg); border: 1px solid rgba(116, 170, 80, 0.3); border-radius: var(--radius-md); padding: 16px; margin-bottom: 20px; font-size: 13px; color: var(--green);">
                                ✓ You have 345 days remaining on your annual plan. Next billing on Jan 15, 2025.
                            </div>

                            <div class="button-group">
                                <button class="btn-pill" onclick="location.href='subscriptions.php'">Change Plan</button>
                                <button class="btn-pill">View Invoice</button>
                            </div>
                        </div>

                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Subscription Features</h3>
                                <p class="section-desc">Your current plan includes:</p>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; font-size: 14px; color: #ccc;">
                                <div>✓ Up to 20 trucks</div>
                                <div>✓ Unlimited drivers</div>
                                <div>✓ Advanced reporting</div>
                                <div>✓ GPS tracking</div>
                                <div>✓ API access</div>
                                <div>✓ 24/7 priority support</div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div id="notifications" class="tab-content">
                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Email Notifications</h3>
                                <p class="section-desc">Choose what emails you want to receive</p>
                            </div>

                            <div class="toggle-option">
                                <div class="toggle-label">
                                    <div class="toggle-title">Daily Reports</div>
                                    <div class="toggle-desc">Receive daily summary reports</div>
                                </div>
                                <div class="toggle-switch on" onclick="toggleSwitch(this)">
                                    <div class="toggle-knob"></div>
                                </div>
                            </div>

                            <div class="toggle-option">
                                <div class="toggle-label">
                                    <div class="toggle-title">Job Alerts</div>
                                    <div class="toggle-desc">Get notified when new jobs are available</div>
                                </div>
                                <div class="toggle-switch on" onclick="toggleSwitch(this)">
                                    <div class="toggle-knob"></div>
                                </div>
                            </div>

                            <div class="toggle-option">
                                <div class="toggle-label">
                                    <div class="toggle-title">Driver Updates</div>
                                    <div class="toggle-desc">Notifications about driver status changes</div>
                                </div>
                                <div class="toggle-switch" onclick="toggleSwitch(this)">
                                    <div class="toggle-knob"></div>
                                </div>
                            </div>

                            <div class="toggle-option">
                                <div class="toggle-label">
                                    <div class="toggle-title">System Updates</div>
                                    <div class="toggle-desc">Important platform updates and maintenance</div>
                                </div>
                                <div class="toggle-switch on" onclick="toggleSwitch(this)">
                                    <div class="toggle-knob"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Tab -->
                    <div id="billing" class="tab-content">
                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Billing Address</h3>
                                <p class="section-desc">Update your billing information</p>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Company Name</label>
                                <div class="form-field-box">
                                    <input type="text" value="John's Transportation" placeholder="Company Name">
                                </div>
                            </div>

                            <div class="form-field-group">
                                <label class="form-field-label">Street Address</label>
                                <div class="form-field-box">
                                    <input type="text" value="123 Fleet Way" placeholder="Street Address">
                                </div>
                            </div>

                            <div class="settings-row">
                                <div class="form-field-group">
                                    <label class="form-field-label">City</label>
                                    <div class="form-field-box">
                                        <input type="text" value="Snoqualmie" placeholder="City">
                                    </div>
                                </div>
                                <div class="form-field-group">
                                    <label class="form-field-label">State</label>
                                    <div class="form-field-box">
                                        <input type="text" value="WA" placeholder="State">
                                    </div>
                                </div>
                            </div>

                            <div class="settings-row">
                                <div class="form-field-group">
                                    <label class="form-field-label">ZIP Code</label>
                                    <div class="form-field-box">
                                        <input type="text" value="98065" placeholder="ZIP Code">
                                    </div>
                                </div>
                            </div>

                            <div class="button-group">
                                <button class="btn-pill primary">Save Address</button>
                                <button class="btn-pill">Cancel</button>
                            </div>
                        </div>

                        <div class="settings-section">
                            <div class="section-header">
                                <h3 class="section-title">Danger Zone</h3>
                                <p class="section-desc">Irreversible actions</p>
                            </div>

                            <div style="padding: 16px; background: rgba(196, 30, 58, 0.1); border: 1px solid rgba(196, 30, 58, 0.3); border-radius: var(--radius-md); margin-bottom: 16px;">
                                <div style="font-size: 14px; font-weight: 600; color: #fff; margin-bottom: 8px;">Cancel Subscription</div>
                                <div style="font-size: 13px; color: #888; margin-bottom: 12px;">Canceling will end your service at the end of the billing period.</div>
                                <button class="btn-pill btn-danger">Cancel My Subscription</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        async function loadUserProfile() {
            try {
                await requireAuthOrRedirect('login.php');
                const profile = await getCurrentUserProfile();
                const profileCard = document.getElementById('userProfileCard');

                document.getElementById('profileDisplayName').textContent = profile.display_name || 'Admin User';
                document.getElementById('profileEmail').textContent = profile.email || '';
                document.getElementById('profileRole').textContent = profile.role ? profile.role.replace('_', ' ') : '';
                document.getElementById('profileStatus').textContent = profile.status ? profile.status.toUpperCase() : '';
                document.getElementById('profileUid').textContent = profile.uid ? `UID: ${profile.uid}` : '';

                // populate account form fields
                const displayInput = document.getElementById('display_name');
                const emailInput = document.getElementById('profile_email');
                const phoneInput = document.getElementById('phone');
                const companyInput = document.getElementById('company_name');
                const countryInput = document.getElementById('country');

                if (displayInput) displayInput.value = profile.display_name || '';
                if (emailInput) emailInput.value = profile.email || '';
                if (phoneInput) phoneInput.value = profile.phone || '';
                if (companyInput) companyInput.value = profile.company_name || '';
                if (countryInput) countryInput.value = profile.country || '';

                profileCard.style.display = 'block';
            } catch (error) {
                console.error('Failed to load user profile:', error);
            }
        }

        loadUserProfile();

        async function saveUserProfile() {
            try {
                const payload = {
                    display_name: document.getElementById('display_name').value.trim(),
                    phone: document.getElementById('phone').value.trim(),
                    company_name: document.getElementById('company_name').value.trim(),
                    country: document.getElementById('country').value.trim()
                };

                await fetchWithAuth(AUTH_API_ME, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                alert('Profile saved successfully.');
                await loadUserProfile();
            } catch (error) {
                console.error('Failed to save profile:', error);
                alert(error.message || 'Unable to save profile.');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const saveBtn = document.getElementById('saveProfileBtn');
            if (saveBtn) saveBtn.addEventListener('click', saveUserProfile);
            const cancelBtn = document.getElementById('cancelProfileBtn');
            if (cancelBtn) cancelBtn.addEventListener('click', loadUserProfile);
        });

        function switchTab(e, tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.settings-tab');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            e.target.classList.add('active');
        }

        function toggleSwitch(element) {
            element.classList.toggle('on');
        }

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
    </script>
</body>
</html>

