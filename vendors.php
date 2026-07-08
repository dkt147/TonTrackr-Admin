<?php
$pageTitle  = 'Vendors';
$activePage = 'vendors';
include __DIR__ . '/includes/header.php';
?>

<style>
    /* ===== PAGE-LEVEL STYLES ===== */
    .tab-bar {
        display: flex;
        align-items: center;
        gap: 4px;
        background: var(--paper);
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 4px;
        width: fit-content;
        margin-bottom: 22px;
    }

    .tab-btn {
        padding: 8px 18px;
        border-radius: 9px;
        border: none;
        background: transparent;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink-soft);
        cursor: pointer;
        transition: background .15s, color .15s, box-shadow .15s;
        position: relative;
    }

    .tab-btn .tab-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--line);
        color: var(--ink-soft);
        font-size: 10.5px;
        font-weight: 800;
        border-radius: 999px;
        padding: 1px 7px;
        margin-left: 6px;
    }

    .tab-btn.active {
        background: #fff;
        color: var(--ink);
        box-shadow: 0 2px 8px -4px rgba(36, 23, 18, 0.18);
    }

    .tab-btn.active .tab-count {
        background: var(--coral);
        color: #fff;
    }

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
        max-width: 320px;
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

    .btn-coral {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(160deg, #FF7A52, var(--coral-deep));
        color: #fff;
        font-size: 13.5px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        margin-left: auto;
        box-shadow: 0 8px 18px -8px rgba(232, 67, 31, 0.5);
        transition: transform .15s, box-shadow .15s;
    }

    .btn-coral:hover {
        transform: translateY(-1px);
    }

    .btn-coral:active {
        transform: scale(0.98);
    }

    /* vendor table */
    .vendor-img {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--paper);
        object-fit: cover;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .rating-stars {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 700;
        color: var(--ink);
    }

    .rating-stars span {
        color: #F9A825;
        font-size: 13px;
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

    .action-btn:hover {
        background: var(--paper);
        color: var(--ink);
    }

    .action-btn.edit:hover {
        background: #E7F5EA;
        color: var(--good);
        border-color: var(--good);
    }

    .action-btn.delete:hover {
        background: var(--bad-bg);
        color: var(--bad);
        border-color: var(--bad);
    }

    .action-btn.view:hover {
        background: #FDEDE7;
        color: var(--coral-deep);
        border-color: var(--coral);
    }

    /* pending card list */
    .pending-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 16px;
        margin-top: 4px;
    }

    .vendor-card {
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--line);
        box-shadow: var(--shadow-card);
        overflow: hidden;
    }

    .vendor-card-thumb {
        height: 130px;
        background: linear-gradient(160deg, #FFD0B8, #FF8A5C);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .vendor-card-body {
        padding: 16px;
    }

    .vendor-card-body .v-name {
        font-size: 15px;
        font-weight: 800;
        color: var(--ink);
        margin-bottom: 4px;
    }

    .vendor-card-body .v-meta {
        font-size: 12px;
        color: var(--ink-soft);
        margin-bottom: 12px;
    }

    .vendor-card-footer {
        display: flex;
        gap: 8px;
    }

    .btn-approve {
        flex: 1;
        padding: 9px;
        border-radius: 9px;
        border: none;
        background: var(--good-bg);
        color: var(--good);
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-approve:hover {
        background: #cfecd8;
    }

    .btn-reject {
        flex: 1;
        padding: 9px;
        border-radius: 9px;
        border: none;
        background: var(--bad-bg);
        color: var(--bad);
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-reject:hover {
        background: #f9cfc9;
    }

    /* ===== DRAWER / FORM OVERLAY ===== */
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
        max-width: 520px;
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
        font-size: 18px;
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
        padding: 24px;
    }

    .drawer-footer {
        padding: 18px 24px;
        border-top: 1px solid var(--line);
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    /* form elements */
    .form-row {
        margin-bottom: 18px;
    }

    .form-row label {
        display: block;
        font-size: 12.5px;
        font-weight: 800;
        letter-spacing: .03em;
        text-transform: uppercase;
        color: var(--ink-soft);
        margin-bottom: 7px;
    }

    .form-row input,
    .form-row select,
    .form-row textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        background: var(--paper);
        font-size: 14px;
        font-family: inherit;
        color: var(--ink);
        outline: none;
        transition: border-color .15s, box-shadow .15s, background .15s;
    }

    .form-row input:focus,
    .form-row select:focus,
    .form-row textarea:focus {
        border-color: var(--coral);
        box-shadow: 0 0 0 4px rgba(255, 90, 60, 0.10);
        background: var(--white);
    }

    .form-row textarea {
        resize: vertical;
        min-height: 90px;
    }

    .form-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .upload-zone {
        border: 2px dashed var(--line);
        border-radius: 12px;
        padding: 26px 16px;
        text-align: center;
        cursor: pointer;
        background: var(--paper);
        transition: border-color .15s, background .15s;
    }

    .upload-zone:hover {
        border-color: var(--coral);
        background: var(--coral-soft);
    }

    .upload-zone p {
        margin: 8px 0 0;
        font-size: 13px;
        color: var(--ink-soft);
    }

    .upload-zone strong {
        color: var(--coral-deep);
    }

    .upload-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }

    .upload-thumb {
        width: 72px;
        height: 72px;
        border-radius: 10px;
        background: var(--paper);
        border: 1px solid var(--line);
        overflow: hidden;
        position: relative;
    }

    .upload-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-thumb .rm {
        position: absolute;
        top: 3px;
        right: 3px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: rgba(36, 23, 18, 0.7);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 10px;
    }

    .btn-outline-ink {
        flex: 1;
        padding: 11px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        background: var(--white);
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        color: var(--ink);
        cursor: pointer;
    }

    .btn-outline-ink:hover {
        background: var(--paper);
    }

    .btn-save {
        flex: 2;
        padding: 11px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(160deg, #FF7A52, var(--coral-deep));
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        box-shadow: 0 8px 18px -8px rgba(232, 67, 31, 0.5);
    }

    .btn-save:hover {
        opacity: .92;
    }

    /* hours grid */
    .hours-grid {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .hours-row {
        display: grid;
        grid-template-columns: 100px 1fr 1fr;
        gap: 10px;
        align-items: center;
    }

    .hours-row .day {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink);
    }

    /* empty state */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--ink-soft);
    }

    .empty-state svg {
        margin: 0 auto 14px;
        display: block;
        opacity: .35;
    }

    .empty-state p {
        font-size: 14px;
    }
</style>

<!-- ===== PAGE HEADER ===== -->
<div class="page-head">
    <div>
        <p class="page-eyebrow">Management</p>
        <h1 class="page-title">Vendors</h1>
        <p class="page-sub">Manage restaurant listings, approve new submissions.</p>
    </div>
</div>

<!-- ===== TABS ===== -->
<div class="tab-bar">
    <button class="tab-btn active" onclick="switchTab('list', this)" id="tab-list">
        All Vendors <span class="tab-count">326</span>
    </button>
    <button class="tab-btn" onclick="switchTab('pending', this)" id="tab-pending">
        Pending <span class="tab-count">6</span>
    </button>
</div>

<!-- ===================================================================
     TAB 1 — ALL VENDORS (LIST VIEW)
     ================================================================= -->
<div id="section-list">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" /></svg>
            </span>
            <input type="text" id="vendorSearch" placeholder="Search by name, cuisine…" oninput="filterVendors()">
        </div>
        <select class="toolbar-select" onchange="filterVendors()" id="cuisineFilter">
            <option value="">All Cuisines</option>
            <option>Italian</option>
            <option>Mexican</option>
            <option>Mediterranean</option>
            <option>Asian</option>
            <option>Fine Dining</option>
            <option>Fast Food</option>
        </select>
        <select class="toolbar-select" onchange="filterVendors()" id="statusFilter">
            <option value="">All Statuses</option>
            <option>Active</option>
            <option>Inactive</option>
            <option>Suspended</option>
        </select>
        <button class="btn-coral" onclick="openDrawer()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" /></svg>
            Add Vendor
        </button>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table" id="vendorTable">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Vendor</th>
                    <th>Cuisine</th>
                    <th>Location</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="vendorTableBody">
                <?php
        $vendors = [
          ['Casa Verde',       'Italian',       'Karachi, DHA',    4.8, 'Active',    'Jan 12, 2025'],
          ['Olive & Thyme',    'Mediterranean', 'Lahore, Gulberg', 4.6, 'Active',    'Feb 4, 2025'],
          ['The Brass Spoon',  'Fine Dining',   'Islamabad, F-7',  4.9, 'Active',    'Mar 1, 2025'],
          ['Velvet Lounge',    'Asian',         'Karachi, Clifton',4.3, 'Inactive',  'Mar 18, 2025'],
          ['Burger Republic',  'Fast Food',     'Lahore, MM Alam', 4.1, 'Active',    'Apr 2, 2025'],
          ['El Ranchero',      'Mexican',       'Karachi, PECHS',  4.5, 'Active',    'Apr 20, 2025'],
          ['Saffron House',    'Asian',         'Islamabad, G-9',  4.7, 'Active',    'May 5, 2025'],
          ['Desi Dhaba',       'Fast Food',     'Lahore, DHA',     3.9, 'Suspended', 'May 14, 2025'],
          ['Terra Nova',       'Italian',       'Karachi, Bahria', 4.4, 'Active',    'Jun 1, 2025'],
          ['Spice Trail',      'Mediterranean', 'Islamabad, F-6',  4.6, 'Inactive',  'Jun 18, 2025'],
        ];
        $colors = ['#FDEDE7','#E7F5EA','#FBF1D9','#EEE9FC','#E9F4FB'];
        $ci = 0;
        foreach($vendors as $v):
          $statusClass = $v[4]==='Active' ? 'badge-good' : ($v[4]==='Inactive' ? 'badge-warn' : 'badge-bad');
          $bg = $colors[$ci % count($colors)];
          $ci++;
          $stars = str_repeat('★', floor($v[3])) . (($v[3]-floor($v[3]))>=0.5?'½':'');
        ?>
                <tr class="vendor-row" data-name="<?php echo strtolower($v[0]); ?>" data-cuisine="<?php echo $v[1]; ?>"
                    data-status="<?php echo $v[4]; ?>">
                    <td style="padding-left:22px;">
                        <div class="cell-user">
                            <div class="vendor-img" style="background:<?php echo $bg; ?>;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 9l1.5-5h15L21 9M3 9v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9M3 9h18"
                                        stroke="#B9AEA8" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round" /></svg>
                            </div>
                            <div>
                                <div class="name"><?php echo $v[0]; ?></div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $v[1]; ?></td>
                    <td style="color:var(--ink-soft); font-size:13px;"><?php echo $v[2]; ?></td>
                    <td>
                        <div class="rating-stars">
                            <span>★</span> <?php echo $v[3]; ?>
                        </div>
                    </td>
                    <td><span class="badge <?php echo $statusClass; ?>"><?php echo $v[4]; ?></span></td>
                    <td style="color:var(--ink-soft); font-size:13px;"><?php echo $v[5]; ?></td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn view" title="View"
                                onclick="openDrawer('<?php echo addslashes($v[0]); ?>', '<?php echo $v[1]; ?>', '<?php echo $v[2]; ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                        stroke-width="1.8" />
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" /></svg>
                            </button>
                            <button class="action-btn edit" title="Edit"
                                onclick="openDrawer('<?php echo addslashes($v[0]); ?>', '<?php echo $v[1]; ?>', '<?php echo $v[2]; ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M18.5 2.5a2.1 2.1 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            </button>
                            <button class="action-btn delete" title="Delete"
                                onclick="confirmDelete('<?php echo addslashes($v[0]); ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path d="M9 6V4h6v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ===================================================================
     TAB 2 — PENDING APPROVALS
     ================================================================= -->
<div id="section-pending" style="display:none;">
    <p style="font-size:13.5px; color:var(--ink-soft); margin-bottom:18px;">
        These vendors are awaiting your review. Approve to make them visible on the platform.
    </p>

    <div class="pending-grid">
        <?php
    $pending = [
      ['Sushi Sora',     'Asian · Sushi',      'Karachi, Zamzama',    '1d ago'],
      ['La Piazza',      'Italian · Pizza',     'Lahore, MM Alam',     '2h ago'],
      ['Meze Garden',    'Mediterranean',       'Islamabad, F-8',      '5h ago'],
      ['Taco Fiesta',    'Mexican · Street',    'Karachi, Clifton',    '8h ago'],
      ['The Curry Leaf', 'Asian · Indian',      'Lahore, Johar Town',  '1d ago'],
      ['Noir Bistro',    'Fine Dining',         'Islamabad, E-7',      '3d ago'],
    ];
    $pcolors = ['#FDEDE7','#E7F5EA','#FBF1D9','#EEE9FC','#E9F4FB','#FDE7E2'];
    foreach($pending as $i => $p):
      $bg = $pcolors[$i % count($pcolors)];
    ?>
        <div class="vendor-card" id="pcard-<?php echo $i; ?>">
            <div class="vendor-card-thumb" style="background:linear-gradient(160deg, <?php echo $bg; ?>, #f0e6df);">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                    <path d="M3 9l1.5-5h15L21 9M3 9v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9M3 9h18M9 21v-6h6v6"
                        stroke="#B9AEA8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </div>
            <div class="vendor-card-body">
                <div class="v-name"><?php echo $p[0]; ?></div>
                <div class="v-meta">
                    <?php echo $p[1]; ?> &nbsp;·&nbsp; <?php echo $p[2]; ?><br>
                    <span style="font-size:11px; color:var(--coral-deep); font-weight:700;">Submitted
                        <?php echo $p[3]; ?></span>
                </div>
                <div class="vendor-card-footer">
                    <button class="btn-approve" onclick="handlePending(<?php echo $i; ?>, 'approve')">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none">
                            <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                                stroke-linejoin="round" /></svg>
                        Approve
                    </button>
                    <button class="btn-reject" onclick="handlePending(<?php echo $i; ?>, 'reject')">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none">
                            <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" /></svg>
                        Reject
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ===================================================================
     DRAWER — ADD / EDIT VENDOR FORM
     ================================================================= -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawerOnBg(event)">
    <div class="drawer" id="drawer">

        <div class="drawer-head">
            <div>
                <div class="drawer-title" id="drawerTitle">Add Vendor</div>
                <div style="font-size:12px; color:var(--ink-soft);" id="drawerSub">Fill in the details below</div>
            </div>
            <button class="drawer-close" onclick="closeDrawer()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
            </button>
        </div>

        <div class="drawer-body">

            <!-- PHOTO UPLOAD -->
            <div class="form-row">
                <label>Photos</label>
                <div class="upload-zone" onclick="document.getElementById('photoInput').click()">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" style="margin:0 auto;">
                        <rect x="3" y="3" width="18" height="18" rx="3" stroke="#B9AEA8" stroke-width="1.6" />
                        <path d="M3 16l4.5-5 3.5 4 3-3 5 6" stroke="#B9AEA8" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="8" cy="8.5" r="1.5" fill="#B9AEA8" /></svg>
                    <p>Drag & drop or <strong>browse</strong> to upload</p>
                    <p style="font-size:11.5px; margin-top:4px;">JPG, PNG, WEBP — max 5MB each</p>
                </div>
                <input type="file" id="photoInput" multiple accept="image/*" style="display:none"
                    onchange="previewPhotos(this)">
                <div class="upload-preview" id="photoPreview"></div>
            </div>

            <!-- BASIC INFO -->
            <div class="form-row">
                <label>Venue Name</label>
                <input type="text" id="f-name" placeholder="e.g. Casa Verde">
            </div>

            <div class="form-2col">
                <div class="form-row">
                    <label>Cuisine Type</label>
                    <select id="f-cuisine">
                        <option value="">Select cuisine</option>
                        <option>Italian</option>
                        <option>Mexican</option>
                        <option>Mediterranean</option>
                        <option>Asian</option>
                        <option>Fine Dining</option>
                        <option>Fast Food</option>
                        <option>Cafe</option>
                        <option>BBQ</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Status</label>
                    <select id="f-status">
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Suspended</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <label>Location / Address</label>
                <input type="text" id="f-location" placeholder="e.g. DHA Phase 5, Karachi">
            </div>

            <div class="form-2col">
                <div class="form-row">
                    <label>City</label>
                    <select id="f-city">
                        <option>Karachi</option>
                        <option>Lahore</option>
                        <option>Islamabad</option>
                        <option>Rawalpindi</option>
                        <option>Faisalabad</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Price Range</label>
                    <select id="f-price">
                        <option>$ Budget</option>
                        <option>$$ Moderate</option>
                        <option>$$$ Upscale</option>
                        <option>$$$$ Fine Dining</option>
                    </select>
                </div>
            </div>

            <!-- HOURS -->
            <div class="form-row">
                <label>Opening Hours</label>
                <div class="hours-grid">
                    <?php
          $days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
          foreach($days as $d):
          ?>
                    <div class="hours-row">
                        <span class="day"><?php echo $d; ?></span>
                        <input type="time" value="09:00" style="padding:8px 10px; font-size:13px;">
                        <input type="time" value="22:00" style="padding:8px 10px; font-size:13px;">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- TAGS -->
            <div class="form-row">
                <label>Mood Tags</label>
                <div style="display:flex; flex-wrap:wrap; gap:8px;" id="tagList">
                    <?php
          $tags = ['Date Night','Family','Casual','Outdoor','Live Music','Rooftop','Pet Friendly','Vegan Options','Late Night','Quick Bite'];
          foreach($tags as $t):
          ?>
                    <button type="button" class="tag-chip" onclick="toggleTag(this)"
                        style="padding:6px 14px; border-radius:999px; border:1.5px solid var(--line); background:var(--paper); font-size:12.5px; font-weight:700; color:var(--ink-soft); cursor:pointer; transition:all .15s;">
                        <?php echo $t; ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="form-row">
                <label>Description</label>
                <textarea id="f-desc"
                    placeholder="Write a short description of the venue (vibe, specialties, what makes it unique)…"></textarea>
            </div>

        </div><!-- /drawer-body -->

        <div class="drawer-footer">
            <button class="btn-outline-ink" onclick="closeDrawer()">Cancel</button>
            <button class="btn-save" onclick="saveVendor()">
                Save Vendor
            </button>
        </div>

    </div>
</div>

<?php
$extraScripts = <<<JS
<script>
// ===== TABS =====
function switchTab(tab, btn){
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('section-list').style.display    = tab === 'list'    ? 'block' : 'none';
  document.getElementById('section-pending').style.display = tab === 'pending' ? 'block' : 'none';
}

// ===== FILTER =====
function filterVendors(){
  const q        = document.getElementById('vendorSearch').value.toLowerCase();
  const cuisine  = document.getElementById('cuisineFilter').value;
  const status   = document.getElementById('statusFilter').value;
  document.querySelectorAll('.vendor-row').forEach(row => {
    const nm = row.dataset.name;
    const cu = row.dataset.cuisine;
    const st = row.dataset.status;
    const show =
      (!q       || nm.includes(q)) &&
      (!cuisine || cu === cuisine) &&
      (!status  || st === status);
    row.style.display = show ? '' : 'none';
  });
}

// ===== DRAWER =====
function openDrawer(name, cuisine, location){
  const overlay = document.getElementById('drawerOverlay');
  overlay.classList.add('open');
  // slight delay so CSS transition fires
  setTimeout(() => document.getElementById('drawer').style.transform = '', 10);
  if(name){
    document.getElementById('drawerTitle').textContent = 'Edit Vendor';
    document.getElementById('drawerSub').textContent   = 'Update vendor details';
    document.getElementById('f-name').value     = name     || '';
    document.getElementById('f-location').value = location || '';
    if(cuisine) document.getElementById('f-cuisine').value = cuisine;
  } else {
    document.getElementById('drawerTitle').textContent = 'Add Vendor';
    document.getElementById('drawerSub').textContent   = 'Fill in the details below';
    document.getElementById('f-name').value     = '';
    document.getElementById('f-location').value = '';
    document.getElementById('f-cuisine').value  = '';
  }
  document.body.style.overflow = 'hidden';
}
function closeDrawer(){
  document.getElementById('drawerOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
function closeDrawerOnBg(e){
  if(e.target === document.getElementById('drawerOverlay')) closeDrawer();
}
function saveVendor(){
  const name = document.getElementById('f-name').value.trim();
  if(!name){ alert('Vendor name is required.'); return; }
  // TODO: POST to your backend here
  alert('Vendor "' + name + '" saved! (Wire this to your backend.)');
  closeDrawer();
}

// ===== PHOTO PREVIEW =====
function previewPhotos(input){
  const preview = document.getElementById('photoPreview');
  Array.from(input.files).forEach(file => {
    const reader = new FileReader();
    reader.onload = e => {
      const div = document.createElement('div');
      div.className = 'upload-thumb';
      div.innerHTML = '<img src="'+e.target.result+'"><span class="rm" onclick="this.parentNode.remove()">✕</span>';
      preview.appendChild(div);
    };
    reader.readAsDataURL(file);
  });
}

// ===== TAG TOGGLE =====
function toggleTag(btn){
  const on = btn.dataset.on === '1';
  btn.dataset.on = on ? '' : '1';
  btn.style.background    = on ? 'var(--paper)'       : 'var(--coral-soft)';
  btn.style.color         = on ? 'var(--ink-soft)'    : 'var(--coral-deep)';
  btn.style.borderColor   = on ? 'var(--line)'        : 'var(--coral)';
}

// ===== PENDING APPROVE / REJECT =====
function handlePending(idx, action){
  const card = document.getElementById('pcard-'+idx);
  const label = action === 'approve' ? 'Approved ✓' : 'Rejected ✕';
  const bg    = action === 'approve' ? 'var(--good-bg)' : 'var(--bad-bg)';
  const col   = action === 'approve' ? 'var(--good)'    : 'var(--bad)';
  card.style.transition   = 'opacity .3s ease, transform .3s ease';
  card.style.opacity      = '0';
  card.style.transform    = 'scale(0.96)';
  setTimeout(() => card.remove(), 300);
}

// ===== DELETE CONFIRM =====
function confirmDelete(name){
  if(confirm('Are you sure you want to delete "'+name+'"? This cannot be undone.')){
    alert('"'+name+'" deleted. (Wire this to your backend.)');
  }
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>