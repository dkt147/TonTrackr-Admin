<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Forgot Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
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
            padding: 26px 24px 60px;
        }

        .inner {
            width: 100%;
            max-width: 340px;
            display: flex;
            flex-direction: column;
        }

        .panel {
            display: none;
            flex-direction: column;
        }

        .panel.active {
            display: flex;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: none;
            border: none;
            cursor: pointer;
            color: #ffffff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            padding: 0;
            margin-bottom: 30px;
            align-self: flex-start;
        }

        .back-link:hover {
            opacity: 0.85;
        }

        .brand-lockup {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 30px;
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
            font-size: 21px;
            margin: 0 0 8px;
            color: #ffffff;
            text-align: center;
        }

        .form-desc {
            font-size: 13.5px;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.85);
            margin: 0 0 26px;
            text-align: center;
        }

        .field {
            margin-bottom: 18px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.75);
            display: flex;
        }

        .input-wrap input {
            width: 100%;
            padding: 16px 16px;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, 0.45);
            background: rgba(255, 255, 255, 0.10);
            font-size: 14px;
            font-family: inherit;
            color: #ffffff;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }

        .input-wrap input.has-icon {
            padding-left: 44px;
        }

        .input-wrap input.has-toggle {
            padding-right: 44px;
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

        .btn-outline {
            background: transparent;
            color: #ffffff;
            border: 2px solid #74AA50;
            margin-top: 12px;
        }

        .btn-outline:hover {
            background: #74AA50;
        }

        /* OTP boxes */
        .otp-row {
            display: flex;
            gap: 8px;
            margin-bottom: 18px;
        }

        .otp-row input {
            width: 100%;
            aspect-ratio: 1/1;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            border-radius: 12px;
            border: 1.5px solid rgba(255, 255, 255, 0.45);
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            outline: none;
            font-family: inherit;
            padding: 0;
            transition: border-color .15s, box-shadow .15s;
        }

        .otp-row input:focus {
            border-color: #4285F4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.28);
        }

        .timer-line {
            text-align: center;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.85);
            margin: 0 0 20px;
        }

        /* password requirements checklist */
        .requirements-label {
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            margin: 4px 0 12px;
        }

        .req-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 10px;
        }

        .req-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .req-dot svg {
            display: none;
            width: 11px;
            height: 11px;
        }

        .req-item.met {
            color: #ffffff;
        }

        .req-item.met .req-dot {
            background: var(--green);
            border-color: var(--green);
        }

        .req-item.met .req-dot svg {
            display: block;
        }

        .field-gap {
            margin-bottom: 24px;
        }

        /* success overlay modal */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 10;
        }

        .overlay.active {
            display: flex;
        }

        .modal {
            background: linear-gradient(180deg, var(--dark-green) 0%, var(--teal) 100%);
            border-radius: 24px;
            padding: 34px 26px 28px;
            width: 100%;
            max-width: 320px;
            text-align: center;
            box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.5);
        }

        .check-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
        }

        .modal h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: #ffffff;
            margin: 0 0 10px;
        }

        .modal p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.55;
            margin: 0 0 24px;
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="inner">

            <!-- ===== STEP 1: FORGOT PASSWORD ===== -->
            <div class="panel active" id="panel-forgot">
                <button class="back-link" onclick="window.location.href='login.php'">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                            stroke-linejoin="round" /></svg>
                    Go back
                </button>

                <div class="brand-lockup">
                    <div class="brand-mark"><img src="assets/images/logo1.png" alt="TonTrackr icon"
                            class="brand-mark-icon"></div>
                    <span class="brand-name">TonTrackr</span>
                </div>

                <p class="form-desc">Please enter your email to recover your password.</p>

                <form id="forgotForm">
                    <div class="field">
                        <div class="input-wrap">
                            <input type="email" id="fp-email" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Recover Password</button>
                </form>
            </div>

            <!-- ===== STEP 2: VERIFY ACCOUNT ===== -->
            <div class="panel" id="panel-verify">
                <button class="back-link" onclick="showPanel('forgot')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                            stroke-linejoin="round" /></svg>
                    Go back
                </button>

                <div class="brand-lockup">
                    <div class="brand-mark"><img src="assets/images/logo1.png" alt="TonTrackr icon"
                            class="brand-mark-icon"></div>
                    <span class="brand-name">TonTrackr</span>
                </div>

                <h1 class="form-title">Check your email.</h1>
                <p class="form-desc">We've sent a code to your email.</p>

                <form id="verifyForm">
                    <div class="otp-row">
                        <input type="text" inputmode="numeric" maxlength="1" class="otp-input" required>
                        <input type="text" inputmode="numeric" maxlength="1" class="otp-input" required>
                        <input type="text" inputmode="numeric" maxlength="1" class="otp-input" required>
                        <input type="text" inputmode="numeric" maxlength="1" class="otp-input" required>
                        <input type="text" inputmode="numeric" maxlength="1" class="otp-input" required>
                        <input type="text" inputmode="numeric" maxlength="1" class="otp-input" required>
                    </div>

                    <p class="timer-line">Code expires in <span id="timer">3:24</span></p>

                    <button type="submit" class="btn btn-primary">Verify</button>
                    <button type="button" class="btn btn-outline" onclick="resendCode()">Send Again</button>
                </form>
            </div>

            <!-- ===== STEP 3: NEW PASSWORD ===== -->
            <div class="panel" id="panel-newpass">
                <button class="back-link" onclick="showPanel('verify')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"
                            stroke-linejoin="round" /></svg>
                    Go back
                </button>

                <div class="brand-lockup">
                    <div class="brand-mark"><img src="assets/images/logo1.png" alt="TonTrackr icon"
                            class="brand-mark-icon"></div>
                    <span class="brand-name">TonTrackr</span>
                </div>

                <h1 class="form-title">Reset your password.</h1>
                <p class="form-desc">Please enter your new password.</p>

                <form id="newPassForm">
                    <div class="field">
                        <div class="input-wrap">
                            <span class="icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <rect x="5" y="10" width="14" height="9" rx="2" stroke="currentColor"
                                        stroke-width="1.8" />
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.8" /></svg>
                            </span>
                            <input type="password" id="np-pass" class="has-icon has-toggle" placeholder="••••••••"
                                minlength="8" required>
                            <button type="button" class="toggle-eye" onclick="togglePass('np-pass', this)">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z" stroke="currentColor"
                                        stroke-width="1.6" />
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6" /></svg>
                            </button>
                        </div>
                    </div>

                    <p class="requirements-label">Your password must contain:</p>

                    <div class="field-gap">
                        <div class="req-item" id="req-length">
                            <span class="req-dot"><svg viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="#fff" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" /></svg></span>
                            At least 8 characters
                        </div>
                        <div class="req-item" id="req-number">
                            <span class="req-dot"><svg viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="#fff" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" /></svg></span>
                            Contains a number
                        </div>
                        <div class="req-item" id="req-symbol">
                            <span class="req-dot"><svg viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="#fff" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" /></svg></span>
                            Contains a symbol
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Done</button>
                </form>
            </div>

        </div>
    </div>

    <!-- ===== SUCCESS MODAL ===== -->
    <div class="overlay" id="successOverlay">
        <div class="modal">
            <div class="check-circle">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M5 13l4 4L19 7" stroke="#ffffff" stroke-width="2.6" stroke-linecap="round"
                        stroke-linejoin="round" /></svg>
            </div>
            <h2>Password Updated</h2>
            <p>Your password has been changed successfully.</p>
            <button class="btn btn-primary" onclick="window.location.href='login.php'">Go Back</button>
        </div>
    </div>

    <script>
        function showPanel(name) {
            document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
            document.getElementById('panel-' + name).classList.add('active');
        }

        function togglePass(id, btn) {
            const input = document.getElementById(id);
            input.type = (input.type === 'password') ? 'text' : 'password';
        }
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showPanel('verify');
            startTimer();
            document.querySelector('.otp-input').focus();
        });
        // OTP auto-advance
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach((input, idx) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^0-9]/g, '');
                if (input.value && idx < otpInputs.length - 1) {
                    otpInputs[idx + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && idx > 0) {
                    otpInputs[idx - 1].focus();
                }
            });
        });

        function resendCode() {
            alert('Code resent (wire this to your backend).');
            startTimer();
        }
        let timerInterval;

        function startTimer() {
            let seconds = 204; // 3:24
            clearInterval(timerInterval);
            const el = document.getElementById('timer');
            timerInterval = setInterval(() => {
                seconds--;
                if (seconds < 0) {
                    clearInterval(timerInterval);
                    return;
                }
                const m = Math.floor(seconds / 60);
                const s = String(seconds % 60).padStart(2, '0');
                el.textContent = m + ':' + s;
            }, 1000);
        }
        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showPanel('newpass');
        });
        const npPass = document.getElementById('np-pass');
        npPass.addEventListener('input', () => {
            const val = npPass.value;
            document.getElementById('req-length').classList.toggle('met', val.length >= 8);
            document.getElementById('req-number').classList.toggle('met', /[0-9]/.test(val));
            document.getElementById('req-symbol').classList.toggle('met', /[^A-Za-z0-9]/.test(val));
        });
        document.getElementById('newPassForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('successOverlay').classList.add('active');
        });
    </script>
</body>

</html>