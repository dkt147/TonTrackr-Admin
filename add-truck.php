<?php
$pageTitle  = 'Add a Truck';
$activePage = 'drivers';
include 'config.php';
$truckId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$isEdit = !empty($truckId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · <?php echo htmlspecialchars($isEdit ? 'Edit Truck' : 'Add a Truck'); ?></title>
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
                        <button class="btn-pill small" type="button">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Trucks</p>
                            <h1 class="page-title"><?php echo htmlspecialchars($isEdit ? 'Edit Truck' : 'Add a Truck'); ?></h1>
                            <p class="page-sub" style="margin-top:6px"><?php echo htmlspecialchars($isEdit ? 'Update the truck details below.' : 'Enter truck details and save it to the fleet.'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="width:100%; max-width:none;">
                    <div class="section-title">Truck Details</div>
                    <p class="section-sub">Fill in the fleet information and assign the truck to a driver.</p>

                    <div class="form-field-box"><input type="text" id="driver_id" placeholder="Driver ID"></div>
                    <div class="form-field-box"><input type="text" id="plate_number" placeholder="Plate Number"></div>
                    <div class="form-field-box"><input type="text" id="truck_number" placeholder="Truck Number"></div>
                    <div class="form-field-box"><input type="text" id="year" placeholder="Year"></div>
                    <div class="form-field-box"><input type="text" id="make" placeholder="Make"></div>
                    <div class="form-field-box"><input type="text" id="model" placeholder="Model"></div>
                    <div class="form-field-box"><input type="text" id="vehicle_type" placeholder="Vehicle Type"></div>
                    <div class="form-field-box"><select id="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
                    <div class="form-field-box"><input type="text" id="capacity_tons" placeholder="Capacity Tons"></div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:18px">
                        <button class="btn-pill small" onclick="location.href='trucks.php'">Cancel</button>
                        <button class="btn-pill primary" id="saveTruckBtn"><?php echo htmlspecialchars($isEdit ? 'Update Truck' : 'Save Truck'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        window.TRUCK_ID = '<?php echo addslashes($truckId); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        function getValue(id) {
            return document.getElementById(id)?.value.trim() || '';
        }

        function setValue(id, value) {
            const el = document.getElementById(id);
            if (el) {
                el.value = value || '';
            }
        }

        function buildPayload() {
            return {
                driver_id: getValue('driver_id'),
                plate_number: getValue('plate_number'),
                truck_number: getValue('truck_number'),
                year: getValue('year'),
                make: getValue('make'),
                model: getValue('model'),
                vehicle_type: getValue('vehicle_type'),
                status: getValue('status'),
                capacity_tons: getValue('capacity_tons')
            };
        }

        async function loadTruckForEdit() {
            if (!window.TRUCK_ID) return;
            try {
                await requireAuthOrRedirect('login.php');
                const truck = await fetchWithAuth(`${window.API_URL}/vehicles/${encodeURIComponent(window.TRUCK_ID)}`);
                if (!truck) return;
                setValue('driver_id', truck.driver_id);
                setValue('plate_number', truck.plate_number);
                setValue('truck_number', truck.truck_number);
                setValue('year', truck.year);
                setValue('make', truck.make);
                setValue('model', truck.model);
                setValue('vehicle_type', truck.vehicle_type);
                setValue('status', truck.status || 'active');
                setValue('capacity_tons', truck.capacity_tons);
            } catch (error) {
                console.error('Unable to load truck:', error);
                alert('Unable to load truck details.');
            }
        }

        async function saveTruck() {
            const payload = buildPayload();
            if (!payload.plate_number || !payload.truck_number || !payload.make || !payload.model) {
                alert('Please fill in the required truck fields: plate number, truck number, make, and model.');
                return;
            }

            const button = document.getElementById('saveTruckBtn');
            if (button) {
                button.disabled = true;
                button.textContent = window.TRUCK_ID ? 'Updating...' : 'Saving...';
            }

            try {
                await requireAuthOrRedirect('login.php');
                const url = window.TRUCK_ID
                    ? `${window.API_URL}/vehicles/${encodeURIComponent(window.TRUCK_ID)}`
                    : `${window.API_URL}/vehicles`;
                const method = window.TRUCK_ID ? 'PUT' : 'POST';

                await fetchWithAuth(url, {
                    method,
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                alert(window.TRUCK_ID ? 'Truck updated successfully.' : 'Truck created successfully.');
                location.href = 'trucks.php';
            } catch (error) {
                console.error('Unable to save truck:', error);
                alert(error.message || 'Unable to save truck.');
            } finally {
                if (button) {
                    button.disabled = false;
                    button.textContent = window.TRUCK_ID ? 'Update Truck' : 'Save Truck';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('saveTruckBtn').addEventListener('click', saveTruck);
            loadTruckForEdit();
        });
    </script>
</body>
</html>
