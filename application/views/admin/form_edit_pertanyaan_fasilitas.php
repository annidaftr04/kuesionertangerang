<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<div class="ml-[350px] mt-16 p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Pertanyaan Fasilitas</h1>

    <div class="bg-white p-6 rounded-xl shadow max-w-2xl">
        <form action="<?= site_url('admin/update_pertanyaan_fasilitas/' . $pertanyaan->id_pertanyaan) ?>" method="post">
            <div class="mb-4">
                <label for="teks_pertanyaan" class="block text-sm font-medium mb-1">Pertanyaan</label>
                <textarea name="teks_pertanyaan" id="teks_pertanyaan" rows="4" required class="w-full border rounded px-3 py-2"><?= htmlspecialchars($pertanyaan->teks_pertanyaan) ?></textarea>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="<?= site_url('admin/pertanyaan_fasilitas') ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            </div>
        </form>
    </div>
</div>