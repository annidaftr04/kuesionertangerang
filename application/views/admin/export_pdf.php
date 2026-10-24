<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Responden</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    th { background-color: #f0f0f0; }
    h2 { text-align: center; margin-bottom: 0; }
  </style>
</head>
<body>
  <h2>Data Responden</h2>
  <p>Filter: Bulan <?= $bulan ?: 'Semua' ?>, Tahun <?= $tahun ?: 'Semua' ?></p>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Domisili</th>
        <th>Jenis Kelamin</th>
        <th>Usia</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($responden)): ?>
        <?php foreach ($responden as $r): ?>
          <tr>
            <td><?= $r->id_responden ?></td>
            <td><?= $r->nama_responden ?></td>
            <td><?= date('d-m-Y', strtotime($r->tanggal_pengisian)) ?></td>
            <td><?= $r->domisili ?></td>
            <td><?= $r->jenis_kelamin ?></td>
            <td><?= $r->usia ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="6" style="text-align: center;">Tidak ada data responden</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>