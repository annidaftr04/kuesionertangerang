<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Kepuasan Fasilitas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
       body {
    font-family: 'Poppins', sans-serif;
    /* Gradasi warna biru-hijau yang baru */
    background: linear-gradient(135deg, #1abc9c, #2ecc71, #3498db);
    background-size: 200% 200%;
    animation: gradient-animation 10s ease infinite;
    
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    color: #ffffff; /* Warna teks putih agar kontras */
    text-align: center;
    padding: 20px;
}
        /* Animasi gradasi warna */
        @keyframes gradient-animation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .intro-container {
            max-width: 600px;
        }

        .intro-container h1 {
            font-weight: 700;
            font-size: 2.5rem;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .intro-container p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        /* Styling untuk menempatkan foto */
        .intro-container .logo-image {
            width: 250px; /* Atur lebar sesuai kebutuhan */
            height: auto;
            margin: 20px auto;
            display: block; /* Menjadikan elemen block agar bisa ditengahkan dengan margin */
        }

        /* Styling untuk tombol */
        .btn-start {
            background-color: rgba(100, 93, 93, 1); /* Tombol transparan */
            border: 2px solid #ffffff; /* Border putih */
            color: #ffffff;
            font-weight: 600;
            padding: 12px 35px;
            border-radius: 50px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-decoration: none; /* Menghilangkan garis bawah pada link */
            display: inline-block; /* Agar bisa menerapkan padding */
        }
        .btn-start:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="intro-container">
        <h1>Selamat datang di KUESIONER KEPUASAN FASILITAS</h1>

        <img src="<?php echo base_url('assets/img/logo_Tng.png'); ?>" alt="Logo Kuesioner" class="logo-image">

        <p>Suara Anda sangat berharga untuk perbaikan destinasi wisata di Kota Tangerang.</p>

        <a href="index.php/kuesioner" class="btn-start">Mulai Mengisi Kuesioner</a>
    </div>
</body>
</html>