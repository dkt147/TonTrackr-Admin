<?php
// add_ticket.php
$pageTitle  = 'New Ticket';
$activePage = 'tickets';
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
        .nav-link:hover { background: var(--dark-green); color: #fff; box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4); }
        .nav-link.active { background: var(--dark-green); color: #fff; box-shadow: 0 4px 10px rgba(62, 88, 36, 0.4); }
        .nav-link.active svg { opacity: 1; color: var(--green); }
        .nav-badge { margin-left: auto; background: var(--teal); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px; }
        .sidebar-footer { padding: 16px 20px 24px; border-top: 1px solid var(--border-color); display: flex; align-items: center; gap: 12px; }
        .avatar-sm { width: 40px; height: 40px; border-radius: 50%; background: var(--teal); color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; flex-shrink: 0; }
        .sidebar-user-name { font-size: 14px; font-weight: 600; color: #fff; }
        .sidebar-user-role { font-size: 11px; color: var(--sidebar-text-dim); }
        .logout-btn { margin-left: auto; width: 34px; height: 34px; border-radius: 10px; background: var(--sidebar-bg-soft); display: flex; align-items: center; justify-content: center; color: var(--sidebar-text); border: none; cursor: pointer; }
        .logout-btn:hover { background: #c41e3a; color: #fff; }
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

        .wizard-step { display: none; animation: fadeIn 0.3s ease; }
        .wizard-step.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

        .form-field-box { background: #1A1A1A; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 12px 16px; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; color: #fff; transition: border-color 0.2s; }
        .form-field-box:focus-within { border-color: var(--green); }
        .form-field-box label { font-size: 13px; color: #888; font-weight: 500; flex-shrink: 0; min-width: 120px; }
        .form-field-box input, .form-field-box select { flex: 1; background: transparent; border: none; color: #fff; font-size: 14px; font-family: 'Poppins', sans-serif; outline: none; text-align: left; padding: 4px 0; }
        .form-field-box input::placeholder { color: #555; text-align: left; }
        .form-field-box .chevron { color: #555; margin-left: 6px; }

        .step-title { font-size: 20px; font-weight: 600; margin-bottom: 8px; }
        .step-sub { font-size: 13px; color: #888; margin-bottom: 20px; }

        .review-row { background: #1A1A1A; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 14px 16px; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; }
        .review-row .r-label { font-size: 13px; color: #888; }
        .review-row .r-value { font-size: 14px; color: #fff; font-weight: 500; }

        .btn-block { width: 100%; padding: 16px; border-radius: var(--radius-lg); border: none; font-weight: 700; font-size: 15px; margin-top: 12px; transition: all 0.15s; }
        .btn-green { background: var(--green); color: #fff; }
        .btn-green:hover { opacity: 0.9; transform: scale(1.01); }
        .btn-dark { background: #222; color: #fff; }
        .btn-dark:hover { background: #333; }

        .flag-btn { border: 1px solid var(--green); background: transparent; color: #fff; }
        .flag-btn:hover { background: var(--green); }

        @media (max-width:1080px) { .page-content { padding: 28px; } }
        @media (max-width:860px) { .sidebar { transform: translateX(-100%); } .sidebar.open { transform: translateX(0); } .page-wrapper { margin-left: 0; } .menu-toggle { display: flex; } .sidebar-overlay.open { display: block; } }
        @media (max-width:560px) { .page-content { padding: 20px; } }
    </style>
</head>
<body>

    <div class="main-wrapper">
        <?php include 'includes\sidebar.php'; ?>

        <div class="page-wrapper">
            <?php include 'includes\header.php'; ?>

            <div class="page-content">
                <!-- Back Button for Wizard Pages -->
                <button class="back-home-btn" onclick="window.location.href='dashboard.php'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to Dashboard
                </button>

                <!-- ================= STEP 1: MANUAL ENTRY ================= -->
                <div class="wizard-step active" id="step1">
                    <h2 class="step-title">Ticket Information</h2>
                    <p class="step-sub" style="color: var(--green); font-weight:600; letter-spacing:0.5px;">ALL FIELDS ARE REQUIRED.</p>

                    <div class="form-field-box">
                        <label>Date</label>
                        <input type="date" id="ticket_date" value="2026-07-09">
                    </div>
                    <div class="form-field-box">
                        <label>Mill Ticket Number</label>
                        <input type="text" id="ticket_num" placeholder="#371444" value="#371444">
                    </div>
                    <div class="form-field-box">
                        <label>Mill</label>
                        <select id="mill_select">
                            <option value="CLW">CLW</option>
                            <option value="IFG" selected>IFG</option>
                        </select>
                        <span class="chevron">▼</span>
                    </div>
                    <div class="form-field-box">
                        <label>Truck Number</label>
                        <input type="text" id="truck_num" placeholder="TG" value="TG">
                    </div>
                    <div class="form-field-box">
                        <label>Job</label>
                        <input type="text" id="job_num" placeholder="#XXXXX" value="#XXXXX">
                    </div>
                    <div class="form-field-box">
                        <label>Contractor</label>
                        <select id="contractor_select">
                            <option value="Jungle Badger" selected>Jungle Badger</option>
                            <option value="IFG Grangeville">IFG Grangeville</option>
                        </select>
                        <span class="chevron">▼</span>
                    </div>
                    <div class="form-field-box">
                        <label>Gross</label>
                        <input type="text" id="gross" placeholder="XXXXX" value="XXXXX">
                    </div>
                    <div class="form-field-box">
                        <label>Tare</label>
                        <input type="text" id="tare" placeholder="XXXXX" value="XXXXX">
                    </div>
                    <div class="form-field-box">
                        <label>Net</label>
                        <input type="text" id="net" placeholder="XXXXX" value="XXXXX">
                    </div>
                    <div class="form-field-box" style="border-color:var(--teal);">
                        <label style="color:#fff; font-weight:600;">Income</label>
                        <span style="color:var(--green); font-weight:700; font-size:18px;">$842</span>
                    </div>

                    <button class="btn-block btn-green" onclick="goToStep(2)">REVIEW TICKET INFORMATION</button>
                    <p style="text-align:center; font-size:11px; color:#666; margin-top:16px;">You must review all ticket information before submitting.</p>
                </div>

                <!-- ================= STEP 2: TICKET REVIEW ================= -->
                <div class="wizard-step" id="step2">
                    <h2 class="step-title">Ticket Review</h2>
                    <p class="step-sub" style="color: #BAAC88;">CLICK THE ENTERED DATA TO MODIFY.</p>

                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Date</span><span class="r-value" style="color:#888;">06/16/2026 &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Mill Ticket Number</span><span class="r-value" style="color:#888;">#371444 &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Mill</span><span class="r-value" style="color:#888;">CLW &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Truck Number</span><span class="r-value" style="color:#888;">TG &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Job</span><span class="r-value" style="color:#888;">#XXXXXX &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Contractor</span><span class="r-value" style="color:#888;">Jungle Badger &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Gross</span><span class="r-value" style="color:#888;">XXXXX &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Tare</span><span class="r-value" style="color:#888;">XXXXX &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Net</span><span class="r-value" style="color:#888;">XXXXX &gt;</span></div>
                    <div class="review-row" onclick="goToStep(1)"><span class="r-label">Tons</span><span class="r-value" style="color:#888;">XXXXX &gt;</span></div>

                    <button class="btn-block btn-green" onclick="goToStep(3)">CONFIRM</button>
                    <p style="text-align:center; font-size:11px; color:#666; margin-top:16px;">You must review all ticket information before submitting.</p>
                </div>

                <!-- ================= STEP 3: SAVED / CONFIRMATION ================= -->
                <div class="wizard-step" id="step3">
                    <div style="text-align:center; margin-top:40px;">
                        <div style="background:#1A1A1A; border:1px solid var(--border-color); border-radius:12px; padding:16px; display:inline-block; margin-bottom:30px;">
                            <span style="font-size:18px; font-weight:600;">Ticket Saved</span>
                            <span style="font-size:24px; margin-left:12px;">⭐</span>
                        </div>
                        
                        <button class="btn-block btn-green" onclick="goToStep(1)">ADD ANOTHER TICKET</button>
                    <button class="btn-block btn-dark" onclick="window.location.href='dashboard.php'">RETURN TO HOME PAGE</button>
                </div>
            </div>

            <!-- ================= STEP 4: TICKET DETAIL / FLAG ================= -->
            <div class="wizard-step" id="step4">
                <p style="font-size:16px; font-weight:600; color:#BAAC88;">Ticket #100567</p>
                <p style="font-size:11px; color: var(--green); margin-bottom:15px;">TICKET ENTERED 06/16/2026</p>
                <p class="step-sub">Select any data points to flag them for Admin to review.</p>

                <div class="form-field-box"><label>Date</label><span style="color:#888;">06/16/2026 &gt;</span></div>
                <div class="form-field-box"><label>Mill Ticket Number</label><span style="color:#888;">#371444 &gt;</span></div>
                <div class="form-field-box"><label>Mill</label><span style="color:#888;">CLW &gt;</span></div>
                <div class="form-field-box"><label>Truck Number</label><span style="color:#888;">TG &gt;</span></div>
                <div class="form-field-box"><label>Job</label><span style="color:#888;">#XXXXXX &gt;</span></div>
                <div class="form-field-box"><label>Contractor</label><span style="color:#888;">Jungle Badger &gt;</span></div>
                
                <div class="form-field-box" style="border: 1px solid #D43B25;">
                    <label>Gross</label><span style="color:#888;">XXXXX &gt;</span>
                </div>
                <div class="form-field-box"><label>Tare</label><span style="color:#888;">XXXXX &gt;</span></div>
                <div class="form-field-box"><label>Net</label><span style="color:#888;">XXXXX &gt;</span></div>
                <div class="form-field-box"><label>Tons</label><span style="color:#888;">XXXXX &gt;</span></div>

                <button class="btn-block flag-btn" onclick="alert('Ticket flagged for admin review!');">FLAG FOR REVIEW</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }

    function goToStep(step) {
        document.querySelectorAll('.wizard-step').forEach(function (stepEl) {
            stepEl.classList.remove('active');
        });
        var target = document.getElementById('step' + step);
        if (target) {
            target.classList.add('active');
            document.querySelector('.page-content').scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
</body>
</html>