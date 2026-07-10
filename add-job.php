<?php
$pageTitle  = 'Add Job';
$activePage = 'jobs';
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
                    <div style="display:flex;align-items:center;gap:12px;cursor:pointer" onclick="location.href='jobs.php'">
                        <button class="btn-pill small" type="button" onclick="location.href='jobs.php'">← BACK</button>
                        <div>
                            <p class="page-eyebrow">Jobs</p>
                            <h1 class="page-title">Add a New Job</h1>
                            <p class="page-sub" style="margin-top:6px">Create a new job assignment for your fleet.</p>
                        </div>
                    </div>
                </div>

                <div class="section-card" style="width:100%; max-width:none;">
                    <div class="section-title">Job Information</div>
                    <p class="section-sub">Enter the job name and description.</p>

                    <div class="form-field-box"><input type="text" id="job_title" placeholder="Job Title"></div>
                    <div class="form-field-box"><input type="text" id="job_description" placeholder="Job Description"></div>

                    <div class="section-title" style="margin-top:28px">Contractor & Location</div>
                    <p class="section-sub">Select contractor and specify pickup/delivery locations.</p>

                    <div class="form-field-box"><select id="contractor">
                        <option value="">Select Contractor</option>
                        <option value="johntimber">John's Timber</option>
                        <option value="mountain">Mountain Lumber</option>
                        <option value="crown">Crown Wood Works</option>
                    </select></div>

                    <div class="form-field-box"><input type="text" id="pickup_location" placeholder="Pickup Location"></div>
                    <div class="form-field-box"><input type="text" id="delivery_location" placeholder="Delivery Location"></div>

                    <div class="section-title" style="margin-top:28px">Load Details</div>
                    <p class="section-sub">Specify load type and weight.</p>

                    <div class="form-field-box"><select id="load_type">
                        <option value="">Select Load Type</option>
                        <option value="long">Long Log</option>
                        <option value="short">Short Log</option>
                        <option value="super">Super Train</option>
                        <option value="mixed">Mixed</option>
                    </select></div>

                    <div class="form-field-box"><input type="number" id="weight" placeholder="Weight (tons)"></div>

                    <div class="section-title" style="margin-top:28px">Assignment</div>
                    <p class="section-sub">Assign a driver and truck to this job.</p>

                    <div class="form-field-box"><select id="driver">
                        <option value="">Select Driver</option>
                        <option value="kaylee">Kaylee K.</option>
                        <option value="jake">Jake M.</option>
                        <option value="travis">Travis B.</option>
                        <option value="unassigned">Unassigned</option>
                    </select></div>

                    <div class="form-field-box"><select id="truck">
                        <option value="">Select Truck</option>
                        <option value="truck1">Truck #1 - Long Log</option>
                        <option value="truck2">Truck #2 - Short Log</option>
                        <option value="truck3">Truck #3 - Super Train</option>
                    </select></div>

                    <div class="section-title" style="margin-top:28px">Dates</div>
                    <p class="section-sub">Set start and end dates for the job.</p>

                    <div class="form-field-box"><input type="date" id="start_date" placeholder="Start Date"></div>
                    <div class="form-field-box"><input type="date" id="end_date" placeholder="End Date"></div>

                    <div class="section-title" style="margin-top:28px">Status</div>
                    <p class="section-sub">Set the initial job status.</p>

                    <div class="form-field-box"><select id="status">
                        <option value="">Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                    </select></div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:28px">
                        <button class="btn-pill small" onclick="location.href='jobs.php'">Cancel</button>
                        <button class="btn-pill primary" onclick="submitJob()">Save Job</button>
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
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }

        function submitJob() {
            const jobTitle = document.getElementById('job_title').value;
            const contractor = document.getElementById('contractor').value;

            if (!jobTitle || !contractor) {
                alert('Please fill in all required fields');
                return;
            }

            alert('Job saved successfully!');
            location.href = 'jobs.php';
        }
    </script>
</body>
</html>
