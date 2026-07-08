<?php
// includes/sidebar.php
if (!isset($activePage)) { $activePage = ''; }
function navActive($key, $activePage){ return $key === $activePage ? 'active' : ''; }
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
      <a href="dashboard.php" class="nav-link <?php echo navActive('dashboard', $activePage); ?>">
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
      <a href="tickets.php" class="nav-link <?php echo navActive('tickets', $activePage); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" stroke="currentColor"
            stroke-width="1.8" stroke-linejoin="round" />
          <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
        </svg>
        Tickets <span class="nav-badge">12</span>
      </a>
      <a href="drivers.php" class="nav-link <?php echo navActive('drivers', $activePage); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <circle cx="9" cy="8" r="3.4" stroke="currentColor" stroke-width="1.8" />
          <path d="M2.5 19c1-3.3 3.7-5.2 6.5-5.2s5.5 1.9 6.5 5.2" stroke="currentColor" stroke-width="1.8"
            stroke-linecap="round" />
        </svg>
        Drivers
      </a>
      <a href="miles.php" class="nav-link <?php echo navActive('miles', $activePage); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path
            d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"
            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
        </svg>
        Miles & Logs
      </a>
    </div>

    <div class="nav-group">
      <div class="nav-group-label">System</div>
      <a href="reports.php" class="nav-link <?php echo navActive('reports', $activePage); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M21 12v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6M15 15l4-4M15 15h-4M15 15l4-4"
            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        Reports
      </a>
      <a href="settings.php" class="nav-link <?php echo navActive('settings', $activePage); ?>">
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