<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login Admin</h2>

    <?php if ($this->session->flashdata('error')): ?>
      <p class="mb-4 text-red-600 text-center"><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <form action="<?= site_url('auth/login') ?>" method="post" class="space-y-4">
      <div>
        <label class="block text-gray-600">Username</label>
        <input type="text" name="username" required class="w-full px-4 py-2 border rounded-lg">
      </div>
      <div>
        <label class="block text-gray-600">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg">
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
        Login
      </button>
    </form>
  </div>

</body>
</html>
