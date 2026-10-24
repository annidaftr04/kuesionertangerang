<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin Kuesioner</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Konten utama -->
  <div class="ml-[350px] mt-16 p-6">
 <!-- margin kiri disesuaikan dengan lebar sidebar -->

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
      <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-6 rounded-xl shadow-lg flex items-center justify-between">
        <div>
          <h2 class="text-sm font-medium opacity-80">Total Responden</h2>
          <p class="text-4xl font-bold mt-1"><?= is_array($total_responden) ? count($total_responden) : $total_responden ?></p>
        </div>
        <div class="opacity-80">📊</div>
      </div>

      <div class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-6 rounded-xl shadow-lg flex items-center justify-between">
        <div>
          <h2 class="text-sm font-medium opacity-80">Persentase Kepuasan</h2>
          <p class="text-4xl font-bold mt-1"><?= number_format($persentase_kepuasan ?? 0, 2) ?>%</p>
        </div>
        <div class="opacity-80">✅</div>
      </div>
    </div>

    <!-- Grafik Usia -->
    <div class="bg-white p-6 rounded-xl shadow mb-8">
      <h2 class="text-xl font-semibold mb-4">Distribusi Berdasarkan Usia</h2>
      <div class="w-full max-w-md mx-auto">
        <canvas id="ageChart" height="250"></canvas>
      </div>
    </div>

    <!-- Rata-rata Kepuasan -->
    <div class="bg-white p-6 rounded-xl shadow mb-8">
      <h2 class="text-xl font-semibold mb-4">Rata-rata Kepuasan Responden Terhadap Fasilitas (%)</h2>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div><canvas id="avgKepuasanChart" height="350"></canvas></div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fasilitas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rata-rata Skor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php if (!empty($avg_kepuasan)): ?>
                <?php foreach ($avg_kepuasan as $row): ?>
                  <tr>
                    <td><?= $row->teks_pertanyaan ?></td>
                    <td><?= number_format($row->total_presentase, 2) ?>%</td>
                    <td>
                      <?php
                        $presentase = $row->total_presentase;
                        if ($presentase >= 85) {
                            echo 'Sangat Puas';
                        } elseif ($presentase >= 70) {
                            echo 'Puas';
                        } elseif ($presentase >= 55) {
                            echo 'Cukup Puas';
                        } elseif ($presentase >= 40) {
                            echo 'Kurang Puas';
                        } else {
                            echo 'Tidak Puas';
                        }
                      ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="3">Belum ada data.</td></tr>
              <?php endif; ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Tabel Semua Responden -->
    <div class="bg-white p-6 rounded-xl shadow">
      <div class="mb-4">
        <a href="<?= site_url('admin/export_responden?bulan=' . ($filter_bulan ?? '') . '&tahun=' . ($filter_tahun ?? '')) ?>"
          class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">⬇ Download Data Responden</a>
        <a href="<?= site_url('admin/export_responden_pdf?bulan=' . ($filter_bulan ?? '') . '&tahun=' . ($filter_tahun ?? '')) ?>"
          target="_blank" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition ml-2">🧾 Export PDF</a>
      </div>
      <h2 class="text-xl font-semibold mb-4">Semua Responden</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domisili</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kelamin</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usia</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($all_responden)): ?>
              <?php foreach ($all_responden as $r): ?>
                <tr>
                  <td class="px-6 py-4 text-sm"><?= htmlspecialchars($r->id_responden ?? '-') ?></td>
                  <td class="px-6 py-4 text-sm"><?= htmlspecialchars($r->nama_responden ?? '-') ?></td>
                  <td class="px-6 py-4 text-sm"><?= !empty($r->tanggal_pengisian) ? date('d-m-Y', strtotime($r->tanggal_pengisian)) : '-' ?></td>
                  <td class="px-6 py-4 text-sm"><?= htmlspecialchars($r->domisili ?? '-') ?></td>
                  <td class="px-6 py-4 text-sm"><?= htmlspecialchars($r->jenis_kelamin ?? '-') ?></td>
                  <td class="px-6 py-4 text-sm"><?= htmlspecialchars($r->usia ?? '-') ?></td>
                  <td class="px-6 py-4 text-sm"><a href="<?= site_url('admin/detail/' . $r->id_responden) ?>" class="text-blue-600 hover:underline">Lihat Detail</a></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada responden.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Script Chart -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const ageData = <?= json_encode($age_distribution ?? []); ?>;
      const avgData = <?= json_encode($avg_kepuasan ?? []); ?>;

      if (ageData.length) {
        new Chart(document.getElementById('ageChart'), {
          type: 'pie',
          data: {
            labels: ageData.map(i => i.usia || '-'),
            datasets: [{ data: ageData.map(i => parseInt(i.jumlah)), backgroundColor: ['#6366F1','#A855F7','#EC4899','#F97316','#10B981'] }]
          },
          options: { responsive: true }
        });
      }

      if (avgData.length) {
  new Chart(document.getElementById('avgKepuasanChart'), {
    type: 'bar',
    data: {
      labels: avgData.map(i => i.teks_pertanyaan || '-'),
      datasets: [{
        data: avgData.map(i => parseFloat(i.total_presentase)),  // <-- pakai presentase
        backgroundColor: 'rgba(34,197,94,0.7)', // warna hijau stabil
        borderColor: 'rgba(21,128,61,1)',
        borderWidth: 1,
        borderRadius: 4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          max: 100,  // <-- ubah dari 5 ke 100
          title: {
            display: true,
            text: 'Tingkat Kepuasan (%)'
          },
          ticks: {
            callback: function(value) {
              return value + '%';
            }
          }
        },
        x: {
          title: {
            display: true,
            text: 'Fasilitas'
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.parsed.y + '%';
            }
          }
        }
      }
    }
  });
}

    });
  </script>
</body>
</html>
<?php $this->load->view('templates/admin_footer'); ?>
