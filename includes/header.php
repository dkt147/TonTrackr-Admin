<?php
// includes/header.php
if (!isset($pageTitle)) { $pageTitle = 'Dashboard'; }
?>
<div class="app-shell">

  <?php include __DIR__ . '/sidebar.php'; ?>

  <div class="main-area">

    <header class="topbar">
      <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
          <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
      </button>

      <span class="topbar-title"><?php echo htmlspecialchars($pageTitle); ?></span>

      <!-- <div class="topbar-search">
        <span class="icon">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
            <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
          </svg>
        </span>
        <input type="text" placeholder="Search tickets, drivers…">
      </div> -->

      <div class="topbar-actions">
        <!-- <button class="icon-btn" title="Notifications">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9Z" stroke="currentColor" stroke-width="1.8"
              stroke-linejoin="round" />
            <path d="M13.7 21a2 2 0 0 1-3.4 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
          </svg>
          <span class="dot"></span>
        </button> -->
        <div class="topbar-profile">
          <div class="avatar-sm" style="width:34px;height:34px;font-size:12px;">JD</div>
          <div>
            <div class="name">John Doe</div>
            <div class="role">Fleet Admin</div>
          </div>
        </div>
      </div>
    </header>

    <main class="content">