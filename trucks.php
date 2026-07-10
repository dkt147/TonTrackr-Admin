<?php
$pageTitle  = 'Admin Trucks';
$activePage = 'drivers';
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
            <p class="page-sub" style="margin-top:6px">Tap a truck to view its daily log and trip history.</p>
          </div>
          <div class="page-actions">
            <button class="btn-pill small" onclick="sendQ2()">SEND Q2 REPORT</button>
            <button class="btn-pill small" onclick="exportPDF()">EXPORT PDF</button>
            <button class="btn-pill primary" onclick="window.location.href='add-truck.php'">+ ADD TRUCK</button>
          </div>
        </div>

        <div class="header-cards">
          <div class="card">
            <h3>Active Trucks</h3>
            <p>3</p>
          </div>
          <div class="card">
            <h3>Assigned Drivers</h3>
            <p>3</p>
          </div>
          <div class="card">
            <h3>Current Month</h3>
            <p>4,012 mi</p>
          </div>
        </div>

        <div class="filter-row">
          <div class="search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><path d="M21 21l-4.35-4.35"></path></svg>
            <input type="search" placeholder="Search truck, driver, stats...">
          </div>
          <div class="chip-group">
            <div class="chip active">ALL</div>
            <div class="chip">TRUCK</div>
            <div class="chip">DRIVER</div>
            <div class="chip">DATE</div>
          </div>
        </div>

        <div class="section-card">
          <div class="section-title">All Trucks</div>
          <div class="data-table" id="truckList">
            <div class="table-head">
              <div>Truck</div>
              <div>Driver</div>
              <div>Last Update</div>
              <div>Mileage</div>
            </div>
            <div class="table-row" data-id="330">
              <div class="table-cell">
                <strong>Truck 330</strong>
                <div class="muted">Long log truck · Active</div>
              </div>
              <div class="table-cell"><strong>Kaylee K.</strong></div>
              <div class="table-cell"><strong>05/19/26</strong><div class="muted">Loaded / In route</div></div>
              <div class="table-cell"><div class="metric-value">1,847 mi</div></div>
            </div>
            <div class="table-row" data-id="1450">
              <div class="table-cell">
                <strong>Truck 1450</strong>
                <div class="muted">Short log truck · Active</div>
              </div>
              <div class="table-cell"><strong>Jake M.</strong></div>
              <div class="table-cell"><strong>05/18/26</strong><div class="muted">Maintenance check</div></div>
              <div class="table-cell"><div class="metric-value">1,200 mi</div></div>
            </div>
            <div class="table-row" data-id="110">
              <div class="table-cell">
                <strong>Truck 110</strong>
                <div class="muted">Super train truck · On hold</div>
              </div>
              <div class="table-cell"><strong>Travis B.</strong></div>
              <div class="table-cell"><strong>05/14/26</strong><div class="muted">Awaiting dispatch</div></div>
              <div class="table-cell"><div class="metric-value">965 mi</div></div>
            </div>
          </div>
          <button class="btn-pill primary" style="width:100%;margin-top:16px;justify-content:center" onclick="window.location.href='#'">EXPORT</button>
        </div>

      </div>
    </div>
  </div>

  <script>
    function toggleDropdown(){
      alert('Dropdown would show selectable trucks (mobile-style).');
    }
    function sendQ2(){
      alert('Q2 report sent (placeholder).');
    }
    function exportPDF(){
      alert('Export PDF (placeholder).');
    }

    document.addEventListener('DOMContentLoaded', function(){
      document.querySelectorAll('.table-row').forEach(function(el){
        el.addEventListener('click', function(){
          const id = el.getAttribute('data-id') || '';
          if(id) location.href = 'truck-detail.php?truck='+id;
        });
      });
    });
  </script>
</body>
</html>