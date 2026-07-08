<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Sign Up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --green: #74AA50;
            --teal: #1D6960;
            --dark-green: #3E5824;
            --tan: #BAAC88;
            --cream: #D7D2C9;
            --black: #000000;
        }

        * {
            box-sizing: border-box;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .page {
            position: relative;
            width: 100vw;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(180deg, var(--dark-green) 0%, var(--green) 42%, var(--teal) 100%);
            padding: 70px 24px 60px;
        }

        .inner {
            width: 100%;
            max-width: 340px;
        }

        .brand-lockup {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-mark-icon {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 45px;
            letter-spacing: -0.02em;
            color: #ffffff;
        }

        .form-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 24px;
            margin: 0 0 8px;
            color: #ffffff;
        }

        .form-desc {
            font-size: 13.5px;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.8);
            margin: 0 0 26px;
        }

        .field {
            margin-bottom: 14px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            padding: 16px 44px 16px 16px;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, 0.45);
            background: rgba(255, 255, 255, 0.10);
            font-size: 14px;
            font-family: inherit;
            color: #ffffff;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .input-wrap input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .input-wrap input:focus {
            border-color: #4285F4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.28);
        }

        .toggle-eye {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.85);
            padding: 4px;
            display: flex;
        }

        .toggle-eye:hover {
            color: #ffffff;
        }

        .btn {
            width: 100%;
            padding: 17px 20px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s ease;
            margin-top: 8px;
        }

        .btn-primary {
            background: var(--green);
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            transform: scale(1.02);
            background: #83b962;
        }

        .switch-line {
            text-align: center;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 22px;
        }

        .switch-line a {
            color: #ffffff;
            font-weight: 800;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="inner">
            <div class="brand-lockup">
                <div class="brand-mark">
                    <img src="assets/images/logo1.png" alt="TonTrackr icon" class="brand-mark-icon">
                </div>
                <span class="brand-name">TonTrackr</span>
            </div>

            <h1 class="form-title">Create your account</h1>
            <p class="form-desc">Track every load, every ton, every dollar. Sign up to get started.</p>

            <form id="signupForm">
                <div class="field">
                    <div class="input-wrap">
                        <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                    </div>
                </div>

                <div class="field">
                    <div class="input-wrap">
                        <input type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                </div>

                <div class="field">
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="Enter Password" minlength="8"
                            required>
                        <button type="button" class="toggle-eye" onclick="togglePass('password', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                    stroke-width="1.6" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6" /></svg>
                        </button>
                    </div>
                </div>

                <div class="field">
                    <div class="input-wrap">
                        <input type="password" id="confirm" name="confirm" placeholder="Confirm Password" required>
                        <button type="button" class="toggle-eye" onclick="togglePass('confirm', this)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                    stroke-width="1.6" />
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6" /></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>

            <p class="switch-line">Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>

    <script>
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            input.type = (input.type === 'password') ? 'text' : 'password';
        }
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('confirm').value;
            if (pass !== confirm) {
                alert('Passwords do not match.');
                return;
            }
            alert('Signup form submitted (wire this to your backend).');
        });
    </script>
</body>

</html>