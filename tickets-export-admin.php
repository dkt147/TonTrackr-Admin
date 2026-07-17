<?php
$pageTitle = 'Tickets Export - Contractor Statement';
$activePage = 'reports';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TonTrackr · Tickets Export - Contractor Statement</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
        <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/svg+xml">
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
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-group {
            border: 1px solid #eee;
            padding: 16px;
            border-radius: 8px;
            background: #fafafa;
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

        .total-section {
            background: #f0f8e8;
            border: 1px solid #e0f0d0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: right;
        }

        .total-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .total-amount {
            font-size: 32px;
            font-weight: 700;
            color: #5ba639;
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

        .truck-name {
            font-weight: 600;
            color: #333;
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
            <button class="btn-back" onclick="window.history.back()">← Back to Reports</button>
            <button class="btn-print" onclick="window.print()">🖨️ Print Report</button>
        </div>

        <div class="report-header">
            <div class="report-title-section">
                <div class="report-logo" style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <img src="assets/images/reports-logo.png" alt="TonTrackr" style="height: 50px; width: auto;">
                    <span style="font-size: 24px; font-weight: 700; color: #5ba639;">TonTrackr</span>
                </div>
                <h1>Contractor Statement</h1>
            </div>
            <div class="report-period">
                <h2>6/1/26 - 6/15/26</h2>
                <p>Generated Jul 10, 2026</p>
            </div>
        </div>

        <div class="info-section">
            <div class="info-group">
                <div class="info-label">Contractor</div>
                <div class="info-value">A's Trucking</div>
                <div class="info-subvalue">123 Riverside Drive</div>
                <div class="info-subvalue">Springfield, ID 83205</div>
            </div>
            <div class="info-group">
                <div class="info-label">Operator</div>
                <div class="info-value">Dustin R</div>
                <div class="info-subvalue">USDOT License Avg.</div>
            </div>
            <div class="info-group">
                <div class="info-label">Vehicle</div>
                <div class="info-value">Truck 330 - Long Log Truck</div>
                <div class="info-subvalue">License Plate: LLT-330</div>
            </div>
        </div>

        <div class="total-section">
            <div class="total-label">Total Amount Due</div>
            <div class="total-amount">$20,661.93</div>
        </div>

        <h2 class="section-title">Ticket Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Date</th>
                    <th>LogUpload</th>
                    <th>WB</th>
                    <th>Number</th>
                    <th>Mills</th>
                    <th>Truck Miles</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>T0001</td>
                    <td>6/1/26</td>
                    <td>4/3</td>
                    <td>-</td>
                    <td>50</td>
                    <td>Long Haul</td>
                    <td>22.0</td>
                    <td>$22.10</td>
                    <td>$486.20</td>
                </tr>
                <tr>
                    <td>T0002</td>
                    <td>6/2/26</td>
                    <td>4/3</td>
                    <td>65</td>
                    <td>120</td>
                    <td>Super</td>
                    <td>27.0</td>
                    <td>$22.12</td>
                    <td>$597.24</td>
                </tr>
                <tr>
                    <td>T0003</td>
                    <td>6/3/26</td>
                    <td>4/3</td>
                    <td>80</td>
                    <td>100</td>
                    <td>Long</td>
                    <td>23.0</td>
                    <td>$22.12</td>
                    <td>$508.76</td>
                </tr>
                <tr>
                    <td>T0004</td>
                    <td>6/4/26</td>
                    <td>4/3</td>
                    <td>CUP</td>
                    <td>80</td>
                    <td>Super</td>
                    <td>27.0</td>
                    <td>$22.10</td>
                    <td>$596.70</td>
                </tr>
                <tr>
                    <td>T0005</td>
                    <td>6/5/26</td>
                    <td>4/2</td>
                    <td>82</td>
                    <td>150</td>
                    <td>Long</td>
                    <td>31.0</td>
                    <td>$22.08</td>
                    <td>$684.48</td>
                </tr>
                <tr>
                    <td>T0006</td>
                    <td>6/6/26</td>
                    <td>4/3</td>
                    <td>75</td>
                    <td>95</td>
                    <td>Super</td>
                    <td>25.0</td>
                    <td>$22.09</td>
                    <td>$552.25</td>
                </tr>
                <tr>
                    <td>T0007</td>
                    <td>6/7/26</td>
                    <td>4/3</td>
                    <td>89</td>
                    <td>280</td>
                    <td>Long</td>
                    <td>29.0</td>
                    <td>$22.22</td>
                    <td>$644.38</td>
                </tr>
                <tr>
                    <td>T0008</td>
                    <td>6/8/26</td>
                    <td>4/3</td>
                    <td>92</td>
                    <td>150</td>
                    <td>Super</td>
                    <td>24.0</td>
                    <td>$22.12</td>
                    <td>$530.88</td>
                </tr>
                <tr>
                    <td>T0009</td>
                    <td>6/9/26</td>
                    <td>4/10</td>
                    <td>65</td>
                    <td>120</td>
                    <td>Long</td>
                    <td>26.0</td>
                    <td>$22.14</td>
                    <td>$575.64</td>
                </tr>
                <tr>
                    <td>T0010</td>
                    <td>6/10/26</td>
                    <td>4/3</td>
                    <td>CUP</td>
                    <td>70</td>
                    <td>Super</td>
                    <td>28.0</td>
                    <td>$22.10</td>
                    <td>$618.80</td>
                </tr>
                <tr>
                    <td>T0011</td>
                    <td>6/11/26</td>
                    <td>4/3</td>
                    <td>2/10</td>
                    <td>320</td>
                    <td>Long</td>
                    <td>27.0</td>
                    <td>$22.20</td>
                    <td>$599.40</td>
                </tr>
                <tr>
                    <td>T0012</td>
                    <td>6/12/26</td>
                    <td>4/3</td>
                    <td>88</td>
                    <td>90</td>
                    <td>Super</td>
                    <td>21.0</td>
                    <td>$22.11</td>
                    <td>$464.31</td>
                </tr>
                <tr>
                    <td>T0013</td>
                    <td>6/13/26</td>
                    <td>4/3</td>
                    <td>250</td>
                    <td>100</td>
                    <td>Long</td>
                    <td>27.0</td>
                    <td>$22.12</td>
                    <td>$597.24</td>
                </tr>
                <tr>
                    <td>T0014</td>
                    <td>6/14/26</td>
                    <td>4/3</td>
                    <td>100</td>
                    <td>160</td>
                    <td>Super</td>
                    <td>22.0</td>
                    <td>$22.13</td>
                    <td>$486.86</td>
                </tr>
                <tr>
                    <td>T0015</td>
                    <td>6/15/26</td>
                    <td>4/12</td>
                    <td>CUP</td>
                    <td>240</td>
                    <td>Long</td>
                    <td>23.0</td>
                    <td>$22.12</td>
                    <td>$508.76</td>
                </tr>
            </tbody>
        </table>

        <div style="text-align: right; margin: 20px 0; padding: 20px; background: #f9f9f9; border-radius: 8px;">
            <div style="font-size: 14px; color: #666; margin-bottom: 8px;">Total</div>
            <div style="font-size: 24px; font-weight: 700; color: #5ba639;">$10,661.93</div>
        </div>

        <div class="footer-note">
            This statement shows all tickets issued for the specified period. Records retained per FTA requirements.
            Generated by TonTrackr | Reports | Page 1 of 1
        </div>
    </div>
</body>

</html>