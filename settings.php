 <?php
$pageTitle  = 'Settings';
$activePage = 'settings';
include __DIR__ . '/includes/header.php';
?>

 <style>
     /* ===== SETTINGS LAYOUT ===== */
     .settings-layout {
         display: grid;
         grid-template-columns: 220px 1fr;
         gap: 20px;
         align-items: start;
     }

     /* ===== SIDEBAR NAV ===== */
     .settings-nav {
         background: var(--white);
         border-radius: var(--radius-md);
         border: 1px solid var(--line);
         box-shadow: var(--shadow-card);
         overflow: hidden;
         position: sticky;
         top: 24px;
     }

     .settings-nav-head {
         padding: 14px 16px;
         border-bottom: 1px solid var(--line);
         font-size: 11px;
         font-weight: 800;
         letter-spacing: .1em;
         text-transform: uppercase;
         color: var(--ink-soft);
     }

     .snav-item {
         display: flex;
         align-items: center;
         gap: 10px;
         padding: 11px 16px;
         font-size: 13.5px;
         font-weight: 700;
         color: var(--ink-soft);
         cursor: pointer;
         border-left: 3px solid transparent;
         transition: background .12s, color .12s, border-color .12s;
         text-decoration: none;
     }

     .snav-item:hover {
         background: var(--paper);
         color: var(--ink);
     }

     .snav-item.active {
         background: #FDEDE7;
         color: var(--coral-deep);
         border-left-color: var(--coral);
     }

     .snav-icon {
         font-size: 15px;
         flex-shrink: 0;
     }

     /* ===== SETTINGS PANEL ===== */
     .settings-panel {
         display: none;
     }

     .settings-panel.active {
         display: flex;
         flex-direction: column;
         gap: 20px;
     }

     /* ===== SECTION CARD ===== */
     .setting-card {
         background: var(--white);
         border-radius: var(--radius-md);
         border: 1px solid var(--line);
         box-shadow: var(--shadow-card);
         overflow: hidden;
     }

     .setting-card-head {
         padding: 18px 24px 16px;
         border-bottom: 1px solid var(--line);
         display: flex;
         align-items: center;
         gap: 12px;
     }

     .setting-card-icon {
         width: 36px;
         height: 36px;
         border-radius: 10px;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 17px;
         flex-shrink: 0;
     }

     .setting-card-title {
         font-family: 'Fraunces', serif;
         font-size: 15px;
         font-weight: 700;
         color: var(--ink);
     }

     .setting-card-sub {
         font-size: 12px;
         color: var(--ink-soft);
         margin-top: 2px;
     }

     .setting-card-body {
         padding: 0;
     }

     /* setting row */
     .setting-row {
         display: flex;
         align-items: center;
         gap: 16px;
         padding: 16px 24px;
         border-bottom: 1px solid var(--line);
         transition: background .12s;
     }

     .setting-row:last-child {
         border-bottom: none;
     }

     .setting-row:hover {
         background: var(--paper);
     }

     .setting-info {
         flex: 1;
         min-width: 0;
     }

     .setting-label {
         font-size: 14px;
         font-weight: 700;
         color: var(--ink);
         margin-bottom: 3px;
     }

     .setting-desc {
         font-size: 12.5px;
         color: var(--ink-soft);
         line-height: 1.45;
     }

     .setting-control {
         flex-shrink: 0;
     }

     /* form inputs */
     .form-input {
         padding: 9px 13px;
         border-radius: 9px;
         border: 1.5px solid var(--line);
         background: var(--white);
         font-size: 13.5px;
         font-family: inherit;
         color: var(--ink);
         outline: none;
         transition: border-color .15s, box-shadow .15s;
     }

     .form-input:focus {
         border-color: var(--coral);
         box-shadow: 0 0 0 4px rgba(255, 90, 60, 0.10);
     }

     .input-with-suffix {
         display: flex;
         align-items: center;
         gap: 0;
         border-radius: 9px;
         border: 1.5px solid var(--line);
         overflow: hidden;
         transition: border-color .15s, box-shadow .15s;
     }

     .input-with-suffix:focus-within {
         border-color: var(--coral);
         box-shadow: 0 0 0 4px rgba(255, 90, 60, 0.10);
     }

     .input-with-suffix input {
         padding: 9px 12px;
         border: none;
         background: var(--white);
         font-size: 13.5px;
         font-family: inherit;
         color: var(--ink);
         outline: none;
         width: 90px;
     }

     .input-suffix {
         padding: 9px 12px;
         background: var(--paper);
         font-size: 12.5px;
         font-weight: 700;
         color: var(--ink-soft);
         border-left: 1px solid var(--line);
         white-space: nowrap;
     }

     /* toggle */
     .toggle {
         position: relative;
         display: inline-block;
         width: 42px;
         height: 24px;
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
         height: 18px;
         width: 18px;
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
         transform: translateX(18px);
     }

     /* color pick inline */
     .color-preview-box {
         width: 36px;
         height: 36px;
         border-radius: 8px;
         border: 2px solid var(--line);
         cursor: pointer;
         flex-shrink: 0;
     }

     /* select */
     select.form-input {
         cursor: pointer;
         padding-right: 28px;
     }

     /* save bar */
     .save-bar {
         position: fixed;
         bottom: 0;
         left: 0;
         right: 0;
         background: var(--white);
         border-top: 1px solid var(--line);
         padding: 14px 28px;
         display: none;
         align-items: center;
         justify-content: flex-end;
         gap: 12px;
         z-index: 40;
         box-shadow: 0 -8px 24px rgba(36, 23, 18, 0.08);
     }

     .save-bar.visible {
         display: flex;
     }

     .save-bar-msg {
         font-size: 13.5px;
         font-weight: 700;
         color: var(--ink-soft);
         flex: 1;
         display: flex;
         align-items: center;
         gap: 8px;
     }

     .btn-discard {
         padding: 10px 20px;
         border-radius: 10px;
         border: 1.5px solid var(--line);
         background: var(--white);
         font-size: 14px;
         font-weight: 700;
         font-family: inherit;
         color: var(--ink-soft);
         cursor: pointer;
     }

     .btn-save-settings {
         padding: 10px 24px;
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

     /* ===== ROLES TABLE ===== */
     .toolbar {
         display: flex;
         align-items: center;
         gap: 12px;
         padding: 14px 20px;
         border-bottom: 1px solid var(--line);
         flex-wrap: wrap;
     }

     .toolbar-search {
         flex: 1;
         min-width: 180px;
         position: relative;
     }

     .toolbar-search .icon {
         position: absolute;
         left: 12px;
         top: 50%;
         transform: translateY(-50%);
         color: var(--ink-faint);
         display: flex;
     }

     .toolbar-search input {
         width: 100%;
         padding: 9px 12px 9px 34px;
         border-radius: 9px;
         border: 1.5px solid var(--line);
         background: var(--paper);
         font-size: 13px;
         font-family: inherit;
         color: var(--ink);
         outline: none;
         transition: border-color .15s;
     }

     .toolbar-search input:focus {
         border-color: var(--coral);
     }

     .btn-add {
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

     /* admin avatar */
     .admin-avatar {
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

     /* permission chips */
     .perm-chips {
         display: flex;
         gap: 5px;
         flex-wrap: wrap;
     }

     .perm-chip {
         padding: 3px 9px;
         border-radius: 999px;
         font-size: 11px;
         font-weight: 700;
     }

     .perm-all {
         background: #FDEDE7;
         color: #E8431F;
         border: 1px solid #F6C7B6;
     }

     .perm-view {
         background: #E9F4FB;
         color: #1A7FB5;
         border: 1px solid #BDDAF0;
     }

     .perm-mod {
         background: #FBF1D9;
         color: #7A5300;
         border: 1px solid #E8C46A;
     }

     .perm-notif {
         background: #EEE9FC;
         color: #5B3FBB;
         border: 1px solid #C8BDF2;
     }

     .perm-venues {
         background: #E7F5EA;
         color: #2C8A4B;
         border: 1px solid #B9DEC2;
     }

     /* action buttons */
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

     /* danger zone */
     .danger-row {
         display: flex;
         align-items: center;
         gap: 16px;
         padding: 16px 24px;
         border-bottom: 1px solid var(--line);
     }

     .danger-row:last-child {
         border-bottom: none;
     }

     .btn-danger-outline {
         padding: 9px 18px;
         border-radius: 9px;
         border: 1.5px solid var(--bad);
         background: var(--bad-bg);
         color: var(--bad);
         font-size: 13.5px;
         font-weight: 700;
         font-family: inherit;
         cursor: pointer;
         white-space: nowrap;
         transition: background .15s;
         flex-shrink: 0;
     }

     .btn-danger-outline:hover {
         background: #f9cfc9;
     }

     /* ===== ADMIN MODAL ===== */
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
         max-width: 500px;
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

     .form-row {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 14px;
     }

     /* permission checkboxes */
     .perm-grid {
         display: grid;
         grid-template-columns: 1fr 1fr;
         gap: 8px;
     }

     .perm-check {
         display: flex;
         align-items: center;
         gap: 8px;
         padding: 9px 12px;
         border-radius: 9px;
         border: 1.5px solid var(--line);
         cursor: pointer;
         font-size: 13px;
         font-weight: 700;
         color: var(--ink);
         transition: background .12s, border-color .12s;
     }

     .perm-check input {
         accent-color: var(--coral);
         width: 15px;
         height: 15px;
         cursor: pointer;
     }

     .perm-check:has(input:checked) {
         background: #FDEDE7;
         border-color: var(--coral);
         color: var(--coral-deep);
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

     @media(max-width:900px) {
         .settings-layout {
             grid-template-columns: 1fr;
         }

         .settings-nav {
             position: static;
         }
     }

     @media(max-width:560px) {
         .form-row {
             grid-template-columns: 1fr;
         }

         .perm-grid {
             grid-template-columns: 1fr;
         }
     }
 </style>

 <!-- PAGE HEADER -->
 <div class="page-head">
     <div>
         <p class="page-eyebrow">Configuration</p>
         <h1 class="page-title">Settings</h1>
         <p class="page-sub">App-level configuration, admin roles and permissions.</p>
     </div>
 </div>

 <div class="settings-layout">

     <!-- ============================================================
         SIDEBAR NAV
         ============================================================ -->
     <div class="settings-nav">
         <div class="settings-nav-head">Settings</div>
         <a class="snav-item active" onclick="showPanel('general', this)">
             <span class="snav-icon">⚙️</span> General
         </a>
         <a class="snav-item" onclick="showPanel('discovery', this)">
             <span class="snav-icon">🔍</span> Discovery
         </a>
         <a class="snav-item" onclick="showPanel('games', this)">
             <span class="snav-icon">🎲</span> Games
         </a>
         <a class="snav-item" onclick="showPanel('notifications', this)">
             <span class="snav-icon">🔔</span> Notifications
         </a>
         <a class="snav-item" onclick="showPanel('admins', this)">
             <span class="snav-icon">👤</span> Admins & Roles
         </a>
         <a class="snav-item" onclick="showPanel('danger', this)">
             <span class="snav-icon">⚠️</span> Danger Zone
         </a>
     </div>

     <!-- ============================================================
         PANELS
         ============================================================ -->
     <div>

         <!-- ===== GENERAL ===== -->
         <div class="settings-panel active" id="panel-general">
             <div class="setting-card">
                 <div class="setting-card-head">
                     <div class="setting-card-icon" style="background:#FDEDE7;">⚙️</div>
                     <div>
                         <div class="setting-card-title">General</div>
                         <div class="setting-card-sub">App name, branding and basic configuration</div>
                     </div>
                 </div>
                 <div class="setting-card-body">
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">App Name</div>
                             <div class="setting-desc">Shown in push notifications and across the app.</div>
                         </div>
                         <div class="setting-control">
                             <input class="form-input" type="text" value="Foody" style="width:180px;"
                                 onchange="markDirty()">
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Tagline</div>
                             <div class="setting-desc">Short description shown on the onboarding screen.</div>
                         </div>
                         <div class="setting-control">
                             <input class="form-input" type="text" value="Spin. Eat. Explore." style="width:220px;"
                                 onchange="markDirty()">
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Primary Colour</div>
                             <div class="setting-desc">Used for buttons, accents and highlights app-wide.</div>
                         </div>
                         <div class="setting-control" style="display:flex; align-items:center; gap:10px;">
                             <input type="color" value="#E8431F" class="color-preview-box" style="padding:2px;"
                                 onchange="markDirty()">
                             <input class="form-input" type="text" value="#E8431F"
                                 style="width:100px; font-family:monospace;" onchange="markDirty()">
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Default Language</div>
                             <div class="setting-desc">Primary language for new users before they set their own.</div>
                         </div>
                         <div class="setting-control">
                             <select class="form-input" style="width:180px;" onchange="markDirty()">
                                 <option selected>English</option>
                                 <option>Urdu</option>
                                 <option>Arabic</option>
                             </select>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Maintenance Mode</div>
                             <div class="setting-desc">Show a maintenance screen to all users. Admins can still log in.
                             </div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">New User Registrations</div>
                             <div class="setting-desc">Allow new users to sign up. Disable to close registrations
                                 temporarily.</div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- ===== DISCOVERY ===== -->
         <div class="settings-panel" id="panel-discovery">
             <div class="setting-card">
                 <div class="setting-card-head">
                     <div class="setting-card-icon" style="background:#E9F4FB;">🔍</div>
                     <div>
                         <div class="setting-card-title">Discovery Settings</div>
                         <div class="setting-card-sub">Search radius, location and venue filters</div>
                     </div>
                 </div>
                 <div class="setting-card-body">
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Default Search Radius</div>
                             <div class="setting-desc">Distance used when a user hasn't set their own radius preference.
                             </div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="5" min="1" max="50" onchange="markDirty()">
                                 <span class="input-suffix">km</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Maximum Search Radius</div>
                             <div class="setting-desc">The furthest distance a user can extend their search to.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="50" min="5" max="200" onchange="markDirty()">
                                 <span class="input-suffix">km</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Results Per Spin</div>
                             <div class="setting-desc">Number of venue candidates Foody picks from per spin.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="10" min="3" max="50" onchange="markDirty()">
                                 <span class="input-suffix">venues</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Minimum Venue Rating</div>
                             <div class="setting-desc">Venues below this rating are excluded from spin results.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="3.5" min="1" max="5" step="0.5" onchange="markDirty()">
                                 <span class="input-suffix">★</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Show Closed Venues</div>
                             <div class="setting-desc">Include currently-closed venues in spin results with a "Closed"
                                 label.</div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Location Services Required</div>
                             <div class="setting-desc">Block access to Quick Pick and Street Walk if location is denied.
                             </div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Active Cities</div>
                             <div class="setting-desc">Cities where Foody is currently live and searchable.</div>
                         </div>
                         <div class="setting-control">
                             <select class="form-input" multiple style="width:200px; height:90px;"
                                 onchange="markDirty()">
                                 <option selected>Karachi</option>
                                 <option selected>Lahore</option>
                                 <option selected>Islamabad</option>
                                 <option>Rawalpindi</option>
                                 <option>Faisalabad</option>
                                 <option>Peshawar</option>
                             </select>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- ===== GAMES ===== -->
         <div class="settings-panel" id="panel-games">
             <div class="setting-card">
                 <div class="setting-card-head">
                     <div class="setting-card-icon" style="background:#FBF1D9;">🎲</div>
                     <div>
                         <div class="setting-card-title">Games & Points</div>
                         <div class="setting-card-sub">Spin limits, Street Walk rules and points economy</div>
                     </div>
                 </div>
                 <div class="setting-card-body">
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Daily Spin Limit</div>
                             <div class="setting-desc">Max Quick Pick / Bar Roulette spins per user per day.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="20" min="1" max="100" onchange="markDirty()">
                                 <span class="input-suffix">spins</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Points per Spin</div>
                             <div class="setting-desc">Base points awarded each time a user completes a spin.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="10" min="1" onchange="markDirty()">
                                 <span class="input-suffix">pts</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Check-in Bonus</div>
                             <div class="setting-desc">Extra points for visiting and checking into the spun venue.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="25" min="0" onchange="markDirty()">
                                 <span class="input-suffix">pts</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Review Bonus</div>
                             <div class="setting-desc">Points earned when a user leaves a review after a visit.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="15" min="0" onchange="markDirty()">
                                 <span class="input-suffix">pts</span>
                             </div>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Street Walk Enabled</div>
                             <div class="setting-desc">Allow users to start Street Walk sessions from the home screen.
                             </div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Bar Roulette Enabled</div>
                             <div class="setting-desc">Show the Bar Roulette mode on the spin screen.</div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Streak Multiplier</div>
                             <div class="setting-desc">Points multiplier applied after a 7-day consecutive check-in
                                 streak.</div>
                         </div>
                         <div class="setting-control">
                             <div class="input-with-suffix">
                                 <input type="number" value="2" min="1" max="5" step="0.5" onchange="markDirty()">
                                 <span class="input-suffix">×</span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- ===== NOTIFICATIONS SETTINGS ===== -->
         <div class="settings-panel" id="panel-notifications">
             <div class="setting-card">
                 <div class="setting-card-head">
                     <div class="setting-card-icon" style="background:#EEE9FC;">🔔</div>
                     <div>
                         <div class="setting-card-title">Notification Defaults</div>
                         <div class="setting-card-sub">Global push and email notification settings</div>
                     </div>
                 </div>
                 <div class="setting-card-body">
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Push Notifications</div>
                             <div class="setting-desc">Master switch for all outbound push notifications to users.</div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Spin Reminder Frequency</div>
                             <div class="setting-desc">How long a user must be inactive before receiving a re-engagement
                                 nudge.</div>
                         </div>
                         <div class="setting-control">
                             <select class="form-input" style="width:180px;" onchange="markDirty()">
                                 <option>After 1 day</option>
                                 <option selected>After 3 days</option>
                                 <option>After 7 days</option>
                                 <option>After 14 days</option>
                                 <option>Never</option>
                             </select>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Quiet Hours</div>
                             <div class="setting-desc">No push notifications will be sent during these hours (local
                                 time).</div>
                         </div>
                         <div class="setting-control" style="display:flex; align-items:center; gap:8px;">
                             <input class="form-input" type="time" value="23:00" style="width:110px;"
                                 onchange="markDirty()">
                             <span style="font-size:12.5px; color:var(--ink-soft); font-weight:700;">to</span>
                             <input class="form-input" type="time" value="08:00" style="width:110px;"
                                 onchange="markDirty()">
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">Challenge Alert</div>
                             <div class="setting-desc">Automatically notify users 48 hours before a challenge deadline.
                             </div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                     <div class="setting-row">
                         <div class="setting-info">
                             <div class="setting-label">New Venue Alert</div>
                             <div class="setting-desc">Notify nearby users when a new venue is added in their city.
                             </div>
                         </div>
                         <div class="setting-control">
                             <label class="toggle">
                                 <input type="checkbox" checked onchange="markDirty()">
                                 <span class="toggle-slider"></span>
                             </label>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- ===== ADMINS & ROLES ===== -->
         <div class="settings-panel" id="panel-admins">
             <div class="setting-card">
                 <div class="setting-card-head">
                     <div class="setting-card-icon" style="background:#FCE8F3;">👤</div>
                     <div>
                         <div class="setting-card-title">Admins & Roles</div>
                         <div class="setting-card-sub">Manage who can access the dashboard and what they can do</div>
                     </div>
                 </div>

                 <div class="toolbar">
                     <div class="toolbar-search">
                         <span class="icon">
                             <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                 <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8" />
                                 <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" />
                             </svg>
                         </span>
                         <input type="text" placeholder="Search admins…" oninput="filterAdmins(this.value)">
                     </div>
                     <button class="btn-add" onclick="openAdminModal()">
                         <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                             <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                         </svg>
                         Invite Admin
                     </button>
                 </div>

                 <table class="table" style="margin:0;">
                     <thead>
                         <tr>
                             <th style="padding-left:22px;">Admin</th>
                             <th>Role</th>
                             <th>Permissions</th>
                             <th>Last Active</th>
                             <th>Status</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tbody id="adminBody">
                         <?php
$avatarColors = [
    ['bg'=>'#FDEDE7','fg'=>'#E8431F'],
    ['bg'=>'#E7F5EA','fg'=>'#2C8A4B'],
    ['bg'=>'#EEE9FC','fg'=>'#5B3FBB'],
    ['bg'=>'#FBF1D9','fg'=>'#C9890B'],
    ['bg'=>'#E9F4FB','fg'=>'#1A7FB5'],
    ['bg'=>'#FCE8F3','fg'=>'#A0306F'],
];
$admins = [
    ['Zain Hussain',   'zain@foody.pk',        'Super Admin',   ['All Access'],                       'Just now',    'Active'],
    ['Sara Malik',     'sara@foody.pk',         'Content Admin', ['Venues','Reviews','Tags'],           '2h ago',     'Active'],
    ['Ali Khan',       'ali@foody.pk',          'Moderator',     ['Reviews','Users'],                  '1d ago',     'Active'],
    ['Rida Hassan',    'rida@foody.pk',         'Marketing',     ['Notifications','Analytics'],        '3d ago',     'Active'],
    ['Hamza Siddiqui', 'hamza@foody.pk',        'Read Only',     ['View Only'],                        '1w ago',     'Active'],
    ['Nadia Jamil',    'nadia@agency.com',      'Guest Admin',   ['View Only'],                        '2w ago',     'Inactive'],
];
$permClass = ['All Access'=>'perm-all','View Only'=>'perm-view','Reviews'=>'perm-mod','Users'=>'perm-mod',
              'Venues'=>'perm-venues','Tags'=>'perm-venues','Notifications'=>'perm-notif','Analytics'=>'perm-view'];
foreach($admins as $i => $a):
    $ac   = $avatarColors[$i % count($avatarColors)];
    $init = strtoupper(substr($a[0],0,1)).strtoupper(substr(strstr($a[0],' '),1,1));
    $isSuperAdmin = $i === 0;
?>
                         <tr data-search="<?php echo strtolower($a[0].' '.$a[1]); ?>">
                             <td style="padding-left:22px;">
                                 <div style="display:flex; align-items:center; gap:10px;">
                                     <div class="admin-avatar"
                                         style="background:<?php echo $ac['bg'];?>; color:<?php echo $ac['fg'];?>;">
                                         <?php echo $init;?></div>
                                     <div>
                                         <div style="font-weight:700; font-size:14px;"><?php echo $a[0];?></div>
                                         <div style="font-size:11.5px; color:var(--ink-soft);"><?php echo $a[1];?></div>
                                     </div>
                                 </div>
                             </td>
                             <td style="font-weight:700; font-size:13.5px;"><?php echo $a[2];?></td>
                             <td>
                                 <div class="perm-chips">
                                     <?php foreach($a[3] as $p): $pc = $permClass[$p] ?? 'perm-view'; ?>
                                     <span class="perm-chip <?php echo $pc;?>"><?php echo $p;?></span>
                                     <?php endforeach;?>
                                 </div>
                             </td>
                             <td style="font-size:13px; color:var(--ink-soft);"><?php echo $a[4];?></td>
                             <td><span
                                     class="badge <?php echo $a[5]==='Active'?'badge-good':'badge-warn';?>"><?php echo $a[5];?></span>
                             </td>
                             <td>
                                 <?php if(!$isSuperAdmin): ?>
                                 <div class="action-btns">
                                     <button class="action-btn edit" title="Edit permissions"
                                         onclick="openAdminModal('<?php echo addslashes($a[0]);?>', '<?php echo $a[1];?>', '<?php echo $a[2];?>')">
                                         <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                             <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                             <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                         </svg>
                                     </button>
                                     <button class="action-btn delete" title="Remove admin"
                                         onclick="removeAdmin('<?php echo addslashes($a[0]);?>')">
                                         <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                             <polyline points="3 6 5 6 21 6" stroke="currentColor" stroke-width="1.8"
                                                 stroke-linecap="round" />
                                             <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"
                                                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                                 stroke-linejoin="round" />
                                             <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8"
                                                 stroke-linecap="round" />
                                         </svg>
                                     </button>
                                 </div>
                                 <?php else: ?>
                                 <span style="font-size:12px; color:var(--ink-faint); font-weight:700;">Owner</span>
                                 <?php endif;?>
                             </td>
                         </tr>
                         <?php endforeach;?>
                     </tbody>
                 </table>
             </div>
         </div>

         <!-- ===== DANGER ZONE ===== -->
         <div class="settings-panel" id="panel-danger">
             <div class="setting-card">
                 <div class="setting-card-head">
                     <div class="setting-card-icon" style="background:var(--bad-bg);">⚠️</div>
                     <div>
                         <div class="setting-card-title" style="color:var(--bad);">Danger Zone</div>
                         <div class="setting-card-sub">Irreversible actions — proceed with caution</div>
                     </div>
                 </div>
                 <div class="setting-card-body">
                     <div class="danger-row">
                         <div class="setting-info">
                             <div class="setting-label">Clear All Spin Logs</div>
                             <div class="setting-desc">Permanently delete all Quick Pick, Street Walk and Bar Roulette
                                 session logs. User points are not affected.</div>
                         </div>
                         <button class="btn-danger-outline" onclick="dangerAction('Clear all spin logs')">Clear
                             Logs</button>
                     </div>
                     <div class="danger-row">
                         <div class="setting-info">
                             <div class="setting-label">Reset All Points</div>
                             <div class="setting-desc">Set every user's points balance to zero. This will invalidate all
                                 current leaderboard standings.</div>
                         </div>
                         <button class="btn-danger-outline" onclick="dangerAction('Reset all user points')">Reset
                             Points</button>
                     </div>
                     <div class="danger-row">
                         <div class="setting-info">
                             <div class="setting-label">Delete All Reviews</div>
                             <div class="setting-desc">Permanently remove every review submitted by users. Venue ratings
                                 will be recalculated.</div>
                         </div>
                         <button class="btn-danger-outline" onclick="dangerAction('Delete all reviews')">Delete
                             Reviews</button>
                     </div>
                     <div class="danger-row">
                         <div class="setting-info">
                             <div class="setting-label">Wipe & Reset App Data</div>
                             <div class="setting-desc">Factory-reset the entire platform — all users, venues, reviews,
                                 logs and settings will be permanently erased.</div>
                         </div>
                         <button class="btn-danger-outline" onclick="dangerAction('WIPE ALL APP DATA')">Wipe
                             Everything</button>
                     </div>
                 </div>
             </div>
         </div>

     </div><!-- /panels -->
 </div><!-- /settings-layout -->

 <!-- SAVE BAR -->
 <div class="save-bar" id="saveBar">
     <div class="save-bar-msg">
         <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
             <circle cx="12" cy="12" r="10" stroke="#C9890B" stroke-width="2" />
             <line x1="12" y1="8" x2="12" y2="12" stroke="#C9890B" stroke-width="2" stroke-linecap="round" />
             <circle cx="12" cy="16" r="1" fill="#C9890B" />
         </svg>
         You have unsaved changes
     </div>
     <button class="btn-discard" onclick="discardChanges()">Discard</button>
     <button class="btn-save-settings" onclick="saveSettings()">Save Changes</button>
 </div>

 <!-- ADMIN MODAL -->
 <div class="modal-overlay" id="adminModalOverlay" onclick="closeAdminModalOnBg(event)">
     <div class="modal" id="adminModal">
         <div class="modal-head">
             <div class="modal-title" id="am-title">Invite Admin</div>
             <button class="modal-close" onclick="closeAdminModal()">
                 <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                     <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                 </svg>
             </button>
         </div>
         <div class="modal-body">
             <div class="form-row">
                 <div class="form-group">
                     <label class="form-label">Full Name</label>
                     <input class="form-input" id="am-name" type="text" placeholder="e.g. Sara Malik">
                 </div>
                 <div class="form-group">
                     <label class="form-label">Email</label>
                     <input class="form-input" id="am-email" type="email" placeholder="admin@foody.pk">
                 </div>
             </div>
             <div class="form-group">
                 <label class="form-label">Role</label>
                 <select class="form-input" id="am-role">
                     <option>Content Admin</option>
                     <option>Moderator</option>
                     <option>Marketing</option>
                     <option>Read Only</option>
                     <option>Guest Admin</option>
                 </select>
             </div>
             <div class="form-group">
                 <label class="form-label">Permissions</label>
                 <div class="perm-grid">
                     <label class="perm-check"><input type="checkbox" value="users">👤 Users</label>
                     <label class="perm-check"><input type="checkbox" value="venues">🏪 Venues</label>
                     <label class="perm-check"><input type="checkbox" value="reviews">⭐ Reviews</label>
                     <label class="perm-check"><input type="checkbox" value="tags">🏷 Tags & Content</label>
                     <label class="perm-check"><input type="checkbox" value="notifications">🔔 Notifications</label>
                     <label class="perm-check"><input type="checkbox" value="games">🎲 Games</label>
                     <label class="perm-check"><input type="checkbox" value="analytics">📊 Analytics</label>
                     <label class="perm-check"><input type="checkbox" value="settings">⚙️ Settings</label>
                 </div>
             </div>
         </div>
         <div class="modal-footer">
             <button class="btn-cancel" onclick="closeAdminModal()">Cancel</button>
             <button class="btn-save" onclick="saveAdmin()">Send Invite</button>
         </div>
     </div>
 </div>

 <?php
$extraScripts = <<<'JS'
<script>
/* ===== SIDEBAR NAV ===== */
function showPanel(name, el) {
    document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.snav-item').forEach(a => a.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    el.classList.add('active');
}

/* ===== DIRTY STATE ===== */
let isDirty = false;

function markDirty() {
    isDirty = true;
    document.getElementById('saveBar').classList.add('visible');
}

function discardChanges() {
    isDirty = false;
    document.getElementById('saveBar').classList.remove('visible');
}

function saveSettings() {
    isDirty = false;
    document.getElementById('saveBar').classList.remove('visible');
    // TODO: POST settings to backend
    const toast = document.createElement('div');
    toast.textContent = '✓ Settings saved';
    toast.style.cssText = 'position:fixed;bottom:80px;right:24px;background:#2C8A4B;color:#fff;padding:12px 20px;border-radius:10px;font-weight:700;font-size:14px;z-index:999;box-shadow:0 8px 24px rgba(0,0,0,0.15);';
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 2500);
}

/* ===== ADMIN FILTER ===== */
function filterAdmins(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#adminBody tr').forEach(row => {
        row.style.display = (!q || row.dataset.search.includes(q)) ? '' : 'none';
    });
}

/* ===== ADMIN MODAL ===== */
function openAdminModal(name, email, role) {
    const isEdit = !!name;
    document.getElementById('am-title').textContent  = isEdit ? 'Edit Admin' : 'Invite Admin';
    document.getElementById('am-name').value         = name  || '';
    document.getElementById('am-email').value        = email || '';
    document.getElementById('am-role').value         = role  || 'Read Only';
    document.querySelectorAll('.perm-check input').forEach(cb => cb.checked = false);
    document.getElementById('adminModalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('am-name').focus(), 200);
}

function closeAdminModal() {
    document.getElementById('adminModalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

function closeAdminModalOnBg(e) {
    if (e.target === document.getElementById('adminModalOverlay')) closeAdminModal();
}

function saveAdmin() {
    const name  = document.getElementById('am-name').value.trim();
    const email = document.getElementById('am-email').value.trim();
    if (!name)  { alert('Please enter the admin\'s name.'); return; }
    if (!email) { alert('Please enter a valid email.'); return; }
    // TODO: POST invite to backend
    closeAdminModal();
    const toast = document.createElement('div');
    toast.textContent = '✉ Invite sent to ' + email;
    toast.style.cssText = 'position:fixed;bottom:24px;right:24px;background:var(--coral-deep);color:#fff;padding:12px 20px;border-radius:10px;font-weight:700;font-size:14px;z-index:999;box-shadow:0 8px 24px rgba(0,0,0,0.15);';
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

function removeAdmin(name) {
    if (confirm('Remove "' + name + '" as admin? They will lose all dashboard access.')) {
        alert('"' + name + '" removed. (Wire to your backend.)');
    }
}

/* ===== DANGER ACTIONS ===== */
function dangerAction(label) {
    const input = prompt('This is irreversible. Type "CONFIRM" to proceed with: ' + label);
    if (input === 'CONFIRM') {
        alert('Action executed. (Wire to your backend.)');
    } else if (input !== null) {
        alert('Action cancelled — confirmation text did not match.');
    }
}
</script>
JS;
include __DIR__ . '/includes/footer.php';
?>