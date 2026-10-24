<h3>Preview Import CSV</h3>

<table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%;">
    <tr style="background-color: #f2f2f2;">
        <th>Nama</th>
        <th>Domisili</th>
        <th>Destinasi</th>
        <th>ID Pertanyaan</th>
        <th>Skala</th>
        <th>Harapan</th>
        <th>Status</th>
    </tr>

    <?php foreach ($preview as $p): ?>
    <tr style="<?= $p['status'] == 'ERROR' ? 'background-color: #ffe6e6;' : '' ?>">
        <td><?= $p['responden']['nama_responden'] ?? '-' ?></td>
        <td><?= $p['responden']['domisili'] ?? '-' ?></td>
        <td><?= $p['responden']['nama_destinasi'] ?? '-' ?></td>
        
        <td><?= $p['id_pertanyaan'] ?></td>
        <td><?= $p['skala_nilai'] ?></td>
        <td><?= $p['harapan'] ?></td>
        <td>
            <?php if ($p['status'] == 'OK'): ?>
                <span style="color: green;">✅ OK</span>
            <?php else: ?>
                <span style="color: red;">❌ ERROR (Data Tidak Lengkap)</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br>

<div style="display: flex; gap: 10px;">
    <form action="<?= base_url('admin/proses_import_csv') ?>" method="post">
        <button type="submit" class="btn btn-success" style="padding: 10px 20px; cursor: pointer;">
            ✅ Konfirmasi & Import ke Database
        </button>
    </form>

    <a href="<?= base_url('admin/import_csv') ?>" style="text-decoration: none;">
        <button type="button" style="padding: 10px 20px; cursor: pointer; background: #ccc; border: 1px solid #999;">
            Back
        </button>
    </a>
</div>