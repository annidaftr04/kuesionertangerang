<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-check"></i> Detail Jawaban Responden</h4>
        </div>
        <div class="card-body">
            <h5 class="text-muted"><i class="fas fa-address-card"></i> Biodata Responden</h5>
            <?php if (!empty($responden)): ?>
                <table class="table table-bordered">
                    <tr><th width="200">Nama</th><td><?= htmlspecialchars($responden->nama_responden ?? '-'); ?></td></tr>
                    <tr><th>Usia</th><td><?= htmlspecialchars($responden->usia ?? '-'); ?></td></tr>
                    <tr><th>Jenis Kelamin</th><td><?= htmlspecialchars($responden->jenis_kelamin ?? '-'); ?></td></tr>
                    <tr><th>Domisili</th><td><?= htmlspecialchars($responden->domisili ?? '-'); ?></td></tr>
                    <tr><th>Nama Destinasi</th><td><?= htmlspecialchars($responden->nama_destinasi ?? '-'); ?></td></tr>
                    <tr><th>Tanggal Pengisian</th><td>
                        <?php
                            $tgl = $responden->tanggal_pengisian ?? null;
                            echo $tgl ? date('d M Y', strtotime($tgl)) : '-';
                        ?>
                    </td></tr>
                </table>

            <?php else: ?>
                <div class="alert alert-warning">Biodata responden tidak ditemukan.</div>
            <?php endif; ?>

            <h5 class="mt-4 text-muted"><i class="fas fa-chart-bar"></i> Penilaian Skala</h5>
            <?php if (!empty($penilaian_fasilitas) && is_iterable($penilaian_fasilitas)): ?>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Pertanyaan</th>
                            <th>Skala Nilai</th>
                            <th>Harapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($penilaian_fasilitas as $j) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($j->teks_pertanyaan ?? ''); ?></td>
                                <td><?= htmlspecialchars($j->skala_nilai ?? ''); ?></td>
                                <td><?= htmlspecialchars($j->harapan ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">Belum ada penilaian skala fasilitas untuk responden ini.</div>
            <?php endif; ?>

            <a href="<?= base_url('index.php/admin/dashboard'); ?>" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
