<?php
// includes/header.php (navbar partial — no wrapper divs here)
$__titles = [
    'dashboard.php' => 'Dashboard',
    'tickets.php'   => 'Tickets',
    'trucks.php'    => 'Admin Trucks',
    'add-truck.php' => 'Add a Truck',
    'truck-detail.php' => 'Truck Detail',
    'drivers.php'   => 'Drivers',
    'miles.php'     => 'Miles & Logs',
    'reports.php'   => 'Reports',
    'earnings.php'  => 'Earnings',
    'settings.php'  => 'Settings',
    'add-ticket.php' => 'New Ticket',
    'tickets-export.php' => 'Tickets - Export',
    'tasks.php' => 'Task Management',
];
$__currentFile = basename($_SERVER['PHP_SELF']);
$__pageTitle = $__titles[$__currentFile] ?? 'Dashboard';
?>
<link rel="stylesheet" href="assets/css/app.css">
<header class="topbar">
    <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
        </svg>
    </button>

    <span class="topbar-title"><?php echo htmlspecialchars($__pageTitle); ?></span>

    <div class="topbar-actions">
        <div class="topbar-profile">
            <div class="avatar-sm" style="width:34px;height:34px;font-size:12px;">JD</div>
            <div>
                <div class="name">John Doe</div>
                <div class="role">Fleet Admin</div>
            </div>
        </div>
    </div>
</header>