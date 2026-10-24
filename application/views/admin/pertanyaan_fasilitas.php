<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<div class="ml-[350px] mt-16 p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pertanyaan Fasilitas</h1>

    <div class="bg-white p-4 rounded-xl shadow mb-4">
        <form action="<?= site_url('admin/pertanyaan_fasilitas'); ?>" method="GET" class="flex items-center space-x-2">
            <label for="search" class="sr-only">Cari</label>
            <input type="text" id="search" name="search" placeholder="Cari berdasarkan teks pertanyaan..."
                   class="form-input flex-grow max-w-lg border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                   value="<?= htmlspecialchars($search_term ?? '') ?>">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                🔍 Cari
            </button>
            <a href="<?= site_url('admin/pertanyaan_fasilitas'); ?>" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition">
                Reset
            </a>
        </form>
    </div>

    <div class="mb-4">
        <a href="<?= site_url('admin/tambah_pertanyaan_fasilitas'); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">+ Tambah Pertanyaan</a>
    </div>

    <div class="overflow-x-auto bg-white p-6 rounded-xl shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NO</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teks Pertanyaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
    <?php if (!empty($pertanyaan)): ?>
        <?php $no = 1; foreach ($pertanyaan as $p): ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $no++ ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($p->teks_pertanyaan) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="<?= site_url('admin/edit_pertanyaan_fasilitas/' . $p->id_pertanyaan) ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <a href="<?= site_url('admin/hapus_pertanyaan_fasilitas/' . $p->id_pertanyaan) ?>" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data pertanyaan.</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
 </div>
</div>