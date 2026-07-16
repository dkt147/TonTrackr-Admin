<?php
$pageTitle  = 'Truck Detail';
$activePage = 'drivers';
include 'config.php';
$truckId = isset($_GET['truck']) ? htmlspecialchars($_GET['truck']) : '';
$truckName = $truckId ? 'Truck ' . $truckId : 'Truck Detail';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · <?php echo htmlspecialchars($truckName); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        .detail-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 24px; }
        .detail-card { background: #111111; border: 1px solid #2a2a2a; border-radius: 18px; padding: 24px; }
        .detail-row { display: flex; justify-content: space-between; gap: 12px; margin-bottom: 16px; }
        .detail-label { color: #888; font-size: 13px; }
        .detail-value { color: #fff; text-align: right; }
        .detail-title { font-size: 16px; font-weight: 700; margin-bottom: 16px; color: #fff; }
        .status-pill { display: inline-flex; align-items: center; padding: 8px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; background: rgba(116, 170, 80, 0.18); color: #74AA50; }
        .status-pill.inactive { background: rgba(255, 91, 91, 0.18); color: #FF5B5B; }
        .detail-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 18px; }
        .loading-note { padding: 24px; color: #ddd; text-align: center; }
        @media (max-width: 900px) { .detail-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes\\sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes\\header.php'; ?>

            <div class="page-content">
                <div class="page-head" style="align-items:flex-start; gap:16px; flex-wrap:wrap;">
                    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;cursor:pointer" onclick="location.href='trucks.php'">
                        <button class="btn-pill small" type="button">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Trucks</p>
                            <h1 class="page-title"><?php echo htmlspecialchars($truckName); ?></h1>
                            <p class="page-sub" style="margin-top:6px">View the truck details and manage assignments.</p>
                        </div>
                    </div>
                    <div class="detail-actions">
                        <button class="btn-pill small" type="button" onclick="location.href='add-truck.php?id='+encodeURIComponent(window.TRUCK_ID)">Edit</button>
                        <button class="btn-pill small" type="button" onclick="deleteTruck()">Delete</button>
                    </div>
                </div>

                <div id="truckDetails">
                    <div class="loading-note">Loading truck details...</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        window.TRUCK_ID = '<?php echo addslashes($truckId); ?>';

        function formatValue(value) {
            return value || '—';
        }

        function renderTruckDetails(truck) {
            if (!truck) {
                document.getElementById('truckDetails').innerHTML = '<div class="loading-note">Truck not found.</div>';
                return;
            }

            const statusClass = truck.status === 'inactive' ? 'status-pill inactive' : 'status-pill';
            const statusText = truck.status || 'active';

            document.getElementById('truckDetails').innerHTML = `
                <div class="detail-grid">
                    <div class="detail-card">
                        <div class="detail-title">Overview</div>
                        <div class="detail-row"><span class="detail-label">Plate Number</span><span class="detail-value">${formatValue(truck.plate_number)}</span></div>
                        <div class="detail-row"><span class="detail-label">Truck Number</span><span class="detail-value">${formatValue(truck.truck_number)}</span></div>
                        <div class="detail-row"><span class="detail-label">Make / Model</span><span class="detail-value">${formatValue(truck.make)} ${formatValue(truck.model)}</span></div>
                        <div class="detail-row"><span class="detail-label">Year</span><span class="detail-value">${formatValue(truck.year)}</span></div>
                        <div class="detail-row"><span class="detail-label">Type</span><span class="detail-value">${formatValue(truck.vehicle_type)}</span></div>
                        <div class="detail-row"><span class="detail-label">Capacity</span><span class="detail-value">${formatValue(truck.capacity_tons)} tons</span></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-title">Assignment</div>
                        <div class="detail-row"><span class="detail-label">Driver ID</span><span class="detail-value">${formatValue(truck.driver_id)}</span></div>
                        <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value"><span class="${statusClass}">${statusText}</span></span></div>
                        <div class="detail-row"><span class="detail-label">Created</span><span class="detail-value">${formatValue(truck.created_at)}</span></div>
                        <div class="detail-row"><span class="detail-label">Updated</span><span class="detail-value">${formatValue(truck.updated_at)}</span></div>
                    </div>
                </div>
            `;
        }

        async function loadTruckDetails() {
            if (!window.TRUCK_ID) {
                document.getElementById('truckDetails').innerHTML = '<div class="loading-note">No truck selected.</div>';
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const truck = await fetchWithAuth(`${window.API_URL}/vehicles/${encodeURIComponent(window.TRUCK_ID)}`);
                renderTruckDetails(truck);
            } catch (error) {
                console.error('Unable to load truck details:', error);
                document.getElementById('truckDetails').innerHTML = '<div class="loading-note">Unable to load truck details.</div>';
            }
        }

        async function deleteTruck() {
            if (!window.TRUCK_ID || !confirm('Delete this truck?')) return;
            try {
                await requireAuthOrRedirect('login.php');
                await fetchWithAuth(`${window.API_URL}/vehicles/${encodeURIComponent(window.TRUCK_ID)}`, { method: 'DELETE' });
                alert('Truck deleted.');
                location.href = 'trucks.php';
            } catch (error) {
                console.error('Unable to delete truck:', error);
                alert(error.message || 'Unable to delete truck.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadTruckDetails);
    </script>
</body>
</html>
