<?php
$pageTitle  = 'Add a Truck';
$activePage = 'drivers';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · <?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
    <div class="main-wrapper">
        <?php include 'includes\\sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes\\header.php'; ?>

            <div class="page-content">

                <div class="page-head">
                    <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='trucks.php'">
                        <button class="btn-pill small" type="button" onclick="location.href='trucks.php'">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Trucks</p>
                            <h1 class="page-title">Add a Truck</h1>
                            <p class="page-sub" style="margin-top:6px">Enter truck details and save it to the fleet.</p>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="width:100%; max-width:none;">
                    <div class="section-title">Truck Details</div>
                    <p class="section-sub">Fill in the fleet information and assign the truck to a driver.</p>

                    <div class="form-field-box"><input type="text" id="year" placeholder="Year"></div>
                    <div class="form-field-box"><input type="text" id="make" placeholder="Make"></div>
                    <div class="form-field-box"><input type="text" id="model" placeholder="Model"></div>
                    <div class="form-field-box"><input type="text" id="plate" placeholder="Licence Plate #"></div>
                    <div class="form-field-box"><input type="text" id="truck_number" placeholder="Truck Number"></div>
                    <div class="form-field-box"><input type="text" id="usdot" placeholder="USDOT"></div>

                    <div class="form-field-box dropdown" id="truckTypeBox">
                        <input type="text" id="truck_types_display" placeholder="Truck Type(s)" readonly value="Select truck type(s)" onclick="toggleDropdown(event)">
                        <span style="color:#888;cursor:pointer" onclick="openModal(event)">▼</span>
                        <div class="dd-panel" id="truckTypePanel" style="display:none">
                            <div class="dd-row"><div>Long Log Truck</div><div class="switch" data-key="long" onclick="toggleSwitch(this)"><div class="knob"></div></div></div>
                            <div class="dd-row"><div>Short Log Truck</div><div class="switch on" data-key="short" onclick="toggleSwitch(this)"><div class="knob"></div></div></div>
                            <div class="dd-row"><div>Super Train Truck</div><div class="switch" data-key="super" onclick="toggleSwitch(this)"><div class="knob"></div></div></div>
                            <div style="margin-top:12px;display:flex;gap:8px"><button class="big-btn" style="flex:1;background:transparent;border:1px solid #333;color:#ccc" onclick="closeDropdown()">Done</button><button class="big-btn" style="flex:1;background:var(--green);color:#000;border:none" onclick="applyTypes()">Apply</button></div>
                        </div>
                    </div>

                    <div class="form-field-box"><select id="assign_driver"><option value="">Assign Driver</option><option>Kaylee K.</option><option>Jake M.</option><option>Travis B.</option></select></div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:18px">
                        <button class="btn-pill small" onclick="location.href='trucks.php'">Cancel</button>
                        <button class="btn-pill primary" onclick="submitTruck()">Save Truck</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-backdrop" id="truckTypeModal">
        <div class="modal">
            <h3>What type of truck are you driving today?</h3>
            <button class="big-btn" onclick="selectModal('Long Log Truck')">LONG LOG TRUCK</button>
            <button class="big-btn" onclick="selectModal('Short Log Truck')">SHORT LOG TRUCK</button>
            <button class="big-btn" onclick="selectModal('Super Train Truck')">SUPER TRAIN TRUCK</button>
            <div style="text-align:center;margin-top:8px"><button class="big-btn" style="background:#2a2a2a" onclick="closeModal()">Cancel</button></div>
        </div>
    </div>

    <script>
        function toggleDropdown(e){
            const panel = document.getElementById('truckTypePanel');
            panel.style.display = panel.style.display === 'block' ? 'none' : 'block';
        }
        function closeDropdown(){ document.getElementById('truckTypePanel').style.display = 'none'; }

        function toggleSwitch(el){
            el.classList.toggle('on');
        }

        function applyTypes(){
            const switches = document.querySelectorAll('#truckTypePanel .switch');
            const selected = [];
            switches.forEach(s=>{ if(s.classList.contains('on')){
                const key = s.getAttribute('data-key');
                if(key==='long') selected.push('Long Log Truck');
                if(key==='short') selected.push('Short Log Truck');
                if(key==='super') selected.push('Super Train Truck');
            }});
            document.getElementById('truck_types_display').value = selected.length ? selected.join(', ') : 'Select truck type(s)';
            closeDropdown();
        }

        function openModal(e){ e.stopPropagation(); document.getElementById('truckTypeModal').style.display = 'flex'; }
        function closeModal(){ document.getElementById('truckTypeModal').style.display = 'none'; }
        function selectModal(type){ document.getElementById('truck_types_display').value = type; closeModal(); }

        function submitTruck(){
            const year = document.getElementById('year').value.trim();
            const make = document.getElementById('make').value.trim();
            const model = document.getElementById('model').value.trim();
            const plate = document.getElementById('plate').value.trim();
            const truckNumber = document.getElementById('truck_number').value.trim();
            const usdot = document.getElementById('usdot').value.trim();
            const types = document.getElementById('truck_types_display').value;

            if(!year||!make||!model||!plate||!truckNumber||!usdot){
                alert('Please fill in all truck details');
                return;
            }

            alert('Truck added:\n'+truckNumber+' - '+make+' '+model+'\nType: '+types);
            document.getElementById('year').value='';document.getElementById('make').value='';document.getElementById('model').value='';document.getElementById('plate').value='';document.getElementById('truck_number').value='';document.getElementById('usdot').value='';document.getElementById('truck_types_display').value='Select truck type(s)';
        }

        document.addEventListener('click', function(ev){
            const panel = document.getElementById('truckTypePanel');
            if(panel && !panel.contains(ev.target) && ev.target.id !== 'truck_types_display') panel.style.display='none';
        });
    </script>
</body>
</html>