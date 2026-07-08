 <?php
$pageTitle  = 'Notifications';
$activePage = 'notifications';
include __DIR__ . '/includes/header.php';
?>

 <style>
     /* ===== LAYOUT: 2-column composer + history ===== */
     .notif-layout {
         display: grid;
         grid-template-columns: 420px 1fr;
         gap: 20px;
         align-items: start;
     }

     /* ===== STATS STRIP ===== */
     .notif-stats {
         display: grid;
         grid-template-columns: repeat(4, 1fr);
         gap: 14px;
         margin-bottom: 22px;
     }

     .nstat {
         background: var(--white);
         border-radius: var(--radius-md);
         border: 1px solid var(--line);
         padding: 16px 18px;
         box-shadow: var(--shadow-card);
     }

     .nstat-val {
         font-family: 'Fraunces', serif;
         font-weight: 700;
         font-size: 24px;
         color: var(--ink);
         line-height: 1;
         margin-bottom: 5px;
     }

     .nstat-label {
         font-size: 12px;
         color: var(--ink-soft);
         font-weight: 600;
     }

     /* ===== COMPOSER CARD ===== */
     .composer-card {
         background: var(--white);
         border-radius: var(--radius-md);
         border: 1px solid var(--line);
         box-shadow: var(--shadow-card);
         overflow: hidden;
         position: sticky;
         top: 24px;
     }

     .composer-head {
         padding: 18px 22px 16px;
         border-bottom: 1px solid var(--line);
         background: linear-gradient(160deg, #FFF5F0 0%, #FFD0B8 100%);
     }

     .composer-head-title {
         font-family: 'Fraunces', serif;
         font-size: 16px;
         font-weight: 700;
         color: var(--ink);
         margin-bottom: 3px;
     }

     .composer-head-sub {
         font-size: 12px;
         color: var(--ink-soft);
     }

     .composer-body {
         padding: 20px 22px;
         display: flex;
         flex-direction: column;
         gap: 16px;
     }

     /* form elements */
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

     .form-label span {
         font-weight: 600;
         text-transform: none;
         letter-spacing: 0;
         color: var(--ink-faint);
         font-size: 11px;
         margin-left: 4px;
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
         min-height: 90px;
         line-height: 1.6;
     }

     .char-count {
         font-size: 11.5px;
         color: var(--ink-faint);
         text-align: right;
         margin-top: -10px;
     }

     .char-count.warn {
         color: #C9890B;
     }

     .char-count.over {
         color: var(--bad);
     }

     /* audience chips */
     .audience-grid {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 8px;
     }

     .aud-chip {
         padding: 10px 12px;
         border-radius: 10px;
         border: 1.5px solid var(--line);
         background: var(--white);
         cursor: pointer;
         transition: border-color .15s, background .15s;
         display: flex;
         align-items: center;
         gap: 8px;
     }

     .aud-chip input[type="radio"] {
         display: none;
     }

     .aud-chip.selected {
         border-color: var(--coral);
         background: #FDEDE7;
     }

     .aud-chip-icon {
         font-size: 16px;
         flex-shrink: 0;
     }

     .aud-chip-label {
         font-size: 13px;
         font-weight: 700;
         color: var(--ink);
     }

     .aud-chip-count {
         font-size: 11px;
         color: var(--ink-soft);
         margin-top: 1px;
     }

     /* type tabs */
     .type-pills {
         display: flex;
         gap: 6px;
         flex-wrap: wrap;
     }

     .type-pill {
         padding: 6px 14px;
         border-radius: 999px;
         border: 1.5px solid var(--line);
         background: var(--white);
         font-size: 12.5px;
         font-weight: 700;
         font-family: inherit;
         color: var(--ink-soft);
         cursor: pointer;
         transition: border-color .15s, background .15s, color .15s;
     }

     .type-pill.active {
         border-color: var(--coral);
         background: #FDEDE7;
         color: var(--coral-deep);
     }

     /* phone mockup preview */
     .phone-preview {
         border-radius: 10px;
         border: 1.5px solid var(--line);
         background: var(--paper);
         padding: 14px;
         display: flex;
         align-items: flex-start;
         gap: 12px;
     }

     .phone-notif-icon {
         width: 38px;
         height: 38px;
         border-radius: 10px;
         background: linear-gradient(160deg, #FF7A52, var(--coral-deep));
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 18px;
         flex-shrink: 0;
     }

     .phone-notif-body {
         flex: 1;
         min-width: 0;
     }

     .phone-notif-app {
         font-size: 10.5px;
         font-weight: 800;
         color: var(--ink-soft);
         text-transform: uppercase;
         letter-spacing: .06em;
         margin-bottom: 3px;
     }

     .phone-notif-title {
         font-size: 13.5px;
         font-weight: 700;
         color: var(--ink);
         margin-bottom: 3px;
         word-break: break-word;
     }

     .phone-notif-msg {
         font-size: 12.5px;
         color: var(--ink-soft);
         line-height: 1.45;
         word-break: break-word;
     }

     .phone-notif-time {
         font-size: 11px;
         color: var(--ink-faint);
         flex-shrink: 0;
         margin-top: 1px;
     }

     /* schedule row */
     .schedule-row {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 10px;
     }

     /* send button */
     .btn-send {
         width: 100%;
         padding: 13px;
         border-radius: 10px;
         border: none;
         background: linear-gradient(160deg, #FF7A52, var(--coral-deep));
         color: #fff;
         font-size: 15px;
         font-weight: 700;
         font-family: inherit;
         cursor: pointer;
         box-shadow: 0 8px 20px -8px rgba(232, 67, 31, 0.50);
         transition: opacity .15s;
         display: flex;
         align-items: center;
         justify-content: center;
         gap: 8px;
     }

     .btn-send:hover {
         opacity: .88;
     }

     .btn-schedule {
         width: 100%;
         padding: 11px;
         border-radius: 10px;
         border: 1.5px solid var(--line);
         background: var(--white);
         color: var(--ink-soft);
         font-size: 13.5px;
         font-weight: 700;
         font-family: inherit;
         cursor: pointer;
         transition: background .15s;
     }

     .btn-schedule:hover {
         background: var(--paper);
     }

     .divider {
         display: flex;
         align-items: center;
         gap: 10px;
         color: var(--ink-faint);
         font-size: 12px;
         font-weight: 700;
     }

     .divider::before,
     .divider::after {
         content: '';
         flex: 1;
         height: 1px;
         background: var(--line);
     }

     /* ===== HISTORY PANEL ===== */
     .history-card {
         background: var(--white);
         border-radius: var(--radius-md);
         border: 1px solid var(--line);
         box-shadow: var(--shadow-card);
         overflow: hidden;
     }

     .history-head {
         padding: 16px 22px;
         border-bottom: 1px solid var(--line);
         display: flex;
         align-items: center;
         gap: 12px;
     }

     .history-title {
         font-family: 'Fraunces', serif;
         font-size: 15px;
         font-weight: 700;
     }

     /* toolbar inside history */
     .h-toolbar {
         display: flex;
         align-items: center;
         gap: 10px;
         padding: 14px 20px;
         border-bottom: 1px solid var(--line);
         flex-wrap: wrap;
     }

     .h-search {
         flex: 1;
         min-width: 180px;
         position: relative;
     }

     .h-search .icon {
         position: absolute;
         left: 12px;
         top: 50%;
         transform: translateY(-50%);
         color: var(--ink-faint);
         display: flex;
     }

     .h-search input {
         width: 100%;
         padding: 9px 12px 9px 35px;
         border-radius: 9px;
         border: 1.5px solid var(--line);
         background: var(--paper);
         font-size: 13px;
         font-family: inherit;
         color: var(--ink);
         outline: none;
         transition: border-color .15s;
     }

     .h-search input:focus {
         border-color: var(--coral);
     }

     .h-select {
         padding: 9px 12px;
         border-radius: 9px;
         border: 1.5px solid var(--line);
         background: var(--paper);
         font-size: 13px;
         font-family: inherit;
         color: var(--ink);
         outline: none;
         cursor: pointer;
     }

     /* notif list item */
     .notif-item {
         display: flex;
         align-items: flex-start;
         gap: 14px;
         padding: 16px 22px;
         border-bottom: 1px solid var(--line);
         transition: background .12s;
     }

     .notif-item:last-child {
         border-bottom: none;
     }

     .notif-item:hover {
         background: var(--paper);
     }

     .notif-type-icon {
         width: 40px;
         height: 40px;
         border-radius: 11px;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 18px;
         flex-shrink: 0;
     }

     .notif-info {
         flex: 1;
         min-width: 0;
     }

     .notif-info-top {
         display: flex;
         align-items: flex-start;
         gap: 8px;
         margin-bottom: 4px;
     }

     .notif-info-title {
         font-size: 14px;
         font-weight: 700;
         color: var(--ink);
         flex: 1;
     }

     .notif-info-body {
         font-size: 13px;
         color: var(--ink-soft);
         line-height: 1.5;
         margin-bottom: 8px;
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis;
         max-width: 100%;
     }

     .notif-meta {
         display: flex;
         align-items: center;
         gap: 10px;
         flex-wrap: wrap;
     }

     .notif-meta-item {
         font-size: 11.5px;
         color: var(--ink-faint);
         font-weight: 600;
         display: flex;
         align-items: center;
         gap: 4px;
     }

     .delivery-bar-wrap {
         display: flex;
         align-items: center;
         gap: 6px;
         margin-top: 8px;
     }

     .delivery-bar {
         flex: 1;
         height: 5px;
         border-radius: 999px;
         background: var(--line);
         overflow: hidden;
     }

     .delivery-fill {
         height: 100%;
         border-radius: 999px;
         background: linear-gradient(90deg, #FF7A52, var(--coral-deep));
     }

     .delivery-pct {
         font-size: 11.5px;
         font-weight: 800;
         color: var(--coral-deep);
         flex-shrink: 0;
     }

     /* action btn */
     .action-btns {
         display: flex;
         gap: 6px;
         flex-shrink: 0;
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

     .action-btn.resend:hover {
         background: #FDEDE7;
         color: var(--coral-deep);
         border-color: var(--coral);
     }

     .action-btn.delete:hover {
         background: var(--bad-bg);
         color: var(--bad);
         border-color: var(--bad);
     }

     /* pagination */
     .pagination {
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding: 14px 22px;
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

     /* schedule toggle */
     .schedule-toggle-wrap {
         display: flex;
         align-items: center;
         gap: 10px;
         padding: 12px 14px;
         border-radius: 10px;
         border: 1.5px solid var(--line);
         background: var(--paper);
         cursor: pointer;
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
         transition: background .2s;
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
         transition: transform .2s;
         box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
     }

     .toggle input:checked+.toggle-slider {
         background: var(--coral);
     }

     .toggle input:checked+.toggle-slider:before {
         transform: translateX(16px);
     }

     .schedule-fields {
         display: none;
         grid-template-columns: 1fr 1fr;
         gap: 10px;
     }

     .schedule-fields.visible {
         display: grid;
     }

     @media(max-width:1100px) {
         .notif-layout {
             grid-template-columns: 1fr;
         }

         .composer-card {
             position: static;
         }
     }

     @media(max-width:900px) {
         .notif-stats {
             grid-template-columns: repeat(2, 1fr);
         }
     }

     @media(max-width:560px) {
         .notif-stats {
             grid-template-columns: 1fr;
         }

         .audience-grid {
             grid-template-columns: 1fr;
         }
     }
 </style>

 <!-- PAGE HEADER -->
 <div class="page-head">
     <div>
         <p class="page-eyebrow">Management</p>
         <h1 class="page-title">Notifications</h1>
         <p class="page-sub">Compose and send push notifications, view delivery history and open rates.</p>
     </div>
 </div>

 <!-- STATS STRIP -->
 <div class="notif-stats">
     <div class="nstat">
         <div class="nstat-val">1,284</div>
         <div class="nstat-label">Sent This Month</div>
     </div>
     <div class="nstat">
         <div class="nstat-val" style="color:var(--coral-deep);">94.2%</div>
         <div class="nstat-label">Avg. Delivery Rate</div>
     </div>
     <div class="nstat">
         <div class="nstat-val" style="color:#2C8A4B;">38.7%</div>
         <div class="nstat-label">Avg. Open Rate</div>
     </div>
     <div class="nstat">
         <div class="nstat-val" style="color:#C9890B;">3</div>
         <div class="nstat-label">Scheduled</div>
     </div>
 </div>

 <!-- 2-COLUMN LAYOUT -->
 <div class="notif-layout">

     <!-- ============================================================
         LEFT: COMPOSER
         ============================================================ -->
     <div class="composer-card">
         <div class="composer-head">
             <div class="composer-head-title">✉ Compose Notification</div>
             <div class="composer-head-sub">Reaches users via push on iOS & Android</div>
         </div>

         <div class="composer-body">

             <!-- Notification Type -->
             <div class="form-group">
                 <label class="form-label">Type</label>
                 <div class="type-pills">
                     <button class="type-pill active" onclick="setType(this,'📣','Announcement')">📣
                         Announcement</button>
                     <button class="type-pill" onclick="setType(this,'🎲','Spin Reminder')">🎲 Spin Reminder</button>
                     <button class="type-pill" onclick="setType(this,'🏆','Challenge')">🏆 Challenge</button>
                     <button class="type-pill" onclick="setType(this,'🎉','Promo')">🎉 Promo</button>
                     <button class="type-pill" onclick="setType(this,'🔔','General')">🔔 General</button>
                 </div>
             </div>

             <!-- Title -->
             <div class="form-group">
                 <label class="form-label">Title <span>max 60 chars</span></label>
                 <input class="form-input" id="n-title" type="text" maxlength="60"
                     placeholder="e.g. New restaurants just dropped 🔥"
                     oninput="updatePreview(); countChars('n-title','n-title-count',60)">
                 <div class="char-count" id="n-title-count">0 / 60</div>
             </div>

             <!-- Message -->
             <div class="form-group">
                 <label class="form-label">Message <span>max 160 chars</span></label>
                 <textarea class="form-input" id="n-msg" maxlength="160"
                     placeholder="Write your push notification message here…"
                     oninput="updatePreview(); countChars('n-msg','n-msg-count',160)"></textarea>
                 <div class="char-count" id="n-msg-count">0 / 160</div>
             </div>

             <!-- Live Preview -->
             <div class="form-group">
                 <label class="form-label">Preview</label>
                 <div class="phone-preview">
                     <div class="phone-notif-icon" id="prev-icon">📣</div>
                     <div class="phone-notif-body">
                         <div class="phone-notif-app">Foody · Now</div>
                         <div class="phone-notif-title" id="prev-title">Your notification title</div>
                         <div class="phone-notif-msg" id="prev-msg">Your message will appear here…</div>
                     </div>
                     <div class="phone-notif-time">now</div>
                 </div>
             </div>

             <!-- Audience -->
             <div class="form-group">
                 <label class="form-label">Audience</label>
                 <div class="audience-grid">
                     <label class="aud-chip selected" onclick="selectAud(this)">
                         <input type="radio" name="audience" value="all" checked>
                         <span class="aud-chip-icon">👥</span>
                         <div>
                             <div class="aud-chip-label">All Users</div>
                             <div class="aud-chip-count">4,812 recipients</div>
                         </div>
                     </label>
                     <label class="aud-chip" onclick="selectAud(this)">
                         <input type="radio" name="audience" value="active">
                         <span class="aud-chip-icon">✅</span>
                         <div>
                             <div class="aud-chip-label">Active Only</div>
                             <div class="aud-chip-count">4,541 recipients</div>
                         </div>
                     </label>
                     <label class="aud-chip" onclick="selectAud(this)">
                         <input type="radio" name="audience" value="karachi">
                         <span class="aud-chip-icon">📍</span>
                         <div>
                             <div class="aud-chip-label">Karachi</div>
                             <div class="aud-chip-count">2,841 recipients</div>
                         </div>
                     </label>
                     <label class="aud-chip" onclick="selectAud(this)">
                         <input type="radio" name="audience" value="lahore">
                         <span class="aud-chip-icon">📍</span>
                         <div>
                             <div class="aud-chip-label">Lahore</div>
                             <div class="aud-chip-count">1,204 recipients</div>
                         </div>
                     </label>
                 </div>
             </div>

             <!-- Schedule Toggle -->
             <div class="form-group">
                 <label class="form-label">Schedule</label>
                 <div class="schedule-toggle-wrap" onclick="toggleSchedule()">
                     <label class="toggle" onclick="event.stopPropagation()">
                         <input type="checkbox" id="schedToggle" onchange="toggleSchedule()">
                         <span class="toggle-slider"></span>
                     </label>
                     <span style="font-size:13.5px; font-weight:700; color:var(--ink);">Schedule for later</span>
                 </div>
                 <div class="schedule-fields" id="schedFields">
                     <div class="form-group">
                         <label class="form-label" style="margin-top:4px;">Date</label>
                         <input class="form-input" type="date" id="sched-date">
                     </div>
                     <div class="form-group">
                         <label class="form-label" style="margin-top:4px;">Time</label>
                         <input class="form-input" type="time" id="sched-time">
                     </div>
                 </div>
             </div>

             <div class="divider">or send now</div>

             <!-- Send Button -->
             <button class="btn-send" onclick="sendNotification()">
                 <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                     <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" />
                     <path d="M22 2L15 22l-4-9-9-4 20-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" />
                 </svg>
                 Send Now
             </button>

         </div>
     </div>

     <!-- ============================================================
         RIGHT: HISTORY
         ============================================================ -->
     <div class="history-card">
         <div class="history-head">
             <div class="history-title">📋 Sent History</div>
             <span style="font-size:12px; color:var(--ink-soft); margin-left:4px;">1,284 notifications</span>
         </div>

         <div class="h-toolbar">
             <div class="h-search">
                 <span class="icon">
                     <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                         <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                         <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                     </svg>
                 </span>
                 <input type="text" placeholder="Search notifications…" oninput="filterNotifs(this.value)">
             </div>
             <select class="h-select" onchange="filterNotifs('')">
                 <option>All Types</option>
                 <option>Announcement</option>
                 <option>Spin Reminder</option>
                 <option>Challenge</option>
                 <option>Promo</option>
                 <option>General</option>
             </select>
             <select class="h-select">
                 <option>Newest First</option>
                 <option>Oldest First</option>
                 <option>Best Open Rate</option>
             </select>
         </div>

         <!-- Notification history list -->
         <div id="notifList">
             <?php
$history = [
  ['📣','Announcement', '#FDEDE7','#E8431F',
   'New Restaurants This Week 🔥',
   'Check out 12 newly added venues across Karachi, Lahore and Islamabad. Spin to discover!',
   'All Users','4,812','4,601','94.2%','42.1%','Jun 28, 2025 · 7:00 PM', false],

  ['🏆','Challenge', '#FBF1D9','#C9890B',
   'New Challenge: Try 3 Cuisines 🌮',
   'A new challenge just dropped. Complete it before July 31 and earn 150 bonus points!',
   'Active Users','4,541','4,388','96.6%','51.3%','Jun 26, 2025 · 12:00 PM', false],

  ['🎲','Spin Reminder', '#E7F5EA','#2C8A4B',
   'Haven\'t spun today? Let\'s go! 🎲',
   'You\'ve been away for 3 days. Your next restaurant adventure is just one spin away.',
   'Inactive 3d+','1,203','1,140','94.8%','38.7%','Jun 24, 2025 · 6:00 PM', false],

  ['🎉','Promo', '#EEE9FC','#5B3FBB',
   'Ramadan Special — Iftar Spots 🌙',
   'Discover the best iftar restaurants near you. Limited time recommendations inside.',
   'All Users','4,812','4,499','93.5%','61.8%','Jun 20, 2025 · 3:30 PM', false],

  ['🔔','General', '#E9F4FB','#1A7FB5',
   'App Update Available v2.4 ✨',
   'We\'ve improved the spin experience and added new filters. Update now for the best experience.',
   'All Users','4,812','4,590','95.4%','29.4%','Jun 15, 2025 · 10:00 AM', false],

  ['🏆','Challenge', '#FBF1D9','#C9890B',
   'Challenge Ending Soon ⏰',
   'Only 2 days left to complete "Visit 5 Venues" and claim your 300 points reward!',
   'Active Users','4,541','4,202','92.5%','47.2%','Jun 10, 2025 · 9:00 AM', false],

  ['📣','Announcement', '#FDEDE7','#E8431F',
   'Islamabad is Live! 🎉',
   'Foody is now available in Islamabad. Welcome all Isloo foodies to the family!',
   'All Users','4,812','4,688','97.4%','73.5%','Jun 1, 2025 · 11:00 AM', false],

  ['🎲','Spin Reminder', '#E7F5EA','#2C8A4B',
   'Weekend plans? Let Foody decide 🎯',
   'Stop scrolling and start spinning. Your perfect restaurant is waiting.',
   'Active Users','4,541','4,310','94.9%','44.8%','May 31, 2025 · 5:00 PM', true],
];

foreach($history as $i => $n):
    $openPct = (int) $n[9];
    $delPct  = (int) $n[8];
    $isScheduled = $n[12];
?>
             <div class="notif-item" data-search="<?php echo strtolower($n[4].' '.$n[5]); ?>">
                 <div class="notif-type-icon" style="background:<?php echo $n[2]; ?>; color:<?php echo $n[3]; ?>;">
                     <?php echo $n[0]; ?>
                 </div>
                 <div class="notif-info">
                     <div class="notif-info-top">
                         <div class="notif-info-title"><?php echo htmlspecialchars($n[4]); ?></div>
                         <?php if($isScheduled): ?>
                         <span class="badge badge-warn" style="white-space:nowrap; font-size:11px;">🕐 Scheduled</span>
                         <?php else: ?>
                         <span class="badge badge-good" style="white-space:nowrap; font-size:11px;">✓ Sent</span>
                         <?php endif; ?>
                     </div>
                     <div class="notif-info-body"><?php echo htmlspecialchars($n[5]); ?></div>
                     <div class="notif-meta">
                         <span class="notif-meta-item">
                             <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                 <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" />
                                 <circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" />
                                 <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" /></svg>
                             <?php echo $n[6]; ?> · <?php echo number_format((int)$n[7]); ?>
                         </span>
                         <span class="notif-meta-item">
                             <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                 <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                                 <polyline points="12 6 12 12 16 14" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" /></svg>
                             <?php echo $n[11]; ?>
                         </span>
                         <span class="notif-meta-item"
                             style="color:<?php echo $n[1]==='Challenge'?'#C9890B':($n[1]==='Promo'?'#5B3FBB':'var(--ink-faint)'); ?>">
                             <?php echo $n[0]; ?> <?php echo $n[1]; ?>
                         </span>
                     </div>
                     <?php if(!$isScheduled): ?>
                     <div style="margin-top:8px;">
                         <div style="display:flex; justify-content:space-between; margin-bottom:4px;">
                             <span style="font-size:11px; font-weight:700; color:var(--ink-faint);">Delivered
                                 <?php echo $n[8]; ?> · Open rate <?php echo $n[9]; ?></span>
                         </div>
                         <div class="delivery-bar-wrap">
                             <div class="delivery-bar">
                                 <div class="delivery-fill" style="width:<?php echo $openPct; ?>%;"></div>
                             </div>
                             <span class="delivery-pct"><?php echo $n[9]; ?></span>
                         </div>
                     </div>
                     <?php endif; ?>
                 </div>
                 <div class="action-btns" style="margin-top:2px;">
                     <button class="action-btn resend" title="Resend / duplicate"
                         onclick="duplicateNotif('<?php echo addslashes($n[4]); ?>', '<?php echo addslashes($n[5]); ?>')">
                         <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                             <path d="M1 4v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                 stroke-linejoin="round" />
                             <path d="M3.51 15a9 9 0 1 0 .49-4.95L1 10" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round" />
                         </svg>
                     </button>
                     <button class="action-btn delete" title="Delete"
                         onclick="deleteNotif('<?php echo addslashes($n[4]); ?>')">
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
             </div>
             <?php endforeach; ?>
         </div>

         <div class="pagination">
             <span>Showing <strong>1–8</strong> of <strong>1,284</strong> notifications</span>
             <div class="page-btns">
                 <button class="page-btn">‹</button>
                 <button class="page-btn active">1</button>
                 <button class="page-btn">2</button>
                 <button class="page-btn">3</button>
                 <button class="page-btn">…</button>
                 <button class="page-btn">161</button>
                 <button class="page-btn">›</button>
             </div>
         </div>
     </div>

 </div><!-- /notif-layout -->

 <?php
$extraScripts = <<<'JS'
<script>
/* ===== TYPE PILLS ===== */
let currentIcon  = '📣';

function setType(btn, icon, label) {
    document.querySelectorAll('.type-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentIcon = icon;
    updatePreview();
}

/* ===== AUDIENCE ===== */
function selectAud(label) {
    document.querySelectorAll('.aud-chip').forEach(c => c.classList.remove('selected'));
    label.classList.add('selected');
}

/* ===== CHAR COUNT ===== */
function countChars(inputId, countId, max) {
    const len = document.getElementById(inputId).value.length;
    const el  = document.getElementById(countId);
    el.textContent = len + ' / ' + max;
    el.className = 'char-count' + (len > max * 0.9 ? (len >= max ? ' over' : ' warn') : '');
}

/* ===== LIVE PREVIEW ===== */
function updatePreview() {
    const title = document.getElementById('n-title').value || 'Your notification title';
    const msg   = document.getElementById('n-msg').value   || 'Your message will appear here…';
    document.getElementById('prev-icon').textContent  = currentIcon;
    document.getElementById('prev-title').textContent = title;
    document.getElementById('prev-msg').textContent   = msg;
}

/* ===== SCHEDULE TOGGLE ===== */
function toggleSchedule() {
    const cb     = document.getElementById('schedToggle');
    const fields = document.getElementById('schedFields');
    if (event.target !== cb) cb.checked = !cb.checked;
    fields.classList.toggle('visible', cb.checked);
}

/* ===== SEND ===== */
function sendNotification() {
    const title = document.getElementById('n-title').value.trim();
    const msg   = document.getElementById('n-msg').value.trim();
    if (!title) { alert('Please enter a notification title.'); return; }
    if (!msg)   { alert('Please enter a message.'); return; }
    const scheduled = document.getElementById('schedToggle').checked;
    const action = scheduled ? 'scheduled' : 'sent';
    alert('Notification ' + action + '! (Wire to your push provider — FCM / APNs.)');
}

/* ===== DUPLICATE ===== */
function duplicateNotif(title, msg) {
    document.getElementById('n-title').value = title;
    document.getElementById('n-msg').value   = msg;
    updatePreview();
    countChars('n-title', 'n-title-count', 60);
    countChars('n-msg',   'n-msg-count',  160);
    document.querySelector('.composer-card').scrollIntoView({ behavior: 'smooth' });
}

/* ===== FILTER HISTORY ===== */
function filterNotifs(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#notifList .notif-item').forEach(item => {
        item.style.display = (!q || item.dataset.search.includes(q)) ? '' : 'none';
    });
}

/* ===== DELETE ===== */
function deleteNotif(title) {
    if (confirm('Delete "' + title + '" from history?')) {
        alert('Deleted. (Wire to your backend.)');
    }
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>