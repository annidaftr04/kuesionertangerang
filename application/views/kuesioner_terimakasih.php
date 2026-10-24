<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Disimpan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <style>
        body {
            background-color: #4CAF50; /* warna hijau background luar */
            font-family: 'Poppins', sans-serif;
            padding: 20px; /* jarak dari sisi layar */
        }

        .kuesioner-wrapper {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            max-width: 550px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            font-size: 19px;
        }

        h1.h3 {
            font-size: 20px;
        }

        img {
            max-width: 180px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="kuesioner-wrapper text-center">
        <h1 class="h3 font-weight-bold">KUESIONER KEPUASAN FASILITAS DESTINASI WISATA DI KOTA TANGERANG</h1>
        <div class="my-3" style="height:3px; background:#333; width:80px; margin:0 auto;"></div>

        <img src="<?= base_url('assets/img/kasih.png'); ?>" alt="Logo">

        <div class="alert alert-success mt-4">
            Terima kasih atas jawaban anda, tunjukan bukti ini kepada petugas dilokasi.
        </div>
         <div class="alert alert-success mt-4">
            Thanks you for your response. Please show this confirmation to our staff at the location.
        </div>
          <div class="mt-4">
        <a href="<?php echo site_url('kuesioner'); ?>" class="btn btn-outline-secondary mt-3">
            &larr; Kembali 
        </a>
    </div>
</body>
</html>