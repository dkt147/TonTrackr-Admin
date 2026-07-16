<?php
$pageTitle  = 'Mills';
$activePage = 'mills';
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

        .page-title-group p { margin: 0; }
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

        .mills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .mill-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px;
            transition: all 0.2s ease;
        }

        .mill-card:hover {
            border-color: var(--green);
            box-shadow: 0 8px 24px rgba(116, 170, 80, 0.15);
            transform: translateY(-4px);
        }

        .mill-name {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 4px;
        }

        .mill-abbr {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(116, 170, 80, 0.16);
            color: var(--green);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .mill-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 13px;
        }

        .mill-info-row {
            display: flex;
            justify-content: space-between;
        }

        .mill-info-label {
            color: #888;
        }

        .mill-info-value {
            color: #fff;
            font-weight: 500;
        }

        .mill-actions {
            display: flex;
            gap: 10px;
        }

        .mill-actions button {
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

        .btn-view:hover { opacity: 0.9; }

        .btn-edit {
            background: #2a2a2a;
            color: #fff;
        }

        .btn-edit:hover { background: #333; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
        }

        .empty-state-icon { font-size: 48px; margin-bottom: 16px; opacity: 0.5; }
        .empty-state-title { font-size: 18px; font-weight: 600; color: #fff; margin-bottom: 8px; }
        .empty-state-text { font-size: 14px; color: #888; margin-bottom: 20px; }

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
    </style>
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
                            <h1 class="page-title">Mills</h1>
                            <p class="page-sub" id="millsSummary">Loading mills...</p>
                        </div>
                    </div>
                    <button class="add-btn-primary" onclick="location.href='add-mill.php'">+ ADD MILL</button>
                </div>

                <div class="mills-grid" id="millsGrid">
                    <div class="empty-state">
                        <div class="empty-state-icon">⏳</div>
                        <div class="empty-state-title">Loading mills...</div>
                        <div class="empty-state-text">Please wait while we load the mill directory.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
    </script>
    <script src="assets/js/auth.js?v=5"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function getField(value, alt) {
            return value || alt || '—';
        }

        function renderMillCard(mill) {
            const name = getField(mill.full_name, mill.abbreviated_name || 'Mill');
            const abbr = getField(mill.abbreviated_name, '—');
            const location = getField(mill.location, 'No location');
            const status = getField(mill.status, 'active');
            const millId = mill.id || '';

            return `
                <div class="mill-card">
                    <div class="mill-name">${name}</div>
                    <div class="mill-abbr">${abbr}</div>
                    <div class="mill-info">
                        <div class="mill-info-row"><span class="mill-info-label">Location</span><span class="mill-info-value">${location}</span></div>
                        <div class="mill-info-row"><span class="mill-info-label">Status</span><span class="mill-info-value">${status}</span></div>
                    </div>
                    <div class="mill-actions">
                        <button class="btn-view" type="button" onclick="location.href='mill-detail.php?id=${encodeURIComponent(millId)}'">View</button>
                        <button class="btn-edit" type="button" onclick="location.href='add-mill.php?id=${encodeURIComponent(millId)}'">Edit</button>
                    </div>
                </div>
            `;
        }

        async function loadMills() {
            try {
                await requireAuthOrRedirect('login.php');
                const response = await fetchWithAuth(`${window.API_URL}/mills`);
                const mills = Array.isArray(response?.mills) ? response.mills : [];
                const grid = document.getElementById('millsGrid');
                const summary = document.getElementById('millsSummary');

                if (summary) {
                    summary.textContent = `${mills.length} mill${mills.length === 1 ? '' : 's'} available`;
                }

                if (!grid) return;

                if (!mills.length) {
                    grid.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">🌲</div>
                            <div class="empty-state-title">No mills found</div>
                            <div class="empty-state-text">Create the first mill to start tracking operations.</div>
                            <button class="add-btn-primary" onclick="location.href='add-mill.php'">+ ADD MILL</button>
                        </div>
                    `;
                    return;
                }

                grid.innerHTML = mills.map(renderMillCard).join('');
            } catch (error) {
                console.error('Failed to load mills:', error);
                const grid = document.getElementById('millsGrid');
                if (grid) {
                    grid.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">⚠️</div>
                            <div class="empty-state-title">Unable to load mills</div>
                            <div class="empty-state-text">Please refresh the page or sign in again.</div>
                        </div>
                    `;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', loadMills);
    </script>
</body>
</html>
