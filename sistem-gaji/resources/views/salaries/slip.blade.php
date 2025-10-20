<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip - {{ $salary->employee->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .slip-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border: 1px solid #ddd;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .slip-title {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }
        .employee-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        .info-section h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .salary-breakdown {
            margin-bottom: 30px;
        }
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .salary-table th,
        .salary-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .salary-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .total-row {
            border-top: 2px solid #333;
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-top: 40px;
            text-align: center;
        }
        .signature-box {
            border-top: 1px solid #333;
            padding-top: 40px;
        }
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .slip-container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>
    <div class="slip-container">
        <div class="header">
            <div class="company-name">{{ config('app.name', 'Company Name') }}</div>
            <div class="slip-title">SALARY SLIP</div>
            <div>Period: {{ $salary->period }}</div>
        </div>

        <div class="employee-info">
            <div class="info-section">
                <h3>Employee Information</h3>
                <div class="info-item">
                    <span>Name:</span>
                    <span>{{ $salary->employee->name }}</span>
                </div>
                <div class="info-item">
                    <span>NIP:</span>
                    <span>{{ $salary->employee->nip }}</span>
                </div>
                <div class="info-item">
                    <span>Position:</span>
                    <span>{{ $salary->employee->position }}</span>
                </div>
                <div class="info-item">
                    <span>Department:</span>
                    <span>{{ $salary->employee->department }}</span>
                </div>
                <div class="info-item">
                    <span>Join Date:</span>
                    <span>{{ $salary->employee->join_date->format('d M Y') }}</span>
                </div>
            </div>

            <div class="info-section">
                <h3>Payment Information</h3>
                <div class="info-item">
                    <span>Pay Date:</span>
                    <span>{{ $salary->pay_date->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                    <span>Status:</span>
                    <span>{{ ucfirst($salary->status) }}</span>
                </div>
                <div class="info-item">
                    <span>Generated:</span>
                    <span>{{ now()->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="salary-breakdown">
            <h3>Salary Breakdown</h3>
            <table class="salary-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Base Salary</td>
                        <td style="text-align: right;">Rp {{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Allowance</td>
                        <td style="text-align: right;">Rp {{ number_format($salary->allowance, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Deduction</td>
                        <td style="text-align: right;">- Rp {{ number_format($salary->deduction, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="total-row">
                        <td><strong>Total Salary</strong></td>
                        <td style="text-align: right;"><strong>Rp {{ number_format($salary->total_salary, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if($salary->notes)
            <div class="info-section">
                <h3>Notes</h3>
                <p>{{ $salary->notes }}</p>
            </div>
        @endif

        <div class="signature-section">
            <div class="signature-box">
                <div>Employee Signature</div>
            </div>
            <div class="signature-box">
                <div>HR Manager</div>
            </div>
            <div class="signature-box">
                <div>Finance Manager</div>
            </div>
        </div>

        <div class="footer">
            <p>This is a computer-generated salary slip. No signature required.</p>
            <p>Generated on {{ now()->format('d M Y \a\t H:i') }}</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
