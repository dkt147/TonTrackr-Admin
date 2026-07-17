<?php
// logout.php - clear server session then instruct browser to clear localStorage and redirect to login
require_once 'config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// clear PHP session
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}
session_destroy();
// output a small page that clears localStorage then redirects to login.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Logging out...</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;background:#000;color:#fff;display:flex;align-items:center;justify-content:center;height:100vh;margin:0}</style>
    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">
</head>
<body>
    <div>
        <p>Signing out…</p>
    </div>
    <script>
        // clear client-side stored auth data
        try {
            localStorage.removeItem('tontrackr_auth');
            localStorage.removeItem('tontrackr_id_token');
            localStorage.removeItem('tontrackr_refresh_token');
            localStorage.removeItem('tontrackr_auth_expires_at');
            localStorage.removeItem('tontrackr_user_email');
            localStorage.removeItem('tontrackr_user_role');
            localStorage.removeItem('tontrackr_user_uid');
        } catch (e) {
            console.warn('Could not clear localStorage during logout', e);
        }
        // redirect to login
        window.location.href = 'login.php';
    </script>
</body>
</html>
