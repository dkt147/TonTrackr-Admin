<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr | Tasks</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">
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
            --warning: #F39C12;
            --warning-bg: rgba(243, 156, 18, 0.16);
            --danger: #FF5B5B;
            --danger-bg: rgba(255, 91, 91, 0.16);
            --radius-lg: 20px;
            --radius-md: 14px;
            --shadow-card: 0 4px 15px rgba(0, 0, 0, 0.6);
            --sidebar-w: 260px;
            --topbar-h: 72px;
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--black);
            color: #ffffff;
        }

        .main-wrapper { display: flex; min-height: 100vh; background: var(--black); }
        .sidebar {
            width: var(--sidebar-w); flex-shrink: 0; background: var(--sidebar-bg); color: var(--sidebar-text);
            display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 40;
            border-right: 1px solid var(--border-color); transition: transform .25s ease;
        }
        .page-wrapper { flex: 1; margin-left: var(--sidebar-w); min-width: 0; display: flex; flex-direction: column; }
        .topbar { height: var(--topbar-h); background: #050505; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 18px; padding: 0 32px; position: sticky; top: 0; z-index: 30; }
        .topbar-title { font-size: 18px; font-weight: 600; color: #fff; }
        .page-content { padding: 32px; flex: 1; }
        .page-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
        .page-title { font-size: 28px; font-weight: 700; }
        .page-sub { color: #888; font-size: 14px; margin-top: 4px; }
        .primary-btn {
            border: none; background: var(--green); color: #fff; padding: 12px 16px; border-radius: 999px; font-weight: 600; cursor: pointer;
        }
        .primary-btn:hover { filter: brightness(1.05); }
        .grid { display: grid; grid-template-columns: minmax(0, 360px) 1fr; gap: 20px; }
        .card {
            background: var(--card-bg); border-radius: var(--radius-lg); border: 1px solid var(--border-color); padding: 24px;
            box-shadow: var(--shadow-card);
        }
        .card-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .card-title { font-size: 18px; font-weight: 600; }
        .task-form { display: flex; flex-direction: column; gap: 12px; }
        .task-form label { display: flex; flex-direction: column; gap: 6px; font-size: 13px; color: #ccc; }
        .task-form input, .task-form textarea, .task-form select {
            width: 100%; border: 1px solid var(--border-color); background: #000; color: #fff; padding: 12px 14px; border-radius: 12px; font-family: 'Poppins', sans-serif;
        }
        .task-form textarea { min-height: 90px; resize: vertical; }
        .alert { display: none; padding: 12px 14px; border-radius: 12px; margin-bottom: 16px; font-size: 13px; }
        .alert.success { display: block; background: var(--good-bg); color: var(--good); }
        .alert.error { display: block; background: var(--danger-bg); color: var(--danger); }
        .table-wrap { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; min-width: 780px; }
        .table th, .table td { padding: 12px 10px; border-bottom: 1px solid var(--border-color); text-align: left; font-size: 13px; }
        .table th { color: #888; text-transform: uppercase; font-size: 11px; }
        .status-pill { display: inline-block; padding: 5px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; text-transform: capitalize; }
        .status-completed { background: var(--good-bg); color: var(--good); }
        .status-pending { background: var(--warning-bg); color: var(--warning); }
        .status-in_progress { background: var(--danger-bg); color: var(--danger); }
        .inline-select { border: 1px solid var(--border-color); background: #000; color: #fff; padding: 8px 10px; border-radius: 10px; }
        .small-btn { border: none; background: var(--teal); color: #fff; padding: 8px 10px; border-radius: 10px; cursor: pointer; }
        .empty { color: #888; text-align: center; padding: 24px 10px; }
        @media (max-width: 980px) {
            .grid { grid-template-columns: 1fr; }
            .page-wrapper { margin-left: 0; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <?php include 'includes/header.php'; ?>
            <div class="page-content">
                <div class="page-head">
                    <div>
                        <h1 class="page-title">Task Management</h1>
                        <p class="page-sub">Create and track fleet assignment tasks from the API.</p>
                    </div>
                    <button id="refreshTasksBtn" class="primary-btn" type="button">Refresh Tasks</button>
                </div>

                <div id="taskAlert" class="alert" role="status"></div>

                <div class="grid">
                    <section class="card">
                        <div class="card-head">
                            <span class="card-title">Assign New Task</span>
                        </div>
                        <form id="taskForm" class="task-form">
                            <label>
                                Description
                                <textarea name="description" id="description" required></textarea>
                            </label>
                            <label>
                                Driver ID
                                <input type="text" name="driver_id" id="driver_id" required>
                            </label>
                            <label>
                                Due Date
                                <input type="datetime-local" name="due_date" id="due_date" required>
                            </label>
                            <label>
                                Job ID
                                <input type="text" name="job_id" id="job_id" required>
                            </label>
                            <label>
                                Mill ID
                                <input type="text" name="mill_id" id="mill_id" required>
                            </label>
                            <label>
                                Vehicle ID
                                <input type="text" name="vehicle_id" id="vehicle_id" required>
                            </label>
                            <button class="primary-btn" type="submit">Assign Task</button>
                        </form>
                    </section>

                    <section class="card">
                        <div class="card-head">
                            <span class="card-title">Tasks List</span>
                        </div>
                        <div class="table-wrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Driver</th>
                                        <th>Job</th>
                                        <th>Mill</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tasksTableBody">
                                    <tr>
                                        <td colspan="7" class="empty">Loading tasks…</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.API_URL = '<?php echo addslashes($API_URL); ?>';
    </script>
    <script src="assets/js/auth.js?v=3"></script>
    <script>
        const taskForm = document.getElementById('taskForm');
        const taskAlert = document.getElementById('taskAlert');
        const tasksTableBody = document.getElementById('tasksTableBody');
        const refreshTasksBtn = document.getElementById('refreshTasksBtn');

        function showAlert(message, type = 'success') {
            taskAlert.textContent = message;
            taskAlert.className = `alert ${type}`;
        }

        function escapeHtml(value = '') {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        function getStatusClass(status = '') {
            const normalized = String(status || '').toLowerCase().replace(/\s+/g, '_');
            if (normalized === 'completed') return 'status-completed';
            if (normalized === 'pending') return 'status-pending';
            return 'status-in_progress';
        }

        function renderTasks(tasks) {
            if (!tasks || !tasks.length) {
                tasksTableBody.innerHTML = '<tr><td colspan="7" class="empty">No tasks found.</td></tr>';
                return;
            }

            tasksTableBody.innerHTML = tasks.map(task => {
                const status = task.status || 'pending';
                const statusLabel = escapeHtml(status);
                return `
                    <tr>
                        <td>${escapeHtml(task.id || '')}</td>
                        <td>${escapeHtml(task.description || task.job_name || '—')}</td>
                        <td>${escapeHtml(task.driver_name || task.driver_id || '—')}</td>
                        <td>${escapeHtml(task.job_name || task.job_id || '—')}</td>
                        <td>${escapeHtml(task.mill_name || task.mill_id || '—')}</td>
                        <td><span class="status-pill ${getStatusClass(status)}">${statusLabel}</span></td>
                        <td>
                            <select class="inline-select" data-task-id="${escapeHtml(task.id || '')}">
                                <option value="pending" ${status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="completed" ${status === 'completed' ? 'selected' : ''}>Completed</option>
                                <option value="in_progress" ${status === 'in_progress' || status === 'in progress' ? 'selected' : ''}>In Progress</option>
                            </select>
                            <button class="small-btn" type="button" data-task-id="${escapeHtml(task.id || '')}" data-action="update-status">Update</button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        async function loadTasks() {
            try {
                const response = await fetchWithAuth(`${window.API_URL}/tasks`);
                const tasks = Array.isArray(response?.tasks) ? response.tasks : [];
                renderTasks(tasks);
            } catch (error) {
                tasksTableBody.innerHTML = '<tr><td colspan="7" class="empty">Unable to load tasks.</td></tr>';
                showAlert(error.message || 'Unable to load tasks.', 'error');
            }
        }

        async function updateTaskStatus(taskId, status) {
            try {
                await fetchWithAuth(`${window.API_URL}/tasks/${taskId}/status`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ status })
                });
                showAlert('Task status updated.', 'success');
                await loadTasks();
            } catch (error) {
                showAlert(error.message || 'Unable to update task status.', 'error');
            }
        }

        taskForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const data = new FormData(taskForm);
            const description = (data.get('description') || '').toString().trim();
            const driverId = (data.get('driver_id') || '').toString().trim();
            const dueDate = (data.get('due_date') || '').toString().trim();
            const jobId = (data.get('job_id') || '').toString().trim();
            const millId = (data.get('mill_id') || '').toString().trim();
            const vehicleId = (data.get('vehicle_id') || '').toString().trim();

            if (!description || !driverId || !dueDate || !jobId || !millId || !vehicleId) {
                showAlert('Please fill in all task fields.', 'error');
                return;
            }

            try {
                const response = await fetchWithAuth(`${window.API_URL}/tasks`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        description,
                        driver_id: driverId,
                        due_date: new Date(dueDate).toISOString(),
                        job_id: jobId,
                        mill_id: millId,
                        vehicle_id: vehicleId
                    })
                });

                taskForm.reset();
                showAlert(response?.message ? `Task assigned. ${response.message}` : 'Task assigned successfully.', 'success');
                await loadTasks();
            } catch (error) {
                showAlert(error.message || 'Unable to assign task.', 'error');
            }
        });

        tasksTableBody.addEventListener('click', async (event) => {
            const button = event.target.closest('[data-action="update-status"]');
            if (!button) return;
            const taskId = button.getAttribute('data-task-id');
            const select = tasksTableBody.querySelector(`select[data-task-id="${taskId}"]`);
            if (!taskId || !select) return;
            await updateTaskStatus(taskId, select.value);
        });

        refreshTasksBtn.addEventListener('click', () => {
            loadTasks();
        });

        document.addEventListener('DOMContentLoaded', async () => {
            try {
                await requireAuthOrRedirect('login.php');
            } catch (error) {
                // auth redirect will handle navigation
            }
            const dueInput = document.getElementById('due_date');
            if (dueInput) {
                const now = new Date();
                const local = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
                dueInput.value = local;
            }
            await loadTasks();
        });
    </script>
</body>
</html>
