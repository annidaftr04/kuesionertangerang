<!-- application/views/templates/header.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $judul ?? 'Dashboard Admin' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="min-h-screen">

<!-- Header -->
<!-- admin_header.php -->
<header class="bg-white shadow-md px-5 py-3 w-full">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>

        <!-- Filter + Logout -->
        <div class="flex items-center space-x-4">
            <form method="get" action="" class="flex flex-wrap gap-3 mb-4">
                <div>
                    <label class="block text-sm text-gray-600">Bulan</label>
                    <select name="bulan" class="border rounded px-2 py-1">
                        <option value="">Semua</option>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i ?>" <?= ($filter_bulan == $i) ? 'selected' : '' ?>>
                                <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Tahun</label>
                    <select name="tahun" class="border rounded px-2 py-1">
                        <option value="">Semua</option>
                        <?php for ($t = date('Y'); $t >= 2020; $t--): ?>
                            <option value="<?= $t ?>" <?= ($filter_tahun == $t) ? 'selected' : '' ?>><?= $t ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Terapkan</button>
                </div>
            </form>

        </div>
    </div>
</header>

