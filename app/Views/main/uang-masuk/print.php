<!DOCTYPE html>
<html>

<head>
    <title>Laporan Uang Masuk</title>
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
            border-bottom: 2px solid #28a745;
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
            color: #28a745;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
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
            background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
            color: white;
            font-weight: bold;
            padding: 12px 8px;
            text-align: center;
            border: 1px solid #1e7e34;
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
            background-color: #f8fff9;
        }

        .report-table tbody tr:hover {
            background-color: #e8f5e8;
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

        .col-sumber {
            width: 20%;
            font-weight: 500;
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
            background: #f0fff4 !important;
            font-weight: bold;
            border-top: 2px solid #28a745;
        }

        .summary-row td {
            padding: 10px 8px;
            border: 1px solid #28a745;
        }

        .summary-label {
            background: linear-gradient(135deg, #e8f8ea 0%, #d1f2d5 100%);
            text-align: center;
            font-weight: bold;
            color: #28a745;
            text-transform: uppercase;
            font-size: 10px;
        }

        .summary-amount {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 11px;
            color: #28a745;
        }

        /* Special styling for different summary types */
        .total-masuk .summary-amount {
            color: #28a745;
            background: #d4edda;
            padding: 5px;
            border-radius: 3px;
        }

        .total-keluar .summary-amount {
            color: #dc3545;
        }

        .saldo .summary-amount {
            color: #155724;
            font-size: 12px;
            background: #d1ecf1;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #bee5eb;
        }

        /* Income specific highlights */
        .income-highlight {
            background: linear-gradient(45deg, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
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
        .positive-amount {
            color: #28a745;
            font-weight: bold;
        }

        .negative-amount {
            color: #dc3545;
        }

        .neutral-amount {
            color: #6c757d;
        }

        /* Source highlighting */
        .source-persembahan {
            background: #fff3cd;
            border-left: 3px solid #ffc107;
        }

        .source-donasi {
            background: #d1ecf1;
            border-left: 3px solid #17a2b8;
        }

        .source-kolekte {
            background: #f8d7da;
            border-left: 3px solid #dc3545;
        }

        /* Stats summary box */
        .stats-summary {
            background: linear-gradient(135deg, #e8f8ea 0%, #d1f2d5 100%);
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }

        .stats-title {
            font-size: 12px;
            font-weight: bold;
            color: #155724;
            margin-bottom: 10px;
        }

        .stats-amount {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>

<body>
    <div class="report-header">
        <img src="https://bajo.jumbomark.com/labels/J002018031283" alt="Logo Gereja" class="logo">
        <div class="church-name">Gereja Santapan Rohani Indonesia Denpasar</div>
        <div class="report-title">Laporan Uang Masuk</div>
        <div class="date-range">Periode: <strong><?= $startDate . ' sampai ' . $endDate ?></strong></div>
        <div class="generated-info">
            Dicetak pada: <?= date('d F Y, H:i:s') ?> |
            Sistem Informasi Pengelolaan Keuangan
        </div>
    </div>

    <!-- Quick Stats Summary -->
    <div class="stats-summary">
        <div class="stats-title">Total Penerimaan Periode Ini</div>
        <div class="stats-amount">Rp <?= number_format(array_sum(array_column($data, 'jumlah')), 0, ',', '.') ?></div>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-user">User</th>
                <th class="col-sumber">Sumber</th>
                <th class="col-tanggal">Tanggal</th>
                <th class="col-keterangan">Keterangan</th>
                <th class="col-jumlah">Jumlah Uang</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0;
            foreach ($data as $key => $row) : ?>
                <tr class="<?php
                            $sumber = strtolower($row['sumber']);
                            if (strpos($sumber, 'persembahan') !== false) echo 'source-persembahan';
                            elseif (strpos($sumber, 'donasi') !== false) echo 'source-donasi';
                            elseif (strpos($sumber, 'kolekte') !== false) echo 'source-kolekte';
                            ?>">
                    <td class="col-no"><?= $key + 1 ?></td>
                    <td class="col-user"><?= esc($row['username']) ?></td>
                    <td class="col-sumber">
                        <strong><?= esc($row['sumber']) ?></strong>
                    </td>
                    <td class="col-tanggal"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td class="col-keterangan"><?= esc($row['keterangan']) ?></td>
                    <td class="col-jumlah positive-amount">Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                </tr>
            <?php $total += $row['jumlah'];
            endforeach ?>

            <!-- Summary Rows -->
            <tr class="summary-row total-masuk income-highlight">
                <td colspan="5" class="summary-label">Total Uang Masuk</td>
                <td class="col-jumlah summary-amount">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>

            <tr class="summary-row total-keluar">
                <td colspan="5" class="summary-label">Total Uang Keluar</td>
                <td class="col-jumlah summary-amount negative-amount">Rp <?= number_format($totalUangKeluar, 0, ',', '.') ?></td>
            </tr>

            <tr class="summary-row saldo">
                <td colspan="5" class="summary-label">Saldo Akhir</td>
                <td class="col-jumlah summary-amount <?= $saldo >= 0 ? 'positive-amount' : 'negative-amount' ?>">
                    Rp <?= number_format($saldo, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Additional Info Section -->
    <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px; border-left: 4px solid #28a745;">
        <h4 style="color: #28a745; margin-bottom: 10px;">Keterangan:</h4>
        <ul style="font-size: 10px; color: #666; margin-left: 20px;">
            <li><strong>Persembahan:</strong> Ditandai dengan latar kuning</li>
            <li><strong>Donasi:</strong> Ditandai dengan latar biru muda</li>
            <li><strong>Kolekte:</strong> Ditandai dengan latar merah muda</li>
            <li><strong>Total:</strong> <?= count($data) ?> transaksi dalam periode ini</li>
        </ul>
    </div>

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
        <p style="margin-top: 5px; font-style: italic;">
            "Setiap orang hendaklah memberikan menurut kerelaan hatinya, jangan dengan sedih hati atau karena paksaan, sebab Allah mengasihi orang yang memberi dengan sukacita." - 2 Korintus 9:7
        </p>
    </div>
</body>

</html>