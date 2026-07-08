<?php
$pageTitle  = 'Games';
$activePage = 'games';
include __DIR__ . '/includes/header.php';
?>

<style>
    /* ===== TABS ===== */
    .tab-bar {
        display: flex;
        gap: 4px;
        margin-bottom: 22px;
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 5px;
        width: fit-content;
        box-shadow: var(--shadow-card);
    }

    .tab-btn {
        padding: 9px 20px;
        border-radius: 9px;
        border: none;
        background: transparent;
        font-size: 13.5px;
        font-weight: 700;
        font-family: inherit;
        color: var(--ink-soft);
        cursor: pointer;
        transition: background .15s, color .15s;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .tab-btn .tab-count {
        font-size: 11px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 999px;
        background: var(--paper);
        color: var(--ink-soft);
        transition: background .15s, color .15s;
    }

    .tab-btn.active {
        background: var(--coral);
        color: #fff;
    }

    .tab-btn.active .tab-count {
        background: rgba(255, 255, 255, .25);
        color: #fff;
    }

    /* ===== STATS STRIP ===== */
    .game-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .gstat {
        background: var(--white);
        border-radius: var(--radius-md);
        border: 1px solid var(--line);
        padding: 16px 18px;
        box-shadow: var(--shadow-card);
    }

    .gstat-val {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 24px;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 5px;
    }

    .gstat-label {
        font-size: 12px;
        color: var(--ink-soft);
        font-weight: 600;
    }

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

    .btn-add {
        margin-left: auto;
        padding: 10px 18px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(160deg, #FF7A52, var(--coral-deep));
        color: #fff;
        font-size: 13.5px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 7px;
        box-shadow: 0 6px 16px -6px rgba(232, 67, 31, 0.45);
        white-space: nowrap;
        transition: opacity .15s;
    }

    .btn-add:hover {
        opacity: .88;
    }

    /* ===== ACTION BUTTONS ===== */
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

    .action-btn.edit:hover {
        background: #FDEDE7;
        color: var(--coral-deep);
        border-color: var(--coral);
    }

    .action-btn.delete:hover {
        background: var(--bad-bg);
        color: var(--bad);
        border-color: var(--bad);
    }

    /* ===== GAME TYPE PILL ===== */
    .game-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 11px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .game-pill.quickpick {
        background: #FDEDE7;
        color: #E8431F;
    }

    .game-pill.streetwalk {
        background: #E7F5EA;
        color: #2C8A4B;
    }

    .game-pill.barroulette {
        background: #EEE9FC;
        color: #5B3FBB;
    }

    /* ===== VENUE CELL ===== */
    .venue-cell {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .venue-dot {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    /* ===== POINTS BADGE ===== */
    .pts-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        background: #FBF1D9;
        color: #7A5300;
        border: 1px solid #E8C46A;
    }

    /* ===== CHALLENGE DIFFICULTY ===== */
    .diff-badge {
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 800;
    }

    .diff-easy {
        background: #E7F5EA;
        color: #2C8A4B;
        border: 1px solid #B9DEC2;
    }

    .diff-medium {
        background: #FBF1D9;
        color: #7A5300;
        border: 1px solid #E8C46A;
    }

    .diff-hard {
        background: #FDEDE7;
        color: #E8431F;
        border: 1px solid #F6C7B6;
    }

    /* ===== PROGRESS BAR ===== */
    .prog-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .prog-bar {
        flex: 1;
        height: 6px;
        border-radius: 999px;
        background: var(--line);
        overflow: hidden;
    }

    .prog-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #FF7A52, var(--coral-deep));
    }

    .prog-pct {
        font-size: 12px;
        font-weight: 800;
        color: var(--ink-soft);
        flex-shrink: 0;
    }

    /* ===== DRAWER ===== */
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

    .session-hero {
        padding: 24px;
        background: linear-gradient(160deg, #FFF5F0 0%, #FFD0B8 100%);
        border-bottom: 1px solid var(--line);
    }

    .session-hero-type {
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--coral-deep);
        margin-bottom: 6px;
    }

    .session-hero-venue {
        font-family: 'Fraunces', serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 4px;
    }

    .session-hero-loc {
        font-size: 13px;
        color: var(--ink-soft);
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

    .drawer-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--line);
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-danger {
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
    }

    /* ===== CHALLENGE MODAL ===== */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(36, 23, 18, 0.45);
        z-index: 60;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-overlay.open {
        display: flex;
    }

    .modal {
        background: var(--white);
        border-radius: 16px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 24px 64px rgba(36, 23, 18, 0.22);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform: scale(.96);
        opacity: 0;
        transition: transform .22s cubic-bezier(.22, .72, 0, 1), opacity .18s;
    }

    .modal-overlay.open .modal {
        transform: scale(1);
        opacity: 1;
    }

    .modal-head {
        padding: 22px 24px 18px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 700;
        font-family: 'Fraunces', serif;
    }

    .modal-close {
        margin-left: auto;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--ink-soft);
    }

    .modal-close:hover {
        background: var(--paper);
    }

    .modal-body {
        padding: 22px 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-label {
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--ink-soft);
    }

    .form-input {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        background: var(--white);
        font-size: 14px;
        font-family: inherit;
        color: var(--ink);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    .form-input:focus {
        border-color: var(--coral);
        box-shadow: 0 0 0 4px rgba(255, 90, 60, 0.10);
    }

    textarea.form-input {
        resize: vertical;
        min-height: 80px;
        line-height: 1.55;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .pts-input-wrap {
        position: relative;
    }

    .pts-input-wrap .pts-suffix {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        font-weight: 700;
        color: var(--ink-soft);
        pointer-events: none;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--line);
        display: flex;
        gap: 10px;
    }

    .btn-cancel {
        flex: 1;
        padding: 11px;
        border-radius: 10px;
        border: 1.5px solid var(--line);
        background: var(--white);
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        color: var(--ink-soft);
        cursor: pointer;
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
        box-shadow: 0 6px 16px -6px rgba(232, 67, 31, 0.45);
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

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    @media(max-width:900px) {
        .game-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:560px) {
        .game-stats {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- PAGE HEADER -->
<div class="page-head">
    <div>
        <p class="page-eyebrow">Management</p>
        <h1 class="page-title">Games</h1>
        <p class="page-sub">Monitor Quick Pick spins, Street Walk & Bar Roulette sessions, and manage challenges.</p>
    </div>
</div>

<!-- STATS STRIP -->
<div class="game-stats">
    <div class="gstat">
        <div class="gstat-val">28,410</div>
        <div class="gstat-label">Total Spins</div>
    </div>
    <div class="gstat">
        <div class="gstat-val" style="color:var(--coral-deep);">3,812</div>
        <div class="gstat-label">Sessions Today</div>
    </div>
    <div class="gstat">
        <div class="gstat-val" style="color:#2C8A4B;">14</div>
        <div class="gstat-label">Active Challenges</div>
    </div>
    <div class="gstat">
        <div class="gstat-val" style="color:#C9890B;">1.2M</div>
        <div class="gstat-label">Points Awarded</div>
    </div>
</div>

<!-- TABS -->
<div class="tab-bar">
    <button class="tab-btn active" onclick="switchTab('quickpick', this)">
        🎲 Quick Pick <span class="tab-count">28K</span>
    </button>
    <button class="tab-btn" onclick="switchTab('sessions', this)">
        🚶 Sessions <span class="tab-count">9.4K</span>
    </button>
    <button class="tab-btn" onclick="switchTab('challenges', this)">
        🏆 Challenges <span class="tab-count">14</span>
    </button>
</div>

<!-- ================================================================
     TAB 1: QUICK PICK LOGS
     ================================================================ -->
<div class="tab-panel active" id="panel-quickpick">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" placeholder="Search by venue or user…" oninput="filterTable('qpBody', this.value)">
        </div>
        <input type="date" class="toolbar-select" id="qpDate" onchange="filterTable('qpBody','')">
        <select class="toolbar-select" onchange="filterTable('qpBody','')">
            <option>All Cities</option>
            <option>Karachi</option>
            <option>Lahore</option>
            <option>Islamabad</option>
        </select>
        <select class="toolbar-select">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
        </select>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Venue</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>City</th>
                    <th>Checked In</th>
                    <th>Date & Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="qpBody">
                <?php
$qpIcons = ['🍕','🍣','🌮','🍔','🥗','☕','🍜','🥩','🍦','🍛','🌱','🍷'];
$qpBgs   = ['#FDEDE7','#E7F5EA','#EEE9FC','#FBF1D9','#E9F4FB','#FCE8F3','#FDE7E2','#E7F5EA','#EEE9FC','#FDEDE7','#E9F4FB','#FBF1D9'];
$qpTypes = ['Quick Pick','Bar Roulette','Quick Pick','Quick Pick','Bar Roulette','Quick Pick','Quick Pick','Bar Roulette','Quick Pick','Quick Pick','Bar Roulette','Quick Pick'];

$qpLogs = [
    ['Casa Verde',      'Sara Malik',     'Karachi',   true,  'Jun 28, 2025 · 8:14 PM'],
    ['Nobu Karachi',    'Ali Khan',       'Karachi',   false, 'Jun 28, 2025 · 7:50 PM'],
    ['Taco Fiesta',     'Rida Hassan',    'Islamabad', true,  'Jun 28, 2025 · 7:22 PM'],
    ['Burger Lab',      'Hamza Siddiqui', 'Karachi',   true,  'Jun 28, 2025 · 6:55 PM'],
    ['The Green Bowl',  'Nadia Jamil',    'Lahore',    true,  'Jun 28, 2025 · 6:30 PM'],
    ['Café Flo',        'Bilal Ahmed',    'Karachi',   false, 'Jun 28, 2025 · 5:47 PM'],
    ['Ramen House',     'Zara Qureshi',   'Lahore',    true,  'Jun 28, 2025 · 5:12 PM'],
    ['Velvet Lounge',   'Usman Tariq',    'Karachi',   false, 'Jun 28, 2025 · 4:40 PM'],
    ['Ice Lab',         'Hina Baig',      'Islamabad', true,  'Jun 28, 2025 · 3:58 PM'],
    ['Spice Route',     'Kamran Iqbal',   'Lahore',    true,  'Jun 28, 2025 · 3:15 PM'],
    ['Chops & Grills',  'Ayesha Raza',    'Karachi',   false, 'Jun 28, 2025 · 2:30 PM'],
    ['The Tapas Bar',   'Omar Farooq',    'Karachi',   true,  'Jun 28, 2025 · 1:48 PM'],
];

foreach($qpLogs as $i => $log):
    $ic = $qpIcons[$i % count($qpIcons)];
    $bg = $qpBgs[$i   % count($qpBgs)];
    $type = $qpTypes[$i];
    $typeClass = $type === 'Quick Pick' ? 'quickpick' : 'barroulette';
?>
                <tr data-search="<?php echo strtolower($log[0].' '.$log[1]); ?>">
                    <td style="padding-left:22px;">
                        <div class="venue-cell">
                            <div class="venue-dot" style="background:<?php echo $bg; ?>"><?php echo $ic; ?></div>
                            <div>
                                <div style="font-weight:700; font-size:14px;"><?php echo $log[0]; ?></div>
                                <div style="font-size:11.5px; color:var(--ink-soft);">
                                    #LOG-<?php echo str_pad($i+1,5,'0',STR_PAD_LEFT); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:13.5px; font-weight:700; color:var(--ink);"><?php echo $log[1]; ?></td>
                    <td><span class="game-pill <?php echo $typeClass; ?>"><?php echo $type==='Quick Pick'?'🎲':'🎰'; ?>
                            <?php echo $type; ?></span></td>
                    <td style="font-size:13px; color:var(--ink-soft);"><?php echo $log[2]; ?></td>
                    <td>
                        <span class="badge <?php echo $log[3]?'badge-good':'badge-warn'; ?>">
                            <?php echo $log[3]?'✓ Yes':'— No'; ?>
                        </span>
                    </td>
                    <td style="font-size:12.5px; color:var(--ink-soft); white-space:nowrap;"><?php echo $log[4]; ?></td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn view" title="View session"
                                onclick="openSession(<?php echo $i; ?>, '<?php echo addslashes($log[0]); ?>', '<?php echo addslashes($log[1]); ?>', '<?php echo $type; ?>', '<?php echo $log[2]; ?>', <?php echo $log[3]?'true':'false'; ?>, '<?php echo $log[4]; ?>', '<?php echo $ic; ?>', '<?php echo $bg; ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                        stroke-width="1.8" />
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                                </svg>
                            </button>
                            <button class="action-btn delete" title="Delete log"
                                onclick="confirmDeleteLog('<?php echo addslashes($log[0]); ?>', '<?php echo addslashes($log[1]); ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <span>Showing <strong>1–12</strong> of <strong>28,410</strong> logs</span>
            <div class="page-btns">
                <button class="page-btn">‹</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">…</button>
                <button class="page-btn">2368</button>
                <button class="page-btn">›</button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     TAB 2: STREET WALK / BAR ROULETTE SESSIONS
     ================================================================ -->
<div class="tab-panel" id="panel-sessions">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" placeholder="Search by area or user…" oninput="filterTable('sessBody', this.value)">
        </div>
        <select class="toolbar-select">
            <option>All Types</option>
            <option>Street Walk</option>
            <option>Bar Roulette</option>
        </select>
        <select class="toolbar-select">
            <option>All Cities</option>
            <option>Karachi</option>
            <option>Lahore</option>
            <option>Islamabad</option>
        </select>
        <select class="toolbar-select">
            <option>Newest First</option>
            <option>Oldest First</option>
            <option>Duration: Long → Short</option>
        </select>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Session</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>Area</th>
                    <th>Stops</th>
                    <th>Duration</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sessBody">
                <?php
$sessions = [
    ['Street Walk',   'Sara Malik',     'DHA, Karachi',       4, '42 min', 'Jun 27, 2025'],
    ['Bar Roulette',  'Ali Khan',       'Clifton, Karachi',   3, '1h 18m', 'Jun 27, 2025'],
    ['Street Walk',   'Hamza Siddiqui', 'MM Alam, Lahore',    6, '1h 05m', 'Jun 26, 2025'],
    ['Street Walk',   'Zara Qureshi',   'F-7, Islamabad',     3, '28 min', 'Jun 26, 2025'],
    ['Bar Roulette',  'Bilal Ahmed',    'Zamzama, Karachi',   5, '2h 10m', 'Jun 25, 2025'],
    ['Street Walk',   'Nadia Jamil',    'Gulberg, Lahore',    4, '55 min', 'Jun 25, 2025'],
    ['Bar Roulette',  'Kamran Iqbal',   'PECHS, Karachi',     3, '1h 32m', 'Jun 24, 2025'],
    ['Street Walk',   'Rida Hassan',    'F-6, Islamabad',     5, '1h 14m', 'Jun 24, 2025'],
    ['Bar Roulette',  'Hina Baig',      'DHA, Karachi',       4, '1h 48m', 'Jun 23, 2025'],
    ['Street Walk',   'Ayesha Raza',    'Liberty, Lahore',    3, '35 min', 'Jun 23, 2025'],
    ['Bar Roulette',  'Usman Tariq',    'Clifton, Karachi',   6, '2h 45m', 'Jun 22, 2025'],
    ['Street Walk',   'Omar Farooq',    'Bahria, Karachi',    2, '18 min', 'Jun 22, 2025'],
];
foreach($sessions as $i => $s):
    $isWalk = $s[0]==='Street Walk';
    $typeClass = $isWalk ? 'streetwalk' : 'barroulette';
    $typeEmoji = $isWalk ? '🚶' : '🎰';
?>
                <tr data-search="<?php echo strtolower($s[1].' '.$s[3]); ?>">
                    <td style="padding-left:22px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div
                                style="width:36px;height:36px;border-radius:10px;background:<?php echo $isWalk?'#E7F5EA':'#EEE9FC';?>;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;">
                                <?php echo $typeEmoji;?></div>
                            <div>
                                <div style="font-weight:700;font-size:14px;"><?php echo $s[0];?></div>
                                <div style="font-size:11.5px;color:var(--ink-soft);">
                                    #SES-<?php echo str_pad($i+1,5,'0',STR_PAD_LEFT);?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:13.5px;font-weight:700;color:var(--ink);"><?php echo $s[1];?></td>
                    <td><span class="game-pill <?php echo $typeClass;?>"><?php echo $typeEmoji.' '.$s[0];?></span></td>
                    <td style="font-size:13px;color:var(--ink-soft);"><?php echo $s[3];?></td>
                    <td style="font-weight:700;"><?php echo $s[4];?> stops</td>
                    <td style="font-weight:700;color:var(--coral-deep);"><?php echo $s[5];?></td>
                    <td style="font-size:12.5px;color:var(--ink-soft);white-space:nowrap;"><?php echo $s[6];?></td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn view" title="View session"
                                onclick="openSession(<?php echo $i+100;?>, '<?php echo addslashes($s[0]);?>', '<?php echo addslashes($s[1]);?>', '<?php echo $s[0];?>', '<?php echo addslashes($s[3]);?>', true, '<?php echo $s[6];?>', '<?php echo $typeEmoji;?>', '<?php echo $isWalk?'#E7F5EA':'#EEE9FC';?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                        stroke-width="1.8" />
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                                </svg>
                            </button>
                            <button class="action-btn delete" title="Delete session"
                                onclick="confirmDeleteLog('<?php echo addslashes($s[0]);?>', '<?php echo addslashes($s[1]);?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="pagination">
            <span>Showing <strong>1–12</strong> of <strong>9,412</strong> sessions</span>
            <div class="page-btns">
                <button class="page-btn">‹</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">…</button>
                <button class="page-btn">785</button>
                <button class="page-btn">›</button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     TAB 3: CHALLENGES
     ================================================================ -->
<div class="tab-panel" id="panel-challenges">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" placeholder="Search challenges…" oninput="filterTable('challBody', this.value)">
        </div>
        <select class="toolbar-select">
            <option>All Difficulties</option>
            <option>Easy</option>
            <option>Medium</option>
            <option>Hard</option>
        </select>
        <select class="toolbar-select">
            <option>All Statuses</option>
            <option>Active</option>
            <option>Ended</option>
            <option>Draft</option>
        </select>
        <button class="btn-add" onclick="openChallengeModal()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            New Challenge
        </button>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Challenge</th>
                    <th>Points</th>
                    <th>Difficulty</th>
                    <th>Completions</th>
                    <th>Progress</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="challBody">
                <?php
$challenges = [
    ['Try 3 New Cuisines',        150, 'Easy',   2841, 'Jul 31, 2025', 'Active'],
    ['Visit 5 Venues in a Week',  300, 'Medium',  621, 'Jul 15, 2025', 'Active'],
    ['Complete a Street Walk',    100, 'Easy',   1204, 'Aug 1, 2025',  'Active'],
    ['Leave 10 Reviews',          500, 'Hard',    187, 'Jun 30, 2025', 'Active'],
    ['Bar Roulette 3 Sessions',   200, 'Medium',  402, 'Jul 20, 2025', 'Active'],
    ['Check-in 7 Days Straight',  400, 'Hard',     98, 'Jul 10, 2025', 'Active'],
    ['Try Vegan Once',             75, 'Easy',    934, 'Aug 15, 2025', 'Active'],
    ['Explore New Neighbourhood', 250, 'Medium',  311, 'Jul 25, 2025', 'Active'],
    ['Midnight Quick Pick',       350, 'Hard',    142, 'Jul 5, 2025',  'Active'],
    ['Rate All Cuisine Types',    600, 'Hard',     44, 'Aug 31, 2025', 'Draft' ],
    ['Weekend Brunch Streak',     200, 'Medium',  708, 'May 31, 2025', 'Ended' ],
    ['Hidden Gem Hunter',         450, 'Hard',     89, 'Jun 15, 2025', 'Ended' ],
];
$maxComp = max(array_column($challenges, 2));
foreach($challenges as $i => $ch):
    $diffClass = ['Easy'=>'diff-easy','Medium'=>'diff-medium','Hard'=>'diff-hard'][$ch[2]];
    $statClass = $ch[5]==='Active'?'badge-good':($ch[5]==='Draft'?'badge-warn':'badge-bad');
    $pct = round($ch[3] / $maxComp * 100);
?>
                <tr data-search="<?php echo strtolower($ch[0]);?>">
                    <td style="padding-left:22px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div
                                style="width:36px;height:36px;border-radius:10px;background:#FBF1D9;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;">
                                🏆</div>
                            <div>
                                <div style="font-weight:700;font-size:14px;"><?php echo $ch[0];?></div>
                                <div style="font-size:11.5px;color:var(--ink-soft);">
                                    #CHG-<?php echo str_pad($i+1,3,'0',STR_PAD_LEFT);?></div>
                            </div>
                        </div>
                    </td>
                    <td><span class="pts-badge">⭐ <?php echo number_format($ch[1]);?> pts</span></td>
                    <td><span class="diff-badge <?php echo $diffClass;?>"><?php echo $ch[2];?></span></td>
                    <td style="font-weight:700;"><?php echo number_format($ch[3]);?></td>
                    <td style="min-width:120px;">
                        <div class="prog-wrap">
                            <div class="prog-bar">
                                <div class="prog-fill" style="width:<?php echo $pct;?>%;"></div>
                            </div>
                            <span class="prog-pct"><?php echo $pct;?>%</span>
                        </div>
                    </td>
                    <td style="font-size:12.5px;color:var(--ink-soft);white-space:nowrap;"><?php echo $ch[4];?></td>
                    <td><span class="badge <?php echo $statClass;?>"><?php echo $ch[5];?></span></td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn edit" title="Edit challenge"
                                onclick="openChallengeModal('<?php echo addslashes($ch[0]);?>', <?php echo $ch[1];?>, '<?php echo $ch[2];?>', '<?php echo $ch[4];?>', '<?php echo $ch[5];?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </button>
                            <button class="action-btn delete" title="Delete challenge"
                                onclick="confirmDeleteLog('<?php echo addslashes($ch[0]);?>', 'challenge')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="pagination">
            <span>Showing <strong>1–12</strong> of <strong>14</strong> challenges</span>
            <div class="page-btns">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">›</button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     SESSION DETAIL DRAWER
     ================================================================ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawerOnBg(event)">
    <div class="drawer" id="drawer">
        <div class="drawer-head">
            <div>
                <div class="drawer-title">Session Detail</div>
                <div style="font-size:12px;color:var(--ink-soft);">Full log & metadata</div>
            </div>
            <button class="drawer-close" onclick="closeDrawer()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
        <div class="drawer-body">
            <div class="session-hero">
                <div class="session-hero-type" id="d-type">Quick Pick</div>
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                    <div style="width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;"
                        id="d-icon"></div>
                    <div>
                        <div class="session-hero-venue" id="d-venue"></div>
                        <div class="session-hero-loc" id="d-loc"></div>
                    </div>
                </div>
            </div>
            <div class="detail-section">
                <div class="detail-section-title">Session Info</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">User</div>
                        <div class="info-val" id="d-user">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Game Type</div>
                        <div class="info-val" id="d-gtype">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Checked In</div>
                        <div class="info-val" id="d-checkin">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Date & Time</div>
                        <div class="info-val" id="d-datetime">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Session ID</div>
                        <div class="info-val" id="d-id">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Platform</div>
                        <div class="info-val">iOS App</div>
                    </div>
                </div>
            </div>
            <div class="detail-section">
                <div class="detail-section-title">Points Awarded</div>
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <div
                        style="flex:1;min-width:120px;background:var(--paper);border-radius:12px;padding:14px 16px;border:1px solid var(--line);">
                        <div style="font-size:11.5px;font-weight:700;color:var(--ink-faint);margin-bottom:4px;">Spin
                            Points</div>
                        <div
                            style="font-family:'Fraunces',serif;font-size:22px;font-weight:700;color:var(--coral-deep);">
                            +10</div>
                    </div>
                    <div
                        style="flex:1;min-width:120px;background:var(--paper);border-radius:12px;padding:14px 16px;border:1px solid var(--line);">
                        <div style="font-size:11.5px;font-weight:700;color:var(--ink-faint);margin-bottom:4px;">Check-in
                            Bonus</div>
                        <div style="font-family:'Fraunces',serif;font-size:22px;font-weight:700;color:#2C8A4B;"
                            id="d-checkin-pts">+25</div>
                    </div>
                    <div
                        style="flex:1;min-width:120px;background:var(--paper);border-radius:12px;padding:14px 16px;border:1px solid var(--line);">
                        <div style="font-size:11.5px;font-weight:700;color:var(--ink-faint);margin-bottom:4px;">Total
                        </div>
                        <div style="font-family:'Fraunces',serif;font-size:22px;font-weight:700;color:var(--ink);"
                            id="d-pts-total">+35</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="drawer-footer">
            <button class="btn-danger" onclick="drawerDelete()">🗑 Delete Log</button>
        </div>
    </div>
</div>

<!-- ================================================================
     CHALLENGE MODAL
     ================================================================ -->
<div class="modal-overlay" id="chalModalOverlay" onclick="closeChalModalOnBg(event)">
    <div class="modal" id="chalModal">
        <div class="modal-head">
            <div class="modal-title" id="cm-title">New Challenge</div>
            <button class="modal-close" onclick="closeChallengeModal()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Challenge Title</label>
                <input class="form-input" id="cm-name" type="text" placeholder="e.g. Try 3 New Cuisines">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" id="cm-desc"
                    placeholder="Describe what users need to do to complete this challenge…"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Points Value</label>
                    <div class="pts-input-wrap">
                        <input class="form-input" id="cm-pts" type="number" min="10" max="1000" step="10"
                            placeholder="150" style="padding-right:40px;">
                        <span class="pts-suffix">pts</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Difficulty</label>
                    <select class="form-input" id="cm-diff">
                        <option>Easy</option>
                        <option>Medium</option>
                        <option>Hard</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Deadline</label>
                    <input class="form-input" id="cm-deadline" type="date">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-input" id="cm-status">
                        <option>Active</option>
                        <option>Draft</option>
                        <option>Ended</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeChallengeModal()">Cancel</button>
            <button class="btn-save" onclick="saveChallenge()">Save Challenge</button>
        </div>
    </div>
</div>

<?php
$extraScripts = <<<'JS'
<script>
/* ===== TABS ===== */
function switchTab(name, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    btn.classList.add('active');
}

/* ===== SEARCH FILTER ===== */
function filterTable(bodyId, q) {
    q = q.toLowerCase();
    document.querySelectorAll('#' + bodyId + ' tr').forEach(row => {
        row.style.display = (!q || row.dataset.search.includes(q)) ? '' : 'none';
    });
}

/* ===== SESSION DRAWER ===== */
function openSession(idx, venue, user, type, loc, checkedIn, datetime, icon, bg) {
    document.getElementById('d-type').textContent     = type;
    document.getElementById('d-icon').textContent     = icon;
    document.getElementById('d-icon').style.background = bg;
    document.getElementById('d-venue').textContent    = venue;
    document.getElementById('d-loc').textContent      = loc;
    document.getElementById('d-user').textContent     = user;
    document.getElementById('d-gtype').textContent    = type;
    document.getElementById('d-checkin').textContent  = checkedIn ? '✓ Yes' : '— No';
    document.getElementById('d-datetime').textContent = datetime;
    document.getElementById('d-id').textContent       = '#SES-' + String(idx + 1).padStart(5, '0');

    const bonus = checkedIn ? 25 : 0;
    document.getElementById('d-checkin-pts').textContent = checkedIn ? '+25' : '+0';
    document.getElementById('d-pts-total').textContent   = '+' + (10 + bonus);

    document.getElementById('drawerOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeDrawer() {
    document.getElementById('drawerOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function closeDrawerOnBg(e) {
    if (e.target === document.getElementById('drawerOverlay')) closeDrawer();
}

function drawerDelete() {
    if (confirm('Delete this session log? This cannot be undone.')) {
        closeDrawer();
        alert('Session deleted. (Wire to your backend.)');
    }
}

/* ===== CHALLENGE MODAL ===== */
function openChallengeModal(name, pts, diff, deadline, status) {
    const isEdit = !!name;
    document.getElementById('cm-title').textContent  = isEdit ? 'Edit Challenge' : 'New Challenge';
    document.getElementById('cm-name').value         = name     || '';
    document.getElementById('cm-pts').value          = pts      || '';
    document.getElementById('cm-diff').value         = diff     || 'Easy';
    document.getElementById('cm-status').value       = status   || 'Active';
    document.getElementById('cm-desc').value         = '';
    document.getElementById('cm-deadline').value     = '';
    document.getElementById('chalModalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('cm-name').focus(), 200);
}

function closeChallengeModal() {
    document.getElementById('chalModalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function closeChalModalOnBg(e) {
    if (e.target === document.getElementById('chalModalOverlay')) closeChallengeModal();
}

function saveChallenge() {
    const name = document.getElementById('cm-name').value.trim();
    const pts  = document.getElementById('cm-pts').value;
    if (!name)  { alert('Please enter a challenge title.'); return; }
    if (!pts)   { alert('Please enter a points value.'); return; }
    // TODO: POST to backend
    closeChallengeModal();
}

/* ===== DELETE ===== */
function confirmDeleteLog(name, user) {
    if (confirm('Delete "' + name + '"? This cannot be undone.')) {
        alert('"' + name + '" deleted. (Wire to your backend.)');
    }
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>