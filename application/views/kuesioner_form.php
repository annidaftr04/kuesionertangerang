<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Kepuasan Fasilitas</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        /* ==========================================================================
           CSS untuk Tampilan Kuesioner yang Lebih Menarik (Diperbarui)
           ========================================================================== */

        /* Pengaturan Global */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1abc9c, #2ecc71, #3498db);
            background-size: 200% 200%;
            animation: gradient-animation 10s ease infinite;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            color: #34495e;
        }

        /* Animasi gradasi warna */
        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Wrapper utama kuesioner */
        .kuesioner-wrapper {
            background-color: #ffffff;
            max-width: 900px;
            margin: 30px auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Header Kuesioner */
        .kuesioner-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .kuesioner-header h1 {
            font-weight: 700;
            color: #34495e;
            font-size: 2.5rem;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .kuesioner-header .header-divider {
            width: 80px;
            height: 4px;
            background-color: #34495e;
            margin: 0 auto;
            border-radius: 2px;
        }

        .kuesioner-header .subtitle {
            font-weight: 600;
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .kuesioner-header .instruction {
            font-weight: 400;
            color: #95a5a6;
            font-size: 1rem;
            margin: 0;
        }

        /* Styling untuk Formulir */
        .card {
            border: none;
            border-radius: 10px;
        }

        .form-group label {
            font-weight: 600;
            color: #34495e;
        }

        /* Styling untuk item penilaian */
        .item-penilaian-group {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .item-penilaian-group.is-invalid-group {
            border: 2px solid #dc3545;
            background-color: #ffecec;
        }

        .item-penilaian-group h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 15px;
        }

        /* ==========================================================================
           PENGATURAN SPESIFIK UNTUK BAGIAN PENILAIAN (EMOTICON) - PERBAIKAN
           ========================================================================== */
        
        /* Menggunakan Flexbox untuk tata letak yang sejajar */
        .rating-row {
            display: flex;
            align-items: center; /* Menyelaraskan item secara vertikal di tengah */
            margin-bottom: 10px;
        }

        .rating-label-wrapper {
            font-weight: 500;
            color: #555;
            flex-basis: 15%; /* Memberikan lebar tetap untuk label "Harapan" dan "Kenyataan" */
            text-align: left;
            padding-right: 15px;
        }
        
        .rating-options-container {
            display: flex;
            flex: 1; /* Mengambil sisa ruang yang tersedia */
        }

        /* Menggunakan Grid untuk menata emotikon dalam kolom yang konsisten */
        .radio-group-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Membuat 4 kolom dengan lebar yang sama */
            gap: 5px; /* Jarak antar item */
            width: 100%;
        }

        .radio-item {
            width: 100%; /* Memastikan setiap item mengisi kolomnya */
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 5px;
            position: relative;
        }
        
        /* Menyembunyikan input radio asli */
        .form-check-input.rating-radio {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }
        
        /* Styling default untuk emoji */
        .emoji-label {
            font-size: 3rem;
            opacity: 0.5;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .form-check-label-emoji {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-weight: 400;
            margin-top: 5px;
            z-index: 1;
            transition: color 0.2s ease;
        }
        
        /* Efek hover dan checked */
        .radio-item:hover .emoji-label {
            transform: scale(1.1);
            opacity: 0.8;
        }
        
        .form-check-input.rating-radio:checked + .emoji-label {
            transform: scale(1.2);
            opacity: 1;
            filter: drop-shadow(0 0 5px rgba(0,0,0,0.3));
        }

        .form-check-input.rating-radio:checked ~ .form-check-label-emoji {
            color: #34495e;
            font-weight: 600;
        }

        /* Tambahan CSS untuk Tanda Error */
        .is-invalid {
            border-color: #dc3545 !important;
        }
        
        .is-invalid + .text-danger {
            display: block !important;
        }
        
        .item-penilaian-group.is-invalid-group {
            border: 2px solid #dc3545;
            background-color: #ffecec;
        }

        /* Styling untuk Tombol */
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        
        /* ==========================================================================
           Responsif untuk Tampilan Mobile (Perbaikan)
           ========================================================================== */
        @media (max-width: 767px) {
            body { padding: 10px; }
            .kuesioner-wrapper {
                margin: 0;
                padding: 20px;
                border-radius: 0;
                box-shadow: none;
            }
            .kuesioner-header h1 { font-size: 1.5rem; }
            .item-penilaian-group { padding: 15px; }
            .item-penilaian-group h5 { font-size: 1rem; }
            
            /* Mengubah Flexbox untuk mobile */
            .rating-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .rating-label-wrapper {
                flex-basis: auto;
                margin-bottom: 10px;
                padding-right: 0;
            }
            .rating-options-container {
                width: 100%;
            }
            .radio-group-wrapper {
                grid-template-columns: repeat(4, 1fr); /* Tetap menggunakan grid untuk konsistensi */
                gap: 5px;
            }
            .radio-item {
                padding: 0 5px;
            }
            
            .emoji-label { font-size: 2rem; }
            .form-check-label-emoji { font-size: 0.75rem; }
        }
        .select2-container { width: 100% !important; }
        .select2-container .select2-selection--single { height: calc(2.25rem + 2px); } /* samakan tinggi bootstrap */
        .select2-container .select2-selection__rendered { padding-left: 0.75rem; padding-top: 0.2rem; }

    </style>
</head>
<body>
    <div class="container kuesioner-wrapper py-5">
        <div class="text-center mb-4 kuesioner-header">
            <h1 class="h3 font-weight-bold">KUESIONER KEPUASAN FASILITAS OBJEK WISATA DI KOTA TANGERANG</h1>
            <div class="header-divider"></div>
            <p class="subtitle mt-3">Petunjuk Pengisian:</p>
            <p class="instruction">Berikan tanda (✓) pada jawaban yang sesuai dengan pendapat Anda.</p>
            <p class="instruction">Skala 1 = Tidak Puas, 2 = Cukup Puas, 3 = Puas, 4 = Sangat Puas.</p>
        </div>

        <?php if ($this->session->flashdata('success_msg')): ?>
            <div class="alert alert-success text-center">
                <?= htmlspecialchars($this->session->flashdata('success_msg')) ?>
            </div>
        <?php elseif ($this->session->flashdata('error_msg')): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($this->session->flashdata('error_msg')) ?>
            </div>
        <?php endif; ?>

        <?php echo form_open('kuesioner/submit', ['class' => 'mt-4']); ?>

        <div id="step-1">
            <div class="card p-4 mb-4">
                <h4 class="mb-3">A. Data Responden</h4>
                <div class="form-group">
                    <label for="nama">Nama: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Masukkan Nama Anda">
                    <?php echo form_error('nama', '<div class="text-danger mt-2">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin: <span class="text-danger">*</span></label>
                    <div class="d-flex flex-wrap" id="jenis-kelamin-group">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="Laki-laki" <?php echo set_radio('jenis_kelamin', 'Laki-laki'); ?>>
                            <label class="form-check-label" for="jk_l">Laki-laki</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="Perempuan" <?php echo set_radio('jenis_kelamin', 'Perempuan'); ?>>
                            <label class="form-check-label" for="jk_p">Perempuan</label>
                        </div>
                    </div>
                    <?php echo form_error('jenis_kelamin', '<div class="text-danger mt-2">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Usia: <span class="text-danger">*</span></label>
                    <div class="d-flex flex-wrap" id="usia-group">
                        <?php
                            $usia_options = ['<17'=>'< 17', '17-25'=>'17-25', '26-35'=>'26-35', '36-45'=>'36-45', '>45'=>'> 45'];
                            foreach ($usia_options as $val => $label):
                        ?>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="usia" value="<?php echo $val; ?>" id="usia_<?php echo str_replace(['<','>','–'], ['lt','gt','_'], $val); ?>" <?php echo set_radio('usia', $val); ?>>
                            <label class="form-check-label" for="usia_<?php echo str_replace(['<','>','–'], ['lt','gt','_'], $val); ?>"><?php echo $label; ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php echo form_error('usia', '<div class="text-danger mt-2">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label>Domisili: <span class="text-danger">*</span></label>
                    <div class="d-flex flex-wrap" id="domisili-group">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili1" value="Kota Tangerang" <?php echo set_radio('domisili', 'Kota Tangerang'); ?>>
                            <label class="form-check-label" for="domisili1">Kota Tangerang</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili2" value="Luar Kota Tangerang" <?php echo set_radio('domisili', 'Luar Kota Tangerang'); ?>>
                            <label class="form-check-label" for="domisili2">Luar Kota Tangerang</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili3" value="Luar Negeri" <?php echo set_radio('domisili', 'Luar Negeri'); ?>>
                            <label class="form-check-label" for="domisili3">Luar Negeri</label>
                        </div>
                    </div>
                    <?php echo form_error('domisili', '<div class="text-danger mt-2">', '</div>'); ?>
                </div>
            </div>
            <div class="text-center mb-5">
                <button type="button" class="btn btn-primary btn-lg" onclick="nextStep(1)">Lanjut ke Penilaian</button>
            </div>
        </div>

        <div id="step-2" class="d-none">
            <div class="card p-4 mb-4">
                <h4 class="mb-3">B. Penilaian Fasilitas <span class="text-danger">*</span></h4>
                <div class="form-group mt-0">
                    <label for="nama_destinasi" class="mb-1">
                        Nama Objek Wisata: <span class="text-danger">*</span>
                    </label>
                
                    <select id="nama_destinasi" name="nama_destinasi" class="form-control">
                        <option value="">Pilih atau cari destinasi...</option>
                        <?php if (!empty($destinasi_list)): ?>
                            <?php foreach ($destinasi_list as $destinasi): 
                                $val = htmlspecialchars($destinasi['nama_destinasi']);
                                $selected = (set_value('nama_destinasi') == $val) ? ' selected' : '';
                            ?>
                                <option value="<?= $val ?>"<?= $selected ?>><?= $val ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                
                    <?php echo form_error('nama_destinasi', '<div class="text-danger mt-2">', '</div>'); ?>
                </div>
                
                <?php
                    $emojis = [
                        1 => ['emoji' => '🙁', 'text' => 'Tidak Puas'],
                        2 => ['emoji' => '😐', 'text' => 'Cukup Puas'],
                        3 => ['emoji' => '😊', 'text' => 'Puas'],
                        4 => ['emoji' => '😁', 'text' => 'Sangat Puas'],
                    ];
                ?>

                <?php if (!empty($pertanyaan)): $no = 1; foreach ($pertanyaan as $row): ?>
                    <div class="item-penilaian-group" data-id-pertanyaan="<?php echo $row['id_pertanyaan']; ?>">
                        <h5 class="mb-3"><?php echo $no++ . '. ' . (isset($row['teks_pertanyaan']) ? htmlspecialchars($row['teks_pertanyaan']) : '[Pertanyaan tidak ditemukan]'); ?></h5>
                        
                        <div class="rating-row">
                            <div class="rating-label-wrapper">Harapan</div>
                            <div class="rating-options-container">
                                <div class="radio-group-wrapper">
                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                        <div class="radio-item">
                                            <input class="form-check-input rating-radio" type="radio" name="harapan[<?php echo $row['id_pertanyaan']; ?>]" id="harapan_<?php echo $row['id_pertanyaan'] . '_' . $i; ?>" value="<?php echo $i; ?>" <?php echo set_radio('harapan[' . $row['id_pertanyaan'] . ']', $i); ?>>
                                            <span class="emoji-label"><?php echo $emojis[$i]['emoji']; ?></span>
                                            <label class="form-check-label-emoji" for="harapan_<?php echo $row['id_pertanyaan'] . '_' . $i; ?>"><?php echo $emojis[$i]['text']; ?></label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="rating-row">
                            <div class="rating-label-wrapper">Kenyataan</div>
                            <div class="rating-options-container">
                                <div class="radio-group-wrapper">
                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                        <div class="radio-item">
                                            <input class="form-check-input rating-radio" type="radio" name="kenyataan[<?php echo $row['id_pertanyaan']; ?>]" id="kenyataan_<?php echo $row['id_pertanyaan'] . '_' . $i; ?>" value="<?php echo $i; ?>" <?php echo set_radio('kenyataan[' . $row['id_pertanyaan'] . ']', $i); ?>>
                                            <span class="emoji-label"><?php echo $emojis[$i]['emoji']; ?></span>
                                            <label class="form-check-label-emoji" for="kenyataan_<?php echo $row['id_pertanyaan'] . '_' . $i; ?>"><?php echo $emojis[$i]['text']; ?></label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>

            <div class="d-flex justify-content-between mt-5">
                <button type="button" class="btn btn-secondary btn-lg" onclick="prevStep(2)">Kembali</button>
                <button type="submit" class="btn btn-primary btn-lg">Kirim Kuesioner</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Select2 JS (letakkan setelah jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let destinasiValid = false;

    // Inisialisasi Select2 (setelah DOM ready)
    $(document).ready(function() {
        // Inisialisasi Select2 pada #nama_destinasi
        $(document).ready(function() {
    $('#nama_destinasi').select2({
        placeholder: "Pilih atau cari destinasi...",
        allowClear: true,
        width: '100%',
        templateResult: formatOption
    });
    });
    
    function formatOption(opt) {
        if (!opt.id) return opt.text;
    
        return $(`
            <div style="
                padding: 6px 10px;
                border-radius: 8px;
                border: 1px solid #ddd;
                margin: 4px 0;
            ">
                ${opt.text}
            </div>
        `);
    }


        // Jika ada nilai ter-set dari server, anggap valid
        if ($('#nama_destinasi').val()) {
            destinasiValid = true;
        }

        // Update destinasiValid saat user memilih/unselect
        $('#nama_destinasi').on('select2:select select2:unselect', function () {
            destinasiValid = !!$(this).val();
        });
    });

    // Fungsi untuk menghapus pesan error validasi
    function resetValidationErrors() {
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.form-group .text-danger.mt-2').forEach(el => el.remove());
        document.querySelectorAll('.item-penilaian-group.is-invalid-group').forEach(item => {
            item.classList.remove('is-invalid-group');
        });
    }

    // Fungsi untuk pindah ke langkah berikutnya (dari step 1 ke step 2)
    function nextStep(currentStep) {
        resetValidationErrors();
        let isValid = true;
        let firstInvalidElement = null;

        // Validasi Nama
        const nama = document.getElementById('nama');
        if (nama.value.trim() === '') {
            nama.classList.add('is-invalid');
            nama.parentElement.insertAdjacentHTML('beforeend', '<div class="text-danger mt-2">Nama wajib diisi.</div>');
            isValid = false;
            if (!firstInvalidElement) firstInvalidElement = nama;
        }

        // Validasi Jenis Kelamin
        const jkChecked = document.querySelector('input[name="jenis_kelamin"]:checked');
        if (!jkChecked) {
            const jkGroup = document.getElementById('jenis-kelamin-group');
            jkGroup.parentElement.insertAdjacentHTML('beforeend', '<div class="text-danger mt-2">Jenis kelamin wajib dipilih.</div>');
            isValid = false;
            if (!firstInvalidElement) firstInvalidElement = jkGroup;
        }

        // Validasi Usia
        const usiaChecked = document.querySelector('input[name="usia"]:checked');
        if (!usiaChecked) {
            const usiaGroup = document.getElementById('usia-group');
            usiaGroup.parentElement.insertAdjacentHTML('beforeend', '<div class="text-danger mt-2">Usia wajib dipilih.</div>');
            isValid = false;
            if (!firstInvalidElement) firstInvalidElement = usiaGroup;
        }

        // Validasi Domisili
        const domisiliChecked = document.querySelector('input[name="domisili"]:checked');
        if (!domisiliChecked) {
            const domisiliGroup = document.getElementById('domisili-group');
            domisiliGroup.parentElement.insertAdjacentHTML('beforeend', '<div class="text-danger mt-2">Domisili wajib dipilih.</div>');
            isValid = false;
            if (!firstInvalidElement) firstInvalidElement = domisiliGroup;
        }

        if (!isValid) {
            if (firstInvalidElement) {
                firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }

        // Jika validasi sukses, sembunyikan step 1 dan tampilkan step 2
        document.getElementById('step-1').classList.add('d-none');
        document.getElementById('step-2').classList.remove('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Fungsi untuk kembali ke langkah sebelumnya (dari step 2 ke step 1)
    function prevStep(currentStep) {
        resetValidationErrors();
        document.getElementById('step-' + currentStep).classList.add('d-none');
        document.getElementById('step-' + (currentStep - 1)).classList.remove('d-none');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Validasi saat formulir akan disubmit
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();
        let isValid = true;
        let firstInvalidElement = null;

        resetValidationErrors();

        // Validasi Nama Destinasi → harus ada pilihan (destinasiValid)
        // Untuk select2, ambil val dari select
        const namaDestinasi = document.getElementById('nama_destinasi');
        if (!destinasiValid || !namaDestinasi.value.trim()) {
            // tambahkan class is-invalid pada elemen select2 container agar tampil
            // (karena Select2 menyembunyikan select asli)
            $('#nama_destinasi').next('.select2-container').find('.select2-selection').addClass('is-invalid');
            namaDestinasi.parentElement.insertAdjacentHTML(
                'beforeend',
                '<div class="text-danger mt-2">Silakan pilih nama destinasi dari daftar.</div>'
            );
            isValid = false;
            if (!firstInvalidElement) firstInvalidElement = namaDestinasi;
        }

        // Validasi setiap pertanyaan penilaian
        const pertanyaanIDs = <?php echo json_encode(array_column($pertanyaan, 'id_pertanyaan')); ?>;
        pertanyaanIDs.forEach(id => {
            const harapan = document.querySelector(`input[name="harapan[${id}]"]:checked`);
            const kenyataan = document.querySelector(`input[name="kenyataan[${id}]"]:checked`);
            if (!harapan || !kenyataan) {
                const group = document.querySelector(`[data-id-pertanyaan="${id}"]`);
                if (group) {
                    group.classList.add('is-invalid-group');
                    if (!firstInvalidElement) firstInvalidElement = group;
                }
                isValid = false;
            }
        });

        // Jika ada yang tidak valid, scroll ke elemen yang salah
        if (!isValid) {
            if (firstInvalidElement) {
                firstInvalidElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            // sebelum submit, kalau select2 menambahkan is-invalid pada container - hapus dulu
            $('#nama_destinasi').next('.select2-container').find('.select2-selection').removeClass('is-invalid');
            this.submit();
        }
    });

    // HAPUS / COMMENT OUT autocomplete jQuery UI bila sebelumnya ada
    // $("#nama_destinasi").autocomplete({ ... });
</script>
</body>
</html>