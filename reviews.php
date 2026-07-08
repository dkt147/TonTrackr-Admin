<?php
$pageTitle  = 'Reviews';
$activePage = 'reviews';
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
    .review-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .rstat {
        background: var(--white);
        border-radius: var(--radius-md);
        border: 1px solid var(--line);
        padding: 16px 18px;
        box-shadow: var(--shadow-card);
    }

    .rstat-val {
        font-family: 'Fraunces', serif;
        font-weight: 700;
        font-size: 24px;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 5px;
    }

    .rstat-label {
        font-size: 12px;
        color: var(--ink-soft);
        font-weight: 600;
    }

    /* ===== STAR RATING ===== */
    .stars {
        display: inline-flex;
        gap: 2px;
        align-items: center;
    }

    .star {
        font-size: 13px;
        color: #D4CCC8;
    }

    .star.filled {
        color: #F5A623;
    }

    .star-score {
        font-size: 13px;
        font-weight: 800;
        color: var(--ink);
        margin-left: 5px;
    }

    /* ===== REVIEW TEXT SNIPPET ===== */
    .review-snippet {
        font-size: 13px;
        color: var(--ink-soft);
        max-width: 280px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4;
    }

    /* ===== VENUE CELL ===== */
    .venue-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .venue-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .venue-name {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--ink);
    }

    .venue-loc {
        font-size: 11.5px;
        color: var(--ink-soft);
        margin-top: 2px;
    }

    /* ===== TAGS ===== */
    .tag-row {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .tag {
        padding: 3px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        background: var(--coral-soft);
        color: var(--coral-deep);
        border: 1px solid #F6C7B6;
        white-space: nowrap;
    }

    .tag.mood {
        background: #EEE9FC;
        color: #5B3FBB;
        border-color: #C8BDF2;
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

    .action-btn.flag:hover {
        background: #FBF1D9;
        color: #C9890B;
        border-color: #E8C46A;
    }

    .action-btn.flag.flagged {
        background: #FBF1D9;
        color: #C9890B;
        border-color: #E8C46A;
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
        max-width: 500px;
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

    /* hero */
    .review-hero {
        padding: 24px;
        background: linear-gradient(160deg, #FFF5F0 0%, #FFD0B8 100%);
        border-bottom: 1px solid var(--line);
    }

    .review-hero-venue {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .hero-venue-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 2px solid rgba(255, 255, 255, 0.7);
    }

    .hero-venue-name {
        font-family: 'Fraunces', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
    }

    .hero-venue-loc {
        font-size: 12.5px;
        color: var(--ink-soft);
        margin-top: 2px;
    }

    .hero-stars-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .hero-stars {
        display: flex;
        gap: 3px;
    }

    .hero-star {
        font-size: 20px;
        color: #D4CCC8;
    }

    .hero-star.filled {
        color: #F5A623;
    }

    .hero-score {
        font-family: 'Fraunces', serif;
        font-size: 22px;
        font-weight: 700;
        color: var(--ink);
    }

    .review-full-text {
        font-size: 14px;
        color: var(--ink);
        line-height: 1.65;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 10px;
        padding: 14px 16px;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    /* detail sections */
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

    /* flag banner */
    .flag-banner {
        display: none;
        margin: 0 24px 0;
        padding: 10px 14px;
        border-radius: 10px;
        background: #FBF1D9;
        border: 1px solid #E8C46A;
        color: #7A5300;
        font-size: 13px;
        font-weight: 700;
        gap: 8px;
        align-items: center;
    }

    .flag-banner.visible {
        display: flex;
        margin-top: 16px;
    }

    /* drawer footer */
    .drawer-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--line);
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-flag {
        flex: 1;
        padding: 11px;
        border-radius: 10px;
        border: 1.5px solid #E8C46A;
        background: #FBF1D9;
        color: #7A5300;
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: background .15s;
    }

    .btn-flag:hover {
        background: #f5e4a8;
    }

    .btn-unflag {
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

    .btn-unflag:hover {
        background: #cfecd8;
    }

    .btn-delete-review {
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

    .btn-delete-review:hover {
        background: #f9cfc9;
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
        .review-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:560px) {
        .review-stats {
            grid-template-columns: 1fr;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .review-snippet {
            max-width: 160px;
        }
    }
</style>

<!-- PAGE HEADER -->
<div class="page-head">
    <div>
        <p class="page-eyebrow">Management</p>
        <h1 class="page-title">Reviews</h1>
        <p class="page-sub">Monitor, flag and moderate all user-submitted reviews.</p>
    </div>
</div>

<!-- STATS STRIP -->
<div class="review-stats">
    <div class="rstat">
        <div class="rstat-val">11,340</div>
        <div class="rstat-label">Total Reviews</div>
    </div>
    <div class="rstat">
        <div class="rstat-val" style="color:var(--coral-deep);">4.3 ★</div>
        <div class="rstat-label">Avg. Rating</div>
    </div>
    <div class="rstat">
        <div class="rstat-val" style="color:#C9890B;">74</div>
        <div class="rstat-label">Flagged</div>
    </div>
    <div class="rstat">
        <div class="rstat-val" style="color:var(--good);">+318</div>
        <div class="rstat-label">This Month</div>
    </div>
</div>

<!-- TOOLBAR -->
<div class="toolbar">
    <div class="toolbar-search">
        <span class="icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
        </span>
        <input type="text" id="reviewSearch" placeholder="Search by venue or reviewer…" oninput="filterReviews()">
    </div>
    <select class="toolbar-select" id="ratingFilter" onchange="filterReviews()">
        <option value="">All Ratings</option>
        <option value="5">5 Stars</option>
        <option value="4">4 Stars</option>
        <option value="3">3 Stars</option>
        <option value="2">2 Stars</option>
        <option value="1">1 Star</option>
    </select>
    <select class="toolbar-select" id="flagFilter" onchange="filterReviews()">
        <option value="">All Reviews</option>
        <option value="flagged">Flagged Only</option>
        <option value="clean">Not Flagged</option>
    </select>
    <select class="toolbar-select" id="sortFilter" onchange="filterReviews()">
        <option value="newest">Newest First</option>
        <option value="oldest">Oldest First</option>
        <option value="rating-high">Rating: High → Low</option>
        <option value="rating-low">Rating: Low → High</option>
    </select>
</div>

<!-- REVIEWS TABLE -->
<div class="card" style="padding:0; overflow:hidden;">
    <table class="table" id="reviewTable">
        <thead>
            <tr>
                <th style="padding-left:22px;">Venue</th>
                <th>Reviewer</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Tags</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="reviewTableBody">
            <?php
$venueIcons = ['🍕','🍣','🌮','🍔','🥗','☕','🍜','🥩','🍷','🍦','🍛','🥘'];
$venueBgs   = ['#FDEDE7','#E7F5EA','#EEE9FC','#FBF1D9','#E9F4FB','#FCE8F3',
               '#FDE7E2','#E7F5EA','#FDEDE7','#EEE9FC','#E9F4FB','#FBF1D9'];

$reviews = [
  /* venue, location, reviewer, rating, text, tags, date, flagged */
  ['Casa Verde',     'DHA, Karachi',     'Sara Malik',     5, 'Absolutely loved the ambiance and food. The pasta was cooked to perfection and the service was impeccable!', ['Italian','Date Night'],   'Jun 28, 2025', false],
  ['Nobu Karachi',   'Clifton, Karachi', 'Ali Khan',       4, 'Great sushi selection. A bit pricey but worth the experience for special occasions.', ['Asian','Fine Dining'],          'Jun 27, 2025', false],
  ['Taco Fiesta',    'F-7, Islamabad',   'Rida Hassan',    3, 'Food was decent but the waiting time was way too long. Could improve on speed.', ['Mexican','Casual'],                'Jun 26, 2025', true ],
  ['Burger Lab',     'Gulshan, Karachi', 'Hamza Siddiqui', 5, 'Best smash burgers in the city, hands down. The truffle fries are a must-try!', ['Burgers','Late Night'],            'Jun 25, 2025', false],
  ['The Green Bowl', 'DHA, Lahore',      'Nadia Jamil',    4, 'Fresh ingredients and generous portions. Perfect for a healthy lunch.', ['Healthy','Lunch'],                         'Jun 24, 2025', false],
  ['Café Flo',       'Zamzama, Karachi', 'Bilal Ahmed',    2, 'Overpriced coffee and rude staff. Definitely not coming back here again ever.', ['Café','Overpriced'],               'Jun 23, 2025', true ],
  ['Ramen House',    'MM Alam, Lahore',  'Zara Qureshi',   5, 'Authentic Japanese ramen in Lahore — who knew! Rich broth and perfectly chewy noodles.', ['Asian','Cozy'],           'Jun 22, 2025', false],
  ['Chops & Grills', 'Bahria, Karachi',  'Usman Tariq',    1, 'Meat was undercooked and the place smelled bad. Reported to food authority already.', ['Steakhouse','Warning'],      'Jun 21, 2025', true ],
  ['Vino & Dine',    'Clifton, Karachi', 'Hina Baig',      4, 'Lovely wine selection paired with excellent pasta dishes. Romantic setting great for couples.', ['Italian','Romantic'],'Jun 20, 2025', false],
  ['Ice Lab',        'F-6, Islamabad',   'Kamran Iqbal',   5, 'The matcha ice cream is otherworldly. Great dessert spot for the whole family!', ['Dessert','Family'],               'Jun 19, 2025', false],
  ['Spice Route',    'Gulberg, Lahore',  'Ayesha Raza',    3, 'Hit or miss with the curries. Some dishes were excellent, others needed more seasoning overall.', ['Indian','Mixed'], 'Jun 18, 2025', false],
  ['The Tapas Bar',  'PECHS, Karachi',   'Omar Farooq',    2, 'Small portions for the price. Staff was inattentive and forgot our order twice.',  ['Spanish','Casual'],              'Jun 17, 2025', true ],
];

foreach($reviews as $i => $r):
    $flagClass = $r[7] ? 'badge-warn' : 'badge-good';
    $flagLabel = $r[7] ? 'Flagged'    : 'Clean';
    $slug      = 'rv' . $i;
    $icon      = $venueIcons[$i % count($venueIcons)];
    $bg        = $venueBgs[$i   % count($venueBgs)];
    $tagsJson  = htmlspecialchars(json_encode($r[5]), ENT_QUOTES);
?>
            <tr class="review-row" data-venue="<?php echo strtolower($r[0]); ?>"
                data-reviewer="<?php echo strtolower($r[2]); ?>" data-rating="<?php echo $r[3]; ?>"
                data-flagged="<?php echo $r[7] ? 'flagged' : 'clean'; ?>" data-date="<?php echo $i; ?>">

                <!-- Venue -->
                <td style="padding-left:22px;">
                    <div class="venue-cell">
                        <div class="venue-icon" style="background:<?php echo $bg; ?>;">
                            <?php echo $icon; ?>
                        </div>
                        <div>
                            <div class="venue-name"><?php echo $r[0]; ?></div>
                            <div class="venue-loc"><?php echo $r[1]; ?></div>
                        </div>
                    </div>
                </td>

                <!-- Reviewer -->
                <td>
                    <div style="font-size:13.5px; font-weight:700; color:var(--ink);"><?php echo $r[2]; ?></div>
                </td>

                <!-- Rating -->
                <td>
                    <div class="stars">
                        <?php for($s=1;$s<=5;$s++): ?>
                        <span class="star<?php echo $s<=$r[3]?' filled':''; ?>">★</span>
                        <?php endfor; ?>
                        <span class="star-score"><?php echo $r[3]; ?>.0</span>
                    </div>
                </td>

                <!-- Review text snippet -->
                <td>
                    <div class="review-snippet" title="<?php echo htmlspecialchars($r[4]); ?>">
                        <?php echo htmlspecialchars($r[4]); ?>
                    </div>
                </td>

                <!-- Tags -->
                <td>
                    <div class="tag-row">
                        <?php foreach($r[5] as $t): ?>
                        <span class="tag"><?php echo $t; ?></span>
                        <?php endforeach; ?>
                    </div>
                </td>

                <!-- Date -->
                <td style="color:var(--ink-soft); font-size:13px; white-space:nowrap;"><?php echo $r[6]; ?></td>

                <!-- Status -->
                <td>
                    <span class="badge <?php echo $flagClass; ?>" id="badge-<?php echo $slug; ?>">
                        <?php echo $flagLabel; ?>
                    </span>
                </td>

                <!-- Actions -->
                <td>
                    <div class="action-btns">
                        <!-- View -->
                        <button class="action-btn view" title="View full review" onclick="openReview(
                                <?php echo $i; ?>,
                                '<?php echo addslashes($r[0]); ?>',
                                '<?php echo addslashes($r[1]); ?>',
                                '<?php echo addslashes($r[2]); ?>',
                                <?php echo $r[3]; ?>,
                                '<?php echo addslashes($r[4]); ?>',
                                <?php echo $tagsJson; ?>,
                                '<?php echo $r[6]; ?>',
                                <?php echo $r[7] ? 'true' : 'false'; ?>,
                                '<?php echo $icon; ?>',
                                '<?php echo $bg; ?>',
                                '<?php echo $slug; ?>'
                            )">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                    stroke-width="1.8" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </button>

                        <!-- Flag -->
                        <button class="action-btn flag<?php echo $r[7]?' flagged':''; ?>"
                            id="flagbtn-<?php echo $slug; ?>" title="Flag review"
                            onclick="toggleFlag(this, '<?php echo $slug; ?>', '<?php echo addslashes($r[2]); ?>')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                <line x1="4" y1="22" x2="4" y2="15" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                        </button>

                        <!-- Delete -->
                        <button class="action-btn delete" title="Delete review"
                            onclick="confirmDelete('<?php echo addslashes($r[0]); ?>', '<?php echo addslashes($r[2]); ?>')">
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
        <span>Showing <strong>1–12</strong> of <strong>11,340</strong> reviews</span>
        <div class="page-btns">
            <button class="page-btn">‹</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">…</button>
            <button class="page-btn">945</button>
            <button class="page-btn">›</button>
        </div>
    </div>
</div>

<!-- ================================================================
     DETAIL DRAWER
     ================================================================ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawerOnBg(event)">
    <div class="drawer" id="drawer">

        <!-- Head -->
        <div class="drawer-head">
            <div>
                <div class="drawer-title">Review Detail</div>
                <div style="font-size:12px; color:var(--ink-soft);">Full review · tags · moderation</div>
            </div>
            <button class="drawer-close" onclick="closeDrawer()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="drawer-body">

            <!-- Hero -->
            <div class="review-hero">
                <div class="review-hero-venue">
                    <div class="hero-venue-icon" id="d-icon"></div>
                    <div>
                        <div class="hero-venue-name" id="d-venue"></div>
                        <div class="hero-venue-loc" id="d-loc"></div>
                    </div>
                </div>
                <div class="hero-stars-row">
                    <div class="hero-stars" id="d-stars"></div>
                    <div class="hero-score" id="d-score"></div>
                </div>
                <div class="review-full-text" id="d-text"></div>
            </div>

            <!-- Flag banner -->
            <div class="flag-banner" id="d-flag-banner">
                🚩 This review has been flagged for moderation.
            </div>

            <!-- Meta -->
            <div class="detail-section">
                <div class="detail-section-title">Review Info</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Reviewer</div>
                        <div class="info-val" id="d-reviewer">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Submitted On</div>
                        <div class="info-val" id="d-date">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Star Rating</div>
                        <div class="info-val" id="d-rating-val">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Moderation</div>
                        <div class="info-val" id="d-mod-status">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Review ID</div>
                        <div class="info-val" id="d-rev-id">—</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Venue City</div>
                        <div class="info-val" id="d-city">—</div>
                    </div>
                </div>
            </div>

            <!-- Tags -->
            <div class="detail-section">
                <div class="detail-section-title">Tags</div>
                <div class="chip-row" id="d-tags"></div>
            </div>

            <!-- Moderation history placeholder -->
            <div class="detail-section">
                <div class="detail-section-title">Moderation Notes</div>
                <div id="d-mod-notes" style="font-size:13.5px; color:var(--ink-soft); line-height:1.6;">
                    No moderation actions taken yet.
                </div>
            </div>

        </div><!-- /drawer-body -->

        <div class="drawer-footer">
            <button class="btn-flag" id="d-flag-btn" onclick="drawerToggleFlag()">🚩 Flag Review</button>
            <button class="btn-unflag" id="d-unflag-btn" onclick="drawerToggleFlag()">✓ Remove Flag</button>
            <button class="btn-delete-review" onclick="drawerDelete()">🗑 Delete</button>
        </div>

    </div>
</div>

<?php
$extraScripts = <<<'JS'
<script>
/* ======================================================
   STATE
   ====================================================== */
let currentSlug   = null;
let currentFlagged = false;

/* ======================================================
   FILTER
   ====================================================== */
function filterReviews() {
    const q      = document.getElementById('reviewSearch').value.toLowerCase();
    const rating = document.getElementById('ratingFilter').value;
    const flag   = document.getElementById('flagFilter').value;
    const sort   = document.getElementById('sortFilter').value;
    const tbody  = document.getElementById('reviewTableBody');
    const rows   = Array.from(tbody.querySelectorAll('.review-row'));

    rows.forEach(row => {
        const venue    = row.dataset.venue;
        const reviewer = row.dataset.reviewer;
        const r        = row.dataset.rating;
        const f        = row.dataset.flagged;
        const show =
            (!q      || venue.includes(q) || reviewer.includes(q)) &&
            (!rating || r === rating) &&
            (!flag   || f === flag);
        row.style.display = show ? '' : 'none';
    });

    const visible = rows.filter(r => r.style.display !== 'none');
    visible.sort((a, b) => {
        if (sort === 'rating-high') return +b.dataset.rating - +a.dataset.rating;
        if (sort === 'rating-low')  return +a.dataset.rating - +b.dataset.rating;
        if (sort === 'oldest')      return +a.dataset.date  - +b.dataset.date;
        return +b.dataset.date - +a.dataset.date;
    });
    visible.forEach(r => tbody.appendChild(r));
}

/* ======================================================
   INLINE FLAG TOGGLE
   ====================================================== */
function toggleFlag(btn, slug, reviewer) {
    const badge    = document.getElementById('badge-' + slug);
    const isFlagged = btn.classList.contains('flagged');

    if (isFlagged) {
        btn.classList.remove('flagged');
        badge.textContent = 'Clean';
        badge.className   = 'badge badge-good';
        btn.closest('tr').dataset.flagged = 'clean';
    } else {
        btn.classList.add('flagged');
        badge.textContent = 'Flagged';
        badge.className   = 'badge badge-warn';
        btn.closest('tr').dataset.flagged = 'flagged';
    }
    // TODO: POST flag status to backend
}

/* ======================================================
   OPEN DETAIL DRAWER
   ====================================================== */
function openReview(idx, venue, loc, reviewer, rating, text, tags, date, flagged, icon, bg, slug) {
    currentSlug    = slug;
    currentFlagged = flagged;

    // Hero
    const iconEl = document.getElementById('d-icon');
    iconEl.textContent       = icon;
    iconEl.style.background  = bg;

    document.getElementById('d-venue').textContent    = venue;
    document.getElementById('d-loc').textContent      = loc;
    document.getElementById('d-text').textContent     = text;

    // Stars
    const starsEl = document.getElementById('d-stars');
    starsEl.innerHTML = '';
    for (let s = 1; s <= 5; s++) {
        const sp = document.createElement('span');
        sp.className = 'hero-star' + (s <= rating ? ' filled' : '');
        sp.textContent = '★';
        starsEl.appendChild(sp);
    }
    document.getElementById('d-score').textContent = rating + '.0';

    // Info grid
    document.getElementById('d-reviewer').textContent  = reviewer;
    document.getElementById('d-date').textContent      = date;
    document.getElementById('d-rating-val').textContent = rating + ' / 5 Stars';
    document.getElementById('d-rev-id').textContent    = '#RV-' + String(idx + 1).padStart(5, '0');
    document.getElementById('d-city').textContent      = loc.split(',').pop().trim();

    // Flag banner + status
    syncDrawerFlag();

    // Tags
    const tagsEl = document.getElementById('d-tags');
    tagsEl.innerHTML = '';
    tags.forEach(t => {
        const span = document.createElement('span');
        span.className   = 'chip';
        span.textContent = t;
        tagsEl.appendChild(span);
    });

    // Mod notes
    document.getElementById('d-mod-notes').textContent = flagged
        ? 'Flagged for review by automated moderation system. Awaiting admin decision.'
        : 'No moderation actions taken yet.';

    // Open
    document.getElementById('drawerOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function syncDrawerFlag() {
    const banner  = document.getElementById('d-flag-banner');
    const flagBtn = document.getElementById('d-flag-btn');
    const unflag  = document.getElementById('d-unflag-btn');
    const modEl   = document.getElementById('d-mod-status');

    if (currentFlagged) {
        banner.classList.add('visible');
        flagBtn.style.display  = 'none';
        unflag.style.display   = 'block';
        modEl.textContent      = '🚩 Flagged';
        modEl.style.color      = '#C9890B';
    } else {
        banner.classList.remove('visible');
        flagBtn.style.display  = 'block';
        unflag.style.display   = 'none';
        modEl.textContent      = '✓ Clean';
        modEl.style.color      = 'var(--good)';
    }
}

function drawerToggleFlag() {
    currentFlagged = !currentFlagged;
    syncDrawerFlag();

    // Sync table badge + flag button
    if (currentSlug) {
        const badge   = document.getElementById('badge-' + currentSlug);
        const flagBtn = document.getElementById('flagbtn-' + currentSlug);
        if (badge) {
            badge.textContent = currentFlagged ? 'Flagged' : 'Clean';
            badge.className   = 'badge ' + (currentFlagged ? 'badge-warn' : 'badge-good');
        }
        if (flagBtn) {
            flagBtn.closest('tr').dataset.flagged = currentFlagged ? 'flagged' : 'clean';
            currentFlagged ? flagBtn.classList.add('flagged') : flagBtn.classList.remove('flagged');
        }
    }
    document.getElementById('d-mod-notes').textContent = currentFlagged
        ? 'Flagged for review. Awaiting admin decision.'
        : 'Flag removed. Review cleared by admin.';
    // TODO: POST to backend
}

function drawerDelete() {
    const venueName = document.getElementById('d-venue').textContent;
    const reviewer  = document.getElementById('d-reviewer').textContent;
    if (confirm('Delete review by "' + reviewer + '" for "' + venueName + '"? This cannot be undone.')) {
        closeDrawer();
        alert('Review deleted. (Wire to your backend.)');
    }
}

/* ======================================================
   CLOSE DRAWER
   ====================================================== */
function closeDrawer() {
    document.getElementById('drawerOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function closeDrawerOnBg(e) {
    if (e.target === document.getElementById('drawerOverlay')) closeDrawer();
}

/* ======================================================
   DELETE (table row)
   ====================================================== */
function confirmDelete(venue, reviewer) {
    if (confirm('Delete review by "' + reviewer + '" for "' + venue + '"? This cannot be undone.')) {
        alert('"' + reviewer + '\'s" review deleted. (Wire to your backend.)');
    }
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>