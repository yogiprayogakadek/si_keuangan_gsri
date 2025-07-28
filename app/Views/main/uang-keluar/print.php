<!DOCTYPE html>
<html>

<head>
    <title>Laporan Uang Keluar</title>
    <meta charset="UTF-8">
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            background: white;
            padding: 20px;
        }

        /* Print Specific Styles */
        @media print {
            body {
                padding: 0;
                font-size: 10px;
            }

            .page-break {
                page-break-before: always;
            }

            .no-print {
                display: none !important;
            }

            @page {
                margin: 1cm;
                size: A4;
            }
        }

        /* Header Styles */
        .report-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #003366;
            padding-bottom: 20px;
        }

        .logo {
            width: 120px;
            max-width: 120px;
            height: auto;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 5px;
        }

        .church-name {
            font-size: 16px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            color: #003366;
            margin: 15px 0 5px 0;
            text-transform: uppercase;
        }

        .date-range {
            font-size: 12px;
            color: #666;
            font-style: italic;
            margin-bottom: 10px;
        }

        .generated-info {
            font-size: 10px;
            color: #888;
            margin-top: 10px;
        }

        /* Table Styles */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .report-table th {
            background: linear-gradient(135deg, #003366 0%, #004080 100%);
            color: white;
            font-weight: bold;
            padding: 12px 8px;
            text-align: center;
            border: 1px solid #002244;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .report-table td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .report-table tbody tr:hover {
            background-color: #e3f2fd;
        }

        /* Column Specific Styles */
        .col-no {
            width: 5%;
            text-align: center;
            font-weight: bold;
        }

        .col-user {
            width: 15%;
        }

        .col-tujuan {
            width: 20%;
        }

        .col-tanggal {
            width: 15%;
            text-align: center;
        }

        .col-keterangan {
            width: 25%;
            font-size: 9px;
            line-height: 1.3;
        }

        .col-jumlah {
            width: 20%;
            text-align: right;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }

        /* Summary Rows */
        .summary-row {
            background: #f0f8ff !important;
            font-weight: bold;
            border-top: 2px solid #003366;
        }

        .summary-row td {
            padding: 10px 8px;
            border: 1px solid #003366;
        }

        .summary-label {
            background: linear-gradient(135deg, #e8f4f8 0%, #d4e9f7 100%);
            text-align: center;
            font-weight: bold;
            color: #003366;
            text-transform: uppercase;
            font-size: 10px;
        }

        .summary-amount {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 11px;
            color: #003366;
        }

        /* Special styling for different summary types */
        .total-keluar .summary-amount {
            color: #dc3545;
        }

        .total-masuk .summary-amount {
            color: #28a745;
        }

        .saldo .summary-amount {
            color: #003366;
            font-size: 12px;
            background: #fff3cd;
            padding: 5px;
            border-radius: 3px;
        }

        /* Footer */
        .report-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 9px;
            color: #666;
            text-align: center;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 60px;
            padding-top: 5px;
            font-size: 10px;
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-italic {
            font-style: italic;
        }

        /* Responsive for smaller prints */
        @media print and (max-width: 21cm) {
            .report-table {
                font-size: 9px;
            }

            .report-table th,
            .report-table td {
                padding: 6px 4px;
            }

            .col-keterangan {
                font-size: 8px;
            }
        }

        /* Color coding for amounts */
        .negative-amount {
            color: #dc3545;
        }

        .positive-amount {
            color: #28a745;
        }

        .neutral-amount {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="report-header">
        <img src="https://bajo.jumbomark.com/labels/J002018031283" alt="Logo Gereja" class="logo">
        <div class="church-name">Gereja Santapan Rohani Indonesia Denpasar</div>
        <div class="report-title">Laporan Uang Keluar</div>
        <div class="date-range">Periode: <strong><?= $startDate . ' sampai ' . $endDate ?></strong></div>
        <div class="generated-info">
            Dicetak pada: <?= date('d F Y, H:i:s') ?> |
            Sistem Informasi Pengelolaan Keuangan
        </div>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-user">User</th>
                <th class="col-tujuan">Tujuan</th>
                <th class="col-tanggal">Tanggal</th>
                <th class="col-keterangan">Keterangan</th>
                <th class="col-jumlah">Jumlah Uang</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0;
            foreach ($data as $key => $row) : ?>
                <tr>
                    <td class="col-no"><?= $key + 1 ?></td>
                    <td class="col-user"><?= esc($row['username']) ?></td>
                    <td class="col-tujuan"><?= esc($row['tujuan']) ?></td>
                    <td class="col-tanggal"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td class="col-keterangan"><?= esc($row['keterangan']) ?></td>
                    <td class="col-jumlah negative-amount">Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                </tr>
            <?php $total += $row['jumlah'];
            endforeach ?>

            <!-- Summary Rows -->
            <tr class="summary-row total-keluar">
                <td colspan="5" class="summary-label">Total Uang Keluar</td>
                <td class="col-jumlah summary-amount negative-amount">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>

            <tr class="summary-row total-masuk">
                <td colspan="5" class="summary-label">Total Uang Masuk</td>
                <td class="col-jumlah summary-amount positive-amount">Rp <?= number_format($totalUangMasuk, 0, ',', '.') ?></td>
            </tr>

            <tr class="summary-row saldo">
                <td colspan="5" class="summary-label">Saldo Akhir</td>
                <td class="col-jumlah summary-amount <?= $saldo >= 0 ? 'positive-amount' : 'negative-amount' ?>">
                    Rp <?= number_format($saldo, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <div>Mengetahui,</div>
            <div class="signature-line">
                <strong>Ketua Gereja</strong>
            </div>
        </div>

        <div class="signature-box">
            <div>Denpasar, <?= date('d F Y') ?></div>
            <div class="signature-line">
                <strong>Bendahara</strong>
            </div>
        </div>
    </div>

    <div class="report-footer">
        <p><strong>Catatan:</strong> Laporan ini dibuat secara otomatis oleh Sistem Informasi Pengelolaan Keuangan</p>
        <p>Gereja Santapan Rohani Indonesia Denpasar</p>
    </div>
</body>

</html>