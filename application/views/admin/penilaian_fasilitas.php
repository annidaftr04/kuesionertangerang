<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<div class="ml-[350px] mt-16 p-6">
    <h1 class="text-2xl font-bold mb-4">Penilaian Fasilitas</h1>

   <div class="bg-white p-4 rounded-xl shadow mb-4">
    
    <form action="<?= site_url('admin/penilaian_fasilitas'); ?>" method="GET" class="flex items-center space-x-2">
        <label for="search" class="sr-only">Cari</label>
        <input type="text" id="search" name="search" placeholder="Cari berdasarkan nama responden..." 
               class="form-input flex-grow max-w-md border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            🔍 Cari
        </button>
        <a href="<?= site_url('admin/penilaian_fasilitas'); ?>" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition">
            Reset
        </a>
    </form>
    </div>

    <div class="overflow-x-auto bg-white p-6 rounded-xl shadow">
        <div class="flex gap-3 mb-4">
            <a href="<?= site_url('admin/export_penilaian_fasilitas_excel?bulan=' . ($filter_bulan ?? '') . '&tahun=' . ($filter_tahun ?? '')) ?>"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">⬇ Export Excel</a>
            <a href="<?= site_url('admin/export_penilaian_fasilitas_pdf?bulan=' . ($filter_bulan ?? '') . '&tahun=' . ($filter_tahun ?? '')) ?>"
               target="_blank"
               class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">🧾 Export PDF</a>
               <a href="<?= site_url('admin/import_csv'); ?>"
                   class="bg-white-600 text-black px-4 py-2 rounded hover:bg-blue-700 transition">
                    , </a>

        </div>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Responden</th>
                    <th class="border px-4 py-2">Nama Destinasi</th> <!-- ✅ Tambah kolom -->
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Pertanyaan</th>
                    <th class="border px-4 py-2">Skor Kenyataan</th>
                    <th class="border px-4 py-2">Skor Harapan</th>
                    <th class="border px-4 py-2">Presentase (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($penilaian)): ?>
                    <?php
                    $no = 1;
                    $grouped = [];

                    // Kelompokkan berdasarkan nama responden, destinasi, dan tanggal
                    foreach ($penilaian as $p) {
                        $key = $p->nama_responden . '|' . $p->nama_destinasi . '|' . $p->tanggal_pengisian;
                        if (!isset($grouped[$key])) {
                            $grouped[$key] = [];
                        }
                        $grouped[$key][] = $p;
                    }
                    ?>

                    <?php foreach ($grouped as $key => $items): ?>
                        <tr><td colspan="8" class="bg-gray-200 h-4"></td></tr>

                        <?php 
                        list($nama_responden, $nama_destinasi, $tanggal) = explode('|', $key);
                        $first_row = true;
                        foreach ($items as $row): 
                            $presentase = ($row->harapan > 0) ? round(($row->skala_nilai / $row->harapan) * 100, 2) : 0;
                        ?>
                        <tr class="bg-white hover:bg-gray-50">
                            <?php if ($first_row): ?>
                                <td class="border px-4 py-2 text-center" rowspan="<?= count($items) ?>"><?= $no++ ?></td>
                                <td class="border px-4 py-2" rowspan="<?= count($items) ?>"><?= htmlspecialchars($nama_responden) ?></td>
                                <td class="border px-4 py-2" rowspan="<?= count($items) ?>"><?= htmlspecialchars($nama_destinasi) ?></td>
                                <td class="border px-4 py-2 text-center" rowspan="<?= count($items) ?>"><?= date('d-m-Y', strtotime($tanggal)) ?></td>
                                <?php $first_row = false; ?>
                            <?php endif; ?>
                            <td class="border px-4 py-2"><?= htmlspecialchars($row->teks_pertanyaan) ?></td>
                            <td class="border px-4 py-2 text-center"><?= $row->skala_nilai ?></td>
                            <td class="border px-4 py-2 text-center"><?= $row->harapan ?></td>
                            <td class="border px-4 py-2 text-center"><?= $presentase ?>%</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4">Tidak ada data penilaian fasilitas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
