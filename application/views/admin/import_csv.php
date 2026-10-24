<?php if(isset($header)) $this->load->view('admin/header'); ?>

<style>
    /* Custom CSS untuk mempercantik tampilan tanpa file external */
    .import-container {
        font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        padding: 30px;
        background-color: #f4f6f9;
        min-height: 100vh;
    }
    .card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border: none;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .card-header {
        background-color: #007bff;
        color: white;
        padding: 15px 20px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }
    .card-body {
        padding: 25px;
    }
    .instruction-box {
        background-color: #e7f3ff;
        border-left: 5px solid #007bff;
        padding: 15px;
        margin-bottom: 25px;
        border-radius: 4px;
    }
    .instruction-box h5 {
        margin-top: 0;
        color: #0056b3;
    }
    .instruction-box ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
    .file-upload-wrapper {
        position: relative;
        margin: 20px 0;
    }
    .custom-file-input {
        width: 100%;
        height: 45px;
        border: 2px dashed #ddd;
        border-radius: 6px;
        padding: 10px;
        cursor: pointer;
        transition: border 0.3s;
    }
    .custom-file-input:hover {
        border-color: #007bff;
    }
    .btn-group-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-primary { background-color: #007bff; color: white; }
    .btn-primary:hover { background-color: #0056b3; }
    .btn-warning { background-color: #ffc107; color: #333; }
    .btn-warning:hover { background-color: #e0a800; }
    .btn-outline { background-color: transparent; border: 1px solid #ccc; color: #666; }
    .btn-outline:hover { background: #f8f9fa; }
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="import-container">
    <div class="card" style="max-width: 900px; margin: 0 auto;">
        <div class="card-header">
            <span>&nbsp; IMPORT DATA KUESIONER (.CSV)</span>
        </div>
        
        <div class="card-body">
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error">
                    <strong>Gagal:</strong> <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="instruction-box">
                <h5>Panduan Pengisian:</h5>
                <ul>
                    <li>Pastikan file berformat <strong>.csv</strong> (Comma Delimited).</li>
                    <li>Gunakan urutan kolom: <em>Nama, Jenis Kelamin, Usia, Domisili, Destinasi, ID Pertanyaan, Skala, Harapan</em>.</li>
                    <li>Kolom <strong>id_pertanyaan</strong> harus diisi angka 1 sampai 17.</li>
                </ul>
            </div>

            <form action="<?= base_url('admin/preview_import_csv') ?>" method="post" enctype="multipart/form-data">
                <div class="file-upload-wrapper">
                    <label style="font-weight: bold; display: block; margin-bottom: 8px;">Pilih File dari Komputer:</label>
                    <input type="file" name="file_csv" class="custom-file-input" accept=".csv" required id="csvFile">
                    <p id="fileNameDisplay" style="margin-top: 8px; color: #28a745; font-weight: bold; display: none;"></p>
                </div>

                <div class="btn-group-action">
                    <a href="<?= base_url('admin/download_template_csv') ?>" class="btn btn-outline">
                        ⬇ Download Template
                    </a>
                    <button type="submit" class="btn btn-warning">
                        👁 Preview Data CSV
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="<?= base_url('admin/dashboard') ?>" style="color: #666; text-decoration: none; font-size: 14px;">&larr; Kembali ke Dashboard</a>
    </div>
</div>

<script>
    // Menampilkan nama file yang dipilih
    document.getElementById('csvFile').onchange = function () {
        var display = document.getElementById('fileNameDisplay');
        if (this.files.length > 0) {
            display.innerText = "File terpilih: " + this.files[0].name;
            display.style.display = "block";
        }
    };
</script>

<?php if(isset($footer)) $this->load->view('admin/footer'); ?>