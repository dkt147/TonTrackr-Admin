<?php
$pageTitle  = 'Content & Tags';
$activePage = 'content';
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
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    /* ===== STATS STRIP ===== */
    .content-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .cstat {
        background: var(--white);
        border-radius: var(--radius-md);
        border: 1px solid var(--line);
        padding: 16px 18px;
        box-shadow: var(--shadow-card);
    }

    .cstat-val {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 24px;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 5px;
    }

    .cstat-label {
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

    /* ===== TAG ICON CELL ===== */
    .tag-icon-cell {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .tag-color-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 7px;
        flex-shrink: 0;
    }

    /* ===== PREVIEW CHIP ===== */
    .preview-chip {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
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

    /* ===== MODAL ===== */
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
        max-width: 460px;
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
        gap: 12px;
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* color picker row */
    .color-picker-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .color-swatch {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: 2.5px solid transparent;
        cursor: pointer;
        transition: transform .12s, border-color .12s;
    }

    .color-swatch:hover {
        transform: scale(1.12);
    }

    .color-swatch.selected {
        border-color: var(--ink);
        transform: scale(1.12);
    }

    /* emoji picker */
    .emoji-picker-row {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .emoji-opt {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        border: 1.5px solid var(--line);
        background: var(--paper);
        font-size: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background .12s, border-color .12s;
    }

    .emoji-opt:hover {
        background: var(--coral-soft);
        border-color: var(--coral);
    }

    .emoji-opt.selected {
        background: var(--coral-soft);
        border-color: var(--coral);
    }

    /* preview band */
    .modal-preview {
        padding: 14px 24px;
        background: var(--paper);
        border-top: 1px solid var(--line);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12.5px;
        font-weight: 700;
        color: var(--ink-soft);
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

    /* tab panels */
    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
    }

    @media(max-width:900px) {
        .content-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:560px) {
        .content-stats {
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
        <h1 class="page-title">Content & Tags</h1>
        <p class="page-sub">Manage cuisine categories, mood tags and dietary labels used across the app.</p>
    </div>
</div>

<!-- STATS STRIP -->
<div class="content-stats">
    <div class="cstat">
        <div class="cstat-val">24</div>
        <div class="cstat-label">Cuisine Categories</div>
    </div>
    <div class="cstat">
        <div class="cstat-val">18</div>
        <div class="cstat-label">Mood Tags</div>
    </div>
    <div class="cstat">
        <div class="cstat-val" style="color:var(--coral-deep);">9</div>
        <div class="cstat-label">Dietary Labels</div>
    </div>
    <div class="cstat">
        <div class="cstat-val" style="color:var(--good);">51</div>
        <div class="cstat-label">Total Tags</div>
    </div>
</div>

<!-- TABS -->
<div class="tab-bar">
    <button class="tab-btn active" onclick="switchTab('cuisines', this)">
        🍽 Cuisines <span class="tab-count">24</span>
    </button>
    <button class="tab-btn" onclick="switchTab('moods', this)">
        ✨ Mood Tags <span class="tab-count">18</span>
    </button>
    <button class="tab-btn" onclick="switchTab('dietary', this)">
        🥗 Dietary <span class="tab-count">9</span>
    </button>
</div>

<!-- ================================================================
     TAB: CUISINES
     ================================================================ -->
<div class="tab-panel active" id="panel-cuisines">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" placeholder="Search cuisines…" oninput="filterTable('cuisineBody', this.value)">
        </div>
        <select class="toolbar-select">
            <option>All Statuses</option>
            <option>Active</option>
            <option>Hidden</option>
        </select>
        <button class="btn-add" onclick="openModal('cuisine')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            Add Cuisine
        </button>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Cuisine</th>
                    <th>Emoji</th>
                    <th>Colour</th>
                    <th>Preview</th>
                    <th>Venues Tagged</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="cuisineBody">
                <?php
$cuisines = [
    ['Italian',       '🍕', '#E8431F', '#FDEDE7', 'Active',  142],
    ['Asian',         '🥢', '#2C8A4B', '#E7F5EA', 'Active',  98 ],
    ['Mediterranean', '🫒', '#1A7FB5', '#E9F4FB', 'Active',  76 ],
    ['Mexican',       '🌮', '#C9890B', '#FBF1D9', 'Active',  54 ],
    ['Pakistani',     '🍛', '#A0306F', '#FCE8F3', 'Active',  211],
    ['Continental',   '🥩', '#5B3FBB', '#EEE9FC', 'Active',  88 ],
    ['Japanese',      '🍣', '#D43B25', '#FDE7E2', 'Active',  47 ],
    ['Chinese',       '🥡', '#2C8A4B', '#E7F5EA', 'Active',  63 ],
    ['Fast Food',     '🍔', '#C9890B', '#FBF1D9', 'Active',  179],
    ['Desserts',      '🍦', '#A0306F', '#FCE8F3', 'Active',  92 ],
    ['Seafood',       '🦞', '#1A7FB5', '#E9F4FB', 'Hidden',  38 ],
    ['Vegan',         '🌱', '#2C8A4B', '#E7F5EA', 'Active',  29 ],
];
foreach($cuisines as $i => $c): ?>
                <tr data-search="<?php echo strtolower($c[0]); ?>">
                    <td style="padding-left:22px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="tag-icon-cell" style="background:<?php echo $c[3]; ?>;">
                                <?php echo $c[1]; ?>
                            </div>
                            <div>
                                <div style="font-weight:700; font-size:14px;"><?php echo $c[0]; ?></div>
                                <div style="font-size:11.5px; color:var(--ink-soft);">
                                    #CUI-<?php echo str_pad($i+1,3,'0',STR_PAD_LEFT); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:20px;"><?php echo $c[1]; ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span class="tag-color-dot"
                                style="background:<?php echo $c[2]; ?>; width:16px; height:16px; border-radius:4px; display:inline-block;"></span>
                            <span
                                style="font-size:12.5px; font-weight:700; color:var(--ink-soft); font-family:monospace;"><?php echo $c[2]; ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="preview-chip"
                            style="background:<?php echo $c[3]; ?>; color:<?php echo $c[2]; ?>; border:1px solid <?php echo $c[2]; ?>22;">
                            <?php echo $c[1]; ?> <?php echo $c[0]; ?>
                        </span>
                    </td>
                    <td style="font-weight:700;"><?php echo $c[5]; ?></td>
                    <td>
                        <span class="badge <?php echo $c[4]==='Active'?'badge-good':'badge-warn'; ?>">
                            <?php echo $c[4]; ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn edit" title="Edit"
                                onclick="openModal('cuisine', '<?php echo addslashes($c[0]); ?>', '<?php echo $c[1]; ?>', '<?php echo $c[2]; ?>', '<?php echo $c[3]; ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </button>
                            <button class="action-btn delete" title="Delete"
                                onclick="confirmDelete('<?php echo addslashes($c[0]); ?>', 'cuisine')">
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
            <span>Showing <strong>1–12</strong> of <strong>24</strong> cuisines</span>
            <div class="page-btns">
                <button class="page-btn">‹</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">›</button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     TAB: MOOD TAGS
     ================================================================ -->
<div class="tab-panel" id="panel-moods">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" placeholder="Search mood tags…" oninput="filterTable('moodBody', this.value)">
        </div>
        <button class="btn-add" onclick="openModal('mood')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            Add Mood Tag
        </button>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Mood Tag</th>
                    <th>Emoji</th>
                    <th>Colour</th>
                    <th>Preview</th>
                    <th>Usage Count</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="moodBody">
                <?php
$moods = [
    ['Date Night',   '💑', '#A0306F', '#FCE8F3', 'Active', 834],
    ['Casual',       '😎', '#5B3FBB', '#EEE9FC', 'Active', 621],
    ['Outdoor',      '🌿', '#2C8A4B', '#E7F5EA', 'Active', 412],
    ['Late Night',   '🌙', '#1A7FB5', '#E9F4FB', 'Active', 389],
    ['Family',       '👨‍👩‍👧', '#C9890B', '#FBF1D9', 'Active', 554],
    ['Quick Bite',   '⚡', '#E8431F', '#FDEDE7', 'Active', 701],
    ['Fine Dining',  '🕯',  '#5B3FBB', '#EEE9FC', 'Active', 287],
    ['Business',     '💼', '#1A7FB5', '#E9F4FB', 'Active', 203],
    ['After Work',   '🍻', '#C9890B', '#FBF1D9', 'Active', 318],
    ['Weekend Brunch','☀️','#A0306F', '#FCE8F3', 'Active', 476],
    ['Rooftop',      '🏙', '#E8431F', '#FDEDE7', 'Active', 192],
    ['Hidden Gem',   '💎', '#5B3FBB', '#EEE9FC', 'Hidden', 88 ],
];
foreach($moods as $i => $m): ?>
                <tr data-search="<?php echo strtolower($m[0]); ?>">
                    <td style="padding-left:22px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="tag-icon-cell" style="background:<?php echo $m[3]; ?>;">
                                <?php echo $m[1]; ?>
                            </div>
                            <div>
                                <div style="font-weight:700; font-size:14px;"><?php echo $m[0]; ?></div>
                                <div style="font-size:11.5px; color:var(--ink-soft);">
                                    #MOD-<?php echo str_pad($i+1,3,'0',STR_PAD_LEFT); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:20px;"><?php echo $m[1]; ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span
                                style="background:<?php echo $m[2]; ?>; width:16px; height:16px; border-radius:4px; display:inline-block;"></span>
                            <span
                                style="font-size:12.5px; font-weight:700; color:var(--ink-soft); font-family:monospace;"><?php echo $m[2]; ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="preview-chip"
                            style="background:<?php echo $m[3]; ?>; color:<?php echo $m[2]; ?>; border:1px solid <?php echo $m[2]; ?>22;">
                            <?php echo $m[1]; ?> <?php echo $m[0]; ?>
                        </span>
                    </td>
                    <td style="font-weight:700;"><?php echo number_format($m[5]); ?></td>
                    <td>
                        <span class="badge <?php echo $m[4]==='Active'?'badge-good':'badge-warn'; ?>">
                            <?php echo $m[4]; ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn edit" title="Edit"
                                onclick="openModal('mood', '<?php echo addslashes($m[0]); ?>', '<?php echo $m[1]; ?>', '<?php echo $m[2]; ?>', '<?php echo $m[3]; ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </button>
                            <button class="action-btn delete" title="Delete"
                                onclick="confirmDelete('<?php echo addslashes($m[0]); ?>', 'mood')">
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
            <span>Showing <strong>1–12</strong> of <strong>18</strong> mood tags</span>
            <div class="page-btns">
                <button class="page-btn">‹</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">›</button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     TAB: DIETARY
     ================================================================ -->
<div class="tab-panel" id="panel-dietary">
    <div class="toolbar">
        <div class="toolbar-search">
            <span class="icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </span>
            <input type="text" placeholder="Search dietary labels…" oninput="filterTable('dietaryBody', this.value)">
        </div>
        <button class="btn-add" onclick="openModal('dietary')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            Add Label
        </button>
    </div>

    <div class="card" style="padding:0; overflow:hidden;">
        <table class="table">
            <thead>
                <tr>
                    <th style="padding-left:22px;">Dietary Label</th>
                    <th>Emoji</th>
                    <th>Colour</th>
                    <th>Preview</th>
                    <th>Users Filtering</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="dietaryBody">
                <?php
$dietary = [
    ['No Restrictions', '✅', '#2C8A4B', '#E7F5EA', 'Active', 2841],
    ['Vegetarian',      '🥦', '#2C8A4B', '#E7F5EA', 'Active',  612],
    ['Vegan',           '🌱', '#2C8A4B', '#E7F5EA', 'Active',  287],
    ['Halal',           '☪️', '#1A7FB5', '#E9F4FB', 'Active', 1934],
    ['Gluten-Free',     '🌾', '#C9890B', '#FBF1D9', 'Active',  341],
    ['Dairy-Free',      '🥛', '#5B3FBB', '#EEE9FC', 'Active',  198],
    ['Nut-Free',        '🥜', '#E8431F', '#FDEDE7', 'Active',  154],
    ['Keto',            '🥑', '#A0306F', '#FCE8F3', 'Active',  229],
    ['Pescatarian',     '🐟', '#1A7FB5', '#E9F4FB', 'Hidden',  87 ],
];
foreach($dietary as $i => $d): ?>
                <tr data-search="<?php echo strtolower($d[0]); ?>">
                    <td style="padding-left:22px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="tag-icon-cell" style="background:<?php echo $d[3]; ?>;">
                                <?php echo $d[1]; ?>
                            </div>
                            <div>
                                <div style="font-weight:700; font-size:14px;"><?php echo $d[0]; ?></div>
                                <div style="font-size:11.5px; color:var(--ink-soft);">
                                    #DIT-<?php echo str_pad($i+1,3,'0',STR_PAD_LEFT); ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:20px;"><?php echo $d[1]; ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span
                                style="background:<?php echo $d[2]; ?>; width:16px; height:16px; border-radius:4px; display:inline-block;"></span>
                            <span
                                style="font-size:12.5px; font-weight:700; color:var(--ink-soft); font-family:monospace;"><?php echo $d[2]; ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="preview-chip"
                            style="background:<?php echo $d[3]; ?>; color:<?php echo $d[2]; ?>; border:1px solid <?php echo $d[2]; ?>22;">
                            <?php echo $d[1]; ?> <?php echo $d[0]; ?>
                        </span>
                    </td>
                    <td style="font-weight:700;"><?php echo number_format($d[5]); ?></td>
                    <td>
                        <span class="badge <?php echo $d[4]==='Active'?'badge-good':'badge-warn'; ?>">
                            <?php echo $d[4]; ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn edit" title="Edit"
                                onclick="openModal('dietary', '<?php echo addslashes($d[0]); ?>', '<?php echo $d[1]; ?>', '<?php echo $d[2]; ?>', '<?php echo $d[3]; ?>')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </button>
                            <button class="action-btn delete" title="Delete"
                                onclick="confirmDelete('<?php echo addslashes($d[0]); ?>', 'dietary')">
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
            <span>Showing <strong>1–9</strong> of <strong>9</strong> labels</span>
            <div class="page-btns">
                <button class="page-btn active">1</button>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     ADD / EDIT MODAL
     ================================================================ -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOnBg(event)">
    <div class="modal" id="modal">
        <div class="modal-head">
            <div class="modal-title" id="m-title">Add Cuisine</div>
            <button class="modal-close" onclick="closeModal()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input class="form-input" id="m-name" type="text" placeholder="e.g. Italian"
                        oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-input" id="m-status">
                        <option>Active</option>
                        <option>Hidden</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Emoji Icon</label>
                <div class="emoji-picker-row" id="emojiRow">
                    <?php
                    $emojis = ['🍕','🥢','🫒','🌮','🍛','🥩','🍣','🥡','🍔','🍦','🦞','🌱',
                               '💑','😎','🌿','🌙','👨‍👩‍👧','⚡','🕯','💼','🍻','☀️','🏙','💎',
                               '✅','🥦','☪️','🌾','🥛','🥑','🐟','🥜'];
                    foreach($emojis as $e): ?>
                    <div class="emoji-opt" onclick="selectEmoji(this, '<?php echo $e; ?>')"><?php echo $e; ?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Colour</label>
                <div class="color-picker-row" id="colorRow">
                    <?php
                    $colors = [
                        ['#E8431F','#FDEDE7'],['#2C8A4B','#E7F5EA'],['#5B3FBB','#EEE9FC'],
                        ['#C9890B','#FBF1D9'],['#1A7FB5','#E9F4FB'],['#A0306F','#FCE8F3'],
                        ['#D43B25','#FDE7E2'],['#0D7E6A','#E3F4F1'],['#7C3D12','#FEF0E7'],
                    ];
                    foreach($colors as $idx => $col): ?>
                    <div class="color-swatch<?php echo $idx===0?' selected':''; ?>"
                        style="background:<?php echo $col[0]; ?>;"
                        onclick="selectColor(this, '<?php echo $col[0]; ?>', '<?php echo $col[1]; ?>')">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Live preview -->
        <div class="modal-preview">
            Preview:
            <span class="preview-chip" id="m-preview"
                style="background:#FDEDE7; color:#E8431F; border:1px solid #E8431F22; font-size:13px;">
                🍕 Italian
            </span>
        </div>

        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-save" onclick="saveTag()">Save Tag</button>
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
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
}

/* ===== MODAL STATE ===== */
let selectedEmoji = '🍕';
let selectedFg    = '#E8431F';
let selectedBg    = '#FDEDE7';

function openModal(type, name, emoji, fg, bg) {
    const titles = { cuisine:'Cuisine', mood:'Mood Tag', dietary:'Dietary Label' };
    const isEdit = !!name;
    document.getElementById('m-title').textContent = (isEdit ? 'Edit ' : 'Add ') + titles[type];
    document.getElementById('m-name').value  = name  || '';
    document.getElementById('m-status').value = 'Active';

    selectedEmoji = emoji || '🍕';
    selectedFg    = fg    || '#E8431F';
    selectedBg    = bg    || '#FDEDE7';

    // sync emoji selection
    document.querySelectorAll('.emoji-opt').forEach(el => {
        el.classList.toggle('selected', el.textContent === selectedEmoji);
    });
    // sync color selection
    document.querySelectorAll('.color-swatch').forEach(el => {
        el.classList.toggle('selected', el.style.background === selectedFg ||
            rgbToHex(el.style.background) === selectedFg.toLowerCase());
    });

    updatePreview();
    document.getElementById('modalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('m-name').focus(), 200);
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function closeModalOnBg(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
}

function selectEmoji(el, emoji) {
    document.querySelectorAll('.emoji-opt').forEach(e => e.classList.remove('selected'));
    el.classList.add('selected');
    selectedEmoji = emoji;
    updatePreview();
}

function selectColor(el, fg, bg) {
    document.querySelectorAll('.color-swatch').forEach(e => e.classList.remove('selected'));
    el.classList.add('selected');
    selectedFg = fg;
    selectedBg = bg;
    updatePreview();
}

function updatePreview() {
    const name = document.getElementById('m-name').value || 'Preview';
    const chip = document.getElementById('m-preview');
    chip.textContent = selectedEmoji + ' ' + name;
    chip.style.background  = selectedBg;
    chip.style.color        = selectedFg;
    chip.style.border       = '1px solid ' + selectedFg + '33';
}

function saveTag() {
    const name = document.getElementById('m-name').value.trim();
    if (!name) { alert('Please enter a name.'); return; }
    // TODO: POST to backend
    closeModal();
}

/* ===== DELETE ===== */
function confirmDelete(name, type) {
    const types = { cuisine:'cuisine', mood:'mood tag', dietary:'dietary label' };
    if (confirm('Delete "' + name + '"? This will remove it from all linked venues and users.')) {
        alert('"' + name + '" deleted. (Wire to your backend.)');
    }
}

/* helper: rgb string → hex */
function rgbToHex(rgb) {
    const m = rgb.match(/\d+/g);
    if (!m) return '';
    return '#' + m.slice(0,3).map(n => (+n).toString(16).padStart(2,'0')).join('');
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>