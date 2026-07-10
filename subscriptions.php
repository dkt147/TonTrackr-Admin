<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Subscription Plans</title>
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
            background: var(--black);
            color: #fff;
        }

        .page {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 60px 24px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            max-width: 600px;
        }

        .brand-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(116, 170, 80, 0.1);
            border: 1px solid rgba(116, 170, 80, 0.3);
            color: var(--green);
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 24px;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            border: none;
        }

        .brand-back:hover {
            background: rgba(116, 170, 80, 0.2);
        }

        .header-title {
            font-size: 40px;
            font-weight: 800;
            margin: 0 0 16px 0;
            letter-spacing: -1px;
        }

        .header-subtitle {
            font-size: 16px;
            color: #888;
            margin: 0;
        }

        .toggle-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-top: 40px;
        }

        .toggle-label {
            font-size: 14px;
            color: #888;
        }

        .toggle-switch {
            width: 56px;
            height: 28px;
            background: #2a2a2a;
            border: 1px solid #3a3a3a;
            border-radius: 14px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s;
        }

        .toggle-switch.on {
            background: var(--green);
            border-color: var(--green);
        }

        .toggle-knob {
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: left 0.3s;
        }

        .toggle-switch.on .toggle-knob {
            left: 30px;
        }

        .save-label {
            font-size: 12px;
            color: var(--green);
            font-weight: 700;
        }

        .plans-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            width: 100%;
            max-width: 1200px;
            margin-top: 40px;
        }

        .plan-card {
            background: #111111;
            border: 1px solid #2A2A2A;
            border-radius: 14px;
            padding: 40px 28px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .plan-card:hover {
            border-color: var(--green);
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(116, 170, 80, 0.15);
        }

        .plan-card.featured {
            border: 2px solid var(--green);
            transform: scale(1.05);
        }

        .featured-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--green);
            color: #000;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .plan-name {
            font-size: 20px;
            font-weight: 700;
            margin: 20px 0 12px 0;
            color: #fff;
        }

        .plan-desc {
            font-size: 13px;
            color: #888;
            margin-bottom: 24px;
        }

        .plan-price {
            font-size: 48px;
            font-weight: 800;
            color: var(--green);
            margin: 0;
            line-height: 1;
        }

        .plan-price-period {
            font-size: 14px;
            color: #888;
            margin: 8px 0 32px 0;
        }

        .plan-features {
            text-align: left;
            flex: 1;
            margin-bottom: 32px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #ccc;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #1a1a1a;
        }

        .feature-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .feature-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(116, 170, 80, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 12px;
            flex-shrink: 0;
        }

        .plan-btn {
            width: 100%;
            padding: 14px 24px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .plan-btn-primary {
            background: var(--green);
            color: #000;
        }

        .plan-btn-primary:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .plan-btn-secondary {
            background: transparent;
            color: #888;
            border: 1px solid #2a2a2a;
        }

        .plan-btn-secondary:hover {
            color: #fff;
            border-color: #555;
        }

        @media (max-width: 768px) {
            .page {
                padding: 40px 20px;
            }

            .header-title {
                font-size: 28px;
            }

            .plans-container {
                grid-template-columns: 1fr;
            }

            .plan-card.featured {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <button class="brand-back" onclick="location.href='dashboard.php'">← Back to Dashboard</button>

        <div class="header">
            <h1 class="header-title">Choose Your Plan</h1>
            <p class="header-subtitle">Select the perfect subscription to manage your fleet</p>

            <div class="toggle-container">
                <span class="toggle-label">Monthly</span>
                <div class="toggle-switch on" id="billingToggle" onclick="toggleBilling()">
                    <div class="toggle-knob"></div>
                </div>
                <span class="toggle-label">Annual</span>
                <span class="save-label" id="saveLabel" style="display:block; margin-left:12px;">Save 20%</span>
            </div>
        </div>

        <div class="plans-container">
            <!-- Owner-Operator Plan -->
            <div class="plan-card">
                <h3 class="plan-name">Owner-Operator</h3>
                <p class="plan-desc">Perfect for small fleets</p>
                <div style="text-align: center;">
                    <p class="plan-price" id="price1">$15</p>
                    <p class="plan-price-period">/month</p>
                </div>
                <div class="plan-features">
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Up to 5 trucks</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>5 driver accounts</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Basic reporting</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Mile tracking</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Email support</span>
                    </div>
                </div>
                <button class="plan-btn plan-btn-secondary" onclick="selectPlan('owner-operator')">Choose Plan</button>
            </div>

            <!-- Fleet Manager Plan (Featured) -->
            <div class="plan-card featured">
                <div class="featured-badge">Most Popular</div>
                <h3 class="plan-name">Fleet Manager</h3>
                <p class="plan-desc">Best for growing fleets</p>
                <div style="text-align: center;">
                    <p class="plan-price" id="price2">$55</p>
                    <p class="plan-price-period">/month</p>
                </div>
                <div class="plan-features">
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Up to 20 trucks</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Unlimited drivers</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Advanced reporting</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>GPS tracking</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>24/7 priority support</span>
                    </div>
                </div>
                <button class="plan-btn plan-btn-primary" onclick="selectPlan('fleet-manager')">Choose Plan</button>
            </div>

            <!-- Enterprise Plan -->
            <div class="plan-card">
                <h3 class="plan-name">Enterprise</h3>
                <p class="plan-desc">For large operations</p>
                <div style="text-align: center;">
                    <p class="plan-price" id="price3">$150</p>
                    <p class="plan-price-period">/month</p>
                </div>
                <div class="plan-features">
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Unlimited trucks</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Unlimited everything</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Custom reports</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>API access</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <span>Dedicated account manager</span>
                    </div>
                </div>
                <button class="plan-btn plan-btn-secondary" onclick="selectPlan('enterprise')">Choose Plan</button>
            </div>
        </div>
    </div>

    <script>
        let isAnnual = true;

        function toggleBilling() {
            isAnnual = !isAnnual;
            document.getElementById('billingToggle').classList.toggle('on');

            if (isAnnual) {
                document.getElementById('price1').textContent = '$180';
                document.getElementById('price2').textContent = '$660';
                document.getElementById('price3').textContent = '$1,800';
                document.getElementById('saveLabel').textContent = 'Save 20%';
            } else {
                document.getElementById('price1').textContent = '$15';
                document.getElementById('price2').textContent = '$55';
                document.getElementById('price3').textContent = '$150';
                document.getElementById('saveLabel').textContent = '';
            }
        }

        function selectPlan(plan) {
            alert(`You selected the ${plan} plan!`);
            location.href = 'trial-signup.php?plan=' + plan;
        }
    </script>
</body>
</html>
