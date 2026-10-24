<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<div class="ml-[350px] mt-16 p-6">
    <h1 class="text-2xl font-bold mb-4">Data Responden</h1>

    <div class="bg-white p-4 rounded-xl shadow mb-4">
        <form action="<?= site_url('admin/responden'); ?>" method="GET" class="flex items-center space-x-2">
            <label for="search" class="sr-only">Cari</label>
            <input type="text" id="search" name="search" placeholder="Cari berdasarkan nama..."
                   class="form-input flex-grow max-w-md border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                   value="<?= htmlspecialchars($search_term ?? '') ?>">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                🔍 Cari
            </button>
            <a href="<?= site_url('admin/responden'); ?>" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition">
                Reset
            </a>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <div class="mb-4">
            <a href="<?= site_url('admin/export_responden?bulan=' . ($filter_bulan ?? '') . '&tahun=' . ($filter_tahun ?? '') . '&search=' . ($search_term ?? '')) ?>"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">⬇ Download Data Responden</a>
            <a href="<?= site_url('admin/export_responden_pdf?bulan=' . ($filter_bulan ?? '') . '&tahun=' . ($filter_tahun ?? '') . '&search=' . ($search_term ?? '')) ?>"
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
                    <?php if (!empty($responden)): ?>
                        <?php foreach ($responden as $r): ?>
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