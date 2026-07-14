<?php
// includes/sidebar.php
$__currentFile = basename($_SERVER['PHP_SELF']);
function navActive($file, $current){ return $file === $current ? 'active' : ''; }
?>
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <div class="brand-mark">
      <img src="assets/images/logo1.png" alt="TonTrackr">
    </div>
    <div>
      <div class="brand-name">TonTrackr</div>
      <div class="brand-tag">Fleet Management</div>
    </div>
  </div>

  <nav class="nav-scroll">
    <div class="nav-group">
      <div class="nav-group-label">Main</div>
      <a href="dashboard.php" class="nav-link <?php echo navActive('dashboard.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <rect x="3" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.8" />
          <rect x="13" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.8" />
          <rect x="3" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.8" />
          <rect x="13" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.8" />
        </svg>
        Dashboard
      </a>
    </div>

    <div class="nav-group">
      <div class="nav-group-label">Manage</div>
      <a href="tickets.php" class="nav-link <?php echo navActive('tickets.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" stroke="currentColor"
            stroke-width="1.8" stroke-linejoin="round" />
          <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
        </svg>
        Tickets <span class="nav-badge">12</span>
      </a>
      <a href="trucks.php" class="nav-link <?php echo navActive('trucks.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M3 13h14v6H3z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
          <path d="M7 13V8a3 3 0 0 1 3-3h6v8" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
        </svg>
        Trucks
      </a>
      <a href="drivers.php" class="nav-link <?php echo navActive('drivers.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <circle cx="9" cy="8" r="3.4" stroke="currentColor" stroke-width="1.8" />
          <path d="M2.5 19c1-3.3 3.7-5.2 6.5-5.2s5.5 1.9 6.5 5.2" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" />
        </svg>
        Drivers
      </a>
      <a href="log-miles.php" class="nav-link <?php echo navActive('log-miles.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path
            d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"
            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Log Miles
      </a>
      <a href="jobs.php" class="nav-link <?php echo navActive('jobs.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M20 8H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
          <path d="M6 4v5M12 4v5M18 4v5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Jobs
      </a>
      <a href="contractors.php" class="nav-link <?php echo navActive('contractors.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
          <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
        </svg>
        Contractors
      </a>
      <a href="reports.php" class="nav-link <?php echo navActive('reports.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M9 3H5a2 2 0 0 0-2 2v4m0 0H3m2 0v4M3 9h18M3 9h18v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
          <path d="M9 13h6M9 17h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Reports
      </a>
      <a href="earnings.php" class="nav-link <?php echo navActive('earnings.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M12 2v20M2 12h20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
          <path d="M5 5l14 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Earnings
      </a>
    </div>

    <div class="nav-group">
      <div class="nav-group-label">System</div>
      <a href="subscriptions.php" class="nav-link <?php echo navActive('subscriptions.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
          <path d="M12 6v12M9 9h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Subscriptions
      </a>
      <a href="settings.php" class="nav-link <?php echo navActive('settings.php', $__currentFile); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.8" />
          <path
            d="M19.4 13.5a7.6 7.6 0 0 0 0-3l2-1.4-2-3.4-2.3.8a7.6 7.6 0 0 0-2.6-1.5L14 2.5h-4l-.5 2.5a7.6 7.6 0 0 0-2.6 1.5l-2.3-.8-2 3.4 2 1.4a7.6 7.6 0 0 0 0 3l-2 1.4 2 3.4 2.3-.8a7.6 7.6 0 0 0 2.6 1.5l.5 2.5h4l.5-2.5a7.6 7.6 0 0 0 2.6-1.5l2.3.8 2-3.4-2-1.4Z"
            stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
        </svg>
        Settings
      </a>
    </div>
  </nav>

  <div class="sidebar-footer">
    <div class="avatar-sm">JD</div>
    <div>
      <div class="sidebar-user-name">John Doe</div>
      <div class="sidebar-user-role">Fleet Admin</div>
    </div>
    <button class="logout-btn" title="Log out" onclick="window.location.href='login.php'">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="1.8"
          stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>
  </div>
</aside>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div> 