<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/admin_header'); ?>

<div class="ml-[350px] mt-16 p-6">
    <h1 class="text-2xl font-bold mb-4"><?= $judul ?></h1>

    <div class="bg-white p-6 rounded-xl shadow max-w-md">
        <?php echo form_open(); ?>
            <div class="mb-4">
                <label class="block text-sm font-medium">Nama Destinasi</label>
                <input type="text" name="nama_destinasi" value="<?= set_value('nama_destinasi', $destinasi->nama_destinasi ?? ''); ?>" class="w-full border rounded px-3 py-2" required>
                <?php echo form_error('nama_destinasi', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="<?= site_url('admin/destinasi') ?>" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('templates/admin_footer'); ?>