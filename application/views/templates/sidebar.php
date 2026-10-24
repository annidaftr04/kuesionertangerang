<!-- application/views/templates/sidebar.php -->

<?php if (!defined('FONT_AWESOME_INCLUDED')): ?>
    <?php define('FONT_AWESOME_INCLUDED', true); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php endif; ?>

<style>
.sidebar-theme {
    background: linear-gradient(135deg, #ffffff, #1e3a8a);
    transition: background 0.3s ease-in-out;
}

.sidebar-theme.purple {
    background: linear-gradient(135deg, #6b21a8, #9333ea);
}

.sidebar-theme.green {
    background: linear-gradient(135deg, #065f46, #10b981);
}

.sidebar-logo {
    position: relative;
    height: 95px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sidebar-logo::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 10%;
    width: 80%;
    height: 2px;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.2), rgba(50, 50, 50, 0.6), rgba(0, 0, 0, 0.2));
    border-radius: 999px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.span class {
    font-size: 18px;  
}
</style>

<aside class="fixed top-0 left-0 h-full w-[350px] sidebar-theme text-black shadow-md z-40">

    <!-- Logo -->
    <div class="sidebar-logo">
        <img src="<?= base_url('assets/img/logo_budpar.png') ?>" alt="Logo" class="h-12 w-25 mr-2">
    </div>

    <!-- Menu Navigasi -->
    <nav class="mt-9">
        <ul>
            <li>
                <a href="<?= base_url('index.php/admin/dashboard') ?>"
                   class="block py-3 px-6 hover:bg-yellow-400 transition flex items-center space-x-2">
                    <i class="fa-solid fa-tachometer-alt"></i>
                     <span class="text-2xl font-semibold">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('index.php/admin/responden') ?>"
                   class="block py-3 px-6 hover:bg-yellow-400 transition flex items-center space-x-2">
                    <i class="fa-solid fa-users"></i>
                    <span class="text-2xl font-semibold">Data Responden</span>
                </a>
            </li>
             <li>
            <a href="<?= base_url('index.php/admin/pertanyaan_fasilitas') ?>"
                class="block py-3 px-6 hover:bg-yellow-400 transition flex items-center space-x-2">
                <i class="fa-solid fa-circle-question"></i>
                <span class="text-2xl font-semibold"> Daftar Pertanyaan Penilaian Fasilitas</span>
            </a>
            </li>
            <li>
                <a href="<?= base_url('index.php/admin/penilaian_fasilitas') ?>"
                class="block py-3 px-6 hover:bg-yellow-400 transition flex items-center space-x-2">
                <i class="fa-solid fa-square-check"></i>
                <span class="text-2xl font-semibold">Penilaian Fasilitas</span>
            </a>
            </li>
            <li>
                <a href="<?= base_url('index.php/admin/Destinasi') ?>"
                class="block py-3 px-6 hover:bg-yellow-400 transition flex items-center space-x-2">
                <i class="fa-solid fa-star"></i>
                <span class="text-2xl font-semibold">Destinasi Wisata</span>
            </a>
            </li>
            <li>
                <a href="<?= base_url('index.php/admin/logout') ?>"
                class="block py-3 px-6 hover:bg-red-600 transition flex items-center space-x-2">
                <i class="fa-solid fa-sign-out-alt"></i>
                <span class="text-2xl font-semibold">Logout</span>
            </a>
            </li>
        </ul>
   </nav>
</aside>