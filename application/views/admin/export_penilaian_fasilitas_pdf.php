<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Penilaian Fasilitas</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        td.left {
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Rekap Penilaian Fasilitas</h2>
<p>Bulan: <?= $bulan ?: 'Semua'; ?> | Tahun: <?= $tahun ?: 'Semua'; ?></p>

<table>
    <tr>
        <th>No</th>
        <th>Nama Responden</th>
        <th>Nama Destinasi</th>
        <th>Tanggal</th>
        <th>Pertanyaan</th>
        <th>Skor Kenyataan</th>
        <th>Skor Harapan</th>
        <th>Persentase (%)</th>
    </tr>
    <?php
    $no = 1;
    foreach ($data_penilaian as $responden) {
        $rowspan = count($responden['penilaian']);
        $printed = false;
        foreach ($responden['penilaian'] as $item):
            $persen = $item['harapan'] > 0
                ? round(($item['skala_nilai'] / $item['harapan']) * 100, 2)
                : 0;
    ?>
    <tr>
        <?php if (!$printed): ?>
            <td rowspan="<?= $rowspan; ?>"><?= $no++; ?></td>
            <td rowspan="<?= $rowspan; ?>"><?= htmlspecialchars($responden['nama']); ?></td>
            <td rowspan="<?= $rowspan; ?>"><?= htmlspecialchars($responden['destinasi']); ?></td>
            <td rowspan="<?= $rowspan; ?>"><?= date('d-m-Y', strtotime($responden['tanggal'])); ?></td>
            <?php $printed = true; ?>
        <?php endif; ?>
        <td class="left"><?= htmlspecialchars($item['pertanyaan']); ?></td>
        <td><?= $item['skala_nilai']; ?></td>
        <td><?= $item['harapan']; ?></td>
        <td><?= $persen; ?>%</td>
    </tr>
    <?php endforeach; } ?>
</table>

</body>
</html>
