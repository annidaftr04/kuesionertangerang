<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<div class="ml-[350px] mt-16 p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Destinasi Wisata</h1>
    <div class="bg-white p-4 rounded-xl shadow mb-4">
    <form action="<?= site_url('admin/destinasi'); ?>" method="GET" class="flex items-center space-x-2">
        <label for="search" class="sr-only">Cari</label>
        <input type="text" id="search" name="search" placeholder="Cari berdasarkan nama destinasi..."
               class="form-input flex-grow max-w-md border border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
               value="<?= htmlspecialchars($search_term ?? '') ?>">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
            🔍 Cari
        </button>
        <a href="<?= site_url('admin/destinasi'); ?>" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition">
            Reset
        </a>
    </form>
</div>

    <a href="<?= site_url('admin/tambah_destinasi') ?>" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">+ Tambah Destinasi</a>

    <div class="bg-white p-6 rounded-xl shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Destinasi</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($destinasi): $no=1; foreach ($destinasi as $d): ?>
                        <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                            <td class="border px-4 py-2"><?= $no++ ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($d->nama_destinasi) ?></td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="<?= site_url('admin/edit_destinasi/' . $d->id_destinasi) ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="<?= site_url('admin/hapus_destinasi/' . $d->id_destinasi) ?>" class="text-red-600 hover:underline" onclick="return confirm('Hapus destinasi ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center py-4">Belum ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
 </div>
</div>