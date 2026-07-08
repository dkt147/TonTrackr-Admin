<?php
$pageTitle  = 'Users';
$activePage = 'users';
include __DIR__ . '/includes/header.php';
?>

<style>
    /* ===== TOOLBAR ===== */
    .toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .toolbar-search {
        flex: 1;
        min-width: 200px;
        max-width: 340px;
        position: relative;
    }

    .toolbar-search .icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--ink-faint);
        display: flex;
    }

    .toolbar-search input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        background: var(--white);
        font-size: 13.5px;
        font-family: inherit;
        color: var(--ink);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .toolbar-search input:focus {
        border-color: var(--coral);
        box-shadow: 0 0 0 4px rgba(255, 90, 60, 0.10);
    }

    .toolbar-select {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        background: var(--white);
        font-size: 13.5px;
        font-family: inherit;
        color: var(--ink);
        outline: none;
        cursor: pointer;
    }

    /* ===== STATS STRIP ===== */
    .user-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .ustat {
        background: var(--white);
        border-radius: var(--radius-md);
        border: 1px solid var(--line);
        padding: 16px 18px;
        box-shadow: var(--shadow-card);
    }

    .ustat-val {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 24px;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 5px;
    }

    .ustat-label {
        font-size: 12px;
        color: var(--ink-soft);
        font-weight: 600;
    }

    /* ===== USER TABLE ===== */
    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 12px;
        flex-shrink: 0;
    }

    .toggle-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .toggle {
        position: relative;
        display: inline-block;
        width: 38px;
        height: 22px;
        flex-shrink: 0;
    }

    .toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        border-radius: 999px;
        background: #D4CCC8;
        transition: background .2s ease;
    }

    .toggle-slider:before {
        content: '';
        position: absolute;
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        border-radius: 50%;
        background: #fff;
        transition: transform .2s ease;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
    }

    .toggle input:checked+.toggle-slider {
        background: var(--coral);
    }

    .toggle input:checked+.toggle-slider:before {
        transform: translateX(16px);
    }

    .toggle-label {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink-soft);
    }

    .action-btns {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--ink-soft);
        transition: background .15s, color .15s, border-color .15s;
    }

    .action-btn.view:hover {
        background: #FDEDE7;
        color: var(--coral-deep);
        border-color: var(--coral);
    }

    .action-btn.delete:hover {
        background: var(--bad-bg);
        color: var(--bad);
        border-color: var(--bad);
    }

    /* ===== DETAIL DRAWER ===== */
    .drawer-overlay {
        position: fixed;
        inset: 0;
        background: rgba(36, 23, 18, 0.45);
        z-index: 50;
        display: none;
        align-items: flex-start;
        justify-content: flex-end;
    }

    .drawer-overlay.open {
        display: flex;
    }

    .drawer {
        width: 100%;
        max-width: 480px;
        height: 100vh;
        background: var(--white);
        box-shadow: -20px 0 60px rgba(36, 23, 18, 0.2);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform: translateX(100%);
        transition: transform .3s cubic-bezier(.22, .72, 0, 1);
    }

    .drawer-overlay.open .drawer {
        transform: translateX(0);
    }

    .drawer-head {
        padding: 22px 24px 18px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }

    .drawer-title {
        font-size: 17px;
        font-weight: 700;
        font-family: 'Fraunces', serif;
    }

    .drawer-close {
        margin-left: auto;
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: 1px solid var(--line);
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--ink-soft);
    }

    .drawer-close:hover {
        background: var(--paper);
    }

    .drawer-body {
        flex: 1;
        overflow-y: auto;
    }

    /* user profile section */
    .user-profile-hero {
        background: linear-gradient(160deg, #FFD0B8 0%, #FF8A5C 100%);
        padding: 28px 24px 20px;
        display: flex;
        align-items: flex-end;
        gap: 16px;
    }

    .profile-avatar-lg {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 22px;
        color: #fff;
        border: 3px solid rgba(255, 255, 255, 0.5);
        flex-shrink: 0;
    }

    .profile-hero-info .p-name {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 19px;
        color: #fff;
    }

    .profile-hero-info .p-email {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.82);
        margin-top: 2px;
    }

    .profile-hero-info .p-joined {
        font-size: 11.5px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 5px;
    }

    .detail-section {
        padding: 20px 24px;
        border-bottom: 1px solid var(--line);
    }

    .detail-section:last-child {
        border-bottom: none;
    }

    .detail-section-title {
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 14px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .info-item .info-label {
        font-size: 11.5px;
        font-weight: 700;
        color: var(--ink-faint);
        margin-bottom: 3px;
    }

    .info-item .info-val {
        font-size: 14px;
        font-weight: 700;
        color: var(--ink);
    }

    /* preferences chips */
    .chip-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .chip {
        padding: 5px 13px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        background: var(--coral-soft);
        color: var(--coral-deep);
        border: 1px solid #F6C7B6;
    }

    .chip.mood {
        background: #EEE9FC;
        color: #5B3FBB;
        border-color: #C8BDF2;
    }

    .chip.diet {
        background: #E7F5EA;
        color: #2C8A4B;
        border-color: #B9DEC2;
    }

    /* activity timeline */
    .timeline {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .timeline-item {
        display: flex;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid var(--line);
        position: relative;
    }

    .timeline-item:last-child {
        border-bottom: none;
    }

    .tl-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .tl-info {
        flex: 1;
        min-width: 0;
    }

    .tl-info .tl-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink);
    }

    .tl-info .tl-meta {
        font-size: 12px;
        color: var(--ink-soft);
        margin-top: 2px;
    }

    .tl-time {
        font-size: 11.5px;
        color: var(--ink-faint);
        flex-shrink: 0;
    }

    /* ban/activate action in drawer footer */
    .drawer-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--line);
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-ban {
        flex: 1;
        padding: 11px;
        border-radius: 10px;
        border: 1.5px solid var(--bad);
        background: var(--bad-bg);
        color: var(--bad);
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s;
    }

    .btn-ban:hover {
        background: #f9cfc9;
    }

    .btn-activate {
        flex: 1;
        padding: 11px;
        border-radius: 10px;
        border: 1.5px solid var(--good);
        background: var(--good-bg);
        color: var(--good);
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        display: none;
        transition: background .15s;
    }

    .btn-activate:hover {
        background: #cfecd8;
    }

    .btn-message {
        flex: 1;
        padding: 11px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(160deg, #FF7A52, var(--coral-deep));
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        box-shadow: 0 8px 18px -8px rgba(232, 67, 31, 0.45);
    }

    /* pagination */
    .pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 22px 14px;
        border-top: 1px solid var(--line);
        font-size: 13px;
        color: var(--ink-soft);
    }

    .page-btns {
        display: flex;
        gap: 4px;
    }

    .page-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        color: var(--ink-soft);
    }

    .page-btn:hover {
        background: var(--paper);
        color: var(--ink);
    }

    .page-btn.active {
        background: var(--coral);
        color: #fff;
        border-color: var(--coral);
    }

    @media(max-width:900px) {
        .user-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:560px) {
        .user-stats {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- PAGE HEADER -->
<div class="page-head">
    <div>
        <p class="page-eyebrow">Management</p>
        <h1 class="page-title">Users</h1>
        <p class="page-sub">View, manage and moderate all registered users.</p>
    </div>
</div>

<!-- STATS STRIP -->
<div class="user-stats">
    <div class="ustat">
        <div class="ustat-val">4,812</div>
        <div class="ustat-label">Total Users</div>
    </div>
    <div class="ustat">
        <div class="ustat-val" style="color:var(--good);">4,541</div>
        <div class="ustat-label">Active</div>
    </div>
    <div class="ustat">
        <div class="ustat-val" style="color:var(--bad);">48</div>
        <div class="ustat-label">Banned</div>
    </div>
    <div class="ustat">
        <div class="ustat-val" style="color:var(--coral-deep);">+186</div>
        <div class="ustat-label">This Month</div>
    </div>
</div>

<!-- TOOLBAR -->
<div class="toolbar">
    <div class="toolbar-search">
        <span class="icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" /></svg>
        </span>
        <input type="text" id="userSearch" placeholder="Search by name or email…" oninput="filterUsers()">
    </div>
    <select class="toolbar-select" id="statusFilter" onchange="filterUsers()">
        <option value="">All Statuses</option>
        <option>Active</option>
        <option>Banned</option>
        <option>Inactive</option>
    </select>
    <select class="toolbar-select" id="sortFilter" onchange="filterUsers()">
        <option value="newest">Newest First</option>
        <option value="oldest">Oldest First</option>
        <option value="name">Name A–Z</option>
    </select>
</div>

<!-- USER TABLE -->
<div class="card" style="padding:0; overflow:hidden;">
    <table class="table" id="userTable">
        <thead>
            <tr>
                <th style="padding-left:22px;">User</th>
                <th>Email</th>
                <th>Join Date</th>
                <th>Spins</th>
                <th>Status</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <?php
      $avatarColors = [
        ['bg'=>'#FDEDE7','fg'=>'#E8431F'],
        ['bg'=>'#E7F5EA','fg'=>'#2C8A4B'],
        ['bg'=>'#EEE9FC','fg'=>'#5B3FBB'],
        ['bg'=>'#FBF1D9','fg'=>'#C9890B'],
        ['bg'=>'#E9F4FB','fg'=>'#1A7FB5'],
        ['bg'=>'#FCE8F3','fg'=>'#A0306F'],
        ['bg'=>'#FDE7E2','fg'=>'#D43B25'],
        ['bg'=>'#E7F5EA','fg'=>'#2C8A4B'],
        ['bg'=>'#FDEDE7','fg'=>'#E8431F'],
        ['bg'=>'#EEE9FC','fg'=>'#5B3FBB'],
        ['bg'=>'#E9F4FB','fg'=>'#1A7FB5'],
        ['bg'=>'#FBF1D9','fg'=>'#C9890B'],
      ];
      $users = [
        ['Sara Malik',     'sara.malik@mail.com',   'Jan 12, 2025', 42, 'Active'],
        ['Ali Khan',       'ali.khan@mail.com',     'Jan 20, 2025', 28, 'Active'],
        ['Rida Hassan',    'rida.h@mail.com',       'Feb 4, 2025',  15, 'Active'],
        ['Omar Farooq',    'omar.f@mail.com',       'Feb 18, 2025', 67, 'Banned'],
        ['Nadia Jamil',    'nadia.j@mail.com',      'Mar 2, 2025',  9,  'Active'],
        ['Hamza Siddiqui', 'hamza.s@mail.com',      'Mar 14, 2025', 33, 'Active'],
        ['Ayesha Raza',    'ayesha.r@mail.com',     'Apr 1, 2025',  5,  'Inactive'],
        ['Bilal Ahmed',    'bilal.a@mail.com',      'Apr 9, 2025',  81, 'Active'],
        ['Zara Qureshi',   'zara.q@mail.com',       'Apr 22, 2025', 22, 'Active'],
        ['Usman Tariq',    'usman.t@mail.com',      'May 5, 2025',  0,  'Banned'],
        ['Hina Baig',      'hina.b@mail.com',       'May 18, 2025', 11, 'Active'],
        ['Kamran Iqbal',   'kamran.i@mail.com',     'Jun 3, 2025',  38, 'Active'],
      ];
      foreach($users as $i => $u):
        $ac   = $avatarColors[$i % count($avatarColors)];
        $init = strtoupper(substr($u[0],0,1)) . strtoupper(substr(strstr($u[0],' '),1,1));
        $sc   = $u[4]==='Active' ? 'badge-good' : ($u[4]==='Banned' ? 'badge-bad' : 'badge-warn');
        $checked = $u[4]==='Active' ? 'checked' : '';
        $slug = 'u' . $i;
      ?>
            <tr class="user-row" data-name="<?php echo strtolower($u[0]); ?>"
                data-email="<?php echo strtolower($u[1]); ?>" data-status="<?php echo $u[4]; ?>"
                data-date="<?php echo $i; ?>">
                <td style="padding-left:22px;">
                    <div class="cell-user">
                        <div class="user-avatar"
                            style="background:<?php echo $ac['bg']; ?>; color:<?php echo $ac['fg']; ?>;">
                            <?php echo $init; ?></div>
                        <div>
                            <div class="name"><?php echo $u[0]; ?></div>
                            <div class="sub" style="font-size:11.5px; color:var(--ink-soft);">
                                #USER-<?php echo str_pad($i+1,4,'0',STR_PAD_LEFT); ?></div>
                        </div>
                    </div>
                </td>
                <td style="color:var(--ink-soft); font-size:13px;"><?php echo $u[1]; ?></td>
                <td style="color:var(--ink-soft); font-size:13px;"><?php echo $u[2]; ?></td>
                <td style="font-weight:700;"><?php echo $u[3]; ?></td>
                <td><span class="badge <?php echo $sc; ?>" id="badge-<?php echo $slug; ?>"><?php echo $u[4]; ?></span>
                </td>
                <td>
                    <div class="toggle-wrap">
                        <label class="toggle">
                            <input type="checkbox" <?php echo $checked; ?>
                                onchange="toggleUser(this, '<?php echo $slug; ?>', '<?php echo addslashes($u[0]); ?>')">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </td>
                <td>
                    <div class="action-btns">
                        <button class="action-btn view" title="View profile"
                            onclick="openDetail(<?php echo $i; ?>, '<?php echo addslashes($u[0]); ?>', '<?php echo $u[1]; ?>', '<?php echo $u[2]; ?>', <?php echo $u[3]; ?>, '<?php echo $u[4]; ?>', '<?php echo $ac['bg']; ?>', '<?php echo $ac['fg']; ?>', '<?php echo $init; ?>')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                    stroke-width="1.8" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" /></svg>
                        </button>
                        <button class="action-btn delete" title="Delete user"
                            onclick="confirmDelete('<?php echo addslashes($u[0]); ?>')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" /></svg>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <span>Showing <strong>1–12</strong> of <strong>4,812</strong> users</span>
        <div class="page-btns">
            <button class="page-btn">‹</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">…</button>
            <button class="page-btn">401</button>
            <button class="page-btn">›</button>
        </div>
    </div>
</div>

<!-- ================================================================
     DETAIL DRAWER
     ============================================================= -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawerOnBg(event)">
    <div class="drawer" id="drawer">

        <div class="drawer-head">
            <div>
                <div class="drawer-title">User Profile</div>
                <div style="font-size:12px; color:var(--ink-soft);">Full activity & preferences</div>
            </div>
            <button class="drawer-close" onclick="closeDrawer()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
            </button>
        </div>

        <div class="drawer-body">

            <!-- hero -->
            <div class="user-profile-hero" id="d-hero">
                <div class="profile-avatar-lg" id="d-avatar"></div>
                <div class="profile-hero-info">
                    <div class="p-name" id="d-name"></div>
                    <div class="p-email" id="d-email"></div>
                    <div class="p-joined" id="d-joined"></div>
                </div>
            </div>

            <!-- quick stats -->
            <div class="detail-section">
                <div class="detail-section-title">Stats</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Total Spins</div>
                        <div class="info-val" id="d-spins">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Check-ins</div>
                        <div class="info-val" id="d-checkins">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Reviews Left</div>
                        <div class="info-val" id="d-reviews">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Challenges Done</div>
                        <div class="info-val" id="d-challenges">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account Status</div>
                        <div class="info-val" id="d-status">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Member Since</div>
                        <div class="info-val" id="d-since">—</div>
                    </div>
                </div>
            </div>

            <!-- preferences -->
            <div class="detail-section">
                <div class="detail-section-title">Preferences</div>
                <p style="font-size:12px; color:var(--ink-soft); margin:0 0 10px;">Favourite Cuisines</p>
                <div class="chip-row" id="d-cuisines">
                    <span class="chip">Italian</span>
                    <span class="chip">Asian</span>
                    <span class="chip">Mediterranean</span>
                </div>
                <p style="font-size:12px; color:var(--ink-soft); margin:14px 0 10px;">Mood Tags</p>
                <div class="chip-row" id="d-moods">
                    <span class="chip mood">Date Night</span>
                    <span class="chip mood">Outdoor</span>
                    <span class="chip mood">Casual</span>
                </div>
                <p style="font-size:12px; color:var(--ink-soft); margin:14px 0 10px;">Dietary</p>
                <div class="chip-row" id="d-dietary">
                    <span class="chip diet">No Restrictions</span>
                </div>
            </div>

            <!-- activity history -->
            <div class="detail-section">
                <div class="detail-section-title">Activity History</div>
                <div class="timeline" id="d-timeline">
                    <div class="timeline-item">
                        <div class="tl-icon" style="background:#FDEDE7;">🎲</div>
                        <div class="tl-info">
                            <div class="tl-title">Quick Pick spin — Casa Verde</div>
                            <div class="tl-meta">Karachi, DHA · Checked in ✓</div>
                        </div>
                        <div class="tl-time">2h ago</div>
                    </div>
                    <div class="timeline-item">
                        <div class="tl-icon" style="background:#E7F5EA;">⭐</div>
                        <div class="tl-info">
                            <div class="tl-title">Left a review — Olive & Thyme</div>
                            <div class="tl-meta">4.8 stars · "Amazing ambiance"</div>
                        </div>
                        <div class="tl-time">1d ago</div>
                    </div>
                    <div class="timeline-item">
                        <div class="tl-icon" style="background:#EEE9FC;">🚶</div>
                        <div class="tl-info">
                            <div class="tl-title">Street Walk session started</div>
                            <div class="tl-meta">Lahore, MM Alam Road</div>
                        </div>
                        <div class="tl-time">2d ago</div>
                    </div>
                    <div class="timeline-item">
                        <div class="tl-icon" style="background:#FBF1D9;">🏆</div>
                        <div class="tl-info">
                            <div class="tl-title">Challenge completed — Try 3 new cuisines</div>
                            <div class="tl-meta">+150 points earned</div>
                        </div>
                        <div class="tl-time">4d ago</div>
                    </div>
                    <div class="timeline-item">
                        <div class="tl-icon" style="background:#FCE8F3;">🎰</div>
                        <div class="tl-info">
                            <div class="tl-title">Bar Roulette spin — Velvet Lounge</div>
                            <div class="tl-meta">Karachi, Clifton</div>
                        </div>
                        <div class="tl-time">6d ago</div>
                    </div>
                </div>
            </div>

        </div><!-- /drawer-body -->

        <div class="drawer-footer">
            <button class="btn-ban" id="d-ban-btn" onclick="drawerToggleBan()">🚫 Ban User</button>
            <button class="btn-activate" id="d-activate-btn" onclick="drawerToggleBan()">✓ Activate</button>
            <button class="btn-message">✉ Message</button>
        </div>

    </div>
</div>

<?php
$extraScripts = <<<'JS'
<script>
/* ===== FILTER ===== */
function filterUsers(){
  const q      = document.getElementById('userSearch').value.toLowerCase();
  const status = document.getElementById('statusFilter').value;
  const sort   = document.getElementById('sortFilter').value;
  const tbody  = document.getElementById('userTableBody');
  const rows   = Array.from(tbody.querySelectorAll('.user-row'));

  rows.forEach(row => {
    const nm  = row.dataset.name;
    const em  = row.dataset.email;
    const st  = row.dataset.status;
    const show =
      (!q      || nm.includes(q) || em.includes(q)) &&
      (!status || st === status);
    row.style.display = show ? '' : 'none';
  });

  // sort
  const visible = rows.filter(r => r.style.display !== 'none');
  visible.sort((a,b) => {
    if(sort==='name')   return a.dataset.name.localeCompare(b.dataset.name);
    if(sort==='oldest') return +a.dataset.date - +b.dataset.date;
    return +b.dataset.date - +a.dataset.date;
  });
  visible.forEach(r => tbody.appendChild(r));
}

/* ===== INLINE TOGGLE ===== */
function toggleUser(checkbox, slug, name){
  const badge  = document.getElementById('badge-' + slug);
  const active = checkbox.checked;
  badge.textContent  = active ? 'Active' : 'Banned';
  badge.className    = 'badge ' + (active ? 'badge-good' : 'badge-bad');
  // TODO: POST to backend
}

/* ===== DETAIL DRAWER ===== */
let currentUserActive = true;

function openDetail(i, name, email, joined, spins, status, bg, fg, init){
  currentUserActive = (status === 'Active');

  document.getElementById('d-hero').style.background =
    'linear-gradient(160deg,' + bg + ' 0%,#FF8A5C 100%)';
  document.getElementById('d-avatar').textContent    = init;
  document.getElementById('d-avatar').style.background = bg;
  document.getElementById('d-avatar').style.color      = fg;

  document.getElementById('d-name').textContent    = name;
  document.getElementById('d-email').textContent   = email;
  document.getElementById('d-joined').textContent  = 'Member since ' + joined;
  document.getElementById('d-spins').textContent   = spins;
  document.getElementById('d-checkins').textContent   = Math.floor(spins * 0.7);
  document.getElementById('d-reviews').textContent    = Math.floor(spins * 0.3);
  document.getElementById('d-challenges').textContent = Math.floor(spins * 0.15);
  document.getElementById('d-since').textContent   = joined;

  const statusEl = document.getElementById('d-status');
  statusEl.textContent = status;
  statusEl.style.color = status === 'Active' ? 'var(--good)' : status === 'Banned' ? 'var(--bad)' : 'var(--warn)';

  syncDrawerBanBtn();

  const overlay = document.getElementById('drawerOverlay');
  overlay.classList.add('open');
  document.body.style.overflow = 'hidden';
}

function syncDrawerBanBtn(){
  document.getElementById('d-ban-btn').style.display      = currentUserActive ? 'block' : 'none';
  document.getElementById('d-activate-btn').style.display = currentUserActive ? 'none'  : 'block';
}

function drawerToggleBan(){
  currentUserActive = !currentUserActive;
  const statusEl = document.getElementById('d-status');
  statusEl.textContent = currentUserActive ? 'Active' : 'Banned';
  statusEl.style.color = currentUserActive ? 'var(--good)' : 'var(--bad)';
  syncDrawerBanBtn();
  // TODO: POST status change to backend
}

function closeDrawer(){
  document.getElementById('drawerOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeDrawerOnBg(e){
  if(e.target === document.getElementById('drawerOverlay')) closeDrawer();
}

/* ===== DELETE ===== */
function confirmDelete(name){
  if(confirm('Delete "' + name + '"? This cannot be undone.')){
    // TODO: call backend delete endpoint
    alert('"' + name + '" deleted. (Wire to your backend.)');
  }
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>