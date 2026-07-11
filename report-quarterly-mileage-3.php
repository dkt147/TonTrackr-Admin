<?php
$pageTitle = 'Quarterly Mileage Summary';
$activePage = 'reports';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Quarterly Mileage Summary - Page 3</title>
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

        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-group {
            border: 1px solid #eee;
            padding: 16px;
            border-radius: 8px;
        }

        .info-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .info-subvalue {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
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

        .state-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .state-badge.idaho {
            background: rgba(91, 166, 57, 0.15);
            color: #5ba639;
        }

        .state-badge.montana {
            background: rgba(127, 201, 127, 0.15);
            color: #4a8f2e;
        }

        .state-badge.wyoming {
            background: rgba(168, 213, 168, 0.15);
            color: #3d6b2f;
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

        .nav-pages {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .nav-pages a,
        .nav-pages button {
            padding: 10px 16px;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #ccc;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-pages a:hover,
        .nav-pages button:hover {
            border-color: #5ba639;
            color: #5ba639;
        }

        .nav-pages .active {
            background: #5ba639;
            color: white;
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
            .btn-back,
            .nav-pages {
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

            .info-section {
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
            <button class="btn-back" onclick="window.location.href='report-quarterly-mileage-2.php'">← Back to Page
                2</button>
            <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
        </div>

        <div class="report-header">
            <div class="report-title-section">
                <div class="report-logo" style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <img src="assets/images/reports-logo.png" alt="TonTrackr" style="height: 50px; width: auto;">
                    <span style="font-size: 24px; font-weight: 700; color: #5ba639;">TonTrackr</span>
                </div>
                <h1>Quarterly Mileage Summary, page 3</h1>
            </div>
            <div class="report-period">
                <h2>Q2 2026</h2>
                <p>April 1 - Jun 30, 2026</p>
                <p>Generated Jul 22, 2026</p>
            </div>
        </div>

        <div class="info-section">
            <div class="info-group">
                <div class="info-label">Carrier & Driver</div>
                <div class="info-value">Garrett Trucking LLC</div>
                <div class="info-subvalue">Driver: Kaylee K</div>
                <div class="info-subvalue">USDOT: 3844102</div>
            </div>
            <div class="info-group">
                <div class="info-label">Vehicle & Odometer</div>
                <div class="info-value">Truck 330</div>
                <div class="info-subvalue">Start odometer (Ivl 1): 45,100</div>
                <div class="info-subvalue">End odometer (Ivl 30): 46,947</div>
            </div>
        </div>

        <h2 class="section-title">Trip-by-Trip Breakdown (Continued)</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>State</th>
                    <th>State mi</th>
                    <th>Day</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>05/10/26</td>
                    <td>45,850</td>
                    <td>46,050</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>200</td>
                    <td>200</td>
                </tr>
                <tr>
                    <td>05/12/26</td>
                    <td>46,050</td>
                    <td>46,060</td>
                    <td><span class="state-badge wyoming">Wyoming</span></td>
                    <td>10</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>05/15/26</td>
                    <td>46,500</td>
                    <td>46,670</td>
                    <td><span class="state-badge montana">Montana</span></td>
                    <td>170</td>
                    <td>170</td>
                </tr>
                <tr>
                    <td>05/20/26</td>
                    <td>46,500</td>
                    <td>46,670</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>170</td>
                    <td>170</td>
                </tr>
                <tr>
                    <td>05/28/26</td>
                    <td>46,870</td>
                    <td>46,947</td>
                    <td><span class="state-badge montana">Montana</span></td>
                    <td>77</td>
                    <td>77</td>
                </tr>
                <tr>
                    <td>05/31/26</td>
                    <td>45,100</td>
                    <td>45,340</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>240</td>
                    <td>240</td>
                </tr>
                <tr>
                    <td>06/02/26</td>
                    <td>45,340</td>
                    <td>45,580</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>240</td>
                    <td>240</td>
                </tr>
                <tr>
                    <td>06/08/26</td>
                    <td>45,580</td>
                    <td>45,850</td>
                    <td><span class="state-badge montana">Montana</span></td>
                    <td>270</td>
                    <td>270</td>
                </tr>
                <tr>
                    <td>06/12/26</td>
                    <td>45,850</td>
                    <td>46,050</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>200</td>
                    <td>200</td>
                </tr>
                <tr>
                    <td>06/15/26</td>
                    <td>46,050</td>
                    <td>46,090</td>
                    <td><span class="state-badge wyoming">Wyoming</span></td>
                    <td>40</td>
                    <td>40</td>
                </tr>
                <tr>
                    <td>06/18/26</td>
                    <td>46,090</td>
                    <td>46,250</td>
                    <td><span class="state-badge montana">Montana</span></td>
                    <td>160</td>
                    <td>160</td>
                </tr>
                <tr>
                    <td>06/22/26</td>
                    <td>46,250</td>
                    <td>46,450</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>200</td>
                    <td>200</td>
                </tr>
                <tr>
                    <td>06/26/26</td>
                    <td>46,450</td>
                    <td>46,600</td>
                    <td><span class="state-badge montana">Montana</span></td>
                    <td>150</td>
                    <td>150</td>
                </tr>
                <tr>
                    <td>06/28/26</td>
                    <td>46,600</td>
                    <td>46,830</td>
                    <td><span class="state-badge wyoming">Wyoming</span></td>
                    <td>230</td>
                    <td>230</td>
                </tr>
                <tr>
                    <td>06/29/26</td>
                    <td>46,830</td>
                    <td>46,947</td>
                    <td><span class="state-badge idaho">Idaho</span></td>
                    <td>117</td>
                    <td>117</td>
                </tr>
            </tbody>
        </table>

        <div class="nav-pages">
            <a href="report-quarterly-mileage.php">← Page 1</a>
            <a href="report-quarterly-mileage-2.php">Page 2</a>
            <button class="active">Page 3</button>
        </div>

        <div class="footer-note">
            Clarity the mileage recorded above is true and accurate. Records retained per FTA requirements (as per
            regulations). Generated by TonTrackr | Fleet | Q2 2026 | Page 3 of 3
        </div>
    </div>
</body>

</html>