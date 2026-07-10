<?php
// add-mill.php
$pageTitle  = 'Add a Mill';
$activePage = 'miles';
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

        .form-section { margin-bottom: 24px; }
        .form-section-label { font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: var(--green); padding: 0; margin-bottom: 16px; }

        .form-field-box { background: #1A1A1A; border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 14px 16px; margin-bottom: 12px; display: flex; align-items: center; color: #fff; transition: border-color 0.2s; }
        .form-field-box:focus-within { border-color: var(--green); }
        .form-field-box input { flex: 1; background: transparent; border: none; color: #fff; font-size: 14px; font-family: 'Poppins', sans-serif; outline: none; padding: 0; width: 100%; }
        .form-field-box input::placeholder { color: #555; }

        .step-title { font-size: 20px; font-weight: 600; margin-bottom: 8px; }

        .btn-block { width: 100%; padding: 16px; border-radius: var(--radius-lg); border: none; font-weight: 700; font-size: 15px; margin-top: 12px; transition: all 0.15s; }
        .btn-green { background: var(--green); color: #fff; }
        .btn-green:hover { opacity: 0.9; transform: scale(1.01); }

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
                <!-- Back Button -->
                <button class="back-home-btn" onclick="window.location.href='dashboard.php'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Back to Dashboard
                </button>

                <!-- ================= ADD MILL FORM ================= -->
                <h2 class="step-title">Add a Mill</h2>

                <div class="form-section">
                    <div class="form-section-label">MILL DETAILS</div>
                    
                    <div class="form-field-box">
                        <input type="text" id="mill_name" placeholder="Full Mill Name">
                    </div>

                    <div class="form-field-box">
                        <input type="text" id="mill_abbr" placeholder="Abbreviated Name">
                    </div>

                    <div class="form-field-box">
                        <input type="text" id="mill_location" placeholder="Location (city, state)">
                    </div>
                </div>

                <button class="btn-block btn-green" onclick="submitMill()">+ ADD MILL</button>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }

    function submitMill() {
        const millName = document.getElementById('mill_name').value.trim();
        const millAbbr = document.getElementById('mill_abbr').value.trim();
        const millLocation = document.getElementById('mill_location').value.trim();

        if (!millName || !millAbbr || !millLocation) {
            alert('Please fill in all fields');
            return;
        }

        // Show success message
        alert(`Mill added successfully!\nName: ${millName}\nAbbreviation: ${millAbbr}\nLocation: ${millLocation}`);
        
        // Reset form
        document.getElementById('mill_name').value = '';
        document.getElementById('mill_abbr').value = '';
        document.getElementById('mill_location').value = '';
    }
</script>
</body>
</html>
