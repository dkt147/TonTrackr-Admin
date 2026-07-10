<?php
$pageTitle  = 'Truck Detail';
$activePage = 'drivers';
$truckId    = isset($_GET['truck']) ? intval($_GET['truck']) : 330;
$truckName  = 'Truck ' . $truckId;
$driverName = $truckId === 1450 ? 'Jake M.' : ($truckId === 110 ? 'Travis B.' : 'Kaylee K.');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TonTrackr · <?php echo htmlspecialchars($truckName); ?></title>
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

        <div class="page-head" style="margin-bottom:18px">
          <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='trucks.php'">
            <button class="btn-pill small" type="button" onclick="location.href='trucks.php'">← BACK</button>
            <div>
              <p class="page-eyebrow">Trucks</p>
              <h1 class="page-title" style="margin:0"><?php echo htmlspecialchars($truckName); ?></h1>
              <p class="page-sub" style="margin-top:6px">Assigned Driver · <?php echo htmlspecialchars($driverName); ?></p>
            </div>
          </div>
          <div class="page-actions">
            <button class="btn-pill small" onclick="sendQ2()">SEND Q2 REPORT</button>
            <button class="btn-pill small" onclick="exportPDF()">EXPORT PDF</button>
          </div>
        </div>

        <div class="section-card">
          <div class="section-title">Truck Overview</div>
          <div class="top-info">
            <div class="stats"><div style="font-size:12px;color:#888">Status</div><div style="font-weight:700"><span class="status-pill active">Active</span></div></div>
            <div class="stats"><div style="font-size:12px;color:#888">Q2</div><div style="font-weight:700">1,847 mi</div></div>
            <div class="stats"><div style="font-size:12px;color:#888">Month</div><div style="font-weight:700">May 2026</div></div>
          </div>

          <div class="section-title" style="margin-top:18px">Recent Mileage Log</div>
          <div class="data-table">
            <div class="table-head">
              <div>Date</div>
              <div>Start</div>
              <div>Load</div>
              <div>Distance</div>
            </div>
            <div class="table-row">
              <div class="table-cell"><strong>05/19/26</strong><div class="muted">Daily run</div></div>
              <div class="table-cell"><strong>48,230</strong></div>
              <div class="table-cell"><strong>IFG Grangeville</strong></div>
              <div class="table-cell"><div class="metric-value">250 mi</div></div>
            </div>
            <div class="table-row">
              <div class="table-cell"><strong>05/18/26</strong><div class="muted">Daily run</div></div>
              <div class="table-cell"><strong>47,980</strong></div>
              <div class="table-cell"><strong>Run Of The Mill</strong></div>
              <div class="table-cell"><div class="metric-value">250 mi</div></div>
            </div>
            <div class="table-row">
              <div class="table-cell"><strong>05/14/26</strong><div class="muted">Daily run</div></div>
              <div class="table-cell"><strong>47,710</strong></div>
              <div class="table-cell"><strong>Jungle Badger</strong></div>
              <div class="table-cell"><div class="metric-value">250 mi</div></div>
            </div>
          </div>

          <div class="summary-row">
            <div class="summary-pill">May Total</div>
            <div class="summary-pill">740 mi</div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    function sendQ2(){ alert('Q2 report sent for <?php echo $truckName; ?> (placeholder).'); }
    function exportPDF(){ alert('Export PDF for <?php echo $truckName; ?> (placeholder).'); }
  </script>
</body>
</html>