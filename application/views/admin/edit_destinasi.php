<?php $this->load->view('templates/admin_header'); ?>

<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">✏️ Edit Destinasi Wisata</h2>

    <?php if (validation_errors()) : ?>
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/edit_destinasi/' . $destinasi['id_destinasi']); ?>" method="post" class="space-y-6">
        <div>
            <label for="nama_destinasi" class="block text-sm font-medium text-gray-700">Nama Destinasi</label>
            <input type="text" name="nama_destinasi" id="nama_destinasi" value="<?= set_value('nama_destinasi', $destinasi['nama_destinasi']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" value="<?= set_value('lokasi', $destinasi['lokasi']); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="<?= base_url('admin/destinasi'); ?>" class="text-sm text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?php $this->load->view('templates/admin_footer'); ?>
