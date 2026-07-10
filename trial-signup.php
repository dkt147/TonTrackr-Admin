<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Start Your 10-Day Free Trial</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            background: linear-gradient(180deg, var(--dark-green) 0%, var(--green) 42%, var(--teal) 100%);
        }

        .page {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 24px;
        }

        .logo-top {
            margin-bottom: 40px;
        }

        .logo-top img {
            width: 50px;
            height: 50px;
        }

        .card-container {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 60px 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .trial-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 20px;
        }

        .title {
            font-size: 36px;
            font-weight: 800;
            color: #fff;
            margin: 0 0 16px 0;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.85);
            margin: 0 0 40px 0;
            line-height: 1.6;
        }

        .trial-highlights {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: left;
        }

        .highlight-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #fff;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .highlight-item:last-child {
            margin-bottom: 0;
        }

        .highlight-icon {
            width: 24px;
            height: 24px;
            background: var(--green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #000;
            flex-shrink: 0;
        }

        .form-section {
            text-align: left;
            margin-top: 32px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 14px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--green);
            background: rgba(0, 0, 0, 0.5);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .submit-btn {
            width: 100%;
            background: var(--green);
            color: #000;
            border: none;
            border-radius: 10px;
            padding: 16px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 24px;
            transition: all 0.2s;
        }

        .submit-btn:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .terms {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 20px;
            line-height: 1.5;
        }

        .terms a {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .page {
                padding: 40px 20px;
            }

            .card-container {
                padding: 40px 24px;
            }

            .title {
                font-size: 28px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="logo-top">
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none">
                <rect width="50" height="50" rx="10" fill="#74AA50"/>
                <text x="25" y="32" font-family="Poppins" font-size="24" font-weight="700" text-anchor="middle" fill="#000">T</text>
            </svg>
        </div>

        <div class="card-container">
            <div class="trial-badge">🎉 Limited Time Offer</div>
            <h1 class="title">Start Your 10-Day Free Trial</h1>
            <p class="subtitle">No credit card required. Full access to all features. Cancel anytime.</p>

            <div class="trial-highlights">
                <div class="highlight-item">
                    <div class="highlight-icon">✓</div>
                    <span>Full access to all features</span>
                </div>
                <div class="highlight-item">
                    <div class="highlight-icon">✓</div>
                    <span>Manage unlimited trucks</span>
                </div>
                <div class="highlight-item">
                    <div class="highlight-icon">✓</div>
                    <span>Add unlimited drivers</span>
                </div>
                <div class="highlight-item">
                    <div class="highlight-icon">✓</div>
                    <span>24/7 support included</span>
                </div>
            </div>

            <form onsubmit="submitTrial(event)">
                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label">First Name *</label>
                        <input type="text" class="form-input" id="firstName" placeholder="Your first name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Last Name *</label>
                        <input type="text" class="form-input" id="lastName" placeholder="Your last name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Business Name *</label>
                        <input type="text" class="form-input" id="businessName" placeholder="Your business name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" class="form-input" id="email" placeholder="your@email.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="tel" class="form-input" id="phone" placeholder="(206) 555-0000" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">State *</label>
                        <select class="form-input" id="state" required>
                            <option value="">Select state</option>
                            <option value="WA">Washington</option>
                            <option value="OR">Oregon</option>
                            <option value="CA">California</option>
                            <option value="ID">Idaho</option>
                            <option value="MT">Montana</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Number of Trucks *</label>
                            <input type="number" class="form-input" id="numTrucks" placeholder="5" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Number of Drivers *</label>
                            <input type="number" class="form-input" id="numDrivers" placeholder="10" min="1" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Start Free Trial</button>

                <p class="terms">
                    By starting your trial, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. 
                    Your trial expires in 10 days.
                </p>
            </form>
        </div>
    </div>

    <script>
        function submitTrial(e) {
            e.preventDefault();

            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;

            if (!firstName || !lastName || !email) {
                alert('Please fill in all required fields');
                return;
            }

            alert(`Welcome to TonTrackr, ${firstName}! Your 10-day free trial has started. Check your email at ${email} for setup instructions.`);
            location.href = 'dashboard.php';
        }
    </script>
</body>
</html>
