<?php
$pageTitle  = 'Admin Trucks';
$activePage = 'drivers';
include 'config.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TonTrackr · <?php echo htmlspecialchars($pageTitle); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/app.css">
  <style>
    .section-card { background:#111; border:1px solid #2a2a2a; border-radius:18px; padding:20px; margin-top:18px; }
    .section-title { font-size:18px; font-weight:700; margin-bottom:8px; }
    .table-row { display:grid; grid-template-columns: 1.2fr .8fr .8fr .6fr auto; gap:12px; padding:14px 12px; border-bottom:1px solid #2a2a2a; align-items:center; }
    .table-head { display:grid; grid-template-columns: 1.2fr .8fr .8fr .6fr auto; gap:12px; padding:10px 12px; color:#888; font-size:12px; text-transform:uppercase; }
    .muted { color:#888; font-size:12px; margin-top:3px; }
    .metric-value { font-weight:700; color:#74AA50; }
    .pill { display:inline-block; padding:5px 10px; border-radius:999px; font-size:11px; font-weight:700; text-transform:uppercase; }
    .pill.active { background:rgba(116,170,80,0.15); color:#74AA50; }
    .pill.inactive { background:rgba(255,91,91,0.16); color:#FF5B5B; }
    .form-grid { display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap:12px; margin-top:12px; }
    .form-field { display:flex; flex-direction:column; gap:6px; }
    .form-field input, .form-field select { width:100%; border:1px solid #2a2a2a; border-radius:12px; padding:10px 12px; background:#000; color:#fff; }
    .btn-row { display:flex; gap:10px; flex-wrap:wrap; margin-top:14px; }
  </style>
</head>
<body>
  <div class="main-wrapper">
    <?php include 'includes\\sidebar.php'; ?>
    <div class="page-wrapper">
      <?php include 'includes\\header.php'; ?>

      <div class="page-content">
        <div class="page-head">
          <div>
            <p class="page-eyebrow">Trucks</p>
            <h1 class="page-title">Fleet Overview</h1>
            <p class="page-sub" style="margin-top:6px">Manage vehicles from the API and update assignments.</p>
          </div>
          <div class="page-actions">
            <button class="btn-pill primary" onclick="location.href='add-truck.php'">+ ADD VEHICLE</button>
          </div>
        </div>

        <div class="section-card">
          <div class="section-title">All Vehicles</div>
          <div class="data-table" id="vehicleList">
            <div class="table-head">
              <div>Vehicle</div>
              <div>Driver</div>
              <div>Status</div>
              <div>Capacity</div>
              <div>Actions</div>
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
  <script src="vehicle-api.js"></script>
  <script>
    let vehicles = [];
    const vehicleList = document.getElementById('vehicleList');

    function escapeHtml(value = '') {
      return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/'/g, '&#39;');
    }

    function renderVehicles() {
      if (!vehicles.length) {
        vehicleList.innerHTML = '<div class="table-row"><div class="muted">No vehicles found.</div></div>';
        return;
      }

      const rows = vehicles.map((vehicle) => {
        const status = vehicle.status || 'active';
        const pillClass = status === 'active' ? 'pill active' : 'pill inactive';
        return `
          <div class="table-row">
            <div>
              <strong>${escapeHtml(vehicle.plate_number || vehicle.truck_number || vehicle.id || 'Vehicle')}</strong>
              <div class="muted">${escapeHtml(vehicle.make || '')} ${escapeHtml(vehicle.model || '')} · ${escapeHtml(vehicle.vehicle_type || 'vehicle')}</div>
            </div>
            <div>${escapeHtml(vehicle.driver_id || 'Unassigned')}</div>
            <div><span class="${pillClass}">${escapeHtml(status)}</span></div>
            <div class="metric-value">${escapeHtml(vehicle.capacity_tons || '—')}</div>
            <div class="btn-row" style="margin:0">
              <button class="btn-pill small" onclick="location.href='truck-detail.php?truck=${encodeURIComponent(vehicle.id || '')}'">View</button>
              <button class="btn-pill small" onclick="location.href='add-truck.php?id=${encodeURIComponent(vehicle.id || '')}'">Edit</button>
              <button class="btn-pill small" onclick="deleteVehicleById('${escapeHtml(vehicle.id || '')}')">Delete</button>
            </div>
          </div>
        `;
      }).join('');

      vehicleList.innerHTML = `
        <div class="table-head">
          <div>Vehicle</div>
          <div>Driver</div>
          <div>Status</div>
          <div>Capacity</div>
          <div>Actions</div>
        </div>
        ${rows}
      `;
    }

    async function loadVehicles() {
      try {
        await requireAuthOrRedirect('login.php');
        const response = await fetchWithAuth(`${window.API_URL}/vehicles`);
        vehicles = Array.isArray(response?.vehicles) ? response.vehicles : (Array.isArray(response) ? response : []);
        renderVehicles();
      } catch (error) {
        vehicleList.innerHTML = '<div class="table-row"><div class="muted">Unable to load vehicles.</div></div>';
        console.error(error);
      }
    }

    async function deleteVehicleById(vehicleId) {
      if (!vehicleId || !confirm('Delete this vehicle?')) return;
      try {
        await requireAuthOrRedirect('login.php');
        await fetchWithAuth(`${window.API_URL}/vehicles/${encodeURIComponent(vehicleId)}`, {
          method: 'DELETE'
        });
        await loadVehicles();
        alert('Vehicle deleted.');
      } catch (error) {
        alert(error.message || 'Vehicle delete failed.');
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', loadVehicles);
    } else {
      loadVehicles();
    }
  </script>
</body>
</html>