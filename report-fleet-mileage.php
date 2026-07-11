<?php
$pageTitle = 'Fleet Mileage Summary';
$activePage = 'reports';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Fleet Mileage Summary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .report-container {
            max-width: 1200px;
            margin: 30px auto;
            background-color: white;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }

        .report-title-section h1 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .report-logo {
            font-size: 24px;
            font-weight: bold;
            color: #5ba639;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .report-logo-icon {
            width: 40px;
            height: 40px;
            background-color: #5ba639;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .report-period {
            text-align: right;
        }

        .report-period h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .report-period p {
            font-size: 14px;
            color: #666;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .metric-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #5ba639;
        }

        .metric-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .metric-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin: 30px 0 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table thead {
            background-color: #5ba639;
            color: white;
        }

        table thead th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }

        table tbody td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        table tbody tr:last-child td {
            border-bottom: 2px solid #5ba639;
            font-weight: 600;
            background-color: #f5f5f5;
        }

        .progress-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-bar {
            flex: 1;
            height: 8px;
            background: #eee;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #5ba639;
        }

        .btn-print {
            background: #5ba639;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-print:hover {
            background: #4a8f2e;
        }

        .btn-back {
            background: #5ba639;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            border-color: #5ba639;
        }

        .footer-note {
            font-size: 11px;
            color: #999;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        @media print {
            body {
                background: white;
            }

            .report-container {
                box-shadow: none;
                margin: 0;
                padding: 0;
            }

            .btn-print,
            .btn-back {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .report-container {
                padding: 20px;
            }

            .report-header {
                flex-direction: column;
                gap: 20px;
            }

            .report-period {
                text-align: left;
            }

            .metrics-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            table thead th,
            table tbody td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="report-container">
        <div style="margin-bottom: 20px; display: flex; justify-content: flex-end; gap: 12px;">
            <button class="btn-back" onclick="window.location.href='reports.php'">← Back to Reports</button>
            <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
        </div>

        <div class="report-header">
            <div class="report-title-section">
                <div class="report-logo" style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <img src="assets/images/reports-logo.png" alt="TonTrackr" style="height: 50px; width: auto;">
                    <span style="font-size: 24px; font-weight: 700; color: #5ba639;">TonTrackr</span>
                </div>
                <h1>Fleet Mileage Summary</h1>
            </div>
            <div class="report-period">
                <h2>Q2 2026</h2>
                <p>April 1 - Jun 30, 2026</p>
                <p>Garrett Trucking LLC | USDOT 3844103</p>
            </div>
        </div>

        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-label">Fleet Total Miles</div>
                <div class="metric-value">3,557 mi</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Trucks</div>
                <div class="metric-value">2</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Jurisdictions</div>
                <div class="metric-value">4</div>
            </div>
        </div>

        <h2 class="section-title">By Truck</h2>
        <table>
            <thead>
                <tr>
                    <th>Unit</th>
                    <th>Driver</th>
                    <th>Start odo</th>
                    <th>End odo</th>
                    <th>Total mi</th>
                    <th>Idaho</th>
                    <th>Montana</th>
                    <th>Wyoming</th>
                    <th>Utah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Truck 330</td>
                    <td>Kaylee K</td>
                    <td>45,100</td>
                    <td>46,967</td>
                    <td>1,867</td>
                    <td>1,210</td>
                    <td>547</td>
                    <td>90</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td>Truck 415</td>
                    <td>Dustin R</td>
                    <td>98,152</td>
                    <td>98,620</td>
                    <td>1,690</td>
                    <td>890</td>
                    <td>620</td>
                    <td>120</td>
                    <td>60</td>
                </tr>
                <tr>
                    <td><strong>Fleet total</strong></td>
                    <td><strong>2 trucks</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>3,557</strong></td>
                    <td><strong>2,100</strong></td>
                    <td><strong>1,167</strong></td>
                    <td><strong>210</strong></td>
                    <td><strong>80</strong></td>
                </tr>
            </tbody>
        </table>

        <h2 class="section-title">Fleet miles by state (IFTA jurisdiction)</h2>
        <table>
            <thead>
                <tr>
                    <th>State</th>
                    <th>Miles</th>
                    <th>% of Fleet</th>
                    <th>Share</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Idaho</td>
                    <td>2,100</td>
                    <td>59.1%</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 59.1%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Montana</td>
                    <td>1,167</td>
                    <td>32.8%</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 32.8%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Wyoming</td>
                    <td>210</td>
                    <td>5.9%</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 5.9%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Utah</td>
                    <td>80</td>
                    <td>2.2%</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 2.2%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>Fleet total</strong></td>
                    <td><strong>3,557</strong></td>
                    <td><strong>100%</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="footer-note">
            Records retained per FTA requirements (as per regulations for IFTA requirements). Generated by TonTrackr |
            Fleet | Q2 2026 | Page 1 of 1
        </div>
    </div>
</body>

</html>