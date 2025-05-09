<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h3, h4 { text-align: center; }
    </style>
</head>
<body>
<div style="text-align: center;">
    <img src="https://bajo.jumbomark.com/labels/J002018031283" style="width: 150px;">
</div>
    <h3>Laporan Uang Keluar</h3>
    <h4>Dari tanggal <i><?= $startDate . ' sampai ' . $endDate ?></></h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Tujuan</th>
                <th>Tanggal Penerimaan</th>
                <th>Keterangan</th>
                <th>Jumlah Uang</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; foreach($data as $key => $data) : ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= esc($data['username']) ?></td>
                    <td><?= esc($data['tujuan']) ?></td>
                    <td><?= esc($data['tanggal']) ?></td>
                    <td><?= esc($data['keterangan']) ?></td>
                    <td style="text-align: right;">Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                </tr>
            <?php $total += $data['jumlah']; endforeach ?>
            <tr>
                <td style="text-align: center; font-weight: bold;" colspan="5">Total uang keluar</td>
                <td style="text-align: right; font-style: italic; font-weight: bold;">Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;" colspan="5">Total uang masuk</td>
                <td style="text-align: right; font-style: italic; font-weight: bold;">Rp <?= number_format($totalUangMasuk, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;" colspan="5">Saldo</td>
                <td style="text-align: right; font-style: italic; font-weight: bold;">Rp <?= number_format($saldo, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
