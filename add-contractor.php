<?php
$pageTitle  = 'Contractors';
$activePage = 'contractors';
include 'config.php';
$contractorId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$isEdit = !empty($contractorId);
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
                    <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='contractors.php'">
                        <button class="btn-pill small" type="button" onclick="location.href='contractors.php'">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Contractors</p>
                            <h1 class="page-title"><?php echo $isEdit ? 'Edit Contractor' : 'Add a Contractor'; ?></h1>
                            <p class="page-sub" style="margin-top:6px"><?php echo $isEdit ? 'Update contractor information.' : 'Add contractor or supplier information.'; ?></p>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="width:100%; max-width:none;">
                    <div class="section-title">Business Information</div>
                    <p class="section-sub">Enter contractor's business details.</p>

                    <div class="form-field-box"><input type="text" id="company_name" placeholder="Company Name"></div>
                    <div class="form-field-box"><select id="contractor_type">
                        <option value="">Select Type</option>
                        <option value="mill">Mill Owner</option>
                        <option value="supplier">Supplier</option>
                        <option value="vendor">Vendor</option>
                        <option value="customer">Customer</option>
                    </select></div>
                    <div class="form-field-box"><input type="text" id="business_license" placeholder="Business License #"></div>

                    <div class="section-title" style="margin-top:28px">Contact Information</div>
                    <p class="section-sub">Enter primary contact details.</p>

                    <div class="form-field-box"><input type="text" id="contact_person" placeholder="Contact Person Name"></div>
                    <div class="form-field-box"><input type="email" id="contact_email" placeholder="Email Address"></div>
                    <div class="form-field-box"><input type="tel" id="contact_phone" placeholder="Phone Number"></div>

                    <div class="section-title" style="margin-top:28px">Location & Details</div>
                    <p class="section-sub">Enter location and operational details.</p>

                    <div class="form-field-box"><input type="text" id="address" placeholder="Street Address"></div>
                    <div class="form-field-box"><input type="text" id="city" placeholder="City"></div>
                    <div class="form-field-box"><input type="text" id="state" placeholder="State"></div>
                    <div class="form-field-box"><input type="text" id="zip" placeholder="ZIP Code"></div>

                    <div class="section-title" style="margin-top:28px">Status</div>
                    <p class="section-sub">Set contractor status.</p>

                    <div class="form-field-box"><select id="status">
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="pending">Pending Verification</option>
                        <option value="inactive">Inactive</option>
                    </select></div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:28px">
                        <button class="btn-pill small" onclick="location.href='contractors.php'">Cancel</button>
                        <button class="btn-pill primary" onclick="submitContractor()"><?php echo $isEdit ? 'Save Changes' : 'Save Contractor'; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
            --tan: #BAAC88;
            --cream: #D7D2C9;
            --black: #000000;
            --sidebar-bg: #0a0a0a;
            --sidebar-bg-soft: #141414;
            --sidebar-text: #A0A0A0;
            --sidebar-text-dim: #555555;
            --card-bg: #111111;
            --border-color: #2A2A2A;
            --good: #74AA50;
            --good-bg: rgba(116, 170, 80, 0.15);
            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-card: 0 4px 15px rgba(0, 0, 0, 0.6);
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: var(--black); color: #ffffff; -webkit-font-smoothing: antialiased; }

        .page-content { padding: 32px; flex: 1; }
        .page-head { display: flex; align-items: center; margin-bottom: 32px; }
        .page-eyebrow { font-size: 12px; text-transform: uppercase; color: var(--green); font-weight: 600; letter-spacing: 0.08em; }
        .page-title { font-size: 28px; font-weight: 700; color: #fff; margin: 0; }
        .page-sub { font-size: 13px; color: #888; margin: 4px 0 0 0; }

        .btn-pill {
            padding: 10px 20px;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: #888;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }

        .btn-pill:hover { color: #fff; border-color: #555; }
        .btn-pill.small { padding: 8px 16px; font-size: 12px; }
        .btn-pill.primary { background: var(--green); color: #000; border: none; }
        .btn-pill.primary:hover { opacity: 0.9; }

        .section-card {
            background: #111111;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 24px;
        }

        .section-title { font-size: 16px; font-weight: 600; color: #fff; margin-bottom: 8px; }
        .section-sub { font-size: 13px; color: #888; margin-bottom: 20px; }

        .form-field-box {
            background: #1A1A1A;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            color: #fff;
            transition: border-color 0.2s;
        }

        .form-field-box:focus-within { border-color: var(--green); }
        .form-field-box input,
        .form-field-box select {
            flex: 1;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            padding: 0;
            width: 100%;
        }

        .form-field-box input::placeholder {
            color: #555;
        }

        .form-field-box select option {
            background: #1A1A1A;
            color: #fff;
        }
    </style>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
        window.CONTRACTOR_ID = '<?php echo addslashes($contractorId); ?>';
    </script>
    <script src="assets/js/auth.js?v=2"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function getValue(id) {
            return document.getElementById(id).value.trim();
        }

        function setValue(id, value) {
            const element = document.getElementById(id);
            if (!element) return;
            element.value = value || '';
        }

        function getPayload() {
            return {
                company_name: getValue('company_name'),
                contractor_type: getValue('contractor_type'),
                business_license: getValue('business_license'),
                contact_person: getValue('contact_person'),
                contact_email: getValue('contact_email'),
                contact_phone: getValue('contact_phone'),
                address: getValue('address'),
                city: getValue('city'),
                state: getValue('state'),
                zip: getValue('zip'),
                status: getValue('status')
            };
        }

        async function loadContractor() {
            if (!window.CONTRACTOR_ID) return;

            try {
                await requireAuthOrRedirect('login.php');
                const contractor = await fetchWithAuth(`${window.API_URL}/contractors/${window.CONTRACTOR_ID}`);

                setValue('company_name', contractor.company_name);
                setValue('contractor_type', contractor.contractor_type);
                setValue('business_license', contractor.business_license);
                setValue('contact_person', contractor.contact_person);
                setValue('contact_email', contractor.contact_email);
                setValue('contact_phone', contractor.contact_phone);
                setValue('address', contractor.address);
                setValue('city', contractor.city);
                setValue('state', contractor.state);
                setValue('zip', contractor.zip);
                setValue('status', contractor.status);
            } catch (error) {
                console.error('Failed to load contractor:', error);
                alert('Unable to load contractor details. Returning to list.');
                window.location.href = 'contractors.php';
            }
        }

        async function submitContractor() {
            const payload = getPayload();

            if (!payload.company_name || !payload.contractor_type || !payload.contact_person || !payload.contact_email || !payload.status) {
                alert('Please fill in required fields: company name, contractor type, contact person, email, and status.');
                return;
            }

            try {
                await requireAuthOrRedirect('login.php');
                const method = window.CONTRACTOR_ID ? 'PUT' : 'POST';
                const url = window.CONTRACTOR_ID ? `${window.API_URL}/contractors/${window.CONTRACTOR_ID}` : `${window.API_URL}/contractors`;
                const response = await fetchWithAuth(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const action = window.CONTRACTOR_ID ? 'updated' : 'created';
                alert(`Contractor ${action} successfully. ID: ${response.contractor_id}`);
                window.location.href = 'contractors.php';
            } catch (error) {
                console.error('Save contractor failed:', error);
                alert('Unable to save contractor. Please try again.');
            }
        }

        document.addEventListener('DOMContentLoaded', loadContractor);
    </script>
</body>
</html>
